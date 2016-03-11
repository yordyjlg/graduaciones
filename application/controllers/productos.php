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
            redirect(base_url());
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
        function catalogos(){
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
           $data['productos']= $this->modelo_productos->get_productos('CATALOGO');
           $data['tipo']= "catalogo";
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
                }else if($tipo=="catalogo"){
                    $tipoD="CATALOGO";
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
                }else if($tipo=="catalogo"){
                    $tipoinsert="CATALOGO";
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
        function cotizacion()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            if($this->input->post('cotizacion_Bs')){
                $datantf =array(
                    "bs" => $this->input->post('cotizacion_Bs'),
                    "estatus" => "ENVIADOADMIN"
                );
                $this->modelo_productos->actualizar_cotizacion($this->input->post('idCotizacion'),$datantf);
                $datos['respuesta'] =array(
                    "clase" => "alert-success",
                    "respuest" => "Cotización Enviada Correctamente"
                );
                $this->session->set_flashdata('mensaje',$datos);
                redirect(current_url());
            }
           $data['menu']='menus/administrador'; 
           $data['contenido']='administrador/vista_cotizacion';
           $this->load->view("template",$data);
           
        }
    function ver_detalle_cotizacion($id=null)
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            
            $data['cotizacion'] = $this->modelo_productos->get_datos_cotizacion($id);
            $data['productos']=$this->modelo_productos->get_productos_cotizacion($id);
             
            $data['id_paquete']=$id;
            $data['menu']='menus/administrador';  
            $data['contenido']='administrador/ver_detalle_cotizacion'; 
            $this->load->view("template",$data);
            
        }
        
        function ajax_tabla_cotizacion(){
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $page = (int)$this->input->post('page', true);  // Almacena el numero de pagina actual
            $limit = (int)$this->input->post('rows', true); // Almacena el numero de filas que se van a mostrar por pagina
            $sidx = $this->input->post('sidx', true);  // Almacena el indice por el cual se hará la ordenación de los datos
            $sord = $this->input->post('sord', true);// Almacena el modo de ordenación
            $filtro =array( );
            if(!$sidx) $sidx =1;
            // Se hace una consulta para saber cuantos registros se van a mostrar
            $_contar = $this->modelo_productos->contar_cotizaciones($filtro);
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

            
            $result = $this->modelo_productos->tabla_cotizaciones($filtro,$sidx,$sord,$limit,$start);
            $respuesta = new stdClass(); 
            // Se agregan los datos de la respuesta del servidor
            $respuesta->page = 1;
            $respuesta->total = $total_pages;
            $respuesta->records = $count;
            $i=0;
            
            foreach ($result AS $i => $row) {
                $modal = "<div class='text-align:center;'>";
                $modal_bottom = '';
                $estatus = $row["cotEstatus"];
                if($row["cotEstatus"]=="ENVIADO"){
                    $estatus = 'Recibido';
                }else if($row["cotEstatus"]=="ENVIADOADMIN"){
                    $estatus = 'Enviado';
                }
                $modal_bottom .= '<a href="'.base_url("productos/ver_detalle_cotizacion/".$row["idcotizacion"]).'" class="btn btn-block btn-primary btn_editar" data-id="'.$row["idcotizacion"].'"style="color:white; background-color: #3DB6E3;border-color: #359FC8;">Ver</a>';
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
                $respuesta->rows[$i]['cell']=array($row["idcotizacion"],$row["Nombre"]." ".$row["Apellido"],$row["num_graduandos"],$estatus,$row["bs"],$row["fecha"],$modal);
                $i++;
            }

            // La respuesta se regresa como json
            echo json_encode($respuesta);
        }
    
    function ajax_notificaciones(){
            $numNotifica = $this->modelo_productos->contar_todas_notificaciones();
            $numSolicitud_presupuesto = $this->modelo_productos->contar_todas_notificaciones_solicitud_presupuesto();
            $numCotizacion = $this->modelo_productos->contar_notificaciones_cotizacion();
            $total = $numNotifica+$numSolicitud_presupuesto+$numCotizacion;
            
            
            $json = '{"results":[[{"num_notifi":"'.$total.'"},'
                  . '{"notificaciones":'.json_encode($this->modelo_productos->get_notificaciones()).'},'
                  . '{"ntf_cotizacion":'.json_encode($this->modelo_productos->get_notificaciones_cotizacion()).'},'
                  . '{"ntf_s_presupuesto":'.json_encode($this->modelo_productos->get_notificaciones_solicitud_presupuesto()).'}]]}';
            echo $json;
            exit;
    }
    
    function ajax_notificaciones_usuarios(){
        
            $numNotifica = $this->modelo_productos->contar_todas_notificaciones_usuarios();
            $numSolicitud_presupuesto = $this->modelo_productos->contar_todas_notificaciones_solicitud_presupuesto_usuarios();
            $numCotizacion = $this->modelo_productos->contar_notificaciones_cotizacion_usuarios();
            $total = $numNotifica+$numSolicitud_presupuesto+$numCotizacion;
            
            $json = '{"results":[[{"num_notifi":"'.$total.'"},'
            . '{"notificaciones":'.json_encode($this->modelo_productos->get_notificaciones_usuarios()).'},'
            . '{"ntf_s_presupuesto":'.json_encode($this->modelo_productos->get_notificaciones_solicitud_presupuesto_usuarios()).'},'
            . '{"ntf_cotizacion":'.json_encode($this->modelo_productos->get_notificaciones_cotizacion_usuarios()).'}]]}';
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
    
        function ver_presupuesto_paquetes($id=null)
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            
            $data['presupuesto_paquetes'] = $this->modelo_productos->get_datos_presupuesto_paquetes($id);
            $data['productos']=$this->modelo_paquetes_grados->get_productos_paquete($data['presupuesto_paquetes']->idpaquetes_grados);
            $data['id_paquete']=$id;
            $data['menu']='menus/administrador'; 
            $data['contenido']='administrador/ver_presupuesto_paquetes'; 
            $this->load->view("template",$data);
            
        } 
        
        function ajax_insert_presupuesto(){
            if(!$this->input->is_ajax_request()){
                    return false;
            }
            $presupuesto= $this->input->post("presupuesto_bs");
            $id= $this->input->post("idnotifi");
            $data =array(
                'estatus' => 'ENVIADOADMIN',
                'bs' => $presupuesto
            );
            $response = $this->modelo_productos->insertar_presupuesto_sol_presupuesto($id,$data);
            $json = '{"results":['.json_encode($response).']}';
            echo $json;
            exit;
        }
        function presupuestos_productos($tipo)
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
           $data['tipo']= $tipo;
           $data['menu']='menus/administrador'; 
           $data['contenido']='administrador/vista_productos_presupuesto';
           $data['cargar']= 0;
           $this->load->view("template",$data);
           
        }
        function presupuestos_paquetes()
        {
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $data['menu']='menus/administrador';  
            $data['contenido']='administrador/vista_paquetes_presupuestos'; 
            $this->load->view("template",$data);
        }
        function ajax_tabla_productos_presupuesto($tipo){
            
            $page = (int)$this->input->post('page', true);  // Almacena el numero de pagina actual
            $limit = (int)$this->input->post('rows', true); // Almacena el numero de filas que se van a mostrar por pagina
            $sidx = $this->input->post('sidx', true);  // Almacena el indice por el cual se hará la ordenación de los datos
            $sord = $this->input->post('sord', true);// Almacena el modo de ordenación
 
            if(!$sidx) $sidx =1;
            // Se hace una consulta para saber cuantos registros se van a mostrar
            $contar_presupuestos = $this->modelo_productos->contar_presupuestos_admin($tipo);
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

            
            $result = $this->modelo_productos->tabla_listar_presupuestos_admin($tipo,$sidx,$sord,$limit,$start);
            
            $respuesta = new stdClass(); 
            // Se agregan los datos de la respuesta del servidor
            $respuesta->page = 1;
            $respuesta->total = $total_pages;
            $respuesta->records = $count;
            $i=0;
            
            foreach ($result AS $i => $row) {
                $modal = "<div class='text-align:center;'>";
                $modal_bottom = '';
                $estatus = $row["estatus"];
                if($row["estatus"]=="Enviado"){
                    $estatus = 'Recibido';
                }else if($row["estatus"]=="ENVIADOADMIN"){
                    $estatus = 'Enviado';
                }
                $modal_bottom .= '<a href="'.base_url("productos/presupuesto_producto/".$row["idNotificacion"]).'" class="btn btn-block btn-primary btn_editar" data-id="'.$row["idNotificacion"].'"style="color:white; background-color: #3DB6E3;border-color: #359FC8;">Ver</a>';
                
                
                $modal .= '<a href="#" style="color:white;background-color: #3DB6E3;border-color: #359FC8;" data-toggle="modal" data-target="#myModal'.$row["idNotificacion"].'" class="btn btn-block btn-outline btn-primary">Opciones</a>';
                $modal .= '<div class="modal fade" id="myModal'.$row["idNotificacion"].'" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="width:300px;">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <button type="button" style="font-size:21px;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabelsucursal'.$row["idNotificacion"].'">Opciones de Cotización: '.$row["idNotificacion"].'</h4>
                                            </div>
                                            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                                                '.$modal_bottom.'
                                             </div>
                                    </div>
                            </div>
                    </div>';
                $modal .= "</div>";
                $respuesta->rows[$i]['id']=$row["idNotificacion"];
                $respuesta->rows[$i]['cell']=array($row["idNotificacion"],$row["Nombre"]." ".$row["Apellido"],$row["NombreProd"],$row["cantidad"],$row["montoBs"],$estatus,$modal);
                $i++;
            }

            // La respuesta se regresa como json
            echo json_encode($respuesta);
        }
        
        function ajax_tabla_solicitud_presupuesto(){
            
            $page = (int)$this->input->post('page', true);  // Almacena el numero de pagina actual
            $limit = (int)$this->input->post('rows', true); // Almacena el numero de filas que se van a mostrar por pagina
            $sidx = $this->input->post('sidx', true);  // Almacena el indice por el cual se hará la ordenación de los datos
            $sord = $this->input->post('sord', true);// Almacena el modo de ordenación
 
            if(!$sidx) $sidx =1;
            // Se hace una consulta para saber cuantos registros se van a mostrar
            $contar_presupuestos = $this->modelo_productos->contar_solicitud_presupuesto_admin();
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

            
            $result = $this->modelo_productos->tabla_solicitud_presupuesto_admin($sidx,$sord,$limit,$start);
            
            $respuesta = new stdClass(); 
            // Se agregan los datos de la respuesta del servidor
            $respuesta->page = 1;
            $respuesta->total = $total_pages;
            $respuesta->records = $count;
            $i=0;
            
            foreach ($result AS $i => $row) {
                $modal = "<div class='text-align:center;'>";
                $modal_bottom = '';
                $estatus = $row["estatus"];
                if($row["estatus"]=="ENVIADO"){
                    $estatus = 'Recibido';
                }else if($row["estatus"]=="ENVIADOADMIN"){
                    $estatus = 'Enviado';
                }
                $modal_bottom .= '<a href="'.base_url("productos/ver_presupuesto_paquetes/".$row["idsolicitud_presupuesto"]).'" class="btn btn-block btn-primary btn_editar" data-id="'.$row["idsolicitud_presupuesto"].'"style="color:white; background-color: #3DB6E3;border-color: #359FC8;">Ver</a>';
                
                
                $modal .= '<a href="#" style="color:white;background-color: #3DB6E3;border-color: #359FC8;" data-toggle="modal" data-target="#myModal'.$row["idsolicitud_presupuesto"].'" class="btn btn-block btn-outline btn-primary">Opciones</a>';
                $modal .= '<div class="modal fade" id="myModal'.$row["idsolicitud_presupuesto"].'" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="width:300px;">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <button type="button" style="font-size:21px;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabelsucursal'.$row["idsolicitud_presupuesto"].'">Opciones de Cotización: '.$row["idsolicitud_presupuesto"].'</h4>
                                            </div>
                                            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                                                '.$modal_bottom.'
                                             </div>
                                    </div>
                            </div>
                    </div>';
                $modal .= "</div>";
                $respuesta->rows[$i]['id']=$row["idsolicitud_presupuesto"];
                $respuesta->rows[$i]['cell']=array($row["idsolicitud_presupuesto"],$row["Nombre"]." ".$row["Apellido"],$row["nombre"],$row["numero_graduandos"],$row["bs"],$estatus,$modal);
                $i++;
            }

            // La respuesta se regresa como json
            echo json_encode($respuesta);
        }
        
        
    
}

?>