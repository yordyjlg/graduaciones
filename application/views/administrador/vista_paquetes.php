<div id="cargar">
         <div id="error"></div>

<script src="<?= base_url() ?>bootstrap/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>css/style_descripcion.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-progressbar-2.3.2.css" type="text/css" media="screen">
                

<script type="text/javascript">
function verpaquete(vent){

          $.ajax({
                url:   '<?= base_url() ?>inicio/paquetesDetalles',
                data : { 'id' : $(vent).data('id') },
                type : 'POST',
                beforeSend: function () {
                        $("#respuestajax").html("Espere un momento, o intente otra vez por favor...");
                        
                        
                },
                success:  function (response) {
                        $("#respuestajax").html(response);
                }
        });
         //alert($(vent).data('id'));
}



var portrait_uploader = {

    reader : null,
    form_data : null,
    file_data : null,

    init : function()
    {
        this.reader = new FileReader();
        this.form_data = new FormData();

        this.handle_file_upload();

        return this;
    },

    handle_file_upload : function()
    {
        $('#file').change(function() {

            var file = (this.files[0].name).toString();

            $('#file-info').empty().text(file);

            portrait_uploader.reader.onload = function(e)
            {
                $('#preview img').attr('src', e.target.result);
            }

            portrait_uploader.reader.readAsDataURL(this.files[0]);
        });

        
        
    }

};

$(document).ready(function() {

    

    $('#file-select').on('click', function(e) {
        e.preventDefault();
        $('#file').click();
    });

    $('#file').val(null);

    portrait_uploader
        .init();

});


</script>


<form id="form_usuario" name="formulario" enctype="multipart/form-data"  method="post" action="<?php echo base_url('/productos/ingresarPaqueteGrado/') ?>">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                                <div class="form-group">
                                    <label class="control-label col-xs-12" for="nombre">Nombre:</label>
                                    
                                        <input style="width: 50%;float: none; display: unset;" type="text" class="form-control nombre col-xs-12" name="nombre" id="nombre" value="" />
                                  
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group ">
                                <div style="text-align: center;" id="foto-portada">                                                               
                                    <label>Imagen:</label>
                                    <div id="preview" class="thumbnail" style="border: none;background-color: transparent;position: relative;text-align: center;">
                                        <a href="#" class="btn btn-default boton" id="file-select" style="margin-bottom: 15px;margin-right: auto;margin-left: auto;">Elegir Archivo</a>
                                        <img style="height: 1%;width: 10%;" src="" alt="">
                                        <span class="alert alert-info" id="file-info">No hay Archivo</span>
                                    </div>

                                    <input style="display: none;" type="file" name="portrait" id="file">

                                </div>
                            </div>
                        </div>
                        <?php if($productosAlmc){ ?>
                        
                        
                            
                            <?php foreach ($productosAlmc as $row){ ?>
                                
                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2" id="casilla" style="margin-top: 20px; min-height: 110px; text-align: center;">
                                    <label  style="color: #000;">
                                        <?php echo $row->nombre_producto; ?>
                                    </label>
                                    <div style="text-align: center;">
                                        <input type="checkbox" name="check_list[]" value="<?php echo $row->idalmacen; ?>">
                                    </div>
                                </div>
                            <?php } ?>
                        
                        
                        <?php } ?>
                        <div class="row" style="text-align: center;">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                                <input style="width: 20%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="file-save" class="boton" value="enviar" title="enviar" />
                            </div>
                        </div>
                        
                    </form>  
                <div class="row" >
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="min-height: 250px;margin-left: 0px; text-align: center;">
                        <label id="titulos">Paquetes</label>
                        <?php if($paquetes){ ?>

                            <?php foreach ($paquetes as $row){ ?>
                            <a onClick="verpaquete(this);" data-id="<?php echo $row->idpaquetes_grados; ?>">
                                <div id="casilla" style=" margin: 15px;text-align: center;">
                                    <label id="titulos"><?php echo $row->nombre; ?></label>
                                    <img style="max-height: 100px;width: 100%;" src="<?= base_url() ?>imagenes/paquetes/<?php echo $row->imagen; ?>" class="img-responsive" title="Paquete de grado <?php echo $row->nombre; ?>"/>
                                </div>
                            </a>       
                            <?php } ?>
                        <?php } ?>

                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-8"  >
                        <div id="titulos" class="titulocurepo">Paquete de grado</div>
                        <div  id="casilla" style="   min-height: 250px; ">
                            <div id="titulos" class="titulocurepo">
                                <div id="respuestajax">
                                    SELECCIONE PAQUETE PARA VER DETALLES
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>