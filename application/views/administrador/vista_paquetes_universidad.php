<div id="cargar">
    <div id="res"></div>
<form id="form_usuario" name="formulario"   method="post" >
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label class="control-label" for="nombrep">Nombre del Paquete:</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input type="text" class="form-control nombrep" placeholder="Nombre" id="nombrep" name="nombrep" size="30" maxlength="45" onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>" />
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label  class="control-label" for="informacionp" >Informacion:</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control informacionp" placeholder="informacion" id="informacionp"  name="informacionp" size="30" maxlength="45"  onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>"/>
                </div>
            </div>
        </div>
                            
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-2">
            <div class="form-group">
                <label class="control-label" for="montop">Monto:</label>
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" class="form-control montop" placeholder="monto" id="montop" name="montop" size="30" maxlength="45" onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>" />
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
            <div class="form-group">
                <label class="control-label" for="especialidad">N° Graduandos:</label>
                <div class="input-group">
                    <span class="input-group-addon">#</span>
                    <input type="text" class="form-control numerog" placeholder="Número de Graduandos" id="numerog" name="numerog" size="30" onKeyUp="return valid(event,this)" maxlength="45" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['especialidad'];?>" />
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label  class="control-label" for="informacionp" >Fecha tope:</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control fechat" placeholder="Fecha tope" id="fechat"  name="fechat" size="30" maxlength="45"  onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['informacionp'];?>"/>
                </div>
            </div>
        </div>
                            
        <div class="col-xs-12 col-sm-6 col-md-5">
            <div class="form-group">
                <label class="control-label" for="univers">Universidad:</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <select id="universidadS" name="universidadS" class="form-control" >
                        <option value="seleccione">SELECCIONE</option>
                        <?php foreach ($universidad as $row){ ?>
                            <option value="<?php echo $row->idUniversidad; ?>" <?php echo $selec; ?>> <?php echo $row->NombreUniversidad; ?></option>
                        <?php } ?>
                        <option value="otra">OTRA</option>
                    </select>
                </div>
            </div>
        </div>
        
    </div>
    
                        <?php if($productosAlmc){ ?>
                        
                        <div  >
                            
                            <?php foreach ($productosAlmc as $row){ ?>
                                
                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2" id="casilla" style="margin-top: 20px; min-height: 110px; text-align: center;">
                                    <label  style="color: #000;">
                                        <?php echo $row->nombre_producto; ?>
                                    </label>
                                    <div style="text-align: center;">
                                        <input type="checkbox" name="check_list[]" value="<?php echo $row->idalmacen; ?>">
                                    </div>
                                </div>
                            
                            <?php } ?>
                        </div>
                               
                        <?php } ?>
                        <div class="row" style="text-align: center;">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <input style="width: 20%; margin-top: 1%;margin-bottom: 1%;" type="submit" id="save" class="boton" value="enviar" title="enviar" />

                            </div>
                        </div>
                        
                    </form>

</div>
<script src="<?= base_url() ?>bootstrap/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript">

                    $(document).ready(function() {
                    $("#save").click(function(event) {
                    event.preventDefault();
                    $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>universidad/ingresar_paquetes_universidad",
                    data: $("#form_usuario").serialize(),
                    beforeSend:function(){
			$("#res").html("enviando");
                                                
		    },success: function(res) {
                        $("#res").html("");//cargar
                        if(res=="error"){
                            $("#res").html("Debe completar el formulario</br>");
                        }else{
                            $("#cargar").html(res);
                        }
                        
                    }
                    });
                    });
                    });
               </script>