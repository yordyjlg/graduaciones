
$(document).ready(function() {
                    $(".submit").click(function(event) {
                    console.log(chequeoFinal());
                    if(chequeoFinal()){
                        event.preventDefault();
                        $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: url_base()+"inicio/registrarse",
                        data: $("#form_usuario").serialize(),
                        beforeSend:function(){
                            $(".loader").show();

                        },success: function(res) {
                            $(".loader").fadeOut("slow",function() {

                                if(res.resultado[0].tipo=='error'){
                                     var cedula=res.resultado[0].cedula;
                                        var nombre=res.resultado[0].nombre;
                                        var apellido=res.resultado[0].apellido;
                                        var telefono=res.resultado[0].telefono;

                                        if(cedula=='<p>cedula</p>'){
                                            var inpu=$("input[type=text].cedula").prop("id", "cedula");
                                            inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                                        }else{
                                            var inpu=$("input[type=text].cedula").prop("id", "cedula");
                                            inpu.parent().parent().prop("class", "form-group has-success has-feedback");
                                        }
                                        if(nombre=='<p>nombre</p>'){
                                            var inpu=$("input[type=text].nombre").prop("id", "nombre");
                                            inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                                        }else{
                                            var inpu=$("input[type=text].nombre").prop("id", "nombre");
                                            inpu.parent().parent().prop("class", "form-group has-success has-feedback");
                                        }
                                        if(apellido=='<p>apellido</p>'){
                                            var inpu=$("input[type=text].apellido").prop("id", "apellido");
                                            inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                                        }else{
                                            var inpu=$("input[type=text].apellido").prop("id", "apellido");
                                            inpu.parent().parent().prop("class", "form-group has-success has-feedback");
                                        }
                                        if(telefono=='<p>telefono</p>'){
                                            var inpu=$("input[type=text].telefono").prop("id", "telefono");
                                            inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                                        }else{
                                            var inpu=$("input[type=text].telefono").prop("id", "telefono");
                                            inpu.parent().parent().prop("class", "form-group has-success has-feedback");
                                        }
                                    $("#respuesta").show();
                                    $("#respuesta").html('<div class="alert alert-danger" role="alert">Debe Completar el Formulario</div>');

                                }else if(res.resultado[0].tipo=='existe'){
                                    $("#respuesta").show();
                                    $("#respuesta").html('<div class="alert alert-danger" role="alert">Nombre de Usuario no Disponible</div>');


                                }else if(res.resultado[0].tipo=='registrado'){
                                    $("#respuesta2").html('<div id="titulos">Registrado Correctamente</div>');
                                    var inpu=$("input[type=submit].submit").prop("style", "display: none;");   
                                }
                              });

                        }
                        });
                    }
                    });
                    });

