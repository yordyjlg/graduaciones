     <div id="cargar" >
         
                <script src="<?= base_url() ?>bootstrap/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
                <script src="<?= base_url() ?>js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/jQuery.resizeEnd.js" type="text/javascript"></script>
                 <script src="<?= base_url() ?>js/i18n/grid.locale-es.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/jquery.jqGrid.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
          
                <link rel="stylesheet" href="<?= base_url() ?>css/style_descripcion.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-progressbar-2.3.2.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/jquery-ui-1.8.16.custom.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/ui.jqgrid.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/estilos_responsive.css" type="text/css" media="screen">
                <link rel="stylesheet" href="<?= base_url() ?>css/datepicker/datepicker.css" type="text/css" media="screen">
                
               





        
                <div  class=" row tablaHead" id="titulos" style="background-color: rgba(255, 255, 255, 0.32);">
                     Registrar Cronograma
                </div>
                
                <?php if(isset($respuesta['clase'])): ?>
                    <div id="success-alert" class="alert <?= $respuesta['clase']?>">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo !empty($respuesta) ? $respuesta["respuest"] : ''  ?>
                    </div>
                <?php endif; ?>
                <div id="res"></div>
        <div class="margen" >
            <form id="form_cronograma" name="form_cronograma" enctype="multipart/form-data"  method="post" action="<?php echo base_url('/administrador/cronograma/') ?>">
            <table class="table table-bordered no-margins" >
                    <div class="col-sm-offset-3 col-md-offset-4 col-xs-12 col-sm-6 col-md-5" style="margin-top: 30px;">
                        <div class="form-group">
                            <label class="control-label" for="univers">Universidad:</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <select id="universidadS" name="universidadS" class="form-control validar" >
                                    <option value="">Seleccione</option>
                                    <?php foreach ($universidad as $row){ ?>
                                        <option value="<?php echo $row->idUniversidad; ?>" > <?php echo $row->NombreUniversidad; ?></option>
                                    <?php } ?>
                                    <option value="otra">OTRA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                         
                         <tbody>
                            <tr>
                                
                                <td colspan="3">
                                    <div class="form-group">
                                        <label for="reclamos_fecha_asignacion">Título: </label>
                                        <input type="text" class="form-control titulo validar" placeholder="Titulo" id="titulo" name="titulo"  />
                                    </div>
                                </td>
                            </tr>
                            
                           
                    </tbody>
                 </table>
            <div id="tabla_dinamica">
                <table class="table  no-margins" id="tabla_cronograma_copiar">
                        <tbody>
                            <tr id="fecha_copiar">
                                
                                <td colspan="3">
                                    <div class="col-xs-12 col-sm-6 col-md-5">
                                        <div class="form-group ">
                                                <label for="reclamos_fecha_asignacion">Fecha: </label>
                                                <input class="form-control fecha validar" id="fecha" name="fecha" placeholder="Fecha" data-date-format="dd-mm-yyyy" type="text" readonly="">
                                            </div>
                                    </div>
                                    
                                </td>
                            </tr>
                            
                            <tr id="copiar">
                                <td style="display: none;">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group ">
                                                <input class="form-control fecha_actividad" id="fecha_actividad" name="fecha_actividad[]"  type="text">
                                            </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group ">
                                                <label for="hora">Hora: </label>
                                                <input class="form-control hora validar" id="hora" name="hora[]" placeholder="hora" type="text">
                                            </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group ">
                                                <label for="actividad">Actividad: </label>
                                                <input class="form-control validar" id="actividad" name="actividad[]" placeholder="Actividad" type="text">
                                            </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group ">
                                                <label for="lugar">Lugar: </label>
                                                <input class="form-control validar" id="lugar" name="lugar[]" placeholder="Lugar" type="text">
                                            </div>
                                    </div>
                                </td>
                                <td style="width: 1%;padding: 0px;">
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0px;">
                                        <div class="form-group ">
                                            <a  onclick="eliminarfila(this)" class="btn btn-success pull-left" id="eliminar_actividad"  style="margin-top:20px;display: none;" >Eliminar</a>
                                            </div>
                                    </div>
                                    
                                </td>
                            </tr>
                           
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <a onclick="agregarfila(this)" class="btn btn-success pull-left" id="agregar_actividad">Agregar Actividad</a>
                                </td>
                            </tr>
                                
                            
                            
                        </tfoot>
                    </table>
                </div>
        
                <div class="row col-lg-12 ">
                    
                    <a onclick="agregar_fecha(this)" class="btn btn-success pull-left" id="agregar_actividad">Agregar Fecha</a>
                    <input type="hidden" name="guardar" value="guardar" >
                    <input type="submit" value="Guardar" name="guardar" id="guardar_form" class="btn btn-primary pull-left" style="margin-left: 20px;">
                </div>
             </form>
            <div class="row col-lg-12 ">
            <table id="presupuesto"></table>
            <div id="paginacion"> </div>
            </div>
              
               
        </div>     
                    
    </div>
<style>
    .vali{
        border: 1px solid #FF2828;
    }
