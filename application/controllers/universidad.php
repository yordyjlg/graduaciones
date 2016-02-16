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
            $data['universidad']= $this->modelo_universidad->get_universidedes();
            $data['productosAlmc']= $this->modelo_almacen->get_productos();
            $data['menu']='menus/administrador'; 
            $data['contenido']='administrador/vista_registrar_universidad';
            $this->load->view("template",$data);
        }
        
        function ajax_tabla_universidad(){
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $page = (int)$this->input->post('page', true);  // Almacena el numero de pagina actual
            $limit = (int)$this->input->post('rows', true); // Almacena el numero de filas que se van a mostrar por pagina
            $sidx = $this->input->post('sidx', true);  // Almacena el indice por el cual se hará la ordenación de los datos
            $sord = $this->input->post('sord', true);// Almacena el modo de ordenación
 
            if(!$sidx) $sidx =1;
            // Se hace una consulta para saber cuantos registros se van a mostrar
            $contar_presupuestos = $this->modelo_universidad->contar_universidedes();
            $count = ( !empty($contar_presupuestos) && count($contar_presupuestos) > 0 ? count($contar_presupuestos) : 0 );

            //En base al numero de registros se obtiene el numero de paginas
            if( $count >0 ) {
                
                $total_pages = ceil($count/$limit);
            } else {
                $total_pages = 0;
            }
            if ($page > $total_pages)
                $page=$total_pages;

            //Almacena numero de registro donde se va a empezar a recuperar los registros para la pagina
            $start = $limit*$page - $limit;
            if($start<0){
                $start=0;
            }

            
            $result = $this->modelo_universidad->tabla_universidad($sidx,$sord,$limit,$start);
            $respuesta = new stdClass(); 
            // Se agregan los datos de la respuesta del servidor
            $respuesta->page = 1;
            $respuesta->total = $total_pages;
            $respuesta->records = $count;
            $i=0;
            
            foreach ($result AS $i => $row) {
                $hidden_options = '<a href="'.base_url("productos_clientes/ver_presupuesto_paquetes/".$row["idUniversidad"]).'" class="btn btn-block btn-outline btn-primary" style="background-color: #3DB6E3;border-color: #359FC8;">Modificar</a>';
                $respuesta->rows[$i]['id']=$row["idUniversidad"];
                $respuesta->rows[$i]['cell']=array($row["idUniversidad"],$row["NombreUniversidad"],$row["direccion"],$hidden_options);
                $i++;
            }

            // La respuesta se regresa como json
            echo json_encode($respuesta);
        }
        
        public function ingresar_universidad()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $respuesta = new stdClass();
            $nombre = $this->input->post("nombreu");
            $direccion = $this->input->post("direccionu");
            
            $this->form_validation->set_rules('nombreu', 'nombreu', 'required');
            $this->form_validation->set_rules('direccionu', 'direccionu', 'required');
            
            
            $this->form_validation->set_message('required', '*El campo %s es requerido. ');
            if($this->form_validation->run() == FALSE)
            {
                $respuesta->clase="alert-danger";
                $respuesta->respuest="Debe completar el formulario";
                echo json_encode($respuesta);
                return;
                
            }else{
                $res = $this->modelo_universidad->insertar_universidad($nombre,$direccion);
                if($res){
                    $respuesta->clase="alert-success";
                    $respuesta->respuest="Guardado correctamente";
                    echo json_encode($respuesta);
                    return;
                }else{
                    $respuesta->clase="alert-danger";
                    $respuesta->respuest="Error al guardar";
                    echo json_encode($respuesta);
                    return;
                }
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