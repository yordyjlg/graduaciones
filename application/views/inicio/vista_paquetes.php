
    <div class="span3" style="min-height: 250px;margin-left: 0px; ">
        <label id="titulos">Paquetes</label>
        <?php if($paquetes){ ?>
        
            <?php foreach ($paquetes as $row){ ?>
            <a onClick="verpaquete(this);" data-id="<?php echo $row->idpaquetes_grados; ?>">
                <div id="casilla" style=" margin: 15px;">
                    <label id="titulos"><?php echo $row->nombre; ?></label>
                    <img style="max-height: 100px;width: 100%;" src="<?= base_url() ?>imagenes/paquetes/<?php echo $row->imagen; ?>" class="img-responsive" title="Paquete de grado <?php echo $row->nombre; ?>"/>
                </div>
            </a>       
            <?php } ?>
        <?php } ?>
        
    </div>
    <div class="span7" id="casilla" style="   min-height: 250px;margin-left: 0.5%; ">
        <div id="titulos" class="titulocurepo">
            Paquete de grado
            <div id="respuestajax">
                
            </div>
            
        </div>
        
    </div>

<script type="text/javascript" src="<?= base_url() ?>bootstrap/js/jquery.js" ></script>
<script type="text/javascript" src="<?= base_url() ?>bootstrap/js/bootstrap.js" ></script>
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

</script>