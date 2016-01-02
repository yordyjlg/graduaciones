<div id="cargar">
    <div id="res"></div>
    <div id="form">
        <form id="form_usuario" name="formulario"   method="post" >
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="nombre">Nombre del Producto:</label>
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control nombre" placeholder="Nombre del Producto" id="nombre" name="nombre" size="30" maxlength="45" onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">
                        <label  class="control-label" for="cantidad" >Cantidad:</label>
                            <div class="input-group">
                                <span class="input-group-addon">#</span>
                                <input type="text" class="form-control cantidad" placeholder="Cantidad" id="cantidad"  name="cantidad" size="30" maxlength="45"  onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">
                        <label  class="control-label" for="precio" >Precio:</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control precio" placeholder="Precio" id="precio"  name="precio" size="30" maxlength="45"  onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>"/>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row" style="text-align: center;">
                <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input style="width: 20%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="save" class="boton" value="enviar" title="enviar" />
                </div>
            </div>
    </form>
    </div>

                        <?php if($productosAlmc){ ?>
                        
                        <div class="row" style="margin-left: 3%;  ">
                            
                            <?php foreach ($productosAlmc as $row){ ?>
                                
                                <div id="casilla" class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                    <div class="view view-first">
                                        <div style=" min-height: 150px;">
                                                <label id="titulos" style="display: inline-block;">Nombre:</label>

                                                    <?php echo $row->nombre_producto; ?>
                                                <br>
                                                <label id="titulos" style="display: inline-block;">Cantidad: </label>
                                                <?php echo $row->cantidad; ?>
                                                <br>
                                                <label id="titulos" style="display: inline-block;">Precio: </label>
                                                <?php echo $row->precio; ?>
                                                <br>
                                        </div>
                                    
                                    
                                        <div class="mask">
                                            <div class="info" style="height: 100%;width: 100%;background-color: #E6E6E6;"><label id="titulos">Acciones</label>
                                                <a   onClick="detalles(this);" data-idf="<?php echo $row->idalmacen; ?>" ><img style="height: 30%;width: 50%; margin-left: 25%;" src="<?= base_url() ?>images/icono_modificar.png" alt="Modificar Imagen"/></a>
                                                <a onClick="detalles(this);" ><img style="height: 30%;width: 50%; margin-top: 5%; margin-left: 25%;" src="<?= base_url() ?>images/icono_eliminar.png" alt="Eliminar imagen" /></a></div>

                                        </div>
                                    </div>
                                </div>
                                    
                            
                            <?php } ?>
                        </div>
                        
                        <?php } ?>
                        
                        
                    

</div>
<script src="<?= base_url() ?>bootstrap/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="<?= base_url() ?>bootstrap/js/bootstrap.js" ></script>
                <script type="text/javascript">
                    
                function detalles(vent){
                    
                    $.ajax({
                            url:   '<?= base_url() ?>almacen/datos_producto',
                            data : { 'idP' : $(vent).data('idf') },
                            type : 'post',
                        beforeSend: function () {
                                   // $("#respuesta2").html("Espere un momento, o intente otra vez por favor...");

                            },
                            success:  function (response) {
                                    $("#form").html(response);
                                    document.formulario.nombre.focus();
                            }
                    });
                   
                    
                }
                    $(document).ready(function() {
                    $("#save").click(function(event) {
                    event.preventDefault();
                    $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>almacen/ingresar_producto",
                    data: $("#form_usuario").serialize(),
                    beforeSend:function(){
			$("#res").html("enviando");
                                                
		    },success: function(res) {
                        $("#res").html("");//cargar
                        if(res=="error"){
                            $("#res").html("Debe completar el formulario</br>");
                        }else{
                            $("#cargar").html(res);
                        }
                        
                    }
                    });
                    });
                    });
               </script>