var sele=false;
		$(document).ready(function()
		{
                    $("#univers").change(function(event)
			{
                            var id = $("#univers").find(':selected').val();
                            if(id=="seleccione"){
                                        var inpu=$('select[name="institucion"]');
                                        inpu.parent().parent().prop("class", "form-group has-error has-feedback");
					k.focus();
					return false;
				}else{
                                        var inpu=$('select[name="institucion"]');
                                        inpu.parent().parent().prop("class", "form-group has-success has-feedback");
					return true;
				}
                        });
                        
			$("#univers").change(function(event)
			{
				var id = $("#univers").find(':selected').val();
				if (id=="otra") {
				nuevaFila = document.getElementById("tabla_usu").insertRow(6);
        
        			nuevaCelda = nuevaFila.insertCell(-1);
        			nuevaCelda1 = nuevaFila.insertCell(1);
        			nuevaCelda2 = nuevaFila.insertCell(2);
        			nuevaCelda3 = nuevaFila.insertCell(3);
        			nuevaCelda.innerHTML = '<td><b>Nombre universidad:</b></td>';
        			nuevaCelda1.innerHTML = '<td></td><td><input type="text" class="inputgri" name="institucionescri" size="30" maxlength="45" onkeypress="return mayuscula(event,this)"  /></td><td></td><td></td>';
        			nuevaCelda2.innerHTML = '<td><b>Direccion universidad:</b></td>';
        			nuevaCelda3.innerHTML = '<td></td><td><input type="text" class="inputgri" name="direcionuniv" size="30" maxlength="45" onkeypress="return mayuscula(event,this)"  /></td><td></td><td></td>';
        			sele=true;
				}else{

					if (sele) {
						var table = document.getElementById("tabla_usu");
						table.deleteRow(6);
						sele=false;
					}

				}
				
			});
		});
			function iniciar()
			{
				document.form_usuario.usuario.focus()
			}

			function validar_numero(e) 
			{
				tecla = e.which || e.keyCode;
				patron = /\d/; // Solo acepta números
				te = String.fromCharCode(tecla);
				return (patron.test(te)||tecla == 9||tecla == 8);  
			}
			function valid(e,solicitar){
			  // Admitir solo letras
                          txt = solicitar.value;
                          var id= solicitar.getAttribute('ID');
                          if(txt.length==0){
                                
                                var tipo= solicitar.getAttribute('type');
                                var inpu=$("input[type="+tipo+"]."+id);
                                inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                          }else{
                                var tipo= solicitar.getAttribute('type');
                                var inpu=$("input[type="+tipo+"]."+id);
                                inpu.parent().parent().prop("class", "form-group has-success has-feedback");
                          }
                          if(id=='contrasena' && txt.length<5){
                                var tipo= solicitar.getAttribute('type');
                                var inpu=$("input[type="+tipo+"]."+id);
                                inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                          }else if(id=='Confirmar' && txt.length<5){
                                var tipo= solicitar.getAttribute('type');
                                var inpu=$("input[type="+tipo+"]."+id);
                                inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                          }
                          if(id=='email'){
                              chequearEmail();
                          }
                          
                          
                        }
                        function validar_campos_vacios(id,leng,tipo){
                            if(leng==0){
                                var inpu=$("input[type="+tipo+"]."+id);
                                inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                                $("#respuesta").show();
                                $("#respuesta").html('<div class="alert alert-danger" role="alert">Debe Completar el Formulario</div>');
                                return false;
                          }else{
                                var inpu=$("input[type="+tipo+"]."+id);
                                inpu.parent().parent().prop("class", "form-group has-success has-feedback");
                                return true;
                          }
                        }

			function chequeoFinal(){
			var control = true;
                        
			if(!validar_campos_vacios('nombre',document.form_usuario.nombre.value.length,'text')){ control = false;}
			if(!validar_campos_vacios('apellido',document.form_usuario.apellido.value.length,'text')){ control = false;}
			if(!validar_campos_vacios('cedula',document.form_usuario.cedula.value.length,'text')){ control = false;}
			if(!validar_campos_vacios('telefono',document.form_usuario.telefono.value.length,'text')){ control = false;}
			if(!validar_campos_vacios('ciudad',document.form_usuario.ciudad.value.length,'text')){ control = false;}
			if(!validar_campos_vacios('direccion',document.form_usuario.direccion.value.length,'text')){ control = false;}
			if(!chequearcombo(document.form_usuario.institucion)){ control = false;}
			if(!camponue()){ control = false;}
			if(!validar_campos_vacios('especialidad',document.form_usuario.especialidad.value.length,'text')){ control = false;}
			if(!validar_campos_vacios('email',document.form_usuario.email.value.length,'text')){ control = false;}
			if(!chequearEmail()){ control = false;}
			if(!validar_campos_vacios('nombreusu',document.form_usuario.nombreusu.value.length,'text')){ control = false;}
			if(!validar_campos_vacios('contrasena',document.form_usuario.contrasena.value.length,'password')){ control = false;}
			if(!validar_campos_vacios('Confirmar',document.form_usuario.rpcontrasena.value.length,'password')){ control = false;}
			if(!tamanio()){ control = false;}
			if(!iguales()){ control = false;}
                            
                        
			return control;
			
					
			}		
			function camponue(){
				if (sele) {
					if (document.form_usuario.institucionescri.value==0) {
						alert("Lo siento el Nombre de la universidad no puede estar vacío");
						document.form_usuario.institucionescri.focus();
						return false;
					}else if (document.form_usuario.direcionuniv.value==0) {
						alert("Lo siento la Dirección de la universidad no puede estar vacía");
						document.form_usuario.direcionuniv.focus();
						return false;
					}else{
						return true;
					}
				
				}else{
					return true;
				}
			}
			function tamanio(){

				if (document.form_usuario.contrasena.value.length>0) {
                                    if (document.form_usuario.contrasena.value.length<5) {  

                                        var inpu=$("input[type=password].contrasena");
                                        inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                                        var inpu=$("input[type=password].Confirmar");
                                        inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                                        $("#respuesta").show();
                                        $("#respuesta").html('<div class="alert alert-danger" role="alert">La contraseña debe de tener como mínimo 5 caracteres o dígitos</div>');
                                        document.form_usuario.contrasena.focus();
                                        return false;
                                    }else{
                                        $("#respuesta").hover();
                                        $("#respuesta").html('');
                                            return true;
                                    }
				}else{
					return true;
				}
			}
			function chequearcombo(k){
				if(k.value=="seleccione"){
                                        var inpu=$('select[name="institucion"]');
                                        inpu.parent().parent().prop("class", "form-group has-error has-feedback");
					k.focus();
					return false;
				}else{
                                        var inpu=$('select[name="institucion"]');
                                        inpu.parent().parent().prop("class", "form-group has-success has-feedback");
					return true;
				}
			}
			function chequearEmail(){
				txt=document.form_usuario.email.value;
				a2=txt.indexOf("@");
				len=txt.length;
                                if(len!=0){
					if(a2<3){
						$("#respuesta").show();
                                                $("#respuesta").html('<div class="alert alert-danger" role="alert">Por favor ingrese una dirección de correo válida</div>');
                                                var inpu=$("input[type=text].email");
                                                inpu.parent().parent().prop("class", "form-group has-error has-feedback");		
                                                document.form_usuario.email.focus();
						return false;
					}
					a3=txt.lastIndexOf(".");
					chequear_ult=len-a3;
					if(chequear_ult<3){
						$("#respuesta").show();
                                                $("#respuesta").html('<div class="alert alert-danger" role="alert">Por favor ingrese una dirección de correo válida</div>');
						var inpu=$("input[type=text].email");
                                                inpu.parent().parent().prop("class", "form-group has-error has-feedback");		
                                                document.form_usuario.email.focus();;
						return false;
					}
					punto=txt.indexOf(".",a2);
					len1=punto-a2;
					if(len1<1){
						$("#respuesta").show();
                                                $("#respuesta").html('<div class="alert alert-danger" role="alert">Por favor ingrese una dirección de correo válida</div>');
						var inpu=$("input[type=text].email");
                                                inpu.parent().parent().prop("class", "form-group has-error has-feedback");		
                                                document.form_usuario.email.focus();
						return false;
					}else{
                                            var inpu=$("input[type=text].email");
                                            inpu.parent().parent().prop("class", "form-group has-success has-feedback");
                                            return true;
					}
                                    }
			}

			function iguales(){
                            if(document.form_usuario.contrasena.value.length>0){
                                if(document.form_usuario.rpcontrasena.value.length>0){
                                    if (document.form_usuario.contrasena.value!=document.form_usuario.rpcontrasena.value) {
                                    document.form_usuario.contrasena.value="";
                                    document.form_usuario.rpcontrasena.value="";
                                    var inpu=$("input[type=password].contrasena");
                                    inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                                    var inpu=$("input[type=password].Confirmar");
                                    inpu.parent().parent().prop("class", "form-group has-error has-feedback");
                                    $("#respuesta").show();
                                    $("#respuesta").html('<div class="alert alert-danger" role="alert">Las contraseñas no coinciden</div>');
                                    document.form_usuario.contrasena.focus();
                                    return false;
                                    }else{
                                        
                                            return true;
                                    }
                                }
                            }
				
			}
 function valida(f) {
  var ok = true;
  if(f.username.value == "")
  {
    $("#Vusuario").show();
    ok = false;
  }else{
      $("#Vusuario").prop("style","display: none;padding: 0px;margin-bottom: 0px;");
  }
  if(f.password.value == "")
  {
    $("#Vclave").show();
    ok = false;
  }else{
      $("#Vclave").prop("style","display: none;padding: 0px;margin-bottom: 0px;");
  }

  return ok;
}