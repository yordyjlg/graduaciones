<style>
    .burbuja {
        width: 8px;
        height: 20px;
        text-align: center;
        background: none repeat scroll 0 0 #E02424;
        border-radius: 3px 3px 3px 3px;
        color: #FFFFFF;
        font: bold 1em Tahoma,Arial,Helvetica;
        padding: 2px 6px;
        position: absolute;
        right: 5px;
        top: -5px;

        /* estas propiedades harán la animación */
        -webkit-transition: all 0.5s ease-out;
           -moz-transition: all 0.5s ease-out;
            -ms-transition: all 0.5s ease-out;
             -o-transition: all 0.5s ease-out;
                transition: all 0.5s ease-out;
    }
</style>
<script type="text/javascript" language="javascript">

		function refreshDivs(divid,secs,url)
		{
		 
		
		var divid,secs,url,fetch_unix_timestamp;
		 
		// Chequeamos que las variables no esten vacias..
		if(divid == ""){ alert('Error: escribe el id del div que quieres refrescar'); return;}
		else if(!document.getElementById(divid)){ alert('Error: el Div ID selectionado no esta definido: '+divid); return;}
		else if(secs == ""){ alert('Error: indica la cantidad de segundos que quieres que el div se refresque'); return;}
		else if(url == ""){ alert('Error: la URL del documento que quieres cargar en el div no puede estar vacia.'); return;}
		 
		// The XMLHttpRequest object
		 
		var xmlHttp;
		try{
		xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
		}
		catch (e){
		try{
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		try{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e){
		alert("Tu explorador no soporta AJAX.");
		return false;
		}
		}
		}
		 
		// Timestamp para evitar que se cachee el array GET
		 
		fetch_unix_timestamp = function()
		{
		return parseInt(new Date().getTime().toString().substring(0, 10))
		}
		 
		var timestamp = fetch_unix_timestamp();
		var nocacheurl = url+"?t="+timestamp;
		 
		// the ajax call
		xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
                    var json = JSON.parse(xmlHttp.responseText);
                    $(".burbuja").html(json.results[0][0].num_notifi);
                    $("#recargado").html("");
                    $.each(json.results[0][1].notificaciones, function(i, result){//border-bottom: 1px dotted #CCC;cursor:pointer;
                        var a1= document.createElement('a');
                        $(a1).attr('href','<?= base_url() ?>productos_clientes/ver_presupuesto_producto/'+result['idNotificacion']);
                        $(a1).attr('style', 'border-bottom: 4px dotted #fff;margin-bottom:10px;box-shadow: 0px 1px 2px #695E5E;text-align: center;');
                        var div1= document.createElement('div');
                            $(div1).attr('style', 'width:100%; word-wrap: break-word;white-space: initial;');
                        var div2= document.createElement('div');
                            $(div2).html('<label  style="font-weight: 700;cursor:pointer;" >Presupuesto:</label></br><label  style="font-weight: 300;cursor:pointer;" >'+result['NombreProd']+'</label>');
                        var div3= document.createElement('div');
                            $(div3).html('<label  style="font-weight: 700;cursor:pointer;" >Bs.:</label> <label  style="font-weight: 300;cursor:pointer;" >'+result['montoBs']+'</label>');
                        
                        $(div1).append(div2);
                        $(div1).append(div3);
                        $(a1).append(div1);
                        $("#recargado").append(a1);
                    });
		//document.getElementById(divid).innerHTML=xmlHttp.responseText;
		setTimeout(function(){refreshDivs(divid,secs,url);},secs*1000);
		}
		}
		xmlHttp.open("GET",nocacheurl,true);
		xmlHttp.send(null);
		}
								 
			// LLamamos las funciones con los repectivos parametros de los DIVs que queremos refrescar.

		window.onload = function startrefresh(){
		refreshDivs('recargado',10,'<?= base_url() ?>productos/ajax_notificaciones_usuarios');
                
		}
		</script>
