     <div id="cargar" >
         
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
                <link rel="stylesheet" href="<?= base_url() ?>css/estilos_responsive.css" type="text/css" media="screen">
                
               





        
                <div  class=" row tablaHead" id="titulos" style="background-color: rgba(255, 255, 255, 0.32);">
                     Cotizaciónes
                </div>
                <?php $respuesta = $this->session->flashdata('mensaje'); $respuesta=$respuesta['respuesta'];?>
                <?php if(isset($respuesta['clase'])): ?>
                    <div id="success-alert" class="alert <?= $respuesta['clase']?>">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo !empty($respuesta) ? $respuesta["respuest"] : ''  ?>
                    </div>
                <?php endif; ?>
                <div id="res"></div>
        <div class="margen" >
            <table id="presupuesto"></table>
            <div id="paginacion"> </div>
               <div class="loader">Porfavor espere. cargando...</div>
              
               
        </div>     
                    
    </div>
<script type="text/javascript">
            $(document).ready(function(){
           jQuery("#presupuesto").jqGrid({
                    url:'<?= base_url() ?>productos/ajax_tabla_cotizacion/', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['Id','Cliente','Nº Graduandos', 'Estatus','Bs','Fecha','Opciones'],
                    colModel:[
                        {name:'idcotizacion', index:'idcotizacion', width:50, resizable:true, align:"center"},
                        {name:'Nombre', index:'Nombre', width:150,resizable:true, sortable:true, align:"center"},
                        {name:'num_graduandos', index:'num_graduandos', width:30,resizable:true, sortable:true, align:"center"},
                        {name:'estatus', index:'estatus', resizable:true, width:50, align:"center"},
                        {name:'bs', index:'bs', resizable:true, width:50, align:"center"},
                        {name:'fecha', index:'fecha', resizable:true, width:50, align:"center"},
                        {name:'ver',  sortable: false, title:false, resizable:true, width:50,height:10}
                    ],
                    height: "auto",
                    autowidth: true,
                    pager: '#paginacion',
                    rowList: [30, 60,90,200],
                    rowNum: 10,
                    page: 1,
                    sortname: 'idcotizacion',
                    sortorder: 'desc',
                    viewrecords: true,
                    caption: 'Cotizaciones Solicitadas',
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