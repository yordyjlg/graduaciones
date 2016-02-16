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
                
                <form id="form_universidad" name="formulario"   method="post" >
                    <div id="res"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                <label class="control-label" for="nombrep">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input type="text" class="form-control nombreu" placeholder="Nombre" id="nombreu" name="nombreu" onKeyUp="return valid(event,this)" value="<?php ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                <label  class="control-label" for="informacionp" >Dirección:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control direccionu" placeholder="Dirección" id="direccionu"  name="direccionu"  onKeyUp="return valid(event,this)" value="<?php  ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label style="color: transparent;" class="control-label" for="informacionp" >Dirección:</label>
                                <input style="width: 90%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="save" class="boton" value="enviar" title="enviar" />
                            </div>
                        </div>

                    </div>
                </form>
                
                <table id="universidades"></table>
                <div id="paginacion"> </div>

<script type="text/javascript">
$(document).ready(function(){
           jQuery("#universidades").jqGrid({
                    url:'<?= base_url() ?>universidad/ajax_tabla_universidad', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['ID','Nombre', 'Dirección','Modificar'],
                    colModel:[
                        {name:'idUniversidad', index:'idUniversidad', width:50, resizable:true, align:"center"},
                        {name:'NombreUniversidad', index:'NombreUniversidad', width:160,resizable:true, sortable:true, align:"center"},
                        {name:'direccion', index:'direccion', resizable:true, width:50, align:"center"},
                        {name:'ver', index:'ver', resizable:true, width:40, align:"center"}
                    ],
                    height: "auto",
                    autowidth: true,
                    pager: '#paginacion',
                    rowList: [10, 20,50,100],
                    rowNum: 10,
                    page: 1,
                    sortname: 'NombreUniversidad',
                    sortorder: 'asc',
                    viewrecords: true,
                    caption: 'Universidades',
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
        
        
        $(document).ready(function() {
            $("#save").click(function(event) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>universidad/ingresar_universidad",
                    data: $("#form_universidad").serialize(),
                    beforeSend:function(){
                        $("#res").html("enviando");
                    },success: function(res) {
                        var respuesta = $.parseJSON(res);
                        $("#res").html("");//cargar
                        $("#res").html('<div id="success-alert" class="alert '+respuesta.clase+'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+respuesta.respuest+'</div>');
                        $("#universidades").trigger("reloadGrid");
                        document.getElementById("form_universidad").reset();
                        $('html, body').animate({
                            scrollTop: $("#res").offset().top
                        }, 200);
                    }
                });
            });
        });
</script>