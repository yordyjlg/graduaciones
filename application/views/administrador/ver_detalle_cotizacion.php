<link rel="stylesheet" href="<?= base_url() ?>css/estilos_responsive.css" type="text/css" media="screen">
<div  class="row" id="fraces">
    <div  class="row" >
    <div style="padding-bottom: 10px;font-size: 22px;margin-top: 20px;margin-bottom: 10px;">Cotización Solicitada</div>
    <div  style="padding: 10px 8px;text-align: justify;"  class=" row col-sm-8 col-sm-push-2 col-sm-pull-2 <?php if($cotizacion->bs==0): ?> alert alert-danger <?php else:?>alert alert-success<?php endif;?>">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label  style="font-weight: 700;font-size: 20px;color: #000" >Nombre del Cliente: <?=$cotizacion->Nombre.' '.$cotizacion->Apellido ?></label>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label  style="font-weight: 700;font-size: 20px;color: #000" >Telefono: <?=$cotizacion->telefono ?></label>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label  style="font-weight: 700;font-size: 20px;color: #000" >Cantidad de Graduandos: <?=$cotizacion->num_graduandos ?></label>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label  style="font-weight: 700;font-size: 20px;color: #000" >Presupuesto Enviado Bs: <?=$cotizacion->bs ?></label>
        </div>
        
    </div>
    </div>
            <div class="row" style="padding-left: 5%;padding-right: 5%;">
                <form id="form_cotizacion" name="formulario_cotizacion" action="<?= base_url() ?>productos/cotizacion"  method="post" >  
                    <div class="row" >
                        <div class="col-xs-12 col-sm-4 col-md-4"></div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label style="font-size: 22px;" class="control-label" for="numero_grad"> Cotización Bs.</label>
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input type="number" class="form-control cotización_Bs" placeholder="Cotización Bs" id="cotizacion_Bs" name="cotizacion_Bs" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <input type="hidden" name="idCotizacion" value="<?=$cotizacion->idcotizacion ?>" >
                            <input id="guardar" type="submit" name="btn" value="Enviar Cotización Bs" class="btn btn-block btn-outline btn-primary" style="margin-bottom: 30px">
                        </div>
                    </div>
                </form>
            </div>
    <div class="margen" >
        <div  class="row" >
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div  class=" row tablaHead" id="titulos" style="background-color: rgba(255, 255, 255, 0.32);font-size: 22px;">
                    Productos
                </div>
            </div>
            
        </div>
        <?php if($productos){ ?>
            
            <?php foreach ($productos as $row){ ?>
                
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="fraces" style="  font-size: 16px;border: 1px solid #d4d0d0;border-bottom-width: 4px;">
                    <?php echo strtoupper($row['nombre_producto']); ?>
                        <div class="row">
                            Cantidad: <?=$row['cantidads'] ?>
                        </div>
                    </div>
            <?php } ?>
        <?php } ?>
    </div>            
                
</div>