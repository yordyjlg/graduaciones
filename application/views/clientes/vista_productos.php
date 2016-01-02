     <div id="cargar">
         <div id="error"></div>
         <?php if(!$cargar){ ?>
                <script src="<?= base_url() ?>bootstrap/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
                <script src="<?= base_url() ?>js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/jQuery.resizeEnd.js" type="text/javascript"></script>
                 <script src="<?= base_url() ?>js/i18n/grid.locale-es.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
                    
         <?php } ?>
                <link rel="stylesheet" href="<?= base_url() ?>css/style_descripcion.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-progressbar-2.3.2.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/jquery-ui-1.8.16.custom.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/ui.jqgrid.css" type="text/css" media="screen">
                
               




<script type="text/javascript">

function detalles(vent){

          $.ajax({
                url:   '<?= base_url() ?>productos_clientes/detallesProducto',
                data : { 'idP' : $(vent).data('idf') },
                type : 'GET',
            beforeSend: function () {
                        $("#respuesta2").html('<div class="alert alert-info " id="informacion" role="alert" style="font-size: 18px; font-color:#fff;">Espere un momento, o intente otra vez por favor...</div>');
                        
                },
                success:  function (response) {
                        $("#respuesta2").html(response);
                }
        });
         
}

</script>
<script type="text/javascript">
            $(document).ready(function(){
           jQuery("#presupuesto").jqGrid({
                    url:'<?= base_url() ?>productos_clientes/ajax_tabla_productos_presupuesto/<?=$tipo ?>', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['ID','PRODUCTO', 'CANTIDAD','BS','ESTATUS','VER'],
                    colModel:[
                        {name:'idNotificacion', index:'idNotificacion', width:50, resizable:true, align:"center"},
                        {name:'productos_idproductos', index:'productos_idproductos', width:160,resizable:true, sortable:true, align:"center"},
                        {name:'cantidad', index:'cantidad', resizable:true, width:50, align:"center"},
                        {name:'montoBs', index:'montoBs', resizable:true, width:50, align:"center"},
                        {name:'estatus', index:'estatus', resizable:true, width:50, align:"center"},
                        {name:'ver', index:'ver', resizable:true, width:40, align:"center"}
                    ],
                    height: "auto",
                    autowidth: true,
                    pager: '#paginacion',
                    rowList: [10, 20,50,100],
                    rowNum: 10,
                    page: 1,
                    sortname: 'idNotificacion',
                    sortorder: 'asc',
                    viewrecords: true,
                    caption: 'Presupuestos Solicitados <?php echo $tipo; ?>',
                    resizable:true,
                    hoverrows: false,
                    refresh: true,
                    gridview: true
                });              
            });
            $(window).resizeEnd(function() {
		$(".ui-jqgrid").each(function(){
                    
			var w = parseInt( $(this).parent().width()) - 6;
			var tmpId = $(this).attr("id");
			var gId = tmpId.replace("gbox_","");
			$("#"+gId).setGridWidth(w);
		});
	});

        </script>
        
                <div  class=" row tablaHead" id="titulos" style="background-color: rgba(255, 255, 255, 0.32);">
                     <?php echo strtoupper($tipo); ?>
                </div>
        <table id="presupuesto"></table>
        <div id="paginacion"> </div>
               <div class="loader">Porfavor espere. cargando...</div>
              
                     
                     <?php if($productos){ ?>
                        <?php foreach ($productos as $row){ ?>

                           <div id="casilla" class="col-xs-12 col-sm-6 col-md-4 col-lg-3 " >
                                <div class="view view-first">
                                    
                                   <img id="imagenP" class="img-responsive img-thumbnail" alt="" src="<?= base_url() ?>imagenes/<?php echo $tipo; ?>/thumbs/<?php echo $row->ImagenPro; ?>"  style="height: 20%;width: 100%;" />
                                    <span class="img-nombre"><?php echo $row->NombreProd; ?></span>
                                   <div class="mask">
					<div class="info" style="height: 100%;width: 50%;">Acciones
                                            <a  data-toggle="modal" onClick="detalles(this);" href="#myModal" data-idf="<?php echo $row->idproductos; ?>" ><img style="height: 80%;width: 100%; " src="<?= base_url() ?>images/icono_solicitar_pres.png" alt="Modificar Imagen"/></a>
                                        </div>
                                        
                                    </div></div>
                                  
                                  <ul id="css3descripcion" class="topdescripcion">
                                       <li class="topdescripcion"><a   title="Descripcion"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>Descripcion</a>
                                        <ul>
                                            <li><a ><?php echo $row->DescripcionPro; ?></a></li>

                                        </ul>
                                      </li>
                                  </ul>

                           </div>
                        
                        <?php } ?>
                     <?php }else{ ?>
                        <div id="titulos">NO SE ENCONTRARON PRODUCTOS</div>
                     <?php } ?>
                        <div class="modal fade"  id="myModal" style="display: none; ">
                            <div class="modal-dialog">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                   <div  style="font: bold italic large Palatino, serif; color: #000000; text-align: center;font-size: 24px;" >Solicitar presupuesto</div>
                                                   <div class="loader">Porfavor espere. cargando...</div>

                                            </div>

                                            <div class="modal-body">
                                                <div id="respuesta2"  >
                                                <div id="titulos"></div>
                                                <div id="respuesta" ></div>

                                                </div>
                                             </div>
                                             <div class="modal-footer">

                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                                             </div>
                                    </div>
                            </div>
                    </div>
                    
               </div>
