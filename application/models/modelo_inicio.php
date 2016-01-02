<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class modelo_inicio extends CI_Model
{
	public function construct()
	{
		parent::__construct();
	}
        public function login_user($username,$password)
	{
                $this->db->where('NombreUsuario',$username);
		$this->db->where('Clave',$password);
		$query = $this->db->get('usuario');
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos-'.$username.'-'.$password);
			redirect(base_url().'inicio','refresh');
		}
	}
        function registrarse($cedula,$nombre,$apellido,$telefono,$email,$ciudad,$direccion,$institucion
                            ,$usuario,$clave,$estatus,$especialidad){
            $data=array(
                'ci_usuario' => $cedula,
                'Nombre' => $nombre,
                'Apellido' => $apellido,
                'telefono' => $telefono,
                'email' => $email,
                'ciudad' => $ciudad,
                'direccion' => $direccion,
                'institucion' => $institucion,
                'NombreUsuario' => $usuario,
                'Clave' => $clave,
                'estatus' => $estatus,
                'especialidad' => $especialidad
            );
            $res= $this->db->insert('usuario', $data);
            return $res;
        }
        function get_usuario($cedula)
        {
            $this->db->where('ci_usuario',$cedula);
            $query=$this->db->get('usuario');
            if($query->num_rows==1){
                return $query->row();
            }else{
                return false;
            }
        }
}
