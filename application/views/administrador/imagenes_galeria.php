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