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
        function modificar_universidedes($data,$id){
            
            $this->db->where('idUniversidad', $id);
            return $this->db->update('universidad', $data);
        }
        
        function contar_universidedes($filtro){
             $campos = array (
				"*"
 		);
             $result = $this->db
                    ->select($campos)
                    ->distinct()
		    ->from('universidad');
             $result = $this->filtro_universidad($filtro);
             
             $result = $this->db
                    ->get()
                    ->result_array();
            return $result;
            //return $this->db->last_query();
        }
        
        function filtro_universidad($filtro){
            if(isset($filtro["nombre"])){
                 $this->db->like('NombreUniversidad', $filtro["nombre"]);
             }
             
             if(isset($filtro["direccion"])){
                 $this->db->like('direccion', $filtro["direccion"]);
             }
             
             if(isset($filtro["estado"])){
                 if($filtro["estado"]==2){
                     $filtro["estado"]=0;
                 }
                 $this->db->where('estado', $filtro["estado"]);
             }
        }
                
        function tabla_universidad($filtro, $sidx = 1, $sord = 1, $limit = 0, $start = 0){
           
            $campos = array (
				"*"
 		);
            
            $result = $this->db
                    ->select($campos)
                    ->distinct()
		    ->from('universidad');
             $result = $this->filtro_universidad($filtro);
             
             $result = $this->db
                    ->order_by($sidx, $sord)
                    ->limit($limit, $start)
                    ->get()
                    ->result_array();
            return $result;
          }
          
          function insertar_universidad($nombre,$direecion){
            $data=array(
                'NombreUniversidad' => $nombre,
                'direccion' => $direecion
            );
            $this->db->insert('universidad', $data);
            return $this->db->insert_id();
        }
        function insertar_actividad_cronograma($data){
            
            return $this->db->insert('actividades', $data);
        }
        function insertar_cronograma($data){
            
            $this->db->insert('cronograma', $data);
            return $this->db->insert_id();
        }
        function contar_cronogramas($filtro){
             $campos = array (
				"*"
 		);
             $result = $this->db
                    ->select($campos)
                    ->distinct()
		    ->from('cronograma');
             //$result = $this->filtro_universidad($filtro);
             
             $result = $this->db
                    ->get()
                    ->result_array();
            return $result;
            //return $this->db->last_query();
        }
        function tabla_cronogramas($filtro, $sidx = 1, $sord = 1, $limit = 0, $start = 0){
           
            $campos = array (
				"*"
 		);
            
            $result = $this->db
                    ->select($campos)
                    ->distinct()
		    ->from('cronograma')
                    ->join('universidad AS uni', 'uni.idUniversidad = cronograma.Universidad_idUniversidad', 'LEFT');
             //$result = $this->filtro_universidad($filtro);
             
             $result = $this->db
                    ->order_by($sidx, $sord)
                    ->limit($limit, $start)
                    ->get()
                    ->result_array();
            return $result;
          }
          function get_cronograma($id){
            
            $campos = array ( 
				"*"
 		);
                $data = $this->db->select($campos)
		
		->from('cronograma')
                ->where ('id_Cronograma', $id)
                ->get();
            
            if($data){
                return $data->result_array();
            }else{
                return false;
            }
            
        }
        function get_cronograma_actividades($id){
            
            $campos = array ( 
				"*"
 		);
                $data = $this->db->select($campos)
		
		->from('actividades')
                ->where ('id_Cronograma', $id)
                ->get();
            
            if($data){
                return $data->result_array();
            }else{
                return false;
            }
            
        }
        function modificar_cronograma($data,$id){
            
            $this->db->where('id_Cronograma', $id);
            return $this->db->update('cronograma', $data);
        }
        function eliminar_actividades($id){
            $this->db->where('id_Cronograma', $id);
            $this->db->delete('actividades');
        }
}