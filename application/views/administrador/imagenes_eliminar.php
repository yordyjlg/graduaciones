<style>
    .img-mascara {
        cursor: pointer;
        min-height: 100%;
        color: #FFF;
        border-radius: 4px;
        position: absolute;
        display: none;
        width: 99%;
        text-align: center;
        background: rgba(0, 0, 0, 0.50) none repeat scroll 0% 0%;
        font: bold 16px/24px Helvetica, Sans-Serif;
        letter-spacing: -1px;
    }
</style>
<div class="margen" >
        <div  class="row" >
            <div class="wrapper wrapper-content">
                
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" id="volver" class="btn btn-primary pull-left">Volver</button>
                <div class="ibox float-e-margins">
                    <form id="form_eliminar"  action="#">
                    <div class="row ibox-content">
                        Seleccione las imagenes a eliminar haciendo click sobre ellas
                        <div>
                            <?php foreach ($imagenes as $value) { ?>
                            <div id="imagen_eliminar" class="col-xs-12 col-sm-4 col-md-4 col-lg-3 imagen_eliminar" data-select="0" style="margin-bottom: 10px;" >
                                <span class="img-mascara"  style="color: transparent"></span>
                                <input type="checkbox" name="id_imagenes[]" id="check" value="<?=$value['idGaleria'] ?>" style="display: none;" >
                                <a href="<?= base_url().$value['directorio'] ?>" >
                                    <img  class="img-responsive " src="<?= base_url()."/imagenes/galeria/thumbs/".$value['Imagen'] ?>">
                                </a>
                            </div>
                            <?php } ?>

                        </div>
                        <div class="col-xs-12 ">
                            
                        </div>
                        <button type="submit" id="eliminar_select" class="btn btn-success pull-left">Eliminar imagenes</button>
                    </div>
                    </form>
                </div>
            </div>
                
            </div>
                
        </div>
            
        </div>
    </div>

<script>
        $(".imagen_eliminar").click(function(event) {
            event.preventDefault();
            console.log($(this).data("select"));
            if($(this).data("select")==0){
                $(this).data("select","1");
                $(this).find(".img-mascara").css("display", "block");
                $(this).find("#check").prop("checked", true);
            }else{
                $(this).data("select","0");
                $(this).find(".img-mascara").css("display", "none");
                $(this).find("#check").prop("checked", false);
            }
        });
        $("#eliminar_select").click(function(event) {
            event.preventDefault();
           $.ajax({
                    type: "POST",
                    url: '<?= base_url() ?>administrador/eliminar_imagenes_select',
                    data: $("#form_eliminar").serialize(),
                    success: function(data)
                    {
			$("#imagenes_galeria").html(data);
                    }
		});
        });
        $("#volver").click(function(event) {
            event.preventDefault();
           $.ajax({
                    type: "POST",
                    url: '<?= base_url() ?>administrador/imagenes_galeria',
                    success: function(data)
                    {
                        $("#imagenes_galeria").html(data);
                    }
		});
        });
</script>