<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador INICIO
 *
 * Desde aquí comienza a ejecutarse el programa.
 *
 * 
 * @package     geasoft/Controladores
 * @copyright   Copyright (c) Leyker Soft - 2016
 * @license     https://www.leyker.com.ar/eb/licencia.txt
 * @version     1.0.0
 * @author      Leyker <dleyendeker@gmail.com>
 *
 * @Date 06/08/2013
 *
 */
class Inicio extends CI_Controller {
  
    
    /**
    * Verifica si una direccion de correo es correcta o no.
    *
    * @return boolean true si la direccion es correcta
    * @param string $email direccion de correo
    */
    public function index()       
    {
						$datos['titulo']="ABM Digesto Santo Tome";
						$this->load->view('login/headerlogin',$datos);
						$this->load->view('login/login');
						$this->load->view('login/footer');
    }
		
    /**
    * Logue al Usuario.
    * 
    * Llama a la funcion check_database 
    * 
    * @author Leyker
    * @return boolean true si es correcto
    */
    public function verifylogin()
    {
        if($this->check_database() == TRUE)
        {
          redirect('abmnorma', 'refresh');

        }else{
          $this->session->set_flashdata('error_msg', 'Error al loguearse. Verifique los datos.');
          redirect(base_url(), 'refresh');
        }
    }
        
    
    /**
    * Chequea en la BBDD.
    * 
    * Control los datos del usuario
		* 
		
    * @author Leyker
    * @param string $password La clave del usuario 
    * @return boolean true si es correcto
    */
    function check_database()
    {
      $this->load->model('userdb','',TRUE); 
      //Field validation succeeded.  Validate against database
      $username = $this->input->post('username');
      $password=$this->input->post('password');
      //query the database
      $result = $this->userdb->login($username, $password);

      if($result)
      {
        $sess_array = array();
        $this->load->model('userdb',true);
        foreach($result as $row)
        {
         $sess_array = array(
            'id' => $row->id,
            'nombrecompleto' => $row->nombre,
            'email' => $row->email,
            'username' => $row->username,
            'nivel'=> $row->nivel,
						'habilitado'=> $row->habilitado,
						'email'=> $row->email,
            'logueado'=>TRUE,
          );
          $this->session->set_userdata($sess_array);
        }
        return TRUE;
      }
      else
      {
        $this->session->unset_userdata('userdata');
        return FALSE;
      }
    }

    function todos_admin()
    {
        $this->check_log();
        $this->load->model('userdb','',TRUE);
        $notes=$this->userdb->notificaciones($this->session->userdata('id'));
        $this->session->notificaciones=$notes;
        $this->load->model('trabajosdb','',TRUE);       
        
        $restrabajos = $this->trabajosdb->admin_trabajos('BORRADOR');
        $trabajos['listaBorrador'] = json_decode(json_encode($restrabajos), True);
        $restrabajos = $this->trabajosdb->admin_trabajos('REVISION');
        $trabajos['listaRevision'] = json_decode(json_encode($restrabajos), True);
        $restrabajos = $this->trabajosdb->admin_trabajos('APROBACION');
        $trabajos['listaAprobacion'] = json_decode(json_encode($restrabajos), True);
        $restrabajos = $this->trabajosdb->admin_trabajos('A PUBLICAR');
        $trabajos['listaApublicar'] = json_decode(json_encode($restrabajos), True);
        $restrabajos = $this->trabajosdb->admin_trabajos('PUBLICADO');
        $trabajos['listaPublicados'] = json_decode(json_encode($restrabajos), True);
     
        $this->load->model('User_model');
        $trabajos['all_users'] = $this->User_model->get_all_users();
        
				$data['titulo']="TODOS LOS DOCUMENTOS";
				$data['encabezado']="Documentos Asignados";
        $data['nivel']=$this->session->userdata('nivel');
        $data['nombre']=$this->session->userdata('nombre');
        $data['id']=$this->session->userdata('id');
        $data['_view'] = $this->load->view('principal/tablaadmin',$trabajos, true);
        
        $this->load->view('templates/header',$data);
        $this->load->view('principal/main2');
        $this->load->view('templates/footer');
    } 
      
    
    function bienvenido()
    {
        $this->check_log();
        $this->load->model('userdb','',TRUE);
        $notes=$this->userdb->notificaciones($this->session->userdata('id'));
        $this->session->notificaciones=$notes;
        $this->load->model('trabajosdb','',TRUE);       
        $restrabajos = $this->trabajosdb->trabajos($this->session->userdata('id'), 'BORRADOR');
        $trabajos['listaBorrador'] = json_decode(json_encode($restrabajos), True);
        $restrabajos = $this->trabajosdb->trabajos($this->session->userdata('id'), 'REVISION');
        $trabajos['listaRevision'] = json_decode(json_encode($restrabajos), True);
        $restrabajos = $this->trabajosdb->trabajos($this->session->userdata('id'), 'APROBACION');
        $trabajos['listaAprobacion'] = json_decode(json_encode($restrabajos), True);
        $restrabajos = $this->trabajosdb->trabajos($this->session->userdata('id'), 'A PUBLICAR');
        $trabajos['listaApublicar'] = json_decode(json_encode($restrabajos), True);
        $restrabajos = $this->trabajosdb->trabajos($this->session->userdata('id'), 'PUBLICADO');
        $trabajos['listaPublicados'] = json_decode(json_encode($restrabajos), True);
     
				$data['titulo']="Documental Cocyar";
				$data['encabezado']="Documentos Asignados";
        $data['nivel']=$this->session->userdata('nivel');
        $data['nombre']=$this->session->userdata('nombre');
        $data['id']=$this->session->userdata('id');
        $data['_view'] = $this->load->view('principal/tabla',$trabajos, true);
        
        $this->load->view('templates/header',$data);
        $this->load->view('principal/main2');
        $this->load->view('templates/footer');
    } 
      
    
    /**
    * Chequea que la sesión esté iniciada
    * Usarla antes de ejecutar un método de un controller
    * 
    * @author Leyker
    */
    private function check_log (){
    if($this->session->userdata('logueado') == FALSE){
        redirect(base_url(), 'refresh');    
    }
    }


