<?php
/**
 * Controller por del inicio de session de la aplicacion 
   Registro de un nuevo cliente 
 *
 */
class ApiController extends AppController{
	
	public function libros(){
		View::template(null);
		$title = Input::hasPost('titulo');	
		echo 'Este es un tile'.$title;	
	}
}
?>