<ul id="css3menu1" class="topmenu">
<input type="checkbox" id="css3menu-switcher" class="switchbox"><label onclick="" class="switch" for="css3menu-switcher"></label>	
	<li class="topmenu"><a href="<?= base_url() ?>cliente" style="line-height:24px;"><img src="<?= base_url() ?>/img/aqua_1_022.png" alt="Home"/>Inicio</a></li>
	<li class="topmenu"><a href="<?= base_url() ?>cliente/nosotros" style="line-height:24px;"><span><img src="<?= base_url() ?>/img/aqua_1_01.png" alt="Overview"/>Nosotros</span></a></li>
	<li class="topmenu"><a style="line-height:24px;"  title="Productos y Servicios"><img src="<?= base_url() ?>/img/aqua_1_022.png" alt="What's New"/>Productos</a>
        <ul>
		<li><a href="<?= base_url() ?>productos_clientes/anillos"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Anillos de Graduaci&oacute;n</a></li>
		<li><a href="<?= base_url() ?>productos_clientes/medallas"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Current Templates"/>Medallas</a></li>
		<li><a href="<?= base_url() ?>productos_clientes/portaTitulos"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Enterprise Templates"/>Porta T&iacute;tulo</a></li>
                <li><a href="<?= base_url() ?>productos_clientes/album"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Enterprise Templates"/>&Aacute;lbumes</a></li>
                <li><a href="<?= base_url() ?>productos_clientes/paquetes"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Enterprise Templates"/>Paquetes de Grado</a></li>
	</ul></li>
	<li class="topmenu"><a href="#" style="line-height:24px;"><span><img src="<?= base_url() ?>/img/aqua_1_46.png" alt="Samples"/>Cliente</span></a>
            <ul>
                    <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Registrar</a>
                        <ul id="submenu" >
                            <li><a href="<?= base_url() ?>universidad/paquetes_universidad"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Paquete universidad</a>
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Universidad</a>
                            <li><a href="<?= base_url() ?>almacen"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>productos de paquetes</a>
                        </ul>
                    </li>
                    <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Current Templates"/>Contratos</a>
                        <ul id="submenu" >
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Consultar</a>
                        </ul>
                    </li>
                    <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Current Templates"/>Cronograma</a>
                        <ul id="submenu" >
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Registrar</a>
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Consultar</a>
                        </ul>
                    </li>
                    <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Current Templates"/>Presupuestos</a>
                        <ul id="submenu" >
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Cotizacion</a>
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Anillos de Graduaci&oacuten</a>
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Medallas</a>
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Porta T&iacutetulo</a>
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>&Aacutelbumes</a>
                            <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Core Templates"/>Paquetes de Grado</a>
                        </ul>
                    </li>
                    <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Current Templates"/>Galer&iacute;a</a></li>
                    <li><a href="#"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Current Templates"/>Usuario</a></li>
                    <li><a href="<?= base_url() ?>inicio/logout_ci"><img src="<?= base_url() ?>/img/aqua_1_50.png" alt="Current Templates"/>Cerrar sesi&oacuten</a></li>
            </ul>
        </li>
	<li class="topmenu" style=" word-wrap: break-word;">
            <a href="#" style="line-height:24px;">
                <span>
                    <img src="<?= base_url() ?>/img/aqua_1_01.png" alt="Overview"/>
                    Notificaciones
                </span>
                <span class="burbuja"></span>
            </a>
            <ul style="max-width: 100%;width:100%; word-wrap: break-word;" >
                <li id="todo" style="width:100%; word-wrap: break-word;">
                    <div id="recargado">
                        <a style="width:100%; word-wrap: break-word;" href="#">
                            <div  style="width:100%; word-wrap: break-word;white-space: initial;">
                                    
                            </div>
                            
                        </a>
                    </div>
                    
                </li>
            </ul>
        </li>
</ul>
