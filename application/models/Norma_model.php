<?php

class Norma_model extends CI_Model{

    public function get_tematican1(){
        $this->db->select('indice1, descripcion1');
        $this->db->from('Estructuratematicanivel1');
        $this->db->order_by('indice1', 'ASC');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return null;
        }
    }

    public function get_tematican2($idtematican1){
        $this->db->select('indice2, descripcion2');
        $this->db->from('Estructuratematicanivel2');
        $this->db->where('indice1', $idtematican1);
        $this->db->order_by('indice2', 'ASC');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return null;
        }
    }

    public function get_tiponorma(){
        $this->db->select('codigo, nombre');
        $this->db->from('Tiposdenormas');
        $this->db->order_by('codigo', 'ASC');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return null;
        }
    }

    public function insert_norma($datos){
        $this->db->set('numero', $datos['numnorma']);
        $this->db->set('tipo', $datos['tiponorma']);
        $this->db->set('expedientechm', $datos['expedientechm']);
        $this->db->set('expedientedem', $datos['expedientedem']);
        $this->db->set('fechasancion', $datos['fechasancion']);
        $this->db->set('fechapromulgacion', $datos['fechapromulgacion']);
        $this->db->set('origen', $datos['origen']);
        $this->db->set('autor', $datos['autor']);
        $this->db->set('contenido', $datos['contenido']);
        $this->db->set('caracter', $datos['caracter']);
        $this->db->set('alcance', $datos['alcance']);
        $this->db->set('nrocaja', $datos['nrocaja']);
        $this->db->set('nroorden', $datos['nroorden']);
        $this->db->set('observaciones', $datos['observaciones']);
        $this->db->set('archivo', $datos['archivo']);
        $this->db->set('archivoord', $datos['archivoord']);
        $this->db->insert('Normas');
        return true;
    }

    public function insert_normaestructuratematica($numnorma, $tiponorma, $numtematican1, $numtematican2){
        $this->db->set('numero', $numnorma);
        $this->db->set('tipo', $tiponorma);
        $this->db->set('indice1', $numtematican1);
        $this->db->set('indice2', $numtematican2);
        $this->db->insert('Normasestructuratematica');
        return true;
    }
}