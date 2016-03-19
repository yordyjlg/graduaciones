<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class administrador extends CI_Controller 
{
        function __construct() 
	{   //en el constructor cargamos nuestro modelo
		parent::__construct();
                $this->load->model('modelo_productos');
		$this->load->model('modelo_almacen');
                $this->load->model('modelo_universidad');
	}
	
        public function index()
	{
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
            $data['menu']='menus/administrador'; 
            $data['contenido']='administrador/vista_inicio'; 
            $this->load->view("template",$data);
        }
        
        function nosotros()
	{  
           $data['menu']='menus/administrador'; 
           $data['contenido']='inicio/vista_nosotros'; 
           $this->load->view("template",$data);
		
	}
        
        function galeria()
	{  
           $data['imagenes'] = $this->modelo_productos->get_imagen_galeria();
           $data['menu']='menus/administrador'; 
           $data['contenido']='administrador/vista_galeria'; 
           $this->load->view("template",$data);
		
	}
        
        function cronograma()
	{  
            if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != '666')
            {
                redirect(base_url().'inicio');
            }
           if($this->input->post("guardar")){
               $fechas = $this->input->post("fecha_actividad");
               $horas = $this->input->post("hora");
               $actividades = $this->input->post("actividad");
               $lugares = $this->input->post("lugar");
               if($this->input->post("fecha_actividad")){
                   $dataCronograma=array(
                       "TituloCrono" => $this->input->post("titulo"),
                       "Universidad_idUniversidad" => $this->input->post("universidadS")
                   );
                   $idCronograma = $this->modelo_universidad->insertar_cronograma($dataCronograma);
                   foreach ($this->input->post("fecha_actividad") as $key => $value) {
                       $dataActividad=array(
                            "hora" => $horas[$key],
                            "actividad" => $actividades[$key],
                            "lugar" => $lugares[$key],
                            "fecha" => $value,
                            "id_Cronograma" => $idCronograma
                        );
                       $this->modelo_universidad->insertar_actividad_cronograma($dataActividad);
                   }
                    

                }
                $data['respuesta'] =array(
                        "clase" => "alert-success",
                        "respuest" => "Cronograma Guardado Correctamente"
                    );
           }
           $data['imagenes'] = $this->modelo_productos->get_imagen_galeria();
           $data['universidad']= $this->modelo_universidad->get_universidedes();
           $data['menu']='menus/administrador'; 
           $data['contenido']='administrador/vista_cronograma'; 
           $this->load->view("template",$data);
		
	}
        
        function imagenes_galeria()
	{  
           $data['imagenes'] = $this->modelo_productos->get_imagen_galeria();
           $this->load->view("administrador/imagenes_galeria",$data);
		
	}
        function eliminar_imagenes(){
            if(!$this->input->is_ajax_request()){
                    redirect(base_url());
            }
            $data['imagenes'] = $this->modelo_productos->get_imagen_galeria();
           $this->load->view("administrador/imagenes_eliminar",$data);
        }
        function eliminar_imagenes_select(){
            if(!$this->input->is_ajax_request()){
                    redirect(base_url());
            }
            if($this->input->post("id_imagenes")){
                foreach ($this->input->post("id_imagenes") as $value) {
                    $this->modelo_productos->eliminar_imagen($value);
                }
                
            }
            
           $data['imagenes'] = $this->modelo_productos->get_imagen_galeria();
           $this->load->view("administrador/imagenes_eliminar",$data);
        }
       function galeria_subir(){
            
            print_r($_FILES['file']['name']);
            $this->upFiles($_FILES['file']['name']);
        }
        
        /**
    *sube archivos al servidor a través de un formulario
    *@access public
    *@param array $files estructura de array con todos los archivos a subir
    */
    public function upFiles($files = array())
    {
        //inicializamos un contador para recorrer los archivos
        $i = 0;
 
        //si no existe la carpeta files la creamos
        if(!is_dir("./imagenes/galeria/")) 
            mkdir("./imagenes/galeria/", 0777);
         
        //recorremos los input files del formulario
        foreach($files as $file) 
        {
            //si se está subiendo algún archivo en ese indice
            if($_FILES['file']['tmp_name'][$i])
            {
                //separamos los trozos del archivo, nombre extension
                $trozos[$i] = explode(".", $_FILES["file"]["name"][$i]);
 
                //obtenemos la extension
                $extension[$i] = end($trozos[$i]);
 
                //si la extensión es una de las permitidas
                if($this->checkExtension($extension[$i]) === TRUE)
                {
 
                    //comprobamos si el archivo existe o no, si existe renombramos 
                    //para evitar que sean eliminados
                    $_FILES['file']['name'][$i] = $this->checkExists($trozos[$i]);           
 
                    //comprobamos si el archivo ha subido
                    if(move_uploaded_file($_FILES['file']['tmp_name'][$i],"./imagenes/galeria/".$_FILES['file']['name'][$i]))
                    {
                        $data=array(
                            'Imagen' => $_FILES['file']['name'][$i],
                            'directorio' => "./imagenes/galeria/".$_FILES['file']['name'][$i]
                        );
                        $bnail = new thumbnail();
                        $bnail->_create_thumbnail($_FILES['file']['name'][$i],"./imagenes/galeria/");
                        $this->modelo_productos->insertar_imagen_galeria($data);
                        
                        echo "subida correctamente";
                        //aqui podemos procesar info de la bd referente a este archivo
                    } 
                //si la extension no es una de las permitidas
                }else{
                    echo "la extension no esta permitida";
                }
            //si ese input file no ha sido cargado con un archivo
            }else{
                echo "sin imagen";
            }
            //en cada pasada por el loop incrementamos i para acceder al siguiente archivo
            $i++;     
        }   
    }
    
    /**
    *funcion privada que devuelve true o false dependiendo de la extension
    *@access private
    *@param string 
    *@return boolean - si esta o no permitido el tipo de archivo
    */
    private function checkExtension($extension)
    {
        //aqui podemos añadir las extensiones que deseemos permitir
        $extensiones = array("gif","jpg","png","jpeg","JPEG","JPG","PNG","GIF");
        if(in_array(strtolower($extension), $extensiones))
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }
     /**
    *funcion que comprueba si el archivo existe, si es asi, iteramos en un loop 
    *y conseguimos un nuevo nombre para el, finalmente lo retornamos
    *@access private
    *@param array 
    *@return array - archivo con el nuevo nombre
    */
    private function checkExists($file)
    {
        //asignamos de nuevo el nombre al archivo
        $archivo = $file[0] . '.' . end($file);
        $i = 0;
        //mientras el archivo exista entramos
        while(file_exists('./imagenes/galeria/'.$archivo))
        {
            $i++;
            $archivo = $file[0]."(".$i.")".".".end($file);       
        }
        //devolvemos el nuevo nombre de la imagen, si es que ha 
        //entrado alguna vez en el loop, en otro caso devolvemos el que
        //ya tenia
        return $archivo;
    }
    
    
    
        
}

class thumbnail extends CI_Controller 
{
        function __construct() 
        {
		parent::__construct();
		
	}
    public function _create_thumbnail($filename,$ruta){
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
}

?>