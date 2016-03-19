<?php if($productos){ ?>
    <?php foreach ($productos as $row){ ?>
        <?php $tipod="";
                if($row->tipo=="ANILLO"){//verifica el tipo de producto para selecionar la carpeta en donde se encuentra guardada la imagen
                    $tipod="anillos";
                }else if($row->tipo=="MEDALLA"){
                    $tipod="medallas";
                }else if($row->tipo=="TITULO"){
                    $tipod="titulo";
                }else if($row->tipo=="ALBUM"){
                    $tipod="album";
                }else if($row->tipo=="CATALOGO"){
                    $tipod="catalogo";
                } ?>
        <div class="span5" style="  margin-left: 0px;">
            <form id="form_usuarioM" name="formularioM" enctype="multipart/form-data"  method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                                <div class="form-group">
                                    <label class="control-label col-xs-12" for="nombreM">Nombre:</label>
                                    <input style="width: 50%;float: none; display: unset;"  type="text"  class="form-control nombre col-xs-12" id="nombreM" name="nombreM" value="<?php echo $row->NombreProd; ?>" />
                                </div>
                            </div>
                        </div>
            
            
            <img  class="img-responsive img-thumbnail" style="height: 100%;width: 100%;" src="<?= base_url() ?>imagenes/<?php echo $tipod; ?>/<?php echo $row->ImagenPro; ?>" />
            
                    <div class="row">
                            <div class="form-group ">
                                <div style="text-align: center;" id="foto-portada">                                                               
                                    <label>Imagen:</label>
                                <div id="previewM" class="thumbnail" style="border: none;background-color: transparent;position: relative;text-align: center;">
                                    <a href="#" class="btn btn-default boton" id="file-selectM" style="margin-bottom: 15px;margin-right: auto;margin-left: auto;">Elegir Archivo</a>
                                    <img style="height: 1%;width: 10%;" src="" alt="">
                                    <span class="alert alert-info" id="file-infoM">No hay Archivo</span>
                                </div>
                                
                                <input type="file" name="portraitM" id="fileM">
                                
                            </div>
                        </div>
                    </div>
                    
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                    <div class="form-group">
                        <label style="vertical-align: top;" class="control-label col-xs-12" for="descripcionM">Descripción:</label>
                        <textarea  style="width: 70%;float: none; display: unset;"  class="form-control col-xs-12"cols="50" rows="1" id="descripcionM" name="descripcionM"><?php echo $row->DescripcionPro; ?></textarea>
                        
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <input type="hidden" name="idM" value="<?php echo $row->idproductos; ?>" />
                <input type="hidden" name="tipoM" value="<?php echo $tipod; ?>" />
                <input style="width: 20%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="saveM" class="boton" value="Guardar" title="Guardar" />
            </div>
            </form>
        </div>
    <?php } ?>

 <?php }else{ ?>
      <div id="titulos">NO SE ENCONTRARON PRODUCTOS</div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#file-selectM').on('click', function(e) {
        e.preventDefault();
        $('#fileM').click();
    });
    $('#fileM').change(function() {

            var file = (this.files[0].name).toString();

            $('#file-infoM').empty().text(file);

            portrait_uploader.reader.onload = function(e)
            {
                $('#previewM img').attr('src', e.target.result);
            }

            portrait_uploader.reader.readAsDataURL(this.files[0]);
        });

    $('#fileM').val(null);
        
        $("#saveM").click(function(event) {
            event.preventDefault();
            var form_data = new FormData();
            var file_data = $('#fileM').prop('files')[0];
            form_data.append('portraitM', file_data);
            form_data.append('nombreM', document.formularioM.nombreM.value);
            form_data.append('descripcionM', document.formularioM.descripcionM.value);
            form_data.append('tipoM', document.formularioM.tipoM.value);
            form_data.append('idM', document.formularioM.idM.value);
            //alert(document.formularioM.nombreM.value);
              $.ajax({
                    url:   '<?= base_url() ?>productos/modificarProducto',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data : form_data,
                    type: 'post',
                beforeSend: function () {
                            
                            $("#respuesta2").html("Guardando modificaciones, por favor espere...");
                            

                    },
                    success:  function (response) {
                        $(".modal-backdrop ").attr('class', 'someClass');
                        $('#myModal').modal('hide');
                        $(".modal-backdrop").remove();
                        $("#cuerpo").removeClass("modal-open")
                        $("#cargar").html(response);
                        
                    }
            });
        });
    });
</script>