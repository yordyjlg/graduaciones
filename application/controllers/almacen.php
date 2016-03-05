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
        
        function ajax_tabla_almacen(){
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            
            $page = (int)$this->input->post('page', true);  // Almacena el numero de pagina actual
            $limit = (int)$this->input->post('rows', true); // Almacena el numero de filas que se van a mostrar por pagina
            $sidx = $this->input->post('sidx', true);  // Almacena el indice por el cual se hará la ordenación de los datos
            $sord = $this->input->post('sord', true);// Almacena el modo de ordenación
            
            $filtro =array( );
            if($this->input->post('nombre')){
                $filtro["nombre"]=$this->input->post('nombre');
            }
            if($this->input->post('estado')){
                $filtro["estado"]=$this->input->post('estado');
            }
            
            if(!$sidx) $sidx =1;
            // Se hace una consulta para saber cuantos registros se van a mostrar
            $contar_presupuestos = $this->modelo_almacen->contar_productos($filtro);
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

            
            $result = $this->modelo_almacen->tabla_productos($filtro,$sidx,$sord,$limit,$start);
            $respuesta = new stdClass(); 
            // Se agregan los datos de la respuesta del servidor
            $respuesta->page = 1;
            $respuesta->total = $total_pages;
            $respuesta->records = $count;
            $i=0;
            
            foreach ($result AS $i => $row) {
                $modal = "<div class='text-align:center;'>";
                
                $modal_bottom = '';
                if ($row["estado"] == 1)//activa
                {
                    $estado = 'Activo' ;
                    $modal_bottom .= '<a href="#" class="btn btn-block btn-primary btn_activar" data-id="'.$row["idalmacen"].'" data-estado="'.$row["estado"].'" style="color:white; background-color: #3DB6E3;border-color: #359FC8;">Inactivar</a>';
                }else
                {
                    $estado = 'Inactivo' ;
                    $modal_bottom .= '<a href="#" class="btn btn-block btn-primary btn_activar" data-id="'.$row["idalmacen"].'" data-estado="'.$row["estado"].'" style="color:white; background-color: #3DB6E3;border-color: #359FC8;">Activar</a>';
                }
                
                $modal_bottom .= '<a href="#" class="btn btn-block btn-primary btn_editar" data-id="'.$row["idalmacen"].'" data-nombre="'.$row["nombre_producto"].'" data-cantidad="'.$row["cantidad"].'" data-precio="'.$row["precio"].'" style="color:white; background-color: #3DB6E3;border-color: #359FC8;">Editar</a>';
                $modal .= '<a href="#" style="color:white;background-color: #3DB6E3;border-color: #359FC8;" data-toggle="modal" data-target="#myModaluniversidad'.$row["idalmacen"].'" class="btn btn-block btn-outline btn-primary">Opciones</a>';
                $modal .= '<div class="modal fade" id="myModaluniversidad'.$row["idalmacen"].'" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="width:300px;">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <button type="button" style="font-size:21px;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabelsucursal'.$row["idalmacen"].'">Opciones de '.$row["nombre_producto"].'</h4>
                                            </div>
                                            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                                                '.$modal_bottom.'
                                             </div>
                                    </div>
                            </div>
                    </div>';
                $modal .= "</div>";
                $respuesta->rows[$i]['id']=$row["idalmacen"];
                $respuesta->rows[$i]['cell']=array($row["nombre_producto"],$row["cantidad"],$row["precio"],$estado,$modal);
                $i++;
            }

            // La respuesta se regresa como json
            echo json_encode($respuesta);
        }
        
        public function ajax_activar(){
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $respuesta = new stdClass();
            if($this->input->post("id")){
                
                if($this->input->post("estado")==1){
                    $estado=0;
                }else{
                    $estado=1;
                }
                $data=array(
                        "estado" => $estado
                    );
                    $res = $this->modelo_almacen->modificar_productos($data,$this->input->post("id"));
                    if($res){
                        $respuesta->success=true;
                        echo json_encode($respuesta);
                        return;
                    }else{
                        $respuesta->success=false;
                        echo json_encode($respuesta);
                        return;
                    }
            }
        }
        public function ingresar_producto()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $respuesta = new stdClass();
            $nombre = $this->input->post("nombre");
            $cantidad = $this->input->post("cantidad");
            $precio = $this->input->post("precio");
            
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('cantidad', 'cantidad', 'required');
            $this->form_validation->set_rules('precio', 'precio', 'required');
            
            
            $this->form_validation->set_message('required', '*El campo %s es requerido. ');
            if($this->form_validation->run() == FALSE)
            {
                
                $respuesta->clase="alert-danger";
                $respuesta->respuest="Debe completar el formulario";
                echo json_encode($respuesta);
                return;
            }else{
                if($this->input->post("id_almacen")){
                    $this->modelo_almacen->modificar_Producto($this->input->post("id_almacen"),$nombre,$cantidad,$precio);
                    $respuesta->clase="alert-success";
                    $respuesta->respuest="Modificado Correctamente";
                }else{
                    $this->modelo_almacen->insertar_productos($nombre,$cantidad,$precio);
                    $respuesta->clase="alert-success";
                    $respuesta->respuest="Guardado Correctamente";
                }
                
                echo json_encode($respuesta);
            }
        }
        
        /*public function modificar_producto()
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
        }*/
        
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