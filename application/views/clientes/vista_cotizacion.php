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
                     Cotización
                </div>
                <div id="res"></div>
        <div class="margen" >
            <table id="presupuesto"></table>
            <div id="paginacion"> </div>
               <div class="loader">Porfavor espere. cargando...</div>
              
               <form id="form_cotizacion" name="formulario"   method="post" >  
                <div class="row" style="padding-left: 5%;padding-right: 5%;"> 
                    <div  class="" id="titulos" style="margin-top: 30px;margin-bottom: 30px;">
                        Solicitar Cotización
                   </div>
                    <div class="col-xs-12 col-sm-4 col-md-4"></div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="numero_grad">N° de Graduandos (mínimo 50).</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="number" class="form-control numero_grad" placeholder="Número de Graduandos" id="numero_grad" name="numero_grad" value="50" />
                            </div>
                        </div>
                    </div>
                </div>
                     <?php if($productos){ ?>
                    <table class="table table-bordered no-margins">
                         <thead>
                             <tr>
                                 <th ><span class="hidden-xs">Seleccionar</span></th>
                                 <th>Cantidad</th>
                                 <th>Producto</th>
                             </tr>
                         </thead>
                         <tbody>
                        <?php foreach ($productos as $row){ ?>
                            <tr>
                                <td>
                                    <div class="input-group" style="width: 100%;">
                                        <input type="checkbox" class="form-control check" value="<?php echo $row->idalmacen; ?>" id="check" name="check[]" checked="" />
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon hidden-xs "></span>
                                        <input type="number" class="form-control cantidad" placeholder="Cantidad" id="cantidad" name="cantidad<?php echo $row->idalmacen; ?>" value="50" />
                                    </div>
                                </td>
                                <td><span id="nombre_producto" class="nombre_producto" ><?php echo $row->nombre_producto; ?></span></td>
                            </tr>
                           
                        
                        <?php } ?>
                    </tbody>
                 </table>
                 <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <input id="guardar" type="submit" name="btn" value="Solicitar Cotización" class="btn btn-block btn-outline btn-primary" style="font-size: 120%;">
                    </div>
                 </form>
                     <?php }else{ ?>
                        <div id="titulos">NO SE ENCONTRARON PRODUCTOS</div>
                     <?php } ?>
        </div>     
                    
    </div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#guardar").click(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>productos_clientes/ajax_insertar_cotizacion",
                data: $("#form_cotizacion").serialize(),
                beforeSend:function(){
                    $("#res").html("");//cargar
                    $("#res").html('<div id="success-alert" class="alert alert-info"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Enviando... Porfavor Espere.</div>');
                    $("#res").html("Enviando... Porfavor Espere");
                    $('html, body').animate({
                        scrollTop: $("#res").offset().top
                    }, 200);
                },success: function(res) {
                    var respuesta = $.parseJSON(res);
                    $("#res").html("");//cargar
                    $("#res").html('<div id="success-alert" class="alert '+respuesta.clase+'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+respuesta.respuest+'</div>');
                    $("#presupuesto").trigger("reloadGrid");
                    limpiar_campos();
                    $('html, body').animate({
                        scrollTop: $("#res").offset().top
                    }, 200);
                }
            });
        });
    });
    $(".check").change(function(){
        console.log($(this).is(':checked'));
        if( $(this).is(':checked') ) {
            $(this).parent().parent().parent().find('#cantidad').prop("disabled", false);
            $(this).parent().parent().parent().find('#nombre_producto').css("color", "#333");
        } else {
            $(this).parent().parent().parent().find('#cantidad').prop("disabled", true);
            $(this).parent().parent().parent().find('#nombre_producto').css("color", "#886e84");
        }
    });
    $(".numero_grad").change(function(){
        valorCantidad();
    });
    $(".numero_grad").keyup(function(){
        valorCantidad();
    });
    function limpiar_campos(){
        $(".numero_grad").val("50");
        $('.check').each(function(i, obj) {
            $(this).prop("checked", true);
        });
        $('.cantidad').each(function(i, obj) {
            $(this).val("50");
            $(this).prop("disabled", false);
        });
        $('.nombre_producto').each(function(i, obj) {
            $(this).css("color", "#333");
        });
    }
    function valorCantidad(){
        $('.cantidad').each(function(i, obj) {
            $(this).val($("#numero_grad").val());
        });
        
    }


</script>
<script type="text/javascript">
            $(document).ready(function(){
           jQuery("#presupuesto").jqGrid({
                    url:'<?= base_url() ?>productos_clientes/ajax_tabla_cotizacion/', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['Id','Nº Graduandos', 'Estatus','Bs','Fecha','Opciones'],
                    colModel:[
                        {name:'idcotizacion', index:'idcotizacion', width:50, resizable:true, align:"center"},
                        {name:'num_graduandos', index:'num_graduandos', width:160,resizable:true, sortable:true, align:"center"},
                        {name:'estatus', index:'estatus', resizable:true, width:50, align:"center"},
                        {name:'bs', index:'bs', resizable:true, width:50, align:"center"},
                        {name:'fecha', index:'fecha', resizable:true, width:50, align:"center"},
                        {name:'ver',  sortable: false, title:false, resizable:true, width:50,height:10}
                    ],
                    height: "auto",
                    autowidth: true,
                    pager: '#paginacion',
                    rowList: [10, 20,50,100],
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