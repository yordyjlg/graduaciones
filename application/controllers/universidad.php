<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class universidad extends CI_Controller 
{
        function __construct() 
	{   //en el constructor cargamos nuestro modelo
		parent::__construct();
                $this->load->model('modelo_universidad');
                $this->load->model('modelo_paquetes_universidad');
                $this->load->model('modelo_almacen');
		
	}
	
        public function index()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            
        }
        public function paquetes_universidad()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $data['universidad']= $this->modelo_universidad->get_universidedes();
            $data['productosAlmc']= $this->modelo_almacen->get_productos();
            $data['menu']='menus/administrador'; 
            $data['contenido']='administrador/vista_paquetes_universidad';
            $this->load->view("template",$data);
        }
        public function ingresar_paquetes_universidad()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $nombre = $this->input->post("nombrep");
            $informacion = $this->input->post("informacionp");
            $monto = $this->input->post("montop");
            $fechat = $this->input->post("fechat");
            $numerog = $this->input->post("numerog");
            $iduniversidad = $this->input->post("universidadS");
            
            $this->form_validation->set_rules('nombrep', 'nombre', 'required');
            $this->form_validation->set_rules('informacionp', 'informacion', 'required');
            $this->form_validation->set_rules('montop', 'monto', 'required');
            $this->form_validation->set_rules('fechat', 'fecha tope', 'required');
            $this->form_validation->set_rules('numerog', 'numero graduados', 'required');
            
            $this->form_validation->set_message('required', '*El campo %s es requerido. ');
            if($this->form_validation->run() == FALSE)
            {
                
                echo 'error';
                return;
                /*
                 echo 'Debe completar el formulario</br>';
                echo form_error('nombrep', '<span class="error">', '</span>');
                echo form_error('informacionp', '<span class="error">', '</span></br>');
                echo form_error('montop', '<span class="error">', '</span>');
                echo form_error('fechat', '<span class="error">', '</span>');
                echo form_error('numerog', '<span class="error">', '</span>');
                 */
            }else{
                $idp=$this->modelo_paquetes_universidad->insertar_paquetes_grados($nombre,
                        $informacion,$monto,$fechat,$numerog);
                    if(!empty($_POST['check_list'])) {
                        foreach($_POST['check_list'] as $check) {
                                $this->modelo_paquetes_universidad->insertar_productos_paquetes($idp,$check);
                        }
                    }
                 $this->modelo_universidad->modificar_universidedes("Paquete_idPaquete",$idp,$iduniversidad);
                 $data['universidad']= $this->modelo_universidad->get_universidedes();
                $data['productosAlmc']= $this->modelo_almacen->get_productos();
                $this->load->view("administrador/vista_paquetes_universidad",$data);
            }
        }

            
}