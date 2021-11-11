<?php
$localpath = '../../../../../';
if(isset($_POST['localpath'])){
	$localpath = $_POST['localpath'];
}
include $localpath."app/libs/valordatabaseini.php";
class ConexionBaseDeDatos{ 
				
		function conectar(){
			$config = new ConfigDataBase();
			$host = $config->getHost();
			$user = $config->getUser();
			$password = $config->getPassword();
			$database = $config->getNameDataBase();
			$link = @mysqli_connect($host,$user,$password,$database)
            or die("No se puede conectar al servidor ");
			$db = @mysqli_select_db($link,$database)  
            or die("No se puede seleccionar la base de datos"); 
			return $link;
		}
		function cerrar($link){
			$link->close();
		}
}
?>