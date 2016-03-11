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
            $(document).ready(function(){
           jQuery("#presupuesto").jqGrid({
                    url:'<?= base_url() ?>productos/ajax_tabla_productos_presupuesto/<?=$tipo ?>', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['Id','Cliente','Producto', 'Cantidad','Bs','Estatus','Ver'],
                    colModel:[
                        {name:'idNotificacion', index:'idNotificacion', width:50, resizable:true, align:"center"},
                        {name:'usuario_ci_usuario', index:'usuario_ci_usuario', width:160,resizable:true, sortable:true, align:"center"},
                        {name:'productos_idproductos', index:'productos_idproductos', width:160,resizable:true, sortable:true, align:"center"},
                        {name:'cantidad', index:'cantidad', resizable:true, width:50, align:"center"},
                        {name:'montoBs', index:'montoBs', resizable:true, width:50, align:"center"},
                        {name:'estatus', index:'estatus', resizable:true, width:50, align:"center"},
                        {name:'ver', sortable: false, title:false, resizable:true, width:50,height:10}
                    ],
                    height: "auto",
                    autowidth: true,
                    pager: '#paginacion',
                    rowList: [10, 20,50,100],
                    rowNum: 10,
                    page: 1,
                    sortname: 'idNotificacion',
                    sortorder: 'desc',
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
        <?php if($tipo!="catalogo"){ ?>
                <table id="presupuesto"></table>
                <div id="paginacion"> </div>
        <?php } ?>
        
               
              
                        
                    
               </div>
