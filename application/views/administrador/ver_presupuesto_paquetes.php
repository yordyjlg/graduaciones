<div  class="row" id="fraces">
    <div style="padding-bottom: 10px;font-size: 22px;margin-top: 20px;margin-bottom: 10px;">Presupuesto Solicitado</div>
    <form id="formulario_presupuesto">
    <div  style="padding: 10px 8px;text-align: justify;"  class="col-sm-8 col-sm-push-2 col-sm-pull-2 <?php if($presupuesto_paquetes->bs==0): ?> alert alert-danger <?php else:?>alert alert-success<?php endif;?>">
        <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label  style="font-weight: 700;font-size: 20px;" >Cantidad de Graduandos: <?=$presupuesto_paquetes->numero_graduandos ?></label>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label  style="font-weight: 700;font-size: 20px;" >Presupuesto Bs: <?=$presupuesto_paquetes->bs ?> </label>
                <input type="hidden" value="<?=$presupuesto_paquetes->idsolicitud_presupuesto ?>" name="idnotifi" >
                <input type="number" name="presupuesto_bs" style="height: 30px;font-weight: 700;font-size: 14px;width: 100px;">
                <input style=" margin-top: 1%;margin-bottom: 1%;height: 30px;" type="submit" id="btnpresupuesto" class="boton" value="enviar" title="enviar" />
           
        </div>
        </div> 
    </div>
         </form>
        <?php if($productos){ ?>
            <?php $cont=true;?>
            <?php foreach ($productos as $row){ ?>
                <?php if($cont){?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"  >
                        
                        <img style="max-height: 300px;width: 100%;" src="<?= base_url() ?>imagenes/paquetes/<?php echo $row->imagen; ?>" class="img-responsive" title="Paquete de grado <?php echo $row->nombre; ?>"/>
                        <span class="img-nombre" style="top: 0%;"><?php echo $row->nombre; ?></span>
                    </div>
                <div style="padding-bottom: 10px;font-size: 22px;" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >Productos</div>
                <?php $cont=false;
                }?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="fraces" style="  font-size: 16px;">
                    <?php echo strtoupper($row->nombre_producto); ?>
                </div>
            <?php } ?>
        <?php } ?>
                
                
</div>

<script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript">

                    $(document).ready(function() {
                       
                        $( "#formulario_presupuesto" ).submit(function( event ) {
                            event.preventDefault();
                            $.ajax({
                            type: "POST",
                            url: "<?= base_url() ?>productos/ajax_insert_presupuesto",
                            dataType: "json",
                            data: $("#formulario_presupuesto").serialize(),
                            beforeSend:function(){
                                

                            },success: function(json) {
                               
                               /* if( json.results[0]){
                                        var div= document.createElement('div');
                                        $(div).attr('style', 'background: #fff none repeat scroll 0% 0%;padding: 10px 8px;border-bottom: 1px dotted #CCC;');
                                        
                                        $(div).append('Presupuesto enviado');
                                        $("#divPresupuesto").append(div);
                                    

                                }*/
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