<link rel="stylesheet" href="<?= base_url() ?>css/estilos_responsive.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url() ?>css/galeria/blueimp-gallery.min.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url() ?>css/galeria/animate.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url() ?>css/dropzone/basic.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url() ?>css/dropzone/dropzone.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url() ?>css/galeria/style.css" type="text/css" media="screen">

<div  class="row" >
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div  class=" row tablaHead" id="titulos" style="background-color: rgba(255, 255, 255, 0.32);font-size: 22px;">
            Galeria
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Clik o arrastre las imagenes en esta zona</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="my-awesome-dropzone" class="dropzone" action="#">
                            <div class="dropzone-previews"></div>
                            <button type="submit" class="btn btn-success pull-right">Guardar imagenes!</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>

            </div>
    <div id="imagenes_galeria">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                
                </div>
            </div>
        </div>
        
        <div class="margen" >
        <div  class="row" >
            <div class="wrapper wrapper-content">
            <div class="row">
                
                <div class="col-lg-12">
                    <button type="submit" id="eliminar" class="btn btn-primary pull-left">Eliminar imagenes</button>
                <div class="ibox float-e-margins">

                    <div class="ibox-content">

                        <div class="lightBoxGallery">
                            <?php foreach ($imagenes as $value) { ?>
                            
                                <a href="<?= base_url().$value['directorio'] ?>"  data-gallery=""><img src="<?= base_url()."/imagenes/galeria/thumbs/".$value['Imagen'] ?>"></a>
                            
                            <?php } ?>
                            

                            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                            <div id="blueimp-gallery" class="blueimp-gallery">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            </div>
        </div>
            
        </div>
    </div>    
    </div>
            
                
</div>
<script src="<?= base_url() ?>js/galeria/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>js/dropzone/dropzone.js" type="text/javascript"></script>
<script>
        $(document).ready(function(){
            $("#eliminar").click(function(event) {
                console.log("eliminar");
                $.ajax({
                    type: "POST",
                    url: '<?= base_url() ?>administrador/eliminar_imagenes',
                    success: function(data)
                    {
			$("#imagenes_galeria").html(data);
                    }
		});
            });

            Dropzone.options.myAwesomeDropzone = {
                url: '<?= base_url() ?>administrador/galeria_subir',
                autoProcessQueue: false,
                uploadMultiple: true,
                addRemoveLinks: true,
                maxFileSize: 1000,
		dictResponseError: "Ha ocurrido un error en el server",
		acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF',
                parallelUploads: 100,
                maxFiles: 100,

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on("sendingmultiple", function() {
                        console.log("sendingmultiple");
                    });
                    this.on("successmultiple", function(files, response) {
                        console.log("successmultiple");
				$.ajax({
					type: "POST",
					url: '<?= base_url() ?>administrador/imagenes_galeria',
					success: function(data)
					{
						$("#imagenes_galeria").html(data);
					}
				});
                    });
                    this.on("errormultiple", function(files, response) {
                        console.log("errormultiple");
                    });
                }

            }

       });
    </script>