<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class productos_clientes extends CI_Controller 
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
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
            redirect(base_url());
        }
        function anillos()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('ANILLO');
           $data['tipo']= "anillos";
           $data['menu']='menus/clientes'; 
           $data['contenido']='clientes/vista_productos';
           $data['cargar']= 0;
           $this->load->view("template",$data);
           
        }
        function medallas()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('MEDALLA');
           $data['tipo']= "medallas";
           $data['menu']='menus/clientes'; 
           $data['contenido']='clientes/vista_productos';
           $data['cargar']= 0;
           $this->load->view("template",$data);
        }
        function portaTitulos()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('TITULO');
           $data['tipo']= "titulo";
           $data['menu']='menus/clientes'; 
           $data['contenido']='clientes/vista_productos';
           $data['cargar']= 0;
           $this->load->view("template",$data);
        }
        function album()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('ALBUM');
           $data['tipo']= "album";
           $data['menu']='menus/clientes'; 
           $data['contenido']='clientes/vista_productos';
           $data['cargar']= 0;
           $this->load->view("template",$data);
        }
        function catalogo()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('CATALOGO');
           $data['tipo']= "catalogo";
           $data['menu']='menus/clientes'; 
           $data['contenido']='clientes/vista_productos';
           $data['cargar']= 0;
           $this->load->view("template",$data);
        }
        function paquetes()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
            $data['paquetes']= $this->modelo_paquetes_grados->get_paquetes_grados();
            $data['productosAlmc']= $this->modelo_almacen->get_productos();
            $data['menu']='menus/clientes';  
            $data['contenido']='clientes/vista_paquetes'; 
            $this->load->view("template",$data);
        }
        function paquetesDetalles()
        {
            $data['productos']=$this->modelo_paquetes_grados->get_productos_paquete($this->input->post("id"));
            $data['id_paquete']=$this->input->post("id");
            $this->load->view("clientes/vista_detalles_paquetes",$data);
            
        }
        function detallesProducto()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
            $idP = $this->input->get("idP");
            $data['productos']= $this->modelo_productos->get_detalle_productos($idP);
            $this->load->view("clientes/vista_detalle_producto",$data);
        }
        function productos_solicitar_presupuesto(){
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
            
            
            $tablaNotificaciones=array(
                'cantidad' => $this->input->post("cantidads"),
                'productos_idproductos' => $this->input->post("idproducto"),
                'usuario_ci_usuario' => $this->session->userdata('id_usuario'),
                'fecha' => date("Y-m-d"),
                'estatus' => 'Enviado'
            );
            
            echo $this->modelo_productos->solicitar_presupuesto_Producto($tablaNotificaciones);
            exit();
        }
        function ajax_tabla_productos_presupuesto($tipo){
            
            $page = (int)$this->input->post('page', true);  // Almacena el numero de pagina actual
            $limit = (int)$this->input->post('rows', true); // Almacena el numero de filas que se van a mostrar por pagina
            $sidx = $this->input->post('sidx', true);  // Almacena el indice por el cual se hará la ordenación de los datos
            $sord = $this->input->post('sord', true);// Almacena el modo de ordenación
 
            if(!$sidx) $sidx =1;
            // Se hace una consulta para saber cuantos registros se van a mostrar
            $contar_presupuestos = $this->modelo_productos->contar_presupuestos($tipo);
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

            
            $result = $this->modelo_productos->tabla_listar_presupuestos($tipo,$sidx,$sord,$limit,$start);
            $respuesta = new stdClass(); 
            // Se agregan los datos de la respuesta del servidor
            $respuesta->page = 1;
            $respuesta->total = $total_pages;
            $respuesta->records = $count;
            $i=0;
            
            foreach ($result AS $i => $row) {
                $hidden_options = '<a href="'.base_url("productos_clientes/ver_presupuesto_producto/".$row["idNotificacion"]).'" class="btn btn-block btn-outline btn-primary" style="background-color: #3DB6E3;border-color: #359FC8;">Ver</a>';
                $respuesta->rows[$i]['id']=$row["idNotificacion"];
                $respuesta->rows[$i]['cell']=array($row["idNotificacion"],$row["NombreProd"],$row["cantidad"],$row["montoBs"],$row["estatus"],$hidden_options);
                $i++;
            }

            // La respuesta se regresa como json
            echo json_encode($respuesta);
        }
        function ajax_ingresar_solicitud_presupuesto(){
            
            $idPaquete = $this->input->post("id_paquete");
            $cedulaUsu = $this->input->post("cedula_usu");
            $numG = $this->input->post("numero_graduandos");
            $this->modelo_productos->insertar_solicitud_presupuesto($idPaquete, $cedulaUsu, $numG);
            exit();
            
        }
        function ajax_tabla_solicitud_presupuesto(){
            
            $page = (int)$this->input->post('page', true);  // Almacena el numero de pagina actual
            $limit = (int)$this->input->post('rows', true); // Almacena el numero de filas que se van a mostrar por pagina
            $sidx = $this->input->post('sidx', true);  // Almacena el indice por el cual se hará la ordenación de los datos
            $sord = $this->input->post('sord', true);// Almacena el modo de ordenación
 
            if(!$sidx) $sidx =1;
            // Se hace una consulta para saber cuantos registros se van a mostrar
            $contar_presupuestos = $this->modelo_productos->contar_solicitud_presupuesto();
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

            
            $result = $this->modelo_productos->tabla_solicitud_presupuesto($sidx,$sord,$limit,$start);
            $respuesta = new stdClass(); 
            // Se agregan los datos de la respuesta del servidor
            $respuesta->page = 1;
            $respuesta->total = $total_pages;
            $respuesta->records = $count;
            $i=0;
            
            foreach ($result AS $i => $row) {
                $hidden_options = '<a href="'.base_url("productos_clientes/ver_presupuesto_paquetes/".$row["idsolicitud_presupuesto"]).'" class="btn btn-block btn-outline btn-primary" style="background-color: #3DB6E3;border-color: #359FC8;">Ver</a>';
                $respuesta->rows[$i]['id']=$row["idsolicitud_presupuesto"];
                $respuesta->rows[$i]['cell']=array($row["idsolicitud_presupuesto"],$row["nombre"],$row["numero_graduandos"],$row["bs"],$row["estatus"],$hidden_options);
                $i++;
            }

            // La respuesta se regresa como json
            echo json_encode($respuesta);
        }
        function ver_presupuesto_producto($id=NULL){
            
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
            $data['notificacion']= $this->modelo_productos->get_datos_notificaciones($id);
            if($data['notificacion']->estatus=='ENVIADOADMIN'){
                $datantf =array(
                    "estatus" => "VISTOUSU"
                );
                $this->modelo_productos->insertar_presupuesto_notificaciones($id,$datantf);
            }
           /*echo $id;
            echo '<pre>';
            print_r($data['notificacion']);
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
                
            $data['menu']='menus/clientes';  
            $data['contenido']='clientes/ver_presupuesto_producto'; 
            $this->load->view("template",$data);
        }
        
        function ver_presupuesto_paquetes($id=null)
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
            
            $data['presupuesto_paquetes'] = $this->modelo_productos->get_datos_presupuesto_paquetes($id);
           
            if($data['presupuesto_paquetes']->es=='ENVIADOADMIN'){
                $datantf =array(
                    "estatus" => "VISTOUSU"
                );
                $this->modelo_productos->actualizar_notificacion_paquete($id,$datantf);
            }
            $data['productos']=$this->modelo_paquetes_grados->get_productos_paquete($data['presupuesto_paquetes']->idpaquetes_grados);
            $data['id_paquete']=$id;
            $data['menu']='menus/clientes';  
            $data['contenido']='clientes/ver_presupuesto_paquetes'; 
            $this->load->view("template",$data);
            
        }
        
        function ajax_get_mensajes_notificaciones(){
            if(!$this->input->is_ajax_request()){
                    return false;
            }
            $mensaje= $this->input->post("respuesta");
            $id= $this->input->post("idnotifi");
            $data =array(
                'mensaje' => $mensaje,
                'idnotific' => $id,
                'ci_usuario' => $this->session->userdata('datos')->ci_usuario
            );
            $this->modelo_productos->ajax_insertar_mensaje_notificacion($data);
            $response = $this->modelo_productos->ajax_get_mensajes_notificaciones($id);
            $json = '{"results":['.json_encode($response).']}';
            echo $json;
            exit;
        }
        
        function ajax_insertar_presupuesto_notificacion(){
            if(!$this->input->is_ajax_request()){
                    return false;
            }
            $presupuesto= $this->input->post("presupuestobs");
            $id= $this->input->post("idnotifi");
            $data =array(
                'estatus' => 'ENVIADOADMIN',
                'montoBs' => $presupuesto
            );
            $response = $this->modelo_productos->insertar_presupuesto_notificaciones($id,$data);
            $json = '{"results":['.json_encode($response).']}';
            echo $json;
            exit;
        }
        
        function cotizacion()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_almacen->get_productos_activos();
           $data['menu']='menus/clientes'; 
           $data['contenido']='clientes/vista_cotizacion';
           $this->load->view("template",$data);
           
        }
        
        function ajax_insertar_cotizacion(){
            if(!$this->input->is_ajax_request()){
                    return false;
            }
            $respuesta = new stdClass();
            $cotizacion =array(
                "num_graduandos"=>$this->input->post("numero_grad"),
                "estatus"=>"ENVIADO",
                "usuario_ci_usuario"=>$this->session->userdata('id_usuario')
            );
            $idCotizacion = $this->modelo_productos->insertar_cotizacion($cotizacion);
            if ($idCotizacion) {
                $respuesta->clase="alert-success";
                $respuesta->respuest="Solicitud Enviada Correctamente";
                echo json_encode($respuesta);
                return;
            }else{
                $respuesta->clase="alert-danger";
                $respuesta->respuest="Error, comuniquese con el administrador del sistema";
                echo json_encode($respuesta);
                return;
            }
            
        }
        function ajax_tabla_cotizacion(){
            
            $page = (int)$this->input->post('page', true);  // Almacena el numero de pagina actual
            $limit = (int)$this->input->post('rows', true); // Almacena el numero de filas que se van a mostrar por pagina
            $sidx = $this->input->post('sidx', true);  // Almacena el indice por el cual se hará la ordenación de los datos
            $sord = $this->input->post('sord', true);// Almacena el modo de ordenación
            $filtro =array( );
            if(!$sidx) $sidx =1;
            // Se hace una consulta para saber cuantos registros se van a mostrar
            $_contar = $this->modelo_productos->contar_cotizaciones_usuario($filtro);
            $count = ( !empty($_contar) && count($_contar) > 0 ? count($_contar) : 0 );

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

            
            $result = $this->modelo_productos->tabla_cotizaciones_usuario($filtro,$sidx,$sord,$limit,$start);
            $respuesta = new stdClass(); 
            // Se agregan los datos de la respuesta del servidor
            $respuesta->page = 1;
            $respuesta->total = $total_pages;
            $respuesta->records = $count;
            $i=0;
            
            foreach ($result AS $i => $row) {
                $modal = "<div class='text-align:center;'>";
                $modal_bottom = '';
                
                $modal_bottom .= '<a href="'.base_url("productos_clientes/ver_detalle_cotizacion/".$row["idcotizacion"]).'" class="btn btn-block btn-primary btn_editar" data-id="'.$row["idcotizacion"].'"style="color:white; background-color: #3DB6E3;border-color: #359FC8;">Ver</a>';
                if($row["bs"]){
                    $modal_bottom .= '<a href="#" class="btn btn-block btn-primary btn_editar" data-id="'.$row["idcotizacion"].'"style="color:white; background-color: #3DB6E3;border-color: #359FC8;">Imprimir</a>';
                }
                
                $modal .= '<a href="#" style="color:white;background-color: #3DB6E3;border-color: #359FC8;" data-toggle="modal" data-target="#myModal'.$row["idcotizacion"].'" class="btn btn-block btn-outline btn-primary">Opciones</a>';
                $modal .= '<div class="modal fade" id="myModal'.$row["idcotizacion"].'" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="width:300px;">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <button type="button" style="font-size:21px;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabelsucursal'.$row["idcotizacion"].'">Opciones de Cotización: '.$row["idcotizacion"].'</h4>
                                            </div>
                                            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                                                '.$modal_bottom.'
                                             </div>
                                    </div>
                            </div>
                    </div>';
                $modal .= "</div>";
                $respuesta->rows[$i]['id']=$row["idcotizacion"];
                $respuesta->rows[$i]['cell']=array($row["idcotizacion"],$row["num_graduandos"],$row["estatus"],$row["bs"],$row["fecha"],$modal);
                $i++;
            }

            // La respuesta se regresa como json
            echo json_encode($respuesta);
        }
       function ver_detalle_cotizacion($id=null)
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '1')
            {
                redirect(base_url().'inicio');
            }
            
            $data['cotizacion'] = $this->modelo_productos->get_datos_cotizacion($id);
            
            if($data['cotizacion']->cotizaestatus=='ENVIADOADMIN'){
                
                $datantf =array(
                    "estatus" => "VISTOUSU"
                );
                $this->modelo_productos->actualizar_cotizacion($id,$datantf);
            }
            $data['productos']=$this->modelo_productos->get_productos_cotizacion($id);
             
            $data['id_paquete']=$id;
            $data['menu']='menus/clientes';  
            $data['contenido']='clientes/ver_detalle_cotizacion'; 
            $this->load->view("template",$data);
            
        }
}

?>