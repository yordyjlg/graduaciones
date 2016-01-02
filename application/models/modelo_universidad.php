<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class modelo_universidad extends CI_Model
{
	public function construct()
	{
		parent::__construct();
	}
        function get_universidedes(){
            $this->db->order_by("NombreUniversidad","ASC");
            $query=$this->db->get('universidad');
            if($query->num_rows()>0){
                foreach ($query->result() as $fila){
                    $data[]=$fila;
                }
                return $data;
            }else{
                return false;
            }
        }
        function modificar_universidedes($campo,$valor,$id){
            
                $data=array(
                    $campo => $valor
                    
                );
            
            
            $this->db->where('idUniversidad', $id);
            return$this->db->update('universidad', $data);
        }
}