<?php

class Relacion_model extends CI_Model{

    public function get_relaciones(){
        $this->db->select('*');
        $this->db->from('Relacionesentrenormas');
        $this->db->where('codigo < 10');
        $this->db->order_by('codigo', 'ASC');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return null;
        }
    }


    public function insert_relacion($datos){
        $this->db->set('tiponorma', $datos['tiponorma']);
        $this->db->set('nronorma', $datos['nronorma']);
        $this->db->set('relacion', $datos['relacion']);
        $this->db->set('tiponormar', $datos['tiponormar']);
        $this->db->set('nronormar', $datos['nronormar']);
        $this->db->set('fecha', $datos['fecha']);
        $this->db->set('observacion', $datos['observacion']);
        $this->db->insert('Relacionentrenormas');
        return true;
    }

}