     <div id="cargar">
         <div id="error"></div>
         <?php if(!$cargar){ ?>
                <script src="<?= base_url() ?>bootstrap/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
         <?php } ?>
               
                <link rel="stylesheet" href="<?= base_url() ?>css/style_descripcion.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-progressbar-2.3.2.css" type="text/css" media="screen">
                
                
                
                
               <script type="text/javascript">
                    
    var global_data = {
        portrait_upload_url : '<?php echo base_url('/productos/ingresarProducto/') ?>'
    };
</script>




<script type="text/javascript">
    var act=0;
var portrait_uploader = {

    reader : null,
    form_data : null,
    file_data : null,
    callbacks : {
        progress : false,
        loaded : false,
        uploaded : false,
        error : false
    },

    init : function()
    {
        this.reader = new FileReader();
        this.form_data = new FormData();

        this.handle_file_upload();

        return this;
    },

    on : function(type, callback)
    {
        var _undefined;

        if(this.callbacks[type] === _undefined || typeof callback !== 'function')
            return this;

        portrait_uploader.callbacks[type] = callback;

        return this;
    },

    upload_file : function(submit_btn)
    {
        this.file_data = $('#file').prop('files')[0];

        this.form_data.append('portrait', this.file_data);
        this.form_data.append('nombre', document.formulario.nombre.value);
        this.form_data.append('descripcion', document.formulario.descripcion.value);
        this.form_data.append('tipo', document.formulario.tipo.value);

        $.ajax({
            
            url: global_data.portrait_upload_url,
            cache: false,
            contentType: false,
            processData: false,
            data: portrait_uploader.form_data,                         
            type: 'post',
            xhr: function()
            {
                var xhr = $.ajaxSettings.xhr();

                if(xhr.upload)
                {                   
                    xhr.upload.addEventListener(
                        'progress',
                        portrait_uploader.handle_progress,
                        false
                    );
                }

                return xhr;
            },
            complete : function(data)
            {
                if(portrait_uploader.callbacks.loaded)
                    portrait_uploader.callbacks.loaded.call(null, data);
            },
            success : function(data)
            {
                if(data.error)
                {
                    if(portrait_uploader.callbacks.error)
                        portrait_uploader.callbacks.error.call(null, data.error, data);

                    return false;
                }
                    
                if(portrait_uploader.callbacks.uploaded)
                    portrait_uploader.callbacks.uploaded.call(null, data);
            },
            error : function(data)
            {
                if(portrait_uploader.callbacks.error)
                    $("#rrr").html(data);
                    portrait_uploader.callbacks.error.call(null, '404 not found', data);
            }
        })

        return false; // prevent anchor action
    },

    handle_progress : function(event)
    {
        console.log('loading');

        if (event.lengthComputable)
        {

            var percentage = (event.loaded / event.total) * 100;

            if(portrait_uploader.callbacks.progress)
                portrait_uploader.callbacks.progress.call(null, percentage, this.file_data);

        }
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

        
        $('#file-save').on('click', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            
            return portrait_uploader.upload_file(this);
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
        .init()
        .on('progress', function(percentage){
            // en este evento obtenemos el porcentaje de subida C:

            console.log('progreso: ', percentage);
            $(".bar").css('width',percentage.toFixed(2)+'%');      
            $(".progressbar-front-text").html(percentage.toFixed(2)+'%');
        })
        .on('uploaded', function(data){
            // el archivo se subió
            // tomamos medidas aqui C:
            if(data=="error validacion" || data=="You did not select a file to upload." || data=="The filetype you are attempting to upload is not allowed."){
                $("#error").html(data);
            }else{
                $("#cargar").html(data);
            }
            $(".bar").css('width',0+'%');      
            $(".progressbar-front-text").html(0+'%');
            
        })
        .on('error', function(msg, data){

            // ocurrio un error
            $('#upload_errors')
                .modal('show')
                .find('.upload_errors')
                .html(msg);
        });

});

function detalles(vent){

          $.ajax({
                url:   '<?= base_url() ?>productos/detallesProducto',
                data : { 'idP' : $(vent).data('idf') },
                type : 'GET',
            beforeSend: function () {
                        $("#respuesta2").html("Espere un momento, o intente otra vez por favor...");
                        
                },
                success:  function (response) {
                        $("#respuesta2").html(response);
                }
        });
         
}

</script>
                <div style="width: 100%;  box-shadow: 0px 1px 2px #695E5E; border-top: 130px none;color: #000;z-index: 1;"  >
                    
                    <form id="form_usuario"  name="formulario" enctype="multipart/form-data"  method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                                <div class="form-group">
                                    <label class="control-label col-xs-12" for="nombre">Nombre:</label>
                                    
                                        <input style="width: 50%;float: none; display: unset;" type="text" class="form-control nombre col-xs-12" name="nombre" id="nombre" value="" />
                                  
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                                <div class="form-group">
                                    <label style="vertical-align: top;" class="control-label col-xs-12" for="descripcion">Descripción:</label>
                                    <textarea  style="width: 70%;float: none; display: unset;"  class="form-control col-xs-12" cols="50" rows="1" id="descripcion" name="descripcion"><?php echo set_value('mensaje'); ?></textarea>
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
                        
                        <div style="text-align: center;">
                            <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" />
                            <input style="width: 20%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="file-save" class="boton" value="enviar" title="enviar" />
                            
                        </div>
                        <div class="progress">
                            <div aria-valuenow="75" style="width: 0%;" data-transitiongoal="75" class="bar" role="progressbar" data-transitiongoal-backup="75">
                                <span  class="progressbar-front-text">0%</span>
                            </div>
                        </div>
                    </form>    
                </div>
               <div class="loader">Porfavor espere. cargando...</div>
                     
                     <?php if($productos){ ?>
                        <?php foreach ($productos as $row){ ?>

                           <div id="casilla" class="col-xs-12 col-sm-6 col-md-4 col-lg-3 " >
                               
                                <div class="view view-first">
                                    
                                   <img id="imagenP" class="img-responsive img-thumbnail" alt="" src="<?= base_url() ?>imagenes/<?php echo $tipo; ?>/thumbs/<?php echo $row->ImagenPro; ?>"  style="height: 20%;width: 100%;" />
                                    <span class="img-nombre"><?php echo $row->NombreProd; ?></span>
                                   <div class="mask">
					<div class="info" style="height: 100%;width: 50%;">Acciones
                                            <a  data-toggle="modal" onClick="detalles(this);" href="#myModal" data-idf="<?php echo $row->idproductos; ?>" ><img style="height: 30%;width: 50%; margin-left: 35%;" src="<?= base_url() ?>images/icono_modificar.png" alt="Modificar Imagen"/></a>
                                            <a href="#eliminar" ><img style="height: 30%;width: 50%; margin-top: 15%; margin-left: 35%;" src="<?= base_url() ?>images/icono_eliminar.png" alt="Eliminar imagen" /></a></div>
                                        
                                    </div></div>
                                  
                                  <ul id="css3descripcion" class="topdescripcion">
                                      <li class="topdescripcion"><a   title="Descripcion"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>Descripcion</a>
                                        <ul>
                                            <li><a ><?php echo $row->DescripcionPro; ?></a></li>

                                        </ul>
                                      </li>
                                  </ul>

                           </div>
                        
                        <?php } ?>
                     <?php }else{ ?>
                        <div id="titulos">NO SE ENCONTRARON PRODUCTOS</div>
                     <?php } ?>
                        <div class="modal fade" id="myModal" style="display: none; ">
                            <div class="modal-dialog">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                   <div  style="font: bold italic large Palatino, serif; color: #000000; text-align: center;">Modificar productos</div>
                                                   <div class="loader">Porfavor espere. cargando...</div>

                                            </div>

                                            <div class="modal-body">
                                                <div id="respuesta2"  >
                                                <div id="titulos">Modificar productos</div>
                                                <div id="respuesta" ></div>

                                                </div>
                                             </div>
                                             <div class="modal-footer">

                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                                             </div>
                                    </div>
                            </div>
                    </div>
               </div>
