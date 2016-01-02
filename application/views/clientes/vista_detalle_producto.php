<?php if($productos){ ?>
    <?php foreach ($productos as $row){ ?>
        <?php $tipod="";
                if($row->tipo=="ANILLO"){
                    $tipod="anillos";
                }else if($row->tipo=="MEDALLA"){
                    $tipod="medallas";
                }else if($row->tipo=="TITULO"){
                    $tipod="titulo";
                }else if($row->tipo=="ALBUM"){
                    $tipod="album";
                } ?>
        <div  id="resp" style="  margin-left: 0px;">
             <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                <img  class="img-responsive img-thumbnail" style="height: 10%;width: 100%;" src="<?= base_url() ?>imagenes/<?php echo $tipod; ?>/<?php echo $row->ImagenPro; ?>" />
               <span class="img-nombre"><?php echo $row->NombreProd; ?></span>
            </div>
            </div>
            <div style="text-align: center;">
                <form id="solicitarPP" name="solicitarPP" enctype="multipart/form-data"  method="post">
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                    <div class="form-group">
                        <label style="vertical-align: top;" class="control-label col-xs-12" for="cantidads">Cantidad:</label>
                        <input style="width: 50%;float: none; display: unset;"  type="text"  class="form-control cantidads col-xs-12" id="cantidads" name="cantidads" value="" />
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                    <div class="form-group">
                        <label style="vertical-align: top;" class="control-label col-xs-12" for="Iadicional">Informacion adicional:</label>
                        <textarea  style="width: 90%;float: none; display: unset;"  class="form-control col-xs-12"cols="50" rows="1" id="Iadicional" name="Iadicional"></textarea>
                        
                    </div>
                </div>
            </div>
                <input type="hidden" name="idproducto" value="<?php echo $row->idproductos; ?>" />
                <input type="hidden" name="tipoproducto" value="<?php echo $tipod; ?>" />
                <input style="width: 20%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="saveM" onClick="solicitarPres(this);" class="boton" value="Solicitar" title="Solicitar" />
                </form>
            </div>
           
        </div>
    <?php } ?>

 <?php }else{ ?>
      <div id="titulos">NO SE ENCONTRARON PRODUCTOS</div>
<?php } ?>
<script type="text/javascript">
    function solicitarPres(vent){

          $.ajax({
                url:   '<?= base_url() ?>productos_clientes/productos_solicitar_presupuesto',
                data : $("#solicitarPP").serialize(),
                type : 'POST',
            beforeSend: function () {
                        $("#respuesta2").html('<div class="alert alert-info " id="informacion" role="alert" style="text-align: center;font-size: 18px; font-color:#fff;">Espere un momento, o intente otra vez por favor...</div>');
                        
                },
                success:  function (response) {
                        $("#respuesta2").html('<div class="alert alert-info " id="informacion" role="alert" style="text-align: center;font-size: 18px; font-color:#fff;">'+response+'</div>');
                }
        });
         
}
</script>