    public function revisados(){
      $this->check_log();
      $this->load->model('userdb','',TRUE);
      $notes=$this->userdb->notificaciones($this->session->userdata('id'));
      $this->session->notificaciones=$notes;
      // check if the trabajo exists before trying to edit it
      $this->load->library('form_validation');

      $this->form_validation->set_rules('usuarioid','Usuario','required');
      $this->form_validation->set_rules('areaid','Area','required');
 
      if($this->form_validation->run()){
        $this->load->model('trabajosdb','',TRUE);
        $restrabajos = $this->trabajosdb->trabajosrevisados($this->input->post('usuarioid'), $this->input->post('areaid'), $this->input->post('busqueda'));
        $data['listaPublicados'] = json_decode(json_encode($restrabajos), True);
      }  
              $this->load->model('User_model');
              $data['all_users'] = $this->User_model->get_all_users();

              $this->load->model('Area_model');
              $data['all_areas'] = $this->Area_model->get_all_areas();

              $this->load->model('Departamento_model');
              $data['all_deptos'] = $this->Departamento_model->get_all_departamentos();

              $data['titulo']="Documental Cocyar";
              $data['encabezado']="Revisiones de Documentos";
              $data['nivel']=$this->session->userdata('nivel');
              $data['nombre']=$this->session->userdata('nombre');
              $data['id']=$this->session->userdata('id');
              $data['_view'] = $this->load->view('principal/revisados', $data, true);
              
              $this->load->view('templates/header',$data);
              $this->load->view('principal/main2');
              $this->load->view('templates/footer');
      
          }
    
    public function publicados(){
      $this->check_log();
      $this->load->model('userdb','',TRUE);
      $notes=$this->userdb->notificaciones($this->session->userdata('id'));
      $this->session->notificaciones=$notes;
      // check if the trabajo exists before trying to edit it
      $this->load->library('form_validation');

      $this->form_validation->set_rules('usuarioid','Usuario','required');
      $this->form_validation->set_rules('areaid','Area','required');
 
      if($this->form_validation->run()){
        $this->load->model('trabajosdb','',TRUE);
        $restrabajos = $this->trabajosdb->trabajospublicados($this->input->post('usuarioid'), $this->input->post('areaid'), $this->input->post('busqueda'),$this->input->post('iddeptos'));
        $data['listaPublicados'] = json_decode(json_encode($restrabajos), True);
      }  
              $this->load->model('User_model');
              $data['all_users'] = $this->User_model->get_all_users();

              $this->load->model('Area_model');
              $data['all_areas'] = $this->Area_model->get_all_areas();

              $this->load->model('Departamento_model');
              $data['all_deptos'] = $this->Departamento_model->get_all_departamentos();

              $data['titulo']="Documental Cocyar";
              $data['encabezado']="Documentos Vigentes";
              $data['nivel']=$this->session->userdata('nivel');
              $data['nombre']=$this->session->userdata('nombre');
              $data['id']=$this->session->userdata('id');
              $data['_view'] = $this->load->view('principal/publicados', $data, true);
              
              $this->load->view('templates/header',$data);
              $this->load->view('principal/main2');
              $this->load->view('templates/footer');
      
          }

