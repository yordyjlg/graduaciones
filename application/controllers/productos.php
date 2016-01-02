<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class productos extends CI_Controller 
{
        function __construct() 
	{   //en el constructor cargamos nuestro modelo
		parent::__construct();
                $this->load->model('modelo_productos');
                $this->load->model('modelo_paquetes_grados');
                $this->load->model('modelo_almacen');
		
	}
	
        public function index()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            
        }
        function anillos()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('ANILLO');
           $data['tipo']= "anillos";
           $data['menu']='menus/administrador'; 
           $data['contenido']='administrador/vista_productos';
           $data['cargar']= 0;
           $this->load->view("template",$data);
           
        }
        function medallas()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('MEDALLA');
           $data['tipo']= "medallas";
           $data['menu']='menus/administrador'; 
           $data['contenido']='administrador/vista_productos';
           $data['cargar']= 0;
           $this->load->view("template",$data);
        }
        function portaTitulos()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('TITULO');
           $data['tipo']= "titulo";
           $data['menu']='menus/administrador'; 
           $data['contenido']='administrador/vista_productos';
           $data['cargar']= 0;
           $this->load->view("template",$data);
        }
        function album()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('ALBUM');
           $data['tipo']= "album";
           $data['menu']='menus/administrador'; 
           $data['contenido']='administrador/vista_productos';
           $data['cargar']= 0;
           $this->load->view("template",$data);
        }
        function paquetes()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $data['paquetes']= $this->modelo_paquetes_grados->get_paquetes_grados();
            $data['productosAlmc']= $this->modelo_almacen->get_productos();
            $data['menu']='menus/administrador'; 
            $data['contenido']='administrador/vista_paquetes'; 
            $this->load->view("template",$data);
        }
        
        function detallesProducto()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $idP = $this->input->get("idP");
            $data['productos']= $this->modelo_productos->get_detalle_productos($idP);
            $this->load->view("administrador/vista_detalle_producto",$data);
        }
        function modificarProducto()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $nombre = $this->input->post("nombreM");
            $descripcion = $this->input->post("descripcionM");
            $tipo = $this->input->post("tipoM");
            $id = $this->input->post("idM");
            $tipoD="";
                if($tipo=="anillos"){
                    $tipoD="ANILLO";
                }else if($tipo=="medallas"){
                    $tipoD="MEDALLA";
                }else if($tipo=="titulo"){
                    $tipoD="TITULO";
                }else if($tipo=="album"){
                    $tipoD="ALBUM";
                }
                $ruta='./imagenes/'.$tipo.'/';
                $config['upload_path'] = $ruta;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2000';
                $config['max_width'] = '4320';
                $config['max_height'] = '3240';
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('portraitM'))
                {
                    $this->modelo_productos->modificarProducto($id,$nombre,$descripcion,"");
                   
                }else{
                    $file_info = $this->upload->data();
                    $imagen = $file_info['file_name'];
                    $this->_create_thumbnail($file_info['file_name'],$ruta);
                    $this->modelo_productos->modificarProducto($id,$nombre,$descripcion,$imagen);
                }
            $this->modelo_productos->modificarProducto($id,$nombre,$descripcion,"");
            $data['productos']= $this->modelo_productos->get_productos($tipoD);
            $data['tipo']= $tipo;
            $data['cargar']= 1;
            $this->load->view("administrador/vista_productos",$data);
        }
        function ingresarPaqueteGrado()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $nombre = $this->input->post("nombre");
            
            
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_message('required', '*El campo %s es requerido. ');
            if($this->form_validation->run() == FALSE)
            {
                echo 'error validacion';
                return;
            }else{
                
                $ruta='./imagenes/paquetes/';
                $config['upload_path'] = $ruta;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2000';
                $config['max_width'] = '4320';
                $config['max_height'] = '3240';
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('portrait'))
                {
                    
                   /* echo "You did not select a file to upload.";
                    echo 'The filetype you are attempting to upload is not allowed.';*/
                    echo $this->upload->display_errors();
                } else {
                    
                    $file_info = $this->upload->data();
                    $imagen = $file_info['file_name'];
                    $this->_create_thumbnail($file_info['file_name'],$ruta);
                    $idp=$this->modelo_paquetes_grados->insertar_paquetes_grados($nombre,$imagen);
                    if(!empty($_POST['check_list'])) {
                        foreach($_POST['check_list'] as $check) {
                                $this->modelo_paquetes_grados->insertar_productos_pqt($check,$idp);
                        }
                    }
                    
                    redirect(base_url().'productos/paquetes');
                }
                
                
            }
        }
        function ingresarProducto()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $nombre = $this->input->post("nombre");
            $descripcion = $this->input->post("descripcion");
            $tipo = $this->input->post("tipo");
            
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('descripcion', 'descripcion', 'required');
            $this->form_validation->set_message('required', '*El campo %s es requerido. ');
            if($this->form_validation->run() == FALSE)
            {
                echo 'error validacion';
                return;
            }else{
                $tipoinsert="";
                if($tipo=="anillos"){
                    $tipoinsert="ANILLO";
                }else if($tipo=="medallas"){
                    $tipoinsert="MEDALLA";
                }else if($tipo=="titulo"){
                    $tipoinsert="TITULO";
                }else if($tipo=="album"){
                    $tipoinsert="ALBUM";
                }
                $ruta='./imagenes/'.$tipo.'/';
                $config['upload_path'] = $ruta;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2000';
                $config['max_width'] = '4320';
                $config['max_height'] = '3240';
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('portrait'))
                {
                    
                    echo "You did not select a file to upload.";
                    echo 'The filetype you are attempting to upload is not allowed.';
                    //echo $this->upload->display_errors();
                } else {
                    $file_info = $this->upload->data();
                    $imagen = $file_info['file_name'];
                    $this->_create_thumbnail($file_info['file_name'],$ruta);
                    $this->modelo_productos->insertarProducto($nombre,$descripcion,$imagen,$tipoinsert);
                
                    $data['productos']= $this->modelo_productos->get_productos($tipoinsert);
                    $data['tipo']= $tipo;
                    $data['cargar']= 1;
                    $this->load->view("administrador/vista_productos",$data);
                }
                
                
            }
           
        }
        function _create_thumbnail($filename,$ruta){
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = $ruta.$filename;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image']=$ruta.'thumbs/';
        $config['width'] = 270;
        $config['height'] = 149;
        $this->load->library('image_lib', $config); 
        $this->image_lib->resize();
    }
    
    function ajax_notificaciones(){
            
            $json = '{"results":[[{"num_notifi":"'.$this->modelo_productos->contar_todas_notificaciones().'"},'
    . '{"notificaciones":'.json_encode($this->modelo_productos->get_notificaciones()).'}]]}';//
            echo $json;
            exit;
    }
    
    function presupuesto_producto($id=NULL){
            
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $data['notificacion']= $this->modelo_productos->get_datos_notificaciones($id);
            /*echo $id;
            echo '<pre>';
            print_r($data['notificacion']);
            print_r($this->session->userdata('datos'));
            echo '<pre>';
            
            die();*/
            $tipo=$data['notificacion']->tipo;
                if($tipo=="ANILLO"){
                    $data['notificacion']->tipo="anillos";
                }else if($tipo=="MEDALLA"){
                    $data['notificacion']->tipo="medallas";
                }else if($tipo=="TITULO"){
                    $data['notificacion']->tipo="titulo";
                }else if($tipo=="ALBUM"){
                    $data['notificacion']->tipo="album";
                }
                
            $data['menu']='menus/administrador'; 
            $data['contenido']='administrador/ver_presupuesto_producto'; 
            $this->load->view("template",$data);
        }
    
    
}

?>