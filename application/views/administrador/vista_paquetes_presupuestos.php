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

$(document).ready(function(){
           jQuery("#presupuesto").jqGrid({
                    url:'<?= base_url() ?>productos/ajax_tabla_solicitud_presupuesto', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['ID','Cliente','Nombre del Paquete', 'Nº Graduandos','BS','Estatus','VER'],
                    colModel:[
                        {name:'idsolicitud_presupuesto', index:'idsolicitud_presupuesto', width:50, resizable:true, align:"center"},
                        {name:'ci_usuario', index:'ci_usuario', width:50,resizable:true, sortable:true, align:"center"},
                        {name:'idpaquetes_grados', index:'idpaquetes_grados', width:160,resizable:true, sortable:true, align:"center"},
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
                    sortname: 'idsolicitud_presupuesto',
                    sortorder: 'desc',
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
                
                 
                
               <table id="presupuesto"></table>
                <div id="paginacion"> </div>
</div>