                
                <script type="text/javascript" src="<?= base_url() ?>bootstrap/js/jquery.js" ></script>
                <script type="text/javascript" src="<?= base_url() ?>bootstrap/js/bootstrap.js" ></script> 
                <link rel="stylesheet" href="<?= base_url() ?>css/style_descripcion.css" type="text/css" media="screen">
                
                     <?php $contador=0; ?>
                     <?php if($productos){ ?>
                        <?php foreach ($productos as $row){ ?>

                           <div id="casilla" class="col-xs-12 col-sm-6 col-md-4 col-lg-3 " >
                                    
                               <img style="height: 20%;width: 100%;" src="<?= base_url() ?>imagenes/<?php echo $tipo; ?>/thumbs/<?php echo $row->ImagenPro; ?>" id="imagenP" class="img-responsive img-thumbnail" alt=""/>
                                   <span class="img-nombre"><?php echo $row->NombreProd; ?></span>
                                  
                                  <ul id="css3descripcion" class="topdescripcion">
                                      <li class="topdescripcion"><a   title="Descripcion"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>Descripcion</a>
                                        <ul>
                                            <li><a ><?php echo $row->DescripcionPro; ?></a></li>

                                        </ul>
                                      </li>
                                  </ul>

                           </div>
                        <?php $contador++; ?>
                        <?php if($contador==3){?>

                        <!--<div class="span2" style="width: 100%"></div>-->
                        <?php $contador=0; }?>
                        <?php } ?>
                     <?php }else{ ?>
                        <div id="titulos">NO SE ENCONTRARON PRODUCTOS</div>
                     <?php } ?>
               