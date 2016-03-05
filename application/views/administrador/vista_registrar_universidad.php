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
                
                <form id="form_universidad" name="formulario"   method="post" >
                    <div id="res"></div>
                    <div class="row" style="padding-left: 5%;padding-right: 5%;">
                        <div class="col-xs-12 col-sm-5 col-md-5 form_input" >
                            <div class="form-group">
                                <label class="control-label" for="nombrep">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input type="text" class="form-control nombreu" placeholder="Nombre" id="nombreu" name="nombreu" onKeyUp="return valid(event,this)" value="<?php ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-5 form_input">
                            <div class="form-group">
                                <label  class="control-label" for="informacionp" >Dirección:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control direccionu" placeholder="Dirección" id="direccionu"  name="direccionu"  onKeyUp="return valid(event,this)" value="<?php  ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 form_btn">
                            <div class="form-group">
                                <label style="color: transparent;" class="control-label" for="informacionp" >Dirección:</label>
                                <input type="hidden" name="iduniversidad" id="iduniversidad" value="0" >
                                <input style="width: 90%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="crear" class="boton" value="Crear" title="Crear"  />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 form_btn_canc" style="display: none;">
                            <div class="form-group">
                                <label style="color: transparent;" class="control-label" for="informacionp" >Dirección:</label>
                                <input style="width: 90%; margin-top: 1%;margin-bottom: 1%;padding: 0px;" type="submit" id="cancelar" class="boton" value="Cancelar" title="Cancelar" />
                            </div>
                        </div>

                    </div>
                </form>
                
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
                                                <div class="col-xs-12 col-sm-5 col-md-4 ">
                                                    <div class="form-group">
                                                        <label  class="control-label" for="filtro_direccionu" >Dirección:</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input type="text" class="form-control filtro_direccionu" placeholder="Dirección" id="filtro_direccionu"  name="filtro_direccionu"  />
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
                
                <table id="universidades"></table>
                <div id="paginacion"> </div>

<script type="text/javascript">
     $(function() {
        $(".accordion").click(function(event) {
                if($(".accordion-heading")[0].className=="accordion-heading accordion-opened"){
                    $(".accordion-heading").removeClass('accordion-opened')
                }else{
                    $(".accordion-heading").addClass('accordion-opened');
                }
        });

    });
$(document).ready(function(){
           jQuery("#universidades").jqGrid({
                    url:'<?= base_url() ?>universidad/ajax_tabla_universidad', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['ID','Nombre', 'Dirección','Paquete','Estado','Opciones'],
                    colModel:[
                        {name:'idUniversidad', index:'idUniversidad', width:20, resizable:true, align:"center"},
                        {name:'NombreUniversidad', index:'NombreUniversidad', width:160,resizable:true, sortable:true, align:"center"},
                        {name:'direccion', index:'direccion', resizable:true, width:50, align:"center"},
                        {name:'Paquete_idPaquete', index:'Paquete_idPaquete', resizable:true, width:50, align:"center"},
                        {name:'estado', index:'estado', resizable:true, width:50, align:"center"},
                        {name:'ver',  sortable: false, title:false, resizable:true, width:50,height:10}
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
            $("#crear").click(function(event) {
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
                        limpiar_campos();
                        $('html, body').animate({
                            scrollTop: $("#res").offset().top
                        }, 200);
                    }
                });
            });
        });
        
        $("#universidades").on("click",".btn_editar", function(e){
            e.preventDefault();
            var id = $(this).data("id");
            var nombre = $(this).data("nombre");
            var direcion = $(this).data("direccion");
            $(".form_input").attr("class","col-xs-12 col-sm-4 col-md-4 form_input");
            $(".form_btn_canc").css("display", "block");
            $("#myModaluniversidad" + id).find(".close").trigger('click');
            //var estado = $(this).data("estado");
            //proceso de visualizacion iduniversidad
            $("#crear").attr("title", "Guardar");
            $("#crear").val("Guardar");
            
            $("#iduniversidad").val(id);
            $("#nombreu").val(nombre);
            $("#direccionu").val(direcion);
        });
        $("#cancelar").click(function(event) {
            event.preventDefault();
            limpiar_campos();
        });
        $("#universidades").on("click",".btn_activar", function(e){
            e.preventDefault();
            var id = $(this).data("id");
            var estado = $(this).data("estado");
            $.ajax({
                url: '<?= base_url() ?>universidad/ajax_activar/',
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
                    $("#universidades").trigger("reloadGrid");
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
            $(".form_input").attr("class","col-xs-12 col-sm-5 col-md-5 form_input");
            $(".form_btn_canc").css("display", "none");
            $("#crear").attr("title", "Crear");
            $("#crear").val("Crear");
            
            $("#iduniversidad").val("0");
            $("#nombreu").val("");
            $("#direccionu").val("");
        }
        $("#filtro").click(function(event) {
            event.preventDefault();
            console.log("hola");
            var nombre = $('#filtro_nombreu').val();
            var direccion = $('#filtro_direccionu').val();
            var estado = $('#filtro_estado').val();
            if(nombre != "" || direccion != "" || estado != "")
            {
                //Reload Grid
                $("#universidades").setGridParam({
                url:'<?= base_url() ?>universidad/ajax_tabla_universidad',
                datatype: "json",
                postData: {
                    nombre: nombre,
                    direccion: direccion,
                    estado: estado
                }
                }).trigger('reloadGrid');
            }
            else{
                $("#universidades").setGridParam({
                url: '<?= base_url() ?>universidad/ajax_tabla_universidad',
                datatype: "json",
                postData: {
                    nombre: "",
                    direccion: "",
                    estado: ""
                }
                }).trigger('reloadGrid');
            }
        });
        
        $("#cancelar_filtro").click(function(event) {
            event.preventDefault();
            $('#filtro_nombreu').val("");
            $('#filtro_direccionu').val("");
            $('#filtro_estado').val("");
            $("#universidades").setGridParam({
                url: '<?= base_url() ?>universidad/ajax_tabla_universidad',
                datatype: "json",
                postData: {
                    nombre: "",
                    direccion: "",
                    estado: ""
                }
                }).trigger('reloadGrid');
        });
        
</script>