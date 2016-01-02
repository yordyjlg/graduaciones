<div id="cargar">
    <div id="res"></div>
                    <form id="formulario_mensaje" name="formulario_mensaje"   method="post" >
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                
                                <div id="casilla" style="text-align: center;">
                                    <label id="titulos"><?php echo $notificacion->NombreProd; ?></label>
                                    <img style="box-shadow: 0px 1px 2px #695E5E;" src="<?= base_url() ?>imagenes/<?php echo $notificacion->tipo; ?>/<?php echo $notificacion->ImagenPro; ?>" class="img-responsive" title="Paquete de grado <?php echo $notificacion->NombreProd; ?>"/>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div id="casilla" style="text-align: center;">
                                    <label id="titulos" class="control-label" for="informacionp" >Informacion:</label>
                                    <div style="text-align: left;">
                                        <label   >Fecha de Solicitud: &nbsp;</label><label  style="font-weight: 300;" ><?php echo $notificacion->fecha; ?></label>
                                    </div>
                                    <div style="text-align: left;">
                                        <label   >Cantidad Solicitada: &nbsp;</label><label  style="font-weight: 300;" ><?php echo $notificacion->cantidad; ?></label>
                                    </div>
                                    <div style="text-align: left;">
                                        <label   >Presupuesto Recibido Bs: &nbsp;</label><label  style="font-weight: 300;" ><?php echo $notificacion->montoBs; ?></label>
                                    </div>
                                    <div style="text-align: left;">
                                        <label   >Descripcion:</label>
                                    </div>
                                    <div style="text-align: justify;">
                                        <label  style="font-weight: 300;" ><?php echo $notificacion->DescripcionPro; ?></label>
                                    </div>
                                </div>
                                
                                
                            </div>

                        </div>
                        <div class="row" style="text-align: center;">
                            <div style="text-align: center;">
                            <label id="titulos" >Informacion Adicional:</label>
                            </div>
                            <div style="background: #94d8f6 none repeat scroll 0% 0%;padding: 10px 8px;"  class="col-sm-8 col-sm-push-2 col-sm-pull-2">
                                <div class="form-group " >
                                    <label for="reunion_descripcion">Preguntar: </label>
                                    <textarea  class="form-control "  rows="5"  name="respuesta" required="" ></textarea>
                                </div>
                                <div style="text-align: center;">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="hidden" value="<?=$notificacion->idNotificacion ?>" name="idnotifi" >
                                <input style="width: 20%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="save" class="boton" value="enviar" title="enviar" />

                            </div>
                        </div>
                            </div>
                            <div id="mensajes">
                            <?php if($notificacion->mensajes){ ?>

                            <?php foreach ($notificacion->mensajes as $row){ ?>
                                <div style="background: #fff none repeat scroll 0% 0%;padding: 10px 8px;border-bottom: 1px dotted #CCC;text-align: justify;"  class="col-sm-8 col-sm-push-2 col-sm-pull-2">
                                    <label  style="font-weight: 300;" >
                                        <?php  if($this->session->userdata('datos')->ci_usuario==$row->usuario_ci_usuario): ?>
                                            <label  style="font-weight: 700;" >YO:</label>
                                        <?php else: ?>
                                            <label  style="font-weight: 700;" >Administrador:</label>
                                        <?php endif; ?>
                                        <?php echo $row->mensaje; ?>
                                    </label>
                                </div>
                                <?php } ?>
                            <?php } ?>
                            </div>
                            <div id="final"></div>
                        </div>
    
                        
                        
                    </form>

</div>
<script src="<?= base_url() ?>bootstrap/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $( "#formulario_mensaje" ).submit(function( event ) {
                            event.preventDefault();
                            $.ajax({
                            type: "POST",
                            url: "<?= base_url() ?>productos_clientes/ajax_get_mensajes_notificaciones",
                            dataType: "json",
                            data: $("#formulario_mensaje").serialize(),
                            beforeSend:function(){
                                

                            },success: function(json) {
                               
                                if( $.isEmptyObject(json.results[0]) == false ){
                                    $("#mensajes").html('');
                                    $.each(json.results[0], function(i, result){
                                        var div= document.createElement('div');
                                        $(div).attr('style', 'background: #fff none repeat scroll 0% 0%;padding: 10px 8px;border-bottom: 1px dotted #CCC;text-align: justify;');
                                        $(div).attr('class','col-sm-8 col-sm-push-2 col-sm-pull-2');
                                        var label1= document.createElement('label');
                                        $(label1).attr('style','font-weight: 300;');

                                        var label2= document.createElement('label');
                                        $(label2).attr('style','font-weight: 700;');
                                        if(result['usuario_ci_usuario']==<?=$this->session->userdata('datos')->ci_usuario?>){
                                            $(label2).append('YO: ');
                                        }else{
                                            $(label2).append('Administrador: ');
                                        }
                                        
                                        $(label1).append(label2);
                                        $(label1).append(' '+result['mensaje']);
                                        $(div).append(label1);
                                        $("#mensajes").append(div);
                                    });
                                    document.getElementById("final").scrollIntoView();

                                }
                                /*$("#res").html("");
                                if(res=="error"){
                                    $("#res").html("Debe completar el formulario</br>");
                                }else{
                                    $("#cargar").html(res);
                                }*/

                            }
                            });
                        });
                    });
               </script>