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
                <link rel="stylesheet" href="<?= base_url() ?>css/filtro.css" type="text/css" media="screen">
<div id="cargar">
    <div id="res"></div>
    <div id="form">
        <form id="form_almacen" name="formulario"   method="post" >
            <div class="row" style="margin-left: 5%;margin-right: 5%;">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="nombre">Nombre del Producto:</label>
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control nombre" placeholder="Nombre del Producto" id="nombre" name="nombre" size="30" maxlength="45" onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">
                        <label  class="control-label" for="cantidad" >Cantidad:</label>
                            <div class="input-group">
                                <span class="input-group-addon">#</span>
                                <input type="text" class="form-control cantidad" placeholder="Cantidad" id="cantidad"  name="cantidad" size="30" maxlength="45"  onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">
                        <label  class="control-label" for="precio" >Precio:</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control precio" placeholder="Precio" id="precio"  name="precio" size="30" maxlength="45"  onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>"/>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_almacen" id="id_almacen" value="0" />
            </div>
            <div class="row" style="text-align: center;">
                <div class="col-xs-12 col-sm-5 col-md-5 " ></div>
                <div class="col-xs-12 col-sm-2 col-md-2 " >
                    <div class="form-group">
                        <label style="color: transparent;" class="control-label" for="informacionp" >:</label>
                        <input style="width: 90%; margin-top: 1%;margin-bottom: 1%;padding: 0px;" type="submit" id="save" class="boton" value="Enviar" title="Enviar" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 form_btn_canc" style="display: none;">
                    <div class="form-group">
                        <label style="color: transparent;" class="control-label" for="informacionp" >:</label>
                        <input style="width: 90%; margin-top: 1%;margin-bottom: 1%;padding: 0px;" type="submit" id="cancelar" class="boton" value="Cancelar" title="Cancelar" />
                    </div>
                </div>
            </div>
    </form>
    </div>
    
    <div class="container-fluid" style="margin-top: 40px;">
                    <div class="accordion" id="accordion2">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" href="#collapseOne" data-toggle="collapse" data-parent="#accordion2">
                                    Filtrar.
                                </a></div>
                            <div class="accordion-body collapse" id="collapseOne" style="height: 0px;">
                                <div class="accordion-inner">
                                    <form id="form_filtro_universidad" name="formulario"   method="post" autocomplete="off" >
                    
                                            <div class="row" style="padding-left: 5%;padding-right: 5%;">
                                                <div class="col-xs-12 col-sm-5 col-md-4 " >
                                                    <div class="form-group">
                                                        <label class="control-label" for="filtro_nombreu">Nombre:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"></span>
                                                            <input type="text" class="form-control filtro_nombreu" placeholder="Nombre" id="filtro_nombreu" name="filtro_nombreu"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xs-12 col-sm4 col-md-4 ">
                                                    <div class="form-group">
                                                        <label  class="control-label" for="filtro_estado" >Estado:</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <select id="filtro_estado" name="filtro_estado" class="form-control">
                                                                    <option value="">SELECCIONE</option>
                                                                    <option value="1">Activos</option>
                                                                    <option value="2">inactivos</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-8 col-md-8 "></div>
                                                <div class="col-xs-12 col-sm-2 col-md-2 ">
                                                    <div class="form-group">
                                                        <label style="color: transparent;" class="control-label" for="filtro" >Dirección:</label>
                                                        <input style="width: 90%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="filtro" class="boton" value="Filtrar" title="Filtrar"  />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-2 col-md-2 " >
                                                    <div class="form-group">
                                                        <label style="color: transparent;" class="control-label" for="cancelar_filtro" >Dirección:</label>
                                                        <input style="width: 90%; margin-top: 1%;margin-bottom: 1%;padding: 0px;" type="submit" id="cancelar_filtro" class="boton" value="Cancelar" title="Cancelar" />
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <table id="tabla_productos"></table>
    <div id="paginacion"> </div>

                       
                        
                        
                    

