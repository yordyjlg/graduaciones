<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cliente extends CI_Controller 
{
        function __construct() 
	{   //en el constructor cargamos nuestro modelo
		parent::__construct();
		
	}
	
        public function index()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
            $data['menu']='menus/clientes'; 
            $data['contenido']='clientes/vista_inicio'; 
            $this->load->view("template",$data);
        }
        
        function nosotros()
	{  
           $data['menu']='menus/clientes'; 
           $data['contenido']='inicio/vista_nosotros'; 
           $this->load->view("template",$data);
		
	}
}

?>