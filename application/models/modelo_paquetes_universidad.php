<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class modelo_paquetes_universidad extends CI_Model
{
	public function construct()
	{
		parent::__construct();
	}
        function get_paquetes_grados(){
            $query=$this->db->get('paquete');
            if($query->num_rows()>0){
                foreach ($query->result() as $fila){
                    $data[]=$fila;
                }
                return $data;
            }else{
                return false;
            }
        }
        function insertar_paquetes_grados($NombrePaquete,$informacion,$monto,$fecha_tope_contrato,$numgraduand){
            $data=array(
                'NombrePaquete' => $NombrePaquete,
                'informacion' => $informacion,
                'monto' => $monto,
                'fecha_tope_contrato' => $fecha_tope_contrato,
                'numgraduand' => $numgraduand
            );
            $res= $this->db->insert('paquete', $data);
            
            
            return $this->db->insert_id();
        }
        function insertar_productos_paquetes($paquete_idPaquete,$almacen_idalmacen){
            $data=array(
                'paquete_idPaquete' => $paquete_idPaquete,
                'almacen_idalmacen' => $almacen_idalmacen
            );
            $res= $this->db->insert('paquete_productos', $data);
            return $res;
        }
        function get_productos_paquete($id){
            $this->db->where('idpaquetes_grados',$id);
            $this->db->where('grados_idpaquetes_grados=idpaquetes_grados');
            $this->db->where('almacen_idalmacen=idalmacen');
            $query=$this->db->get('paquetes_grados,almacen,productos_pqt');
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