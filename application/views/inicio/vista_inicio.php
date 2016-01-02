
    <link rel="stylesheet" href="<?= base_url() ?>css/slider.css" type="text/css" media="screen">
    <script src="<?= base_url() ?>bootstrap/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
    
    <div class="bs-docs-grid">
      <div class="row show-grid">
          <div class="col-xs-12 col-sm-8 col-md-8 ">
            <div class="flex-container">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="<?= base_url() ?>images/logogra.jpg" alt="" title="<strong>Empresa Graduaciones Esmeralda C.A</strong><span></a></span>"></a>
                        </li>

                        <li>
                            <img src="<?= base_url() ?>images/album.jpg" alt="" title="<strong>Álbumes</strong><span></a></span>">
                        </li>
                        <li>
                            <img src="<?= base_url() ?>images/ve.jpg" alt="" title="<strong>CD</strong><span></a></span>">
                        </li>
                        <li>
                            <img src="<?= base_url() ?>images/botones.jpg" alt="" title="<strong>Botones con logo y vitrificado</strong><span></a></span>">
                        </li>
                        <li>
                            <img src="<?= base_url() ?>images/medallas.jpg" alt="" title="<strong>Medallas</strong><span></a></span>">
                        </li>
                    </ul>
                </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4" >
              <?php
                    $username = array('name' => 'username', 'placeholder' => 'nombre de usuario','style'=> 'display: inline;','class'=>'form-control');
                    $password = array('name' => 'password', 'placeholder' => 'introduce tu password','style'=> 'display: inline;','class'=>'form-control');
                    $submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión','style'=> 'width:80%;','class'=>'btn btn-primary');
                    $form = array('onsubmit' => 'return valida(this)','name'=>'login');
                ?>
            <div>
                <div id="login">
                    <div  id="formulario_login">
                        <div  id="campos_login" style="text-align: center;">
                          
                            <?=form_open(base_url().'inicio/login',$form)?>
                            <h2 >Iniciar sesion:</h2>
                            <div class="form-group">
                                <label class="label-inherit" for="username">Nombre de usuario:</label>
                                <div class="alert alert-danger oculto " id="Vusuario" role="alert" style="padding: 0px;margin-bottom: 0px;">Ingrese su Nombre de Usuario</div>
                                <?=form_input($username)?><p><?=form_error('username')?></p>
                            </div>
                            <div class="form-group">
                                <label class="label-inherit" for="password">Introduce tu password:</label>
                                <div class="alert alert-danger oculto " id="Vclave" role="alert" style="padding: 0px;margin-bottom: 0px;">Ingrese su Clave</div>
                                <?=form_password($password)?><p><?=form_error('password')?></p>
                             </div>
                            <?=form_hidden('token',$token)?>
                            <?=form_submit($submit)?>
                            <?=form_close()?>
                            <?php 
                            if($this->session->flashdata('usuario_incorrecto'))
                            {
                            ?>
                            <p><?=$this->session->flashdata('usuario_incorrecto')?></p>
                            <?php
                            }
                            ?>
                            <a data-toggle="modal" href="#myModal" class="popup-with-zoom-anim" style="text-align: right; font-family: 'Comic Sans MS', cursive; font-size: 15px;">REGISTRARSE</a>
                        </div>
                    </div>
                </div>
            </div>
     
          </div>
        <div class="clearfix visible-xs-block"></div>
      </div>
    </div>
        
						<?php echo $titulo; ?>
					

<div class="modal fade" id="myModal" style="display: none; ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div  style="font: bold italic large Palatino, serif; color: #000000; text-align: center;">Registrarse</div>
                <div class="loader">Porfavor espere. cargando...</div>
            </div>
            <div class="modal-body">
                <div id="respuesta2"  >
                    <div id="titulos">Registro de usuario</div>
                    <div id="respuesta" ></div>
                    <form name="form_usuario" id="form_usuario"  method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="nombre">Nombre:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control nombre" placeholder="Nombre" id="nombre" name="nombre" size="30" maxlength="45" onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['nombre'];?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label  class="control-label" for="apellido" >Apellido:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control apellido" placeholder="Apellido" id="apellido"  name="apellido" size="30" maxlength="45"  onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['apellido'];?>"/>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="cedula" >C&eacute;dula:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control cedula" placeholder="C&eacute;dula" id="cedula" name="cedula" size="30" maxlength="9" onKeyUp="return valid(event,this)" onKeyPress="return validar_numero(event);" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['cedula'];?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="telefono">Tel&eacute;fono:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control telefono" placeholder="Tel&eacute;fono" id="telefono" name="telefono" size="30" maxlength="11" onKeyUp="return valid(event,this)" onKeyPress="return validar_numero(event);" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['telefono'];?>"/>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="ciudad">Ciudad:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control ciudad" placeholder="Ciudad" id="ciudad" name="ciudad" size="30" maxlength="45" onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['ciudad'];?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="direccion">Direcci&oacute;n:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control direccion" placeholder="Direcci&oacute;n" id="direccion" name="direccion" size="30" maxlength="45" onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['direccion'];?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="univers">Universidad:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select id="univers" name="institucion" class="form-control" >
                                            <option value="seleccione">SELECCIONE</option>
                                            <?php foreach ($universidades as $row){ ?>
                                                <option value="<?php echo $row->idUniversidad; ?>" <?php echo $selec; ?>> <?php echo $row->NombreUniversidad; ?></option>
                                            <?php } ?>
                                            <option value="otra">OTRA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="especialidad">Especialidad:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control especialidad" placeholder="Especialidad" id="especialidad" name="especialidad" size="30" onKeyUp="return valid(event,this)" maxlength="45" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['especialidad'];?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">E-mail:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control email" placeholder="E-mail" id="email" name="email" size="30" maxlength="45" onKeyUp="return valid(event,this)" value="<?php error_reporting(E_ALL ^ E_NOTICE); echo $_usuario['email'];?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="nombreusu">Nombre de Usuario:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" class="form-control nombreusu" placeholder="Nombre de Usuario" id="nombreusu" name="nombreusu" onKeyUp="return valid(event,this)" size="30" maxlength="45"  value="" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="contrasena">Contrase&ntilde;a:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" class="form-control contrasena" placeholder="Contrase&ntilde;a" id="contrasena" name="contrasena" onKeyUp="return valid(event,this)" size="30" maxlength="45" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="Confirmar">Confirmar  Contrase&ntilde;a:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" class="form-control Confirmar" id="Confirmar" placeholder="Confirmar  Contrase&ntilde;a" onKeyUp="return valid(event,this)" name="rpcontrasena" size="30" maxlength="45" value="" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
			<input type="hidden" name="via" value="editar_usuario" />
			<input type="hidden" name="boton" value="GUARDAR" />
                        
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-lg submit" value="Registrarse" title="Registrarse" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
                <!--<script type="text/javascript" src="<?//= base_url() ?>bootstrap/js/jquery.js" ></script>
                <script type="text/javascript" src="<?//= base_url() ?>bootstrap/js/bootstrap.js" ></script>-->
            
<script type="text/javascript" src="<?= base_url() ?>js/jquery-1.6.js" ></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.flexslider-min.js" ></script>
<script type="text/javascript" src="<?= base_url() ?>js/registrarse/registrarse.js" ></script>    
		

	<script type="text/javascript">
$(document).ready(function () {
	$('.flexslider').flexslider({
		animation: 'fade',
		controlsContainer: '.flexslider'
	});
});
        </script>