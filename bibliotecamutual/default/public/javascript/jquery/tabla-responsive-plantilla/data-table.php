<?php

class Tabla{
	private $cebecera;
	private $datos;
	private $numero;
	private $titulo;
	private $campos;
	private $url_actualizar;
	private $url_eliminar;
	private $url_refresh;
	private $encriptype;
	function Tabla(){
		$this->cebecera =  Array();
		$this->datos =  Array();
		$this->campos = Array();
		$this->numero = -1;
		$this->titulo = 'Editar';
		$this->url_actualizar = '#';
		$this->url_eliminar = '#';
		$this->url_refresh = '#';
		$this->modo_eliminar = true;
		$this->modo_editar = true;
		$this->encriptype = '';
	}
	function setCabecera($cabecera){
		$this->cabecera = $cabecera;
	}
	function setCamposModal($campos){
		$this->campos = $campos;
	}
	function setDatos($datos){
		$this->datos = $datos;
	}
	function setCeldaControl($numero){
		$this->numero = $numero;
	}
	function setTituloModalEdicion($titulo){
		$this->titulo = $titulo;
	}
	function setURLActualizar($url){
		$this->url_actualizar = $url;
	}
	function setURLEliminar($url){
		$this->url_eliminar = $url;
	}
	function setModoEliminar($eliminar){
		$this->modo_eliminar = $eliminar;
	}
	function setModoEditar($editar){
		$this->modo_editar = $editar;
	}
	function setMethodRefresh($url_refresh){
		$this->url_refresh = $url_refresh;
	}
	function getModoEliminar(){
		return $this->modo_eliminar;
	}
	function getModoEditar(){
		return $this->modo_editar;
	}
	function getCabecera(){
		return $this->cabecera;
	}
	function getCamposModal(){
		return $this->campos;
	}
	function getDatos(){
		return $this->datos;
	}
	function getCeldaControl(){
		return $this->numero;
	}
	function getTituloModalEdicion(){
		return $this->titulo;
	}
	function getURLActualizar(){
		return $this->url_actualizar;
	}
	function getURLEliminar(){
		return $this->url_eliminar;
	}
	function getMethodRefresh(){
		return $this->url_refresh;
	}
	function getTablaEditable(){
		$tabla = '';
		$cabecera = $this->getCabecera();
		$datos = $this->getDatos();
		$celda_control = $this->getCeldaControl();
		$parametros = $this->getCamposModal();
		$size_cabecera = count($cabecera);
		$size_datos = count($datos);
		$titulo = '<thead><tr>';
		$contenido = '<tbody>';
		if($size_cabecera == 0 ){
			return 'No existe títulos de celdas.';
			exit();
		}
		
		for($x = 0;$x < $size_cabecera; $x++){
			$titulo = $titulo .'<th>'.$cabecera[$x].'</th>';
		}
		if($this->getModoEditar() === true || $this->getModoEliminar() === true){
			$titulo = $titulo .'<th>Acción</th>';
		}
		for($x = 0;$x < $size_datos; $x++){
			$contenido = $contenido.'<tr id="fila['.$x.']">';
			for($y = 0; $y < $size_cabecera; $y++){
				if($parametros[$y]['tipo'] === 'image'){
					if($datos[$x][$y] ==  ''){
						$datos[$x][$y] = 'img/no-imagen-200x200.jpg';
					}
					$dato_imagen = '<img src="../'.$datos[$x][$y].'" alt="Imagen" width="30px" height="30px" id="dato_image['.$x.']['.$y.']" />';
					$contenido = $contenido.'<td id="dato_['.$x.']['.$y.']">'.$dato_imagen.'</td>';
				}else{
					$contenido = $contenido.'<td id="dato_['.$x.']['.$y.']">'.$datos[$x][$y].'</td>';
				}	
			}
			$check = false;
			$boton_editar = '';
			$boton_eliminar = '';
			if($this->getModoEditar()){
				$boton_editar = '<button class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEditar" onclick="cargarCampos('.$x.');"></button>';
				$check = true;
			}
			if($this->getModoEliminar()){
				$boton_eliminar = '<button class="btn btn-danger glyphicon glyphicon-trash" data-toggle="modal" data-target="#modalEliminar" onclick="cargarEliminar('.$x.')" ></button>';
				$check = true;
			}
			if($check){
				$contenido = $contenido.'<td >'.$boton_editar.' '.$boton_eliminar.'</td>';
				$contenido = $contenido.'<input type="hidden" id="hd_id_'.$x.'" value="'.$datos[$x]['id'].'">';
			}
			$contenido = $contenido.'</tr>'; 
		}
		$contenido = $contenido.'</tbody>';
		$titulo = $titulo.'</tr></thead>';
		$tabla = '<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">'.$titulo.$contenido.'</table>';
		$tabla = $this->getModalEditable().$tabla;
		return $tabla;

	}
	function getModalEditable(){
		$cabecera = $this->getCamposModal();
		$size_cabecera = count($cabecera);
		$celda_control = $this->getCeldaControl();
		$contenido = '';
		for($x = 0; $x < $size_cabecera; $x++){
			if(isset($cabecera[$x]['regla'])){
				$icon = '';
				$require = '';
				if(isset($cabecera[$x]['icon'])){
					$icon = '<span class="'.$cabecera[$x]['icon'].' form-control-feedback left" aria-hidden="true"></span>';
				}
				$placeholder = $cabecera[$x]['titulo'];
				if($cabecera[$x]['regla'] === 'required'){
					$placeholder = $cabecera[$x]['titulo'].'*';
				}
				if($cabecera[$x]['tipo'] === 'link'){
					$contenido = $contenido.'
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					<a href="'.$cabecera[$x]['href'].'" '.$cabecera[$x]['atributos'].' id="'.$cabecera[$x]['id'].'"> Click para editar <strong>'.$cabecera[$x]['titulo'].'</strong></a>
					</div>';
				}else if($cabecera[$x]['tipo'] === 'select'){

					$contenido = $contenido.'
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					<select name="'.$cabecera[$x]['id'].'" id="'.$cabecera[$x]['id'].'" '.$cabecera[$x]['regla'].' '.$cabecera[$x]['atributos'].' class="form-control has-feedback-left" >';
						$option = array();
						$option = explode(',',$cabecera[$x]['opciones']);
						$valores = array();
						$valores = explode(',',$cabecera[$x]['valores']);
						for($l=0;$l < count($option);$l++){
							$seleccionado = '';
							if($cabecera[$x]['seleccionar'] == ($l+1)){
								$seleccionado = 'selected';
							}
							$contenido = $contenido.'<option value="'.base64_encode($valores[$l]).'" '.$seleccionado.'>'.$option[$l].'</option>';
						}
					$contenido = $contenido.'</select>
				'.$icon.'</div>';
				}
				else if($cabecera[$x]['tipo'] === 'image'){
					$contenido = $contenido.'
					<div class="col-md-12 col-sm-12 col-xs-12 profile_right" align="center">
						<div class="profile_img">
				            <div id="crop-avatar">
				               <div id="mensaje_image_'.$cabecera[$x]['id'].'"><br /></div>
				                 <img class="img-responsive avatar-view" src="" alt="Avatar" title="Imagen" width="120px" height="120px" id="image_'.$cabecera[$x]['id'].'" />
				            </div>
				            <div align="center" >
				              <div class="ln_solid"></div>  
				                <label class="btn btn-info"><span class="fa fa-camera"><div id="div_file_'.$cabecera[$x]['id'].'"><input type="file" id="'.$cabecera[$x]['id'].'" name="'.$cabecera[$x]['id'].'" style="display: none" onchange="validarImagen(\''.$cabecera[$x]['id'].'\');"  /></div></span> Subir Imagen</label>
				          	</div>
				        </div>
				   	</div>';					
				}else{
					$contenido = $contenido.'
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					<input type="'.$cabecera[$x]['tipo'].'"  title="'.$cabecera[$x]['id'].'" name="'.$cabecera[$x]['id'].'" id="'.$cabecera[$x]['id'].'" '.$cabecera[$x]['regla'].' '.$cabecera[$x]['atributos'].' class="form-control has-feedback-left" placeholder="'.$placeholder.'" autocomplete="off" />
				'.$icon.'</div>';
				}
			}
		}
		$contenido = $contenido.'<input type="hidden" id="id" name="id" />';
		$dialog = $this->scriptEdicion().$this->scriptValidarImagen().$this->actualizar().$this->modalEliminar();
		$dialog .= '
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="" aria-hidden="true" id="modalEditar">
	        <div class="modal-dialog modal-sm">
	          <div class="modal-content">

	            <div class="modal-header">
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
	              </button>
	              <h4 class="modal-title" id="myModalLabel2">'.$this->getTituloModalEdicion().'</h4>
	            </div>
	            <div class="modal-body">
	              <div id="modal_mensaje"></div>
	              <div id="div_dtformulario">
	              	  <input type="hidden" id="hd_fila" />
		              <form id="form_dtactualizar" class="form-horizontal form-label-left input_mask" onsubmit="return false;" '.$this->encriptype.' >
		              '.$contenido.'
		              	<div class="modal-footer">
			              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			              <button type="submit" class="btn btn-primary" onclick="actualizar();">Save changes</button>
			            </div>
		              </form>
		          </div>
	            </div>
	          </div>
	       </div>
	    </div>';
	    return $dialog;
	}
	function scriptEdicion(){
		$campos = $this->getCamposModal();
		$numero_campos = count($campos);
		$campos_javascript = '';
		$campos_javascript = $campos_javascript.'var id = document.getElementById("id").value = document.getElementById("hd_id_"+fila).value;';
		for($x=0;$x < $numero_campos; $x++){
			if($campos[$x]['tipo'] == 'link'){
				$campos_javascript = $campos_javascript.'
				if(document.getElementById("'.$campos[$x]['id'].'")){
					var link_a = document.getElementById("'.$campos[$x]['id'].'");
					link_a.setAttribute("href","'.$campos[$x]['href'].'/"+id);
					link_a.setAttribute("onclick","window.open(this.href, this.target, \'width=600,height=400,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=50,left=100\'); return false;");
				}';
			}else if($campos[$x]['tipo'] == 'image'){
				$this->encriptype = 'enctype="multipart/form-data"';
				$campos_javascript = $campos_javascript.'
				if(document.getElementById("'.$campos[$x]['id'].'")){
					var imagen = document.getElementById("mensaje_image_'.$campos[$x]['id'].'").innerHTML = "<br />";
					var imagen = document.getElementById("image_'.$campos[$x]['id'].'");
					var  imagen_celda = document.getElementById("dato_image["+fila+"]['.$x.']");
					imagen.setAttribute("src",imagen_celda.src);
				}';
			}else if($campos[$x]['tipo'] == 'select'){
				continue;
			}else{
				$campos_javascript = $campos_javascript.';
				if(document.getElementById("dato_["+fila+"]['.$x.']")){
					var dato'.$x.' = document.getElementById("dato_["+fila+"]['.$x.']");
					var campo'.$x.' = document.getElementById("'.$campos[$x]["id"].'");
					campo'.$x.'.value =  dato'.$x.'.innerHTML;
				}';
			}
		}
		$script = '
		<script type="text/javascript">
			function cargarCampos(fila){
				document.getElementById("hd_fila").value = fila;
				var div_mensaje = document.getElementById("modal_mensaje").innerHTML= "";
				var div_form = document.getElementById("div_dtformulario");
				div_form.style.display = "";
		'.$campos_javascript.'
			}
		</script>';
		return $script;
	}
	function actualizar(){
		$valor_imagen = '';
		$paramentros_jquery = '';
		if($this->encriptype != ''){
			$valor_imagen = 'parametros = new FormData(formulario);';
			$paramentros_jquery = '
					dataType: "html",
		            cache: false,
		            contentType: false,
		            processData: false,';
		}
		$actualizar = '<script type="text/javascript">
			function actualizar(){
				var rqst = null;
				var loc = window.location;
				var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf("/"));
				pathName = pathName.substring(0, pathName.lastIndexOf("/") + 1);
				var div_form = document.getElementById("div_dtformulario");
				var formulario = document.getElementById("form_dtactualizar");
				var parametros = $("#form_dtactualizar").serialize();
				'.$valor_imagen.'
				var url = pathName + "'.$this->getURLActualizar().'";
				var check = true;
				if(rqst && rqst.readyState != 4) {
					rqst.abort();
				}

				for(x = 0; x < formulario.length - 2; x++){
					if(!formulario[x].checkValidity()){
						check = false;
						break;
					}
				}
				if(check == true){
					rqst = $.ajax({
						  url:   url,
						  data:  parametros,
				          type:  "post",
				          '.$paramentros_jquery.'
				          beforeSend: function () {
				          	div_form.style.display = "none";
				            $("#modal_mensaje").html(\'<center><img src="\'+pathName+\'img/big_loading.gif" alt="Cargando..."></center>\');
				          },
				          success: function (response) {
				          	//$("#modal_mensaje").html(response);
				          	var consulta = jQuery.parseJSON(response);
				          	var msg = consulta.resultado;
				          	var estado = consulta.estado;
				          	if(estado == "error"){
				          		msg = "<font color=\"red\">" + msg + "</font>"; 
				          		div_form.style.display = "";
				          		$("#modal_mensaje").html(msg);
				          	}else{
				          		$("#modal_mensaje").html(msg);
				          	} 
				          }
				    }).fail( function( jqXHR, textStatus, errorThrown ) {
				    	  div_form.style.display = "";
				    	  if (jqXHR.status === 0) {
					        $("#modal_mensaje").html("Not connect: Verify Network.");
					      } else if (jqXHR.status == 404) {
					        $("#modal_mensaje").html("Requested page not found [404]");
					      } else if (jqXHR.status == 500) {
					        $("#modal_mensaje").html("Internal Server Error [500].");
					      } else if (textStatus === "parsererror") {
					        $("#modal_mensaje").html("Requested JSON parse failed.");
					      } else if (textStatus === "timeout") {
					        $("#modal_mensaje").html("Time out error.");
					      } else if (textStatus === "abort") {
					        $("#modal_mensaje").html("Ajax request aborted.");
					      } else {
					        $("#modal_mensaje").html("Uncaught Error: " + jqXHR.responseText);
					      }
					});
				}
			}
			function actualizarTabla(){
				setTimeout("'.$this->getMethodRefresh().'", 500)
				/*var fila = document.getElementById("hd_fila").value;
				var formulario = document.getElementById("form_actualizar");
				var cont=0;
				for(x = 0; x < '.count($this->getCamposModal()).'; x++){
					var celda = document.getElementById("dato_["+fila+"]["+x+"]");
					if(celda){
						if(formulario.elements[x].type == "file"){
							celda.innerHTML = "<img src= \"../img/refresh.png\" alt=\"Actualizando archivos\" title =\"Actualizando la imagen\" id=\"dato_image["+fila+"]["+x+"]\" />";
						}else{
							celda.innerHTML = formulario.elements[x].value;
						}
					}
				}*/
			}
		</script>';
		return $actualizar;
	}
	function modalEliminar(){
		$contenido = '¿Confirma que desea <strong>eliminar</strong> el registro?';
		$modal = '<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modalEliminar">
	        <div class="modal-dialog modal-sm">
	          <div class="modal-content">

	            <div class="modal-header">
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
	              </button>
	              <h4 class="modal-title" id="myModalLabel2">Eliminar</h4>
	            </div>
	            <div class="modal-body">
	              <div id="modal_mensaje_eliminar"></div>
	              <div id="div_form_eliminar">
	              	  <input type="hidden" id="hd_fila_eliminar" />
		              <form id="form_eliminar" class="form-horizontal form-label-left input_mask" onsubmit="return false;"  >
		              '.$contenido.'
		              	<div class="modal-footer">
			              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			              <button type="submit" class="btn btn-primary" onclick="eliminar();">Eliminar</button>
			            </div>
		              </form>
		          </div>
	            </div>
	          </div>
	       </div>
	    </div>';
		return $modal.$this->scriptEliminar();
	}
	function scriptEliminar(){
		$script = '<script type="text/javascript">
		function cargarEliminar(fila){
			$("#modal_mensaje_eliminar").html("");
			var div_form = document.getElementById("div_form_eliminar");
			div_form.style.display = "";
			var id = document.getElementById("hd_fila_eliminar");
			id.value = fila;
		}
		function eliminar(){
				var fila = document.getElementById("hd_fila_eliminar").value;
				var id = document.getElementById("hd_id_"+fila).value;
				var div_form = document.getElementById("div_form_eliminar");
				var url = pathName + "'.$this->getURLEliminar().'"; 
	  			var parametros = {
      				"id": id
  				}
				if(rqst && rqst.readyState != 4) { 
				    rqst.abort();
				}
				rqst = $.ajax({
			          data: parametros,
			          url:   url,
			          type:  "post",
			          beforeSend: function () {
			            $("#modal_mensaje_eliminar").html(\'<center><img src="\'+pathName+\'img/big_loading.gif" alt="Cargando..."></center>\');
			            	div_form.style.display =\'none\';
			          },
			          success: function (response) {
			            //$("#modal_mensaje_eliminar").html(response);
			            var consulta = jQuery.parseJSON(response);
			          	var msg = consulta.resultado;
			          	var estado = consulta.estado;
			          	if(estado == "error"){
			          		msg = "<font color=\"red\">" + msg + "</font>"; 
			          		div_form.style.display = "";
			          		$("#modal_mensaje_eliminar").html(msg);
			          	}else{
			          		$("#modal_mensaje_eliminar").html(msg);
			          	}  
			          }
			    }).fail( function( jqXHR, textStatus, errorThrown ) { 
			       $("#modal_mensaje_eliminar").html(\'<center>\'+errorAjax( jqXHR, textStatus, errorThrown )+\'</center>\');
				});
			}
		</script>';
		return $script;
	}
	function scriptValidarImagen(){
		$script = '<script type="text/javascript">
			function validarImagen(id){
				var file = document.getElementById(id);
				var div_file = document.getElementById("div_file_"+id);
				var div_mensaje_foto = document.getElementById("mensaje_image_"+id);
				var foto_perfil = document.getElementById("image_"+id);
				var imagen = file.files[0];
				var tamanioMaxByte = 2000;
				var check = true;
				div_mensaje_foto.innerHTML = "";

				if (!window.FileReader) {
			        foto_perfil.alt = "El navegador no soporta la lectura de archivos";
			    }else{
			    	if (!(/\.(jpg|png|gif)$/i).test(imagen.name)) {
			    		check = false;
				        div_mensaje_foto.innerHTML = \'<font color="red">El archivo a adjuntar no es una imagen</font>\';
				        div_file.innerHTML = \'<input type="file" name="foto" id="foto" style="display: none" onchange="validarImagen();" />\';
				        foto_perfil.src = "../img/no-imagen-200x200.jpg";
				    }
				    else {
				        var photo = new Image();
				        photo.onload = function () {
				            if (imagen.size > tamanioMax)
				            {
				                check = false;
				                div_mensaje_foto.innerHTML = \'<font color="red">El peso de la imagen no puede exceder los 2MB</font>\';
				            }
				        };
				        if(check){
				        	foto_perfil.src = URL.createObjectURL(imagen);
				        	div_mensaje_foto.innerHTML = "<br />";
				        }else{
				        	div_file.innerHTML = \'<input type="file" name="foto" id="foto" style="display: none" onchange="validarImagen();" />\';
				        }
				    } 
			    }
			}
		</script>';
		return $script;	
	}
}
?>