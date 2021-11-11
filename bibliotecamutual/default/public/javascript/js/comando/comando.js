var rqst = null;
var cont = 0;
var contbt = 0;
var loc = window.location;
var msg = 'Sin respuesta';
var tipo_programacion = 0;
var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/'));
pathName = pathName.substring(0, pathName.lastIndexOf('/'));
pathName = pathName.substring(0, pathName.lastIndexOf('/') + 1);
function errorAjax( jqXHR, textStatus, errorThrown ){
    if (jqXHR.status === 0) {
       msg = 'Not connect: Verify Network.';
    } else if (jqXHR.status == 404) {
       msg = 'Requested page not found [404].';
    } else if (jqXHR.status == 500) {
       msg = 'Internal Server Error [500].';
    } else if (textStatus === 'parsererror') {
       msg = 'Requested JSON parse failed.';
    } else if (textStatus === 'timeout') {
       msg = 'Time out error.';
    } else if (textStatus === 'abort') {
       msg = 'Ajax request aborted.';
    } else {
       msg = 'Uncaught Error: ' + jqXHR.responseText;
    }
    return msg;
}
function propiedadesCSS(){
	var div_login_wrapper = document.getElementById("div_login_wrapper");
	div_login_wrapper.style = "right: 0;margin: 5% auto 0;max-width: 350px;position: relative";
}
function retornar(formatear){
	var resetear = formatear || 'no-formatear';
	var div_respuesta = document.getElementById('div_respuesta');
	var div_formulario = document.getElementById('div_formulario');
	var formulario = document.getElementById('form_registrar_mantenimiento');
	div_respuesta.style.display = 'none';
	div_formulario.style.display = '';
	if(resetear == 'formatear'){
	   formulario.reset();
	}
}
function habilitarProgramacion(){
	var div_programacion = document.getElementById('div_programacion');
	var check_programacion = document.getElementById('check_programacion');
	var boton_enviar = document.getElementById('boton_enviar');
	if(check_programacion.checked){
		var boton_pro_unico = document.getElementById('boton_pro_unico');
		var boton_pro_repetitiva = document.getElementById('boton_pro_repetitiva');
		div_programacion.style.display = "";
		if(boton_pro_unico.innerHTML === 'Retornar' || boton_pro_repetitiva.innerHTML === 'Retornar'){
			boton_enviar.style.display = "";
		}else{
			boton_enviar.style.display = "none";
		}
	}else{
		div_programacion.style.display = "none";
		boton_enviar.style.display = "";
		tipo_programacion = 0;
		document.getElementById('div_programaciones_unica').style.display == "none";
		document.getElementById('div_diario').style.display == "none";
	}
}
function programarUnaVez(){
	var div_calendario_hora = document.getElementById('div_programaciones_unica');
	var boton_pro_unico = document.getElementById('boton_pro_unico');
	var boton_pro_repetitiva = document.getElementById('boton_pro_repetitiva');
	var boton_enviar = document.getElementById('boton_enviar');
	if(div_calendario_hora.style.display == "none"){
		boton_pro_unico.innerHTML = "Retornar";
		boton_enviar.style.display = "";
		div_calendario_hora.style.display = "";
		boton_pro_repetitiva.style.display = "none";
		tipo_programacion = 1;
	}else{
		boton_enviar.style.display = "none";
		boton_pro_unico.innerHTML = "Programación Única";
		div_calendario_hora.style.display = "none";
		boton_pro_repetitiva.style.display = "";
		tipo_programacion = 0;
	}
}
function programarDiario(){
	var div_diario = document.getElementById('div_diario');
	var boton_pro_unico = document.getElementById('boton_pro_unico');
	var boton_pro_repetitiva = document.getElementById('boton_pro_repetitiva');
	var boton_enviar = document.getElementById('boton_enviar');
	if(div_diario.style.display == "none"){
		boton_pro_unico.style.display = "none";
		div_diario.style.display = "";
		boton_pro_repetitiva.innerHTML = "Retornar";
		boton_enviar.style.display = "";
		tipo_programacion = 2;
	}else{
		boton_pro_repetitiva.innerHTML = "Programación Repetitiva";
		div_diario.style.display = "none";
		boton_pro_unico.style.display = "";
		boton_enviar.style.display = "none";
		tipo_programacion = 0;
	}
}
function registrarProgramacion(){
	if(rqst && rqst.readyState != 4) { 
		rqst.abort();
	}
	var url = pathName + 'javascript/jquery/modelos/traccar/registrarComando.php'; 
	var check_programacion = document.getElementById('check_programacion');
	var select = document.getElementById('comando');
	if(select.value !== 'none'){
		var formulario = document.getElementById("form_comando");
		var div_respuesta = document.getElementById("div_respuesta");
		var div_formulario = document.getElementById("div_formulario");
		var dataform = new FormData(formulario);
		dataform.append("check_programacion",check_programacion.checked);
		dataform.append("tipo_programacion",tipo_programacion.toString());
		dataform.append("nombre_comando",select.options[select.selectedIndex].text);
		var check = false;
		if(tipo_programacion == 2 && check_programacion.checked == true ){
			if(document.getElementById("mes").selectedIndex == 0){
				alert("Debe seleccionar el mes");
			}else{
				for(var x = 1; x <= 7; x++){
					if(document.getElementById("dia_"+x).checked == true){
						check = true;
						break;
					}
				}
				if(check == false){
					alert("Debe seleccionar por lo menos un día de la semana");
				}
			}
		}
		if((check == false && tipo_programacion != 2) || (check == true && tipo_programacion == 2)){
			rqst = $.ajax({
			  url:   url,
			  type:  'post',
			  dataType: "html",
			  data: dataform,
			  cache: false,
			  contentType: false,
			  processData: false,
			  beforeSend: function () {
			  	div_formulario.style.display ="none";
			    div_respuesta.innerHTML = '<center><img src="'+pathName+'img/big_loading.gif" alt="Cargando..."></center>';
			  },
			  success: function (response) {
			  	var consulta = jQuery.parseJSON(response);
			    var icono_alerta = "";
			    if(consulta.estado == 'success'){
			    	div_respuesta.innerHTML = '<center><font size="+1" color="green">'+consulta.msg+'</font></center>';
			    	div_formulario.style.display = "";
			    	if(check_programacion.checked == true){
			    		formulario.reset();
			    		check_programacion.checked = 'true';
			    	}else{
			    		formulario.reset();
			    	}
			    }else if(consulta.estado == 'warning'){
			    	div_respuesta.innerHTML = '<center><font size="+1" color="orange">'+consulta.msg+'</font></center>';
			    	div_formulario.style.display = "";
			    }else{
			    	div_respuesta.innerHTML = '<center><font size="+1" color="red">'+consulta.msg+'</font><center>';
			    	div_formulario.style.display = "";
			    }
			  }
			}).fail( function( jqXHR, textStatus, errorThrown ) { 
				div_respuesta.innerHTML = errorAjax( jqXHR, textStatus, errorThrown ) + '<br />' + boton_retorno;   
				div_respuesta.focus();  
			});
		}
	}else{
		alert("Seleccione un comando por favor.");
	}
}
function consultarComandosenTraccar(){
	if(rqst && rqst.readyState != 4) { 
		rqst.abort();
	}
	var div_respuesta = document.getElementById("div_respuesta");
	var url = pathName + 'javascript/jquery/modelos/traccar/consultarComandoenTraccar.php'; 	
	var iddis = document.getElementById("iddis");
	var parametros = {
		"iddis": iddis.value
	};
	rqst = $.ajax({
	  url:   url,
	  type:  'post',
	  data: parametros,
	  beforeSend: function () {
	    div_respuesta.innerHTML = '<center>Buscando comandos <br><img src="'+pathName+'img/big_loading.gif" alt="Cargando..."></center>';
	  },
	  success: function (response) {
		div_respuesta.innerHTML = '';
		var consulta = jQuery.parseJSON(response);
		var icono_alerta = "";
		if(consulta.estado == 'success'){
		   	var select = document.getElementById("comando");
		   	var total_comandos = consulta.msg.length;
		   	for(x=0; x< total_comandos; x++){
		   		var option = document.createElement("option");
		   		option.text = consulta.msg[x].description;
		   		option.value = btoa(consulta.msg[x].id);
		   		select.add(option);
		   	}
		}else if(consulta.estado == 'warning'){
		   	div_respuesta.innerHTML = '<font size="+1" color="orange">'+consulta.msg+'</font>';
		}
		else{
		  	div_respuesta.innerHTML = '<font size="+1" color="red">'+consulta.msg+'</font>';
		}
	}
	}).fail( function( jqXHR, textStatus, errorThrown ) { 
			div_respuesta.innerHTML = errorAjax( jqXHR, textStatus, errorThrown ) + '<br />' + boton_retorno;   
			div_respuesta.focus();  
	});	
}
function consultarTodo(){ 	
  var url = pathName + 'javascript/jquery/modelos/traccar/consultar.php'; 
  var div_alerta = document.getElementById("div_alerta_r");
  var iddis = document.getElementById("iddis");
  var div_login_wrapper = document.getElementById("div_login_wrapper");
  if(rqst && rqst.readyState != 4) { 
      rqst.abort();
  }
  var parametros = {
  	'iddis': iddis.value,
  	'tipo_programacion': tipo_programacion.toString()
  }
  rqst = $.ajax({
      url:  url,
      type: 'post',
      data: parametros,			
      beforeSend: function () {
        $("#contenido").html('<center><img src="'+pathName+'img/big_loading.gif" alt="Cargando..."></center>');
        div_alerta.setAttribute('class','');
        div_alerta.setAttribute('role','');
      },
      success: function (response) {
        div_login_wrapper.style.cssText = 'right: 0;margin: 5% auto 0;max-width: 680px;position: relative';
        var consulta = jQuery.parseJSON(response);
        var icono_alerta = '';
        var tipo_msg = '';
        if(consulta.estado == 'success'){
          $("#contenido").html(consulta.msg); 
        }else{
          if(consulta.estado == 'warning'){
            icono_alerta = "fa fa-exclamation-triangle";
          }else if(consulta.estado == 'info'){
            icono_alerta = "fa fa-info-circle";
          }
          else{
            icono_alerta = "fa fa-times-circle";
          }
          tipo_msg = 'alert alert-'+consulta.estado+' alert-dismissible fade in';
          div_alerta.setAttribute('class',tipo_msg);
          div_alerta.setAttribute('role','alert');  
          $("#contenido").html(consulta.msg);
        } 
      }
    }).fail( function( jqXHR, textStatus, errorThrown ) { 
        $("#contenido").html(errorAjax( jqXHR, textStatus, errorThrown ));     
	});
}
function eliminar(idpro,idcom){
  var url = pathName + 'javascript/jquery/modelos/traccar/eliminarComando.php'; 
  var div_alerta = document.getElementById("div_alerta_r");
  if(rqst && rqst.readyState != 4) { 
      rqst.abort();
  }
  var parametros = {
  	'idcom': idcom,
  	'idpro': idpro,
  	'tipo_programacion': tipo_programacion.toString()
  }
  if(confirm("¿Deseas Eliminar la programación?")){
	  rqst = $.ajax({
	     url:  url,
	     type: 'post',
	     data: parametros,			
	     beforeSend: function () {
	        $("#contenido").html('<center><img src="'+pathName+'img/big_loading.gif" alt="Cargando..."></center>');
	        div_alerta.setAttribute('class','');
	        div_alerta.setAttribute('role','');
	      },
	     success: function (response) {
	        var consulta = jQuery.parseJSON(response);
	        var icono_alerta = '';
	        var tipo_msg = '';
	        if(consulta.estado == 'success'){
	          $("#contenido").html(consulta.msg);
	           consultarTodo();
	        }else{
	          if(consulta.estado == 'warning'){
	            icono_alerta = "fa fa-exclamation-triangle";
	          }else if(consulta.estado == 'info'){
	            icono_alerta = "fa fa-info-circle";
	          }
	          else{
	            icono_alerta = "fa fa-times-circle";
	          }
	          tipo_msg = 'alert alert-'+consulta.estado+' alert-dismissible fade in';
	          div_alerta.setAttribute('class',tipo_msg);
	          div_alerta.setAttribute('role','alert');  
	          $("#contenido").html(consulta.msg);
	        } 
	     }
	    }).fail( function( jqXHR, textStatus, errorThrown ) { 
	        $("#contenido").html(errorAjax( jqXHR, textStatus, errorThrown ));     
		});
	}	
}