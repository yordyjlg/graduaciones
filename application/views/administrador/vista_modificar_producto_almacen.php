<?php if($productos){ ?>
    <?php foreach ($productos as $row){ ?>
        <form id="form_usuario" name="formulario"   method="post" >
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $row->idalmacen; ?>" />
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="nombre">Nombre del Producto:</label>
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control nombre" placeholder="Nombre del Producto" id="nombre" name="nombre" size="30" maxlength="45" onKeyUp="return valid(event,this)" value="<?php echo $row->nombre_producto; ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">
                        <label  class="control-label" for="cantidad" >Cantidad:</label>
                            <div class="input-group">
                                <span class="input-group-addon">#</span>
                                <input type="text" class="form-control cantidad" placeholder="Cantidad" id="cantidad"  name="cantidad" size="30" maxlength="45"  onKeyUp="return valid(event,this)" value="<?php echo $row->cantidad; ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">
                        <label  class="control-label" for="precio" >Precio:</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control precio" placeholder="Precio" id="precio"  name="precio" size="30" maxlength="45"  onKeyUp="return valid(event,this)" value="<?php echo $row->precio; ?>" />
                        </div>
                    </div>
                </div>

            </div>
                <div class="row" style="text-align: center;">
                    <div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input style="width: 20%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="modificar" class="boton" value="Modificar" title="Modificar" />
                    </div>
                </div>
            </form>
    <?php } ?>

     <?php }else{ ?>
      <div id="titulos">NO SE ENCONTRARON PRODUCTOS</div>
    <?php } ?>
                <script type="text/javascript">
                    
                
                    $(document).ready(function() {
                    $("#modificar").click(function(event) {
                    event.preventDefault();
                    $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>almacen/modificar_producto",
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