</style>
<script type="text/javascript">
    $("#guardar_form").click(function(event) {
        event.preventDefault();
        var validar = true;
        //validar
        $(".validar").each(function(i, obj) {
            if($(this).val()==""){
                $(this).addClass("vali");
                validar=false;
            }
        });
        
        if(validar){
            $( "#form_cronograma" ).submit();
        }else{
            $("#res").html('<div id="success-alert" class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Debe Completar el Formulario.</div>');
            $('html, body').animate({
                scrollTop: $("#res").offset().top
            }, 200);
        }
    });
    $(".validar").change(function(){
        if($(this).val()!=""){
            $(this).removeClass("vali");
       }
    });
    $(".validar").keyup(function(){
        if($(this).val()!=""){
            $(this).removeClass("vali");
       }
    });
    function eliminarfila(evt){
        if($(evt).parent().parent().parent().parent()[0].id != "copiar"){
            $(evt).parent().parent().parent().parent().remove();
        }
        
    }
    
    $(".fecha").datepicker().on("changeDate", function(e){
        var fecha = $(this).val();
        $(this).parent().parent().parent().parent().parent().find(".fecha_actividad").each(function(i, obj) {
            $(this).val(fecha);
        });
        if($(this).val()!=""){
            $(this).removeClass("vali");
       }
    });
    function agregarfila(evt){
                        
                        var $tr = $(evt).parent().parent().parent().parent().find("#copiar").clone();
                        // obtener el atributo name para los inputs y selects fecha_actividad
                          var fecha = $tr.find("#fecha_actividad").val();
                          $tr.find("#eliminar_actividad").css("display", "block");
                          $tr.find("input:text").val("");
                          $tr.attr("id","nuevo");
                          $tr.find("input:hidden").val("");
                          $tr.find("#fecha_actividad").val(fecha);
                        $tr.find("input,select").attr("name", function()
                        {
                            //  separar el campo name y su numero en dos partes
                            var name = this.name;
                            
                         return name;
                        // repetir los atributos ids
                        }).attr("id", function(){
                            var id = "";
                            
                         //console.log("-id:"+parts); 
                         return id;
                        });
                        $tr.find("#fecha_actividad").val(fecha);
                        // añadir la nueva fila a la tabla
                        $(evt).parent().parent().parent().parent().find("tbody tr:last").after($tr);
                        $(".fecha").datepicker().on("changeDate", function(e){
                            //console.log(e);
                            $(this).datepicker("hide");
                        });
                        $tr.find("#fecha_actividad").val(fecha);
                        $(".validar").change(function(){
                            if($(this).val()!=""){
                                $(this).removeClass("vali");
                           }
                        });
                        $(".validar").keyup(function(){
                            if($(this).val()!=""){
                                $(this).removeClass("vali");
                           }
                        });

        }
        function agregar_fecha(evt){
                        
                        var $tr = $('#tabla_cronograma_copiar').clone();
                        
                        // obtener el atributo name para los inputs y selects
                          $tr.find("input:text").val("");
                          $tr.find("#nuevo").remove();
                          $tr.attr("id","tabla_nueva");
                          $tr.find("input:hidden").val("");
                          
                        $tr.find("input,select").attr("name", function()
                        {
                            //  separar el campo name y su numero en dos partes
                            var name = this.name;
                            
                         return name;
                        // repetir los atributos ids
                        }).attr("id", function(){
                            var id = "";
                            
                         //console.log("-id:"+parts); 
                         return id;
                        });
                        // añadir la nueva fila a la tabla
                        $('#tabla_dinamica').append($tr);
                        $(".fecha").datepicker().on("changeDate", function(e){
                            //console.log(e);
                            $(this).datepicker("hide");
                        });
                        $(".fecha").datepicker().on("changeDate", function(e){
                            var fecha = $(this).val();
                            $(this).parent().parent().parent().parent().parent().find(".fecha_actividad").each(function(i, obj) {
                                $(this).val(fecha);
                            });
                            if($(this).val()!=""){
                                $(this).removeClass("vali");
                           }
                        });

        }
    $(document).ready(function() {
        $(".fecha").datepicker().on("changeDate", function(e){
            //console.log(e);
            $(this).datepicker("hide");
        });
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
                    url:'<?= base_url() ?>administrador/ajax_tabla_cronograma/', 
                    datatype: 'json',
                    mtype: 'POST',
                    colNames:['Id','Titulo','Universidad', 'Opciones'],
                    colModel:[
                        {name:'id_Cronograma', index:'id_Cronograma', width:50, resizable:true, align:"center"},
                        {name:'TituloCrono', index:'TituloCrono', width:150,resizable:true, sortable:true, align:"center"},
                        {name:'Universidad_idUniversidad', index:'Universidad_idUniversidad', width:30,resizable:true, sortable:true, align:"center"},
                        {name:'ver',  sortable: false, title:false, resizable:true, width:50,height:10}
                    ],
                    height: "auto",
                    autowidth: true,
                    pager: '#paginacion',
                    rowList: [30, 60,90,200],
                    rowNum: 10,
                    page: 1,
                    sortname: 'id_Cronograma',
                    sortorder: 'desc',
                    viewrecords: true,
                    caption: 'Cronogramas',
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