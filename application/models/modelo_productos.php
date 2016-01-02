<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class modelo_productos extends CI_Model
{
	public function construct()
	{
		parent::__construct();
	}
        function get_productos($producto){
            $this->db->order_by("idproductos","DESC");
            $this->db->where('tipo',$producto);
            $query=$this->db->get('productos');
            
            if($query->num_rows()>0){
                foreach ($query->result() as $fila){
                    $data[]=$fila;
                }
                return $data;
            }else{
                return false;
            }
        }
        function get_detalle_productos($idP){
            $this->db->where('idproductos',$idP);
            $query=$this->db->get('productos');
            
            if($query->num_rows()>0){
                foreach ($query->result() as $fila){
                    $data[]=$fila;
                }
                return $data;
            }else{
                return false;
            }
        }
        function modificarProducto($id,$NombreProd, $DescripcionPro, $ImagenPro){
            if($ImagenPro!=""){
                $data=array(
                    'NombreProd' => $NombreProd,
                    'DescripcionPro' => $DescripcionPro,
                    'ImagenPro' => $ImagenPro
                    
                );
            }else{
                $data=array(
                    'NombreProd' => $NombreProd,
                    'DescripcionPro' => $DescripcionPro
                    
                );
            }
            
            $this->db->where('idproductos', $id);
            return$this->db->update('productos', $data);
            
        }
        function insertarProducto($NombreProd, $DescripcionPro, $ImagenPro,$tipo){
            $data=array(
                'NombreProd' => $NombreProd,
                'DescripcionPro' => $DescripcionPro,
                'ImagenPro' => $ImagenPro,
                'tipo' => $tipo
            );
            return $this->db->insert('productos', $data);
        }
        function solicitar_presupuesto_Producto($data){
            $this->db->trans_start();
            $this->db->insert('notificacion', $data);
            
            $tablaNotificacionesMensajes=array(
                'mensaje' => $this->input->post("Iadicional"),
                'idNotificaciones' => $this->db->insert_id(),
                'fecha' => date("Y-m-d")
            );
            $this->db->insert('notificaciones_mesajes', $tablaNotificacionesMensajes);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return "No se Pudo Completar la Solicitud";
            }else{
                return "Solicitud Enviada";
            }
	
            //return "yordy ".$data['cantidad']." ".$data['informacion']." ".$data['id']." ".$data['tipo']." ".$this->session->userdata('id_usuario')." ".date("Y-m-d");
        }
        function contar_presupuestos($tipo){
             if($tipo=="anillos"){
                    $tipoD="ANILLO";
                }else if($tipo=="medallas"){
                    $tipoD="MEDALLA";
                }else if($tipo=="titulo"){
                    $tipoD="TITULO";
                }else if($tipo=="album"){
                    $tipoD="ALBUM";
                }
                $campos = array (
				"idNotificacion AS id"
 		);
            return $this->db->select($campos)
		->distinct()
		->from('notificacion as notif')
                ->join('productos AS prod', 'prod.idproductos = notif.productos_idproductos', 'LEFT')
                ->where ('usuario_ci_usuario', $this->session->userdata('id_usuario'))
                ->where ('prod.tipo', strtoupper($tipoD))
                
                ->get()
                ->result_array();
            //return $this->db->last_query();
        }
        function tabla_listar_presupuestos($tipo, $sidx = 1, $sord = 1, $limit = 0, $start = 0){
            if($tipo=="anillos"){
                    $tipoD="ANILLO";
                }else if($tipo=="medallas"){
                    $tipoD="MEDALLA";
                }else if($tipo=="titulo"){
                    $tipoD="TITULO";
                }else if($tipo=="album"){
                    $tipoD="ALBUM";
                }
            $campos = array (
				"*"
 		);
                 return $this->db->select($campos)
		->distinct()
		->from('notificacion as notif')
                ->join('productos AS prod', 'prod.idproductos = notif.productos_idproductos', 'LEFT')
                ->where ('usuario_ci_usuario', $this->session->userdata('id_usuario'))
                ->where ('prod.tipo', strtoupper($tipoD))
                ->order_by($sidx, $sord)
                ->limit($limit, $start)
                ->get()
                ->result_array();
            /*$result = $this->db->select($fields)
				->distinct()
				->from('solicitud_documentos AS sd')
				->join('documentos_solicitud_documentos AS dsd', 'dsd.id_solicitud_documento = sd.id', 'LEFT')
                                ->join('documentos AS d', 'd.id = dsd.id_documento', 'LEFT')
                                ->join('archivos_tipos AS at', 'at.id = d.tipo', 'LEFT')
                                ->join('usuarios AS usu', 'usu.id = dsd.id_usuario', 'LEFT')
				->where($clause)
				->get()->result();*/
        }
        function insertar_solicitud_presupuesto($idPaquete, $cedulaUsu, $numG){
            $data=array(
                'numero_graduandos' => $numG,
                'idpaquetes_grados' => $idPaquete,
                'ci_usuario' => $cedulaUsu,
                'estatus' => 'ENVIADO'
            );
            return $this->db->insert('solicitud_presupuesto', $data);
        }
        function contar_solicitud_presupuesto(){
             $campos = array (
				"*"
 		);
            return $this->db->select($campos)
		->distinct()
		->from('solicitud_presupuesto')
                ->where ('ci_usuario', $this->session->userdata('id_usuario'))
                ->get()
                ->result_array();
            //return $this->db->last_query();
        }
        function tabla_solicitud_presupuesto( $sidx = 1, $sord = 1, $limit = 0, $start = 0){
           
            $campos = array (
				"*"
 		);
                return $this->db->select($campos)
		->distinct()
		->from('solicitud_presupuesto as sp')
                ->join('paquetes_grados AS pqtg', 'pqtg.idpaquetes_grados = sp.idpaquetes_grados', 'LEFT')
                ->where ('ci_usuario', $this->session->userdata('id_usuario'))
                ->order_by($sidx, $sord)
                ->limit($limit, $start)
                ->get()
                ->result_array();
       
            /*$result = $this->db->select($fields)
				->distinct()
				->from('solicitud_documentos AS sd')
				->join('documentos_solicitud_documentos AS dsd', 'dsd.id_solicitud_documento = sd.id', 'LEFT')
                                ->join('documentos AS d', 'd.id = dsd.id_documento', 'LEFT')
                                ->join('archivos_tipos AS at', 'at.id = d.tipo', 'LEFT')
                                ->join('usuarios AS usu', 'usu.id = dsd.id_usuario', 'LEFT')
				->where($clause)
				->get()->result();*/
        }
        
        function get_datos_notificaciones($id){
           
            $campos = array (
				"*"
 		);
                $data = $this->db->select($campos)
		->distinct()
		->from('notificacion as notf')
                ->join('productos AS prod', 'prod.idproductos = notf.productos_idproductos', 'LEFT')
                ->join('usuario AS usu', 'usu.ci_usuario = notf.usuario_ci_usuario', 'LEFT')
                ->join('universidad AS uni', 'uni.idUniversidad = usu.institucion', 'LEFT')
                ->where ('notf.idNotificacion', $id)
                ->get()
                ->result();
                $data = $data['0'];
                
                if($data){
                    $data->mensajes = $this->get_mensajes_notificaciones($data->idNotificacion );
                    
                }
                
                return $data;
                
        }
        
        function get_mensajes_notificaciones($id){
                $campos = array (
				"*"
 		);
                $data = $this->db->select($campos)
		->distinct()
		->from('notificaciones_mesajes as msj')
                ->join('usuario AS usu', 'usu.ci_usuario = msj.usuario_ci_usuario', 'LEFT')
                ->where ('msj.idNotificaciones', $id)
                ->get()
                ->result();
                return $data;
        }
        function ajax_get_mensajes_notificaciones($id){
                $campos = array (
				"*"
 		);
                $data = $this->db->select($campos)
		->distinct()
		->from('notificaciones_mesajes as msj')
                ->join('usuario AS usu', 'usu.ci_usuario = msj.usuario_ci_usuario', 'LEFT')
                ->where ('msj.idNotificaciones', $id)
                ->get()
                ->result_array();
                return !empty($data) ? $data : array();
        }
        function ajax_insertar_mensaje_notificacion($data){
            $this->db->trans_start();
            
            
            $tablaNotificacionesMensajes=array(
                'mensaje' => $data['mensaje'],
                'idNotificaciones' => $data['idnotific'],
                'fecha' => date("Y-m-d"),
                'usuario_ci_usuario' => $data['ci_usuario']
            );
            $this->db->insert('notificaciones_mesajes', $tablaNotificacionesMensajes);
            $this->db->trans_complete();
            
                return $this->db->trans_status();
            
	
            //return "yordy ".$data['cantidad']." ".$data['informacion']." ".$data['id']." ".$data['tipo']." ".$this->session->userdata('id_usuario')." ".date("Y-m-d");
        }
        
        function get_datos_presupuesto_paquetes($id){
           
            $campos = array (
				"*"
 		);
                $data = $this->db->select($campos)
		->distinct()
		->from('solicitud_presupuesto as sp')
                ->join('usuario AS usu', 'usu.ci_usuario = sp.ci_usuario', 'LEFT')
                ->where ('sp.idsolicitud_presupuesto', $id)
                ->get()
                ->result();
                $data = $data['0'];
                
                
                return $data;
                
        }
        function contar_todas_notificaciones(){
                $campos = array (
				"*"
 		);
                $num = $this->db->select($campos)
		->distinct()
		->from('notificacion')
                ->where ('estatus', 'Enviado')
                ->get()
                ->num_rows();
                
                
                
                return $num;
        }
        function get_notificaciones(){
             
                $campos = array (
				"*"
 		);
            return $this->db->select($campos)
		->distinct()
		->from('notificacion as notif')
                ->join('productos AS prod', 'prod.idproductos = notif.productos_idproductos', 'LEFT')
                ->where ('estatus', 'Enviado')
                ->get()
                ->result_array();
            //return $this->db->last_query();
        }
}