          public function admin_documentos(){
            $this->check_log();
            $this->load->model('userdb','',TRUE);
            $notes=$this->userdb->notificaciones($this->session->userdata('id'));
            $this->session->notificaciones=$notes;
            // check if the trabajo exists before trying to edit it
            $this->load->library('form_validation');
      
            $this->form_validation->set_rules('usuarioid','Usuario','required');
            $this->form_validation->set_rules('areaid','Area','required');
       
            if($this->form_validation->run()){
              $this->load->model('trabajosdb','',TRUE);
              $restrabajos = $this->trabajosdb->admin_trabajos();
              $data['listaTrabajos'] = json_decode(json_encode($restrabajos), True);
            }  
                    $this->load->model('User_model');
                    $data['all_users'] = $this->User_model->get_all_users();
      
                    $this->load->model('Area_model');
                    $data['all_areas'] = $this->Area_model->get_all_areas();

                    $this->load->model('Departamento_model');
                    $data['all_deptos'] = $this->Departamento_model->get_all_departamentos();
      
                    $data['titulo']="Documental Cocyar";
                    $data['encabezado']="Administración de Documentos";
                    $data['nivel']=$this->session->userdata('nivel');
                    $data['nombre']=$this->session->userdata('nombre');
                    $data['id']=$this->session->userdata('id');
                    $data['_view'] = $this->load->view('principal/admin_documentos', $data, true);
                    
                    $this->load->view('templates/header',$data);
                    $this->load->view('principal/main2');
                    $this->load->view('templates/footer');
            
                }

          public function historicos(){
            $this->check_log();
            $this->load->model('userdb','',TRUE);
            $notes=$this->userdb->notificaciones($this->session->userdata('id'));
            $this->session->notificaciones=$notes;
            // check if the trabajo exists before trying to edit it
            $this->load->library('form_validation');
      
            $this->form_validation->set_rules('usuarioid','Usuario','required');
            $this->form_validation->set_rules('areaid','Area','required');
       
            if($this->form_validation->run()){
              $this->load->model('trabajosdb','',TRUE);
              $restrabajos = $this->trabajosdb->trabajoshistoricos($this->input->post('usuarioid'), $this->input->post('areaid'));
              $data['listaHistoricos'] = json_decode(json_encode($restrabajos), True);
            }  
                    $this->load->model('User_model');
                    $data['all_users'] = $this->User_model->get_all_users();
      
                    $this->load->model('Area_model');
                    $data['all_areas'] = $this->Area_model->get_all_areas();

                    $this->load->model('Departamento_model');
                    $data['all_deptos'] = $this->Departamento_model->get_all_departamentos();
      
                    $data['titulo']="Documental Cocyar";
                    $data['encabezado']="Documentos Históricos";
                    $data['nivel']=$this->session->userdata('nivel');
                    $data['nombre']=$this->session->userdata('nombre');
                    $data['id']=$this->session->userdata('id');
                    $data['_view'] = $this->load->view('principal/historicos', $data, true);
                    
                    $this->load->view('templates/header',$data);
                    $this->load->view('principal/main2');
                    $this->load->view('templates/footer');
            
                }

          public function cancelados(){
            $this->check_log();
            $this->load->model('userdb','',TRUE);
            $notes=$this->userdb->notificaciones($this->session->userdata('id'));
            $this->session->notificaciones=$notes;
            // check if the trabajo exists before trying to edit it
            $this->load->library('form_validation');
      
            $this->form_validation->set_rules('usuarioid','Usuario','required');
            $this->form_validation->set_rules('areaid','Area','required');
       
            if($this->form_validation->run()){
              $this->load->model('trabajosdb','',TRUE);
              $restrabajos = $this->trabajosdb->trabajoscancelados($this->input->post('usuarioid'), $this->input->post('areaid'));
              $data['listaCancelados'] = json_decode(json_encode($restrabajos), True);
            }  
                    $this->load->model('User_model');
                    $data['all_users'] = $this->User_model->get_all_users();
      
                    $this->load->model('Area_model');
                    $data['all_areas'] = $this->Area_model->get_all_areas();

                    $this->load->model('Departamento_model');
                    $data['all_deptos'] = $this->Departamento_model->get_all_departamentos();
      
                    $data['titulo']="Documental Cocyar";
                    $data['encabezado']="Documentos Cancelados";
                    $data['nivel']=$this->session->userdata('nivel');
                    $data['nombre']=$this->session->userdata('nombre');
                    $data['id']=$this->session->userdata('id');
                    $data['_view'] = $this->load->view('principal/cancelados', $data, true);
                    
                    $this->load->view('templates/header',$data);
                    $this->load->view('principal/main2');
                    $this->load->view('templates/footer');
            
                }

    public function notificaciones(){
      $this->check_log();
      $this->load->model('userdb','',TRUE);
      $notes=$this->userdb->notificaciones($this->session->userdata('id'));
      $this->session->notificaciones=$notes;

      $restrabajos = $this->userdb->traenotificaciones($this->session->userdata('id'));
      $data['listaNotificaciones'] = json_decode(json_encode($restrabajos), True);         
      $data['titulo']="Documental Cocyar";
      $data['encabezado']="Notificaciones Sin Leer";
      $data['nivel']=$this->session->userdata('nivel');
      $data['nombre']=$this->session->userdata('nombre');
      $data['id']=$this->session->userdata('id');
      $data['_view'] = $this->load->view('principal/notificaciones', $data, true);
                          
      $this->load->view('templates/header',$data);
      $this->load->view('principal/main2');
      $this->load->view('templates/footer');
    }

    /**
    * Cierra la sesión abierta.
    * y te lleva al inicio
    */
    public function logout()
    {
        $this->check_log();
        $this->session->sess_destroy();
        redirect (base_url(),'refresh');
    }
        
}