</div>
                <script type="text/javascript">
                    
                    
       $(document).ready(function(){
           jQuery("#tabla_productos").jqGrid({
                    url:'<?= base_url() ?>almacen/ajax_tabla_almacen', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['Nombre', 'Cantidad','Precio','Estado','Opciones'],
                    colModel:[
                        {name:'nombre_producto', index:'nombre_producto', width:160,resizable:true, sortable:true, align:"center"},
                        {name:'cantidad', index:'cantidad', resizable:true, width:50, align:"center"},
                        {name:'precio', index:'precio', resizable:true, width:50, align:"center"},
                        {name:'estado', index:'estado', resizable:true, width:50, align:"center"},
                        {name:'ver',  sortable: false, title:false, resizable:true, width:50,height:10}
                    ],
                    height: "auto",
                    autowidth: true,
                    pager: '#paginacion',
                    rowList: [10, 20,50,100],
                    rowNum: 10,
                    page: 1,
                    sortname: 'nombre_producto',
                    sortorder: 'asc',
                    viewrecords: true,
                    caption: 'Productos',
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
                function detalles(vent){
                    
                    $.ajax({
                            url:   '<?= base_url() ?>almacen/datos_producto',
                            data : { 'idP' : $(vent).data('idf') },
                            type : 'post',
                        beforeSend: function () {
                                   // $("#respuesta2").html("Espere un momento, o intente otra vez por favor...");

                            },
                            success:  function (response) {
                                    $("#form").html(response);
                                    document.formulario.nombre.focus();
                            }
                    });
                   
                    
                }
                    $(document).ready(function() {
                        $("#save").click(function(event) {
                            event.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url() ?>almacen/ingresar_producto",
                                data: $("#form_almacen").serialize(),
                                beforeSend:function(){
                                    $("#res").html("enviando");

                                },success: function(res) {
                                    var respuesta = $.parseJSON(res);
                                    $("#res").html("");//cargar
                                    $("#res").html('<div id="success-alert" class="alert '+respuesta.clase+'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+respuesta.respuest+'</div>');
                                    $("#tabla_productos").trigger("reloadGrid");
                                    document.getElementById("form_almacen").reset();
                                    $('html, body').animate({
                                        scrollTop: $("#res").offset().top
                                    }, 200);
                                    limpiar_campos();
                                }
                            });
                        });
                    });
                    $("#tabla_productos").on("click",".btn_editar", function(e){
                        e.preventDefault();
                        var id = $(this).data("id");
                        var nombre = $(this).data("nombre");
                        var cantidad = $(this).data("cantidad");
                        var precio = $(this).data("precio");
                        $(".form_btn_canc").css("display", "block");
                        $("#myModaluniversidad" + id).find(".close").trigger('click');
                        //var estado = $(this).data("estado");
                        //proceso de visualizacion iduniversidad
                        $("#save").attr("title", "Modificar");
                        $("#save").val("Modificar");
                        $("#save").attr("id", "modificar");
                        

                        $("#id_almacen").val(id);
                        $("#nombre").val(nombre);
                        $("#cantidad").val(cantidad);
                        $("#precio").val(precio);
                    });
                    $("#cancelar").click(function(event) {
                        event.preventDefault();
                        limpiar_campos();
                    });
                    $("#tabla_productos").on("click",".btn_activar", function(e){
                        e.preventDefault();
                        var id = $(this).data("id");
                        var estado = $(this).data("estado");
                        $.ajax({
                            url: '<?= base_url() ?>almacen/ajax_activar/',
                            data: {
                            id: id,
                            estado: estado,
                            },
                            type:'post',
                            dataType: 'json',
                        })
                        .done(function(data) { // Variable data contains the data we get from serverside
                            if(data.success === true)
                            {
                                $("#myModaluniversidad" + id).find(".close").trigger('click');
                                setTimeout(function(){
                                $("#tabla_productos").trigger("reloadGrid");
                                }, 1500);
                            }
                            else
                            {
                                $("#myModaluniversidad" + id).find(".close").trigger('click');
                                alert("Error! Comuniquelo con el administrador");
                            }
                        });
                    });
                    function limpiar_campos(){
                        $(".form_btn_canc").css("display", "none");
                        $("#modificar").attr("title", "Enviar");
                        $("#modificar").val("Enviar");
                        $("#save").attr("id", "modificar");
                        

                        $("#id_almacen").val("0");
                        $("#nombre").val("");
                        $("#cantidad").val("");
                        $("#precio").val("");
                    }
                    
                     $("#filtro").click(function(event) {
                        event.preventDefault();
                        console.log("hola");
                        var nombre = $('#filtro_nombreu').val();
                        var estado = $('#filtro_estado').val();
                        if(nombre != "" || estado != "")
                        {
                            //Reload Grid
                            $("#tabla_productos").setGridParam({
                            url:'<?= base_url() ?>almacen/ajax_tabla_almacen',
                            datatype: "json",
                            postData: {
                                nombre: nombre,
                                estado: estado
                            }
                            }).trigger('reloadGrid');
                        }
                        else{
                            $("#tabla_productos").setGridParam({
                            url: '<?= base_url() ?>almacen/ajax_tabla_almacen',
                            datatype: "json",
                            postData: {
                                nombre: "",
                                estado: ""
                            }
                            }).trigger('reloadGrid');
                        }
                    });

                    $("#cancelar_filtro").click(function(event) {
                        event.preventDefault();
                        $('#filtro_nombreu').val("");
                        $('#filtro_estado').val("");
                        $("#tabla_productos").setGridParam({
                            url: '<?= base_url() ?>almacen/ajax_tabla_almacen',
                            datatype: "json",
                            postData: {
                                nombre: "",
                                estado: ""
                            }
                            }).trigger('reloadGrid');
                    });
               </script>