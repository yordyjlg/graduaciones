<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class almacen extends CI_Controller 
{
        function __construct() 
	{   //en el constructor cargamos nuestro modelo
		parent::__construct();
               // $this->load->model('modelo_universidad');
                //$this->load->model('modelo_paquetes_universidad');
                $this->load->model('modelo_almacen');
		
	}
	
        public function index()
	{
            
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $data['productosAlmc']= $this->modelo_almacen->get_productos();
            $data['menu']='menus/administrador'; 
            $data['contenido']='administrador/vista_almacen';
            $this->load->view("template",$data);
            
        }
        public function ingresar_producto()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            
            $nombre = $this->input->post("nombre");
            $cantidad = $this->input->post("cantidad");
            $precio = $this->input->post("precio");
            
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('cantidad', 'cantidad', 'required');
            $this->form_validation->set_rules('precio', 'precio', 'required');
            
            
            $this->form_validation->set_message('required', '*El campo %s es requerido. ');
            if($this->form_validation->run() == FALSE)
            {
                
                echo 'error';
                return;
                
            }else{
                $this->modelo_almacen->insertar_productos($nombre,$cantidad,$precio);
                $data['productosAlmc']= $this->modelo_almacen->get_productos();
                $this->load->view("administrador/vista_almacen",$data);
            }
        }
        
        public function modificar_producto()
	{
             if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $id = $this->input->post("id");
            $nombre = $this->input->post("nombre");
            $cantidad = $this->input->post("cantidad");
            $precio = $this->input->post("precio");
            
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('cantidad', 'cantidad', 'required');
            $this->form_validation->set_rules('precio', 'precio', 'required');
            
            
            $this->form_validation->set_message('required', '*El campo %s es requerido. ');
            if($this->form_validation->run() == FALSE)
            {
                
                echo 'error';
                return;
                
            }else{
                $this->modelo_almacen->modificar_Producto($id,$nombre,$cantidad,$precio);
                $data['productosAlmc']= $this->modelo_almacen->get_productos();
                $this->load->view("administrador/vista_almacen",$data);
            }
        }
        
        public function datos_producto()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $idP = $this->input->post("idP");
            $data['productos']= $this->modelo_almacen->get_detalle_productos($idP);
            $this->load->view("administrador/vista_modificar_producto_almacen",$data);
        }

            
}