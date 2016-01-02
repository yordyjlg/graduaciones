<div  class="row" id="fraces">
    
        <?php if($productos){ ?>
            <?php $cont=true;?>
            <?php foreach ($productos as $row){ ?>
                <?php if($cont){?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"  >
                        
                        <img style="max-height: 300px;width: 100%;" src="<?= base_url() ?>imagenes/paquetes/<?php echo $row->imagen; ?>" class="img-responsive" title="Paquete de grado <?php echo $row->nombre; ?>"/>
                        <span class="img-nombre" style="top: 0%;"><?php echo $row->nombre; ?></span>
                    </div>
                <div style="padding-bottom: 10px;font-size: 22px;">Productos</div>
                <?php $cont=false;
                }?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="fraces" style="  font-size: 16px;">
                    <?php echo strtoupper($row->nombre_producto); ?>
                </div>
            <?php } ?>
        <?php } ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="fraces" style="  font-size: 16px;">
                    <form name="formulario_solicitar_paqt" id="formulario_solicitar_paqt">
                        <div id="info" >
                            
                        </div>
                        <div id="form" >
                            <div class="form-group" style="margin-top: 20px;">
                                <label  class="control-label" for="cantidad" >N° de Graduandos (mínimo 50).</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">#</span>
                                        <input type="number" value="50" name="numero_graduandos" class="form-control cantidad" placeholder="N° de Graduandos (mínimo 50)."/>
                                </div>
                            </div>
                            <input type="hidden" name="id_paquete" value="<?=$id_paquete?>">
                            <input type="hidden" name="cedula_usu" value="<?=$this->session->userdata('datos')->ci_usuario?>">
                            <input type="submit" name="btn" value="Solicitar Presupuesto" class="btn btn-block btn-outline btn-primary" style="font-size: 120%;">
                        </div>
                    </form>
                    </div>
                
</div>
<script>
            $( "#formulario_solicitar_paqt" ).submit(function( event ) {
                    event.preventDefault();
                    
                    $.ajax({
                        url:   '<?= base_url() ?>productos_clientes/ajax_ingresar_solicitud_presupuesto',
                        data : $("#formulario_solicitar_paqt").serialize(),
                        type : 'POST',
                        beforeSend: function () {
                            var div= document.createElement('div');
                            $(div).attr('style', 'font-size: 130%;margin-top: 30px;');
                            $(div).html("Enviando, porfavor espere...");
                            $( "#info" ).html('');
                            $( "#info" ).append(div);
                            $( "#form" ).attr('style', 'display: none;');
                        },
                        success:  function (response){ 
                            var div= document.createElement('div');
                            $(div).attr('class', 'alert alert-success');
                            $(div).html("Enviado exitosamente.");
                            $( "#info" ).html('');
                            $( "#info" ).append(div);
                            $( "#form" ).attr('style', '');
                            $('#presupuesto').trigger('reloadGrid');
                        }
                });
                  });
</script>