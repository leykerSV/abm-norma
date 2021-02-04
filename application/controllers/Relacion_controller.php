<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relacion_controller extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Relacion_model');
        $this->load->model('Norma_model');
        $this->config->set_item('language', 'spanish');
    }

    public function index()	{
        $this->check_log();
        $datos['tiponorma'] = $this->Norma_model->get_tiponorma();
        $datos['relaciones'] = $this->Relacion_model->get_relaciones();
		$this->load->view('Relacion_view',$datos);
    }

    
    public function crea_relacion() {
        $this->check_log();
        $this->form_validation->set_rules('tiponorma', 'Tipo de Norma', 'required');
        $this->form_validation->set_rules('nronorma', 'Numero de Norma', 'required');
        $this->form_validation->set_rules('relacion', 'Relacion', 'required');
        $this->form_validation->set_rules('tiponormar', 'Tipo de Norma', 'required');
        $this->form_validation->set_rules('nronormar', 'Numero de Norma', 'required');
        
        if($this->form_validation->run()){
            if($_POST['fecha']!=""){
                $inicio1 = strtotime($_POST['fecha']);
                $fff1 = date('Y-m-d',$inicio1);
                $_POST['fecha']=$fff1;
            } else {
                $_POST['fecha']=NULL;   
            }            
            $resp1 = $this->Relacion_model->insert_relacion($_POST);
            echo 'Relacion/es Ingresada con exito';
            echo '<br />';
            echo '<a href="https://abm-norma.concejosantotome.gob.ar/index.php/relaciones">Volver al inicio de Carga</a>';
        }else{
            $this->index();
        }        
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
	
}
