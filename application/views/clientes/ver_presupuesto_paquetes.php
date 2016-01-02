<div  class="row" id="fraces">
    <div style="padding-bottom: 10px;font-size: 22px;margin-top: 20px;margin-bottom: 10px;">Presupuesto Solicitado</div>
    <div  style="padding: 10px 8px;text-align: justify;"  class="col-sm-8 col-sm-push-2 col-sm-pull-2 <?php if($presupuesto_paquetes->bs==0): ?> alert alert-danger <?php else:?>alert alert-success<?php endif;?>">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label  style="font-weight: 700;font-size: 20px;" >Cantidad de Graduandos: <?=$presupuesto_paquetes->numero_graduandos ?></label>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label  style="font-weight: 700;font-size: 20px;" >Presupuesto Bs: <?=$presupuesto_paquetes->bs ?></label>
        </div>
        
    </div>
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