<div id="cargar">
         <div id="error"></div>

                     <script src="<?= base_url() ?>bootstrap/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
                <script src="<?= base_url() ?>js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/jQuery.resizeEnd.js" type="text/javascript"></script>
                 <script src="<?= base_url() ?>js/i18n/grid.locale-es.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
                    
         
                <link rel="stylesheet" href="<?= base_url() ?>css/style_descripcion.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-progressbar-2.3.2.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/jquery-ui-1.8.16.custom.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/ui.jqgrid.css" type="text/css" media="screen">
                

<script type="text/javascript">
function verpaquete(vent){

          $.ajax({
                url:   '<?= base_url() ?>productos_clientes/paquetesDetalles',
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
$(document).ready(function(){
           jQuery("#presupuesto").jqGrid({
                    url:'<?= base_url() ?>productos_clientes/ajax_tabla_solicitud_presupuesto', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['ID','Nombre del Paquete', 'Nº Graduandos','BS','Estatus','VER'],
                    colModel:[
                        {name:'idsolicitud_presupuesto', index:'idsolicitud_presupuesto', width:50, resizable:true, align:"center"},
                        {name:'idpaquetes_grados', index:'idpaquetes_grados', width:160,resizable:true, sortable:true, align:"center"},
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
                    sortname: 'idsolicitud_presupuesto',
                    sortorder: 'asc',
                    viewrecords: true,
                    caption: 'Presupuestos Solicitados',
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
                <div class="row" >
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style=" text-align: center;">
                        
                        <label id="titulos">Paquetes de Grado</label>
                    </div>
                        <?php if($paquetes){ ?>

                            <?php foreach ($paquetes as $row){ ?>
                            
                                <div   class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                    <a onClick="verpaquete(this);" data-id="<?php echo $row->idpaquetes_grados; ?>">
                                        <div id="casilla">
                                            <label id="titulos"><?php echo $row->nombre; ?></label>
                                            <img style="max-height: 100px;width: 100%;" src="<?= base_url() ?>imagenes/paquetes/thumbs/<?php echo $row->imagen; ?>" class="img-responsive" title="Paquete de grado <?php echo $row->nombre; ?>"/>
                                        </div>
                                    </a> 
                                </div>
                                  
                            <?php } ?>
                        <?php } ?>

                    
                 </div>
                 <div class="row" >
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
                        
                        <div  id="casilla" >
                            <div id="titulos" class="titulocurepo">
                                <div id="respuestajax">
                                    SELECCIONE PAQUETE PARA VER DETALLES
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
               <table id="presupuesto"></table>
                <div id="paginacion"> </div>
</div>