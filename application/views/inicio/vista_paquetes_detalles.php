<div  class="row" >
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="fraces" >
        <?php if($productos){ ?>
            <?php $cont=true;?>
            <?php foreach ($productos as $row){ ?>
                <?php if($cont){?>
                    <?php echo $row->nombre; ?>
                    <img style="max-height: 300px;width: 100%;" src="<?= base_url() ?>imagenes/paquetes/<?php echo $row->imagen; ?>" class="img-responsive" title="Paquete de grado <?php echo $row->nombre; ?>"/>
                    <div>Productos</div>
                <?php $cont=false;
                }?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="fraces" style="border: solid #000">
                    <?php echo $row->nombre_producto; ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>