<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Norma_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Norma_model');
        $this->config->set_item('language', 'spanish');
    }

    public function index()	{
        $datos['tematican1'] = $this->Norma_model->get_tematican1();
        $datos['tiponorma'] = $this->Norma_model->get_tiponorma();
		$this->load->view('Norma_view',$datos);
    }

    public function get_tematican2() {
        $data_post = $this->input->post();
        $datos = $this->Norma_model->get_tematican2($data_post['idtematican1']);
        echo json_encode($datos);
    }
    
    public function crea_norma() {
        $this->form_validation->set_rules('numnorma', 'N° Norma', 'required|min_length[4]|numeric');
        $this->form_validation->set_rules('tiponorma', 'Tipo de Norma', 'required');
        $this->form_validation->set_rules('expedientechm', 'Expediente HCM', 'required');
        $this->form_validation->set_rules('expedientedem', 'Expediente DEM', 'required');
        $this->form_validation->set_rules('tematican1', 'Tematica de Nivel 1', 'required');
        $this->form_validation->set_rules('tematican2', 'Tematica de Nivel 2', 'required');
        $this->form_validation->set_rules('fechasancion', 'Fecha de Sanción', 'required');
        $this->form_validation->set_rules('fechapromulgacion', 'Fecha de Promulgación', 'required');
        $this->form_validation->set_rules('origen', 'Origen', 'required');
        $this->form_validation->set_rules('autor', 'Autor', 'required');
        $this->form_validation->set_rules('contenido', 'Contenido', 'required');
        $this->form_validation->set_rules('caracter', 'Caracter', 'required');
        $this->form_validation->set_rules('alcance', 'Alcance', 'required');
        $this->form_validation->set_rules('nrocaja', 'N° Caja', 'required|min_length[4]|numeric');
        $this->form_validation->set_rules('nroorden', 'N° Orden', 'required|min_length[4]|numeric');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'required');
        $this->form_validation->set_rules('nrocaja', 'N° Caja', 'required');
        
        chdir('..');
        chdir('normas');
        $directorio=getcwd()."/";
        if ($_FILES['archivo']['name']==null){
                
        }else{
            $fichero_subido = $directorio . basename($_FILES['archivo']['name']);
            $nombrearchivo=basename($_FILES['archivo']['name']);
            move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido);
        }

        if ($_FILES['archivoord']['name']==null){
                
        }else{
            $fichero_subido = $directorio . basename($_FILES['archivoord']['name']);
            $nombrearchivoord=basename($_FILES['archivoord']['name']);
            move_uploaded_file($_FILES['archivoord']['tmp_name'], $fichero_subido);
        }

        $_POST['archivo']=$nombrearchivo;
        $_POST['archivoord']=$nombrearchivoord;
        
        if($this->form_validation->run()){            
            $resp1 = $this->Norma_model->insert_norma($_POST);
            $resp2 = $this->Norma_model->insert_normaestructuratematica($_POST['numnorma'], $_POST['tiponorma'],$_POST['tematican1'], $_POST['tematican2']);
            echo 'Norma Ingresada con exito';
        }else{
            $this->index();
        }        
	}
}