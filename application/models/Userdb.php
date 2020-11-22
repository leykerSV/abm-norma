<?php
  /**
  * Modulo de Usarios.
  *
  * 
  * @package     geasoft/Modulos
  * @copyright   Copyright (c) Leyker Soft - 2016
  * @license     https://www.leyker.com.ar/eb/licencia.txt
  * @version     1.0.0
  * @author      Leyker <dleyendeker@gmail.com>
  *
  * @Date 25-16-2016
  *
  */
Class Userdb extends CI_Model
{
 
 /**
    * Verifica El Usuario.
    * 
    * Determina si el usuario utilizó los datos correctos.
    * 
    * @author Leyker
    * @param string $username Nombre del Usuario.
    * @param string $password Pass del usuario.  
    * @return boolean Devuelve True si los datos son correctos.
    */    
 function login($username, $password)
 {
    date_default_timezone_set('America/Argentina/Cordoba');
    $this->load->database();    
    $this->db->select('id, nombre, email, username, password, nivel, habilitado');
    $this->db->from('users');
    $this->db->where('username = ' . "'" . $username . "'");
    $this->db->where('password = ' . "'" . MD5($password) . "'");
    $this->db->where('habilitado = ' . "'" . 1 . "'");
    $this->db->limit(1);

	 $query = $this->db->get();
    $a=$query->result();

    if($query->num_rows() == 1)
    {


        return $query->result();
    }
    else
    {
			return false;
    }
 }

 /**
    * Verifica El Usuario.
    * 
    * Determina si el usuario utilizó los datos correctos.
    * 
    * @author Leyker
    * @param string $username Nombre del Usuario.
    * @param string $password Pass del usuario.  
    * @return boolean Devuelve True si los datos son correctos.
    */    
    function notificaciones($idusuario)
    {
       date_default_timezone_set('America/Argentina/Cordoba');
       $this->load->database();    
       
       $this->db->select('*');
       $this->db->from('notificaciones');
       $this->db->where('idusuario = ' . "'" . $idusuario . "'");
       $this->db->where('leido = 0');
       $cantidad=$this->db->count_all_results();
       return $cantidad;
    }

    function traenotificaciones($idusuario)
    {
       date_default_timezone_set('America/Argentina/Cordoba');
       $this->load->database();    
       
       $this->db->select('*');
       $this->db->from('notificaciones');
       $this->db->where('idusuario = ' . "'" . $idusuario . "'");
       $this->db->where('leido = 0');
       $query = $this->db->get();
       return $query->result();
    }

    function marcarleido($id)
    {
        $this->db->where('id',$id);
        $this->db->set('leido', 1);
        return $this->db->update('notificaciones');
    }

    /*
     * function para agreagar una nueva notificacion
     */
    function add_notificaciones($params)
    {
        $this->db->insert('notificaciones',$params);
        return $this->db->insert_id();
    }

    
  
}    
