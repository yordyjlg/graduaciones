<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class modelo_almacen extends CI_Model
{
	public function construct()
	{
		parent::__construct();
	}
        function get_productos(){
            $this->db->order_by("idalmacen","DESC");
            $query=$this->db->get('almacen');
            if($query->num_rows()>0){
                foreach ($query->result() as $fila){
                    $data[]=$fila;
                }
                return $data;
            }else{
                return false;
            }
        }
        function insertar_productos($nombre,$cantidad,$precio){
            $data=array(
                'nombre_producto' => $nombre,
                'cantidad' => $cantidad,
                'precio' => $precio
            );
            $res= $this->db->insert('almacen', $data);
            return $res;
        }
        function modificar_Producto($id,$nombre,$cantidad,$precio){
            
                $data=array(
                    'nombre_producto' => $nombre,
                    'cantidad' => $cantidad,
                    'precio' => $precio
                    
                );
           
            
            $this->db->where('idalmacen', $id);
            return $this->db->update('almacen', $data);
            
        }
       function get_detalle_productos($idP){
            $this->db->where('idalmacen',$idP);
            $query=$this->db->get('almacen');
            
            if($query->num_rows()>0){
                foreach ($query->result() as $fila){
                    $data[]=$fila;
                }
                return $data;
            }else{
                return false;
            }
        }
}