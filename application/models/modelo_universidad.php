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
        
        function contar_universidedes(){
             $campos = array (
				"*"
 		);
            return $this->db->select($campos)
		->distinct()
		->from('universidad')
                ->get()
                ->result_array();
            //return $this->db->last_query();
        }
        
        function tabla_universidad( $sidx = 1, $sord = 1, $limit = 0, $start = 0){
           
            $campos = array (
				"*"
 		);
                return $this->db->select($campos)
		->distinct()
		->from('universidad')
                ->order_by($sidx, $sord)
                ->limit($limit, $start)
                ->get()
                ->result_array();
       
          }
          
          function insertar_universidad($nombre,$direecion){
            $data=array(
                'NombreUniversidad' => $nombre,
                'direccion' => $direecion
            );
            $this->db->insert('universidad', $data);
            return $this->db->insert_id();
        }
}