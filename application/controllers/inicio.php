<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class inicio extends CI_Controller 
{
        function __construct() 
	{   //en el constructor cargamos nuestro modelo
		parent::__construct();
		$this->load->model('modelo_productos');
                $this->load->model('modelo_inicio');
                $this->load->model('modelo_universidad');
                $this->load->model('modelo_paquetes_grados');
	}
	
        public function index()
	{	
		switch ($this->session->userdata('perfil')) {
			case '':
				$data['token'] = $this->token();
				$data['titulo'] = 'Login con roles de usuario-'.$this->session->userdata('perfil');
				$data['universidades']= $this->modelo_universidad->get_universidedes();
                                $data['menu']='menus/menuInvitado'; 
                                $data['contenido']='inicio/vista_inicio'; 
                                $this->load->view("template",$data);
				break;
			case '666':
				redirect(base_url().'administrador');
				break;
			case '1':
				redirect(base_url().'cliente');
				break;	
			case '0':
                            
				$data['token'] = $this->token();
				$data['titulo'] = 'esperre permisos-'.$this->session->userdata('perfil');
				$data['universidades']= $this->modelo_universidad->get_universidedes();
                                $data['menu']='menus/menuInvitado'; 
                                $data['contenido']='inicio/vista_inicio'; 
                                $this->load->view("template",$data);
				break;
			default:		
				$data['universidades']= $this->modelo_universidad->get_universidedes();
                                $data['menu']='menus/menuInvitado'; 
                                $data['contenido']='inicio/vista_inicio'; 
                                $this->load->view("template",$data);
				break;		
		}
	}
	
	public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	
	public function login()
	{
		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
		{
                    $this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]');
                    $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[4]|max_length[150]');
                    $this->form_validation->set_message('required', 'El %s es requerido');
                    $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
                    $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
			if($this->form_validation->run() == FALSE)
			{
				$this->index();
			}else{
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				$check_user = $this->modelo_inicio->login_user($username,$password);
				if($check_user == TRUE)
				{
                                    $data = array(
                                    'is_logued_in' => TRUE,
                                    'id_usuario' => $check_user->ci_usuario,
                                    'perfil'	=> $check_user->estatus,
                                    'username' 	=> $check_user->NombreUsuario,
                                    'datos' 	=> $check_user
                                     );		
					$this->session->set_userdata($data);
					$this->index();
				}
			}
		}else{
			redirect(base_url().'inicio');
		}
	}

	public function logout_ci()
	{
                $this->session->set_userdata('perfil',"");
		$this->session->sess_destroy();
		redirect(base_url().'inicio');
	}
        function registrarse()
	{
            $cedula = $this->input->post("cedula");
            $nombre = $this->input->post("nombre");
            $apellido = $this->input->post("apellido");
            $telefono = $this->input->post("telefono");
            $email = $this->input->post("email");
            $ciudad = $this->input->post("ciudad");
            $direccion = $this->input->post("direccion");
            $institucion = $this->input->post("institucion");
            $usuario = $this->input->post("nombreusu");
            $clave = $this->input->post("contrasena");
            $especialidad = $this->input->post("especialidad");
            
            $this->form_validation->set_rules('cedula', 'cedula', 'required');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('apellido', 'apellido', 'required');
            $this->form_validation->set_rules('telefono', 'telefono', 'required');
            
            $this->form_validation->set_message('required', '%s');
	    if($this->form_validation->run() == FALSE)
            {
                
                $miArray = array("tipo"=> "error","cedula"=> form_error('cedula'), "nombre"=>form_error('nombre')
                                ,"apellido"=>form_error('apellido'),"telefono"=>form_error('telefono'));
                $json = '{"resultado":['.json_encode($miArray).']}';
                
                echo $json;
                return;
            }
            
            $existe = $this->modelo_inicio->get_usuario($cedula);
            if(!$existe){
                $this->modelo_inicio->registrarse($cedula,$nombre,$apellido,$telefono,$email,$ciudad,$direccion
                            ,$institucion,$usuario,md5($clave),0,$especialidad);
                
                $miArray = array("tipo"=> "registrado");
                $json = '{"resultado":['.json_encode($miArray).']}';
                
                echo $json;
            }else{
                
                $miArray = array("tipo"=> "existe");
                $json = '{"resultado":['.json_encode($miArray).']}';
                
                echo $json;
            }
                     
        }
	function nosotros()
	{  
           $data['menu']='menus/menuInvitado'; 
           $data['contenido']='inicio/vista_nosotros'; 
           $this->load->view("template",$data);
		
	}
        function anillos()
        {
           $data['productos']= $this->modelo_productos->get_productos('ANILLO');
           $data['tipo']= "anillos";
           $data['menu']='menus/menuInvitado'; 
           $data['contenido']='inicio/vista_productos'; 
           $this->load->view("template",$data);
        }
        function medallas()
        {
           $data['productos']= $this->modelo_productos->get_productos('MEDALLA');
           $data['tipo']= "medallas";
           $data['menu']='menus/menuInvitado'; 
           $data['contenido']='inicio/vista_productos'; 
           $this->load->view("template",$data);
        }
        function portaTitulos()
        {
           $data['productos']= $this->modelo_productos->get_productos('TITULO');
           $data['tipo']= "titulo";
           $data['menu']='menus/menuInvitado'; 
           $data['contenido']='inicio/vista_productos'; 
           $this->load->view("template",$data);
        }
        function album()
        {
           $data['productos']= $this->modelo_productos->get_productos('ALBUM');
           $data['tipo']= "album";
           $data['menu']='menus/menuInvitado'; 
           $data['contenido']='inicio/vista_productos'; 
           $this->load->view("template",$data);
        }
        function paquetes()
        {
            $data['paquetes']= $this->modelo_paquetes_grados->get_paquetes_grados();
            $data['menu']='menus/menuInvitado'; 
            $data['contenido']='inicio/vista_paquetes'; 
            $this->load->view("template",$data);
        }
        function paquetesDetalles()
        {
            $data['productos']=$this->modelo_paquetes_grados->get_productos_paquete($this->input->post("id"));
            
            $this->load->view("inicio/vista_paquetes_detalles",$data);
            
        }
}