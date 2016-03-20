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
            <form id="form_cronograma" name="form_cronograma" enctype="multipart/form-data"  method="post" action="<?php echo base_url('/administrador/cronograma_ver_editar/'.$cronograma[0]["id_Cronograma"].'') ?>">
            <table class="table table-bordered no-margins" >
                    <div class="col-sm-offset-3 col-md-offset-4 col-xs-12 col-sm-6 col-md-5" style="margin-top: 30px;">
                        <div class="form-group">
                            <label class="control-label" for="univers">Universidad:</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <select id="universidadS" name="universidadS" class="form-control validar" >
                                    <option value="">Seleccione</option>
                                    <?php foreach ($universidad as $row){ ?>
                                    <option value="<?php echo $row->idUniversidad; ?>" <?php if($row->idUniversidad==$cronograma[0]["Universidad_idUniversidad"]){echo 'selected="true"';} ?> > <?php echo $row->NombreUniversidad; ?></option>
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
                                        <input type="text" class="form-control titulo validar" placeholder="Titulo" id="titulo" name="titulo" value="<?=$cronograma[0]["TituloCrono"] ?>" />
                                    </div>
                                </td>
                            </tr>
                            
                           
                    </tbody>
                 </table>
            <div id="tabla_dinamica">
                <?php foreach ($actividades as $key => $value) {?>
                    <?php if($key==0){ ?>
                        <table class="table  no-margins" id="tabla_cronograma_copiar">
                            <tbody>
                                <tr id="fecha_copiar">

                                    <td colspan="3">
                                        <div class="col-xs-12 col-sm-6 col-md-5">
                                            <div class="form-group ">
                                                    <label for="reclamos_fecha_asignacion">Fecha: </label>
                                                    <input class="form-control fecha validar" id="fecha" name="fecha" placeholder="Fecha" data-date-format="dd-mm-yyyy" type="text" readonly="" value="<?=$value["fecha"] ?>" >
                                                </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php foreach ($value["actividades"] as $indice => $actividad){ ?>
                                    <?php if($indice==0){ ?>
                                        <tr id="copiar">
                                            <td style="display: none;">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group ">
                                                        <input class="form-control fecha_actividad" id="fecha_actividad" name="fecha_actividad[]"  type="text" value="<?=$actividad["fecha"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group ">
                                                            <label for="hora">Hora: </label>
                                                            <input class="form-control hora validar" id="hora" name="hora[]" placeholder="hora" type="text" value="<?=$actividad["hora"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group ">
                                                            <label for="actividad">Actividad: </label>
                                                            <input class="form-control validar" id="actividad" name="actividad[]" placeholder="Actividad" type="text" value="<?=$actividad["actividad"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group ">
                                                            <label for="lugar">Lugar: </label>
                                                            <input class="form-control validar" id="lugar" name="lugar[]" placeholder="Lugar" type="text" value="<?=$actividad["lugar"] ?>">
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
                                    <?php }else{ ?>
                                        <tr id="nuevo">
                                            <td style="display: none;">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group ">
                                                        <input class="form-control fecha_actividad" id="fecha_actividad" name="fecha_actividad[]"  type="text" value="<?=$actividad["fecha"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group ">
                                                            <label for="hora">Hora: </label>
                                                            <input class="form-control hora validar" id="hora" name="hora[]" placeholder="hora" type="text" value="<?=$actividad["hora"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group ">
                                                            <label for="actividad">Actividad: </label>
                                                            <input class="form-control validar" id="actividad" name="actividad[]" placeholder="Actividad" type="text" value="<?=$actividad["actividad"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group ">
                                                            <label for="lugar">Lugar: </label>
                                                            <input class="form-control validar" id="lugar" name="lugar[]" placeholder="Lugar" type="text" value="<?=$actividad["lugar"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td style="width: 1%;padding: 0px;">
                                                <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0px;">
                                                    <div class="form-group ">
                                                        <a  onclick="eliminarfila(this)" class="btn btn-success pull-left" id="eliminar_actividad"  style="margin-top:20px;display: block;" >Eliminar</a>
                                                        </div>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <a onclick="agregarfila(this)" class="btn btn-success pull-left" id="agregar_actividad">Agregar Actividad</a>
                                    </td>
                                </tr>



                            </tfoot>
                        </table>
                        
                    <?php }else{ ?>
                        <table class="table  no-margins" id="tabla_nueva">
                            <tbody>
                                <tr id="fecha_copiar">

                                    <td colspan="3">
                                        <div class="col-xs-12 col-sm-6 col-md-5">
                                            <div class="form-group ">
                                                    <label for="reclamos_fecha_asignacion">Fecha: </label>
                                                    <input class="form-control fecha validar" id="fecha" name="fecha" placeholder="Fecha" data-date-format="dd-mm-yyyy" type="text" readonly="" value="<?=$value["fecha"] ?>" >
                                                </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php foreach ($value["actividades"] as $indice => $actividad){ ?>
                                    <?php if($indice==0){ ?>
                                        <tr id="copiar">
                                            <td style="display: none;">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group ">
                                                        <input class="form-control fecha_actividad" id="fecha_actividad" name="fecha_actividad[]"  type="text" value="<?=$actividad["fecha"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group ">
                                                            <label for="hora">Hora: </label>
                                                            <input class="form-control hora validar" id="hora" name="hora[]" placeholder="hora" type="text" value="<?=$actividad["hora"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group ">
                                                            <label for="actividad">Actividad: </label>
                                                            <input class="form-control validar" id="actividad" name="actividad[]" placeholder="Actividad" type="text" value="<?=$actividad["actividad"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group ">
                                                            <label for="lugar">Lugar: </label>
                                                            <input class="form-control validar" id="lugar" name="lugar[]" placeholder="Lugar" type="text" value="<?=$actividad["lugar"] ?>">
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
                                    <?php }else{ ?>
                                        <tr id="nuevo">
                                            <td style="display: none;">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group ">
                                                        <input class="form-control fecha_actividad" id="fecha_actividad" name="fecha_actividad[]"  type="text" value="<?=$actividad["fecha"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group ">
                                                            <label for="hora">Hora: </label>
                                                            <input class="form-control hora validar" id="hora" name="hora[]" placeholder="hora" type="text" value="<?=$actividad["hora"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group ">
                                                            <label for="actividad">Actividad: </label>
                                                            <input class="form-control validar" id="actividad" name="actividad[]" placeholder="Actividad" type="text" value="<?=$actividad["actividad"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group ">
                                                            <label for="lugar">Lugar: </label>
                                                            <input class="form-control validar" id="lugar" name="lugar[]" placeholder="Lugar" type="text" value="<?=$actividad["lugar"] ?>">
                                                        </div>
                                                </div>
                                            </td>
                                            <td style="width: 1%;padding: 0px;">
                                                <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0px;">
                                                    <div class="form-group ">
                                                        <a  onclick="eliminarfila(this)" class="btn btn-success pull-left" id="eliminar_actividad"  style="margin-top:20px;display: block;" >Eliminar</a>
                                                        </div>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <a onclick="agregarfila(this)" class="btn btn-success pull-left" id="agregar_actividad">Agregar Actividad</a>
                                    </td>
                                </tr>



                            </tfoot>
                        </table>
                    <?php } ?>
                    <?php ?>
                <?php } ?>
                
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


</script>