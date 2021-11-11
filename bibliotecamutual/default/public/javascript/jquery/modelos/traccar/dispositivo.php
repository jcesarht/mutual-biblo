<?php
header('Access-Control-Allow-Origin: *');
$usuario = "";
$password = "";
$servidor = "";
$protocolo = "";
$id_dispositivo = "";
$resultado = Array();
if(isset($_POST["usuario"]) === true || isset($_POST["password"]) === true || isset($_POST["url"]) === true || isset($_POST["protocolo"]) === true ||isset($_POST["dispositivo"]) === true ){
	$usuario = $_POST["usuario"];
	$password = $_POST["password"];
	$servidor = $_POST["url"];
	$protocolo = $_POST["protocolo"];
	$id_dispositivo = $_POST["dispositivo"];
	$resultado = Array();
	$login = $protocolo.$usuario.":".$password."@".$servidor."/api/devices?id=".$id_dispositivo;
	$json_dispositivos_gps = @file_get_contents($login);
	if($json_dispositivos_gps !== FALSE){
		$array_dispositivos_gps = json_decode($json_dispositivos_gps,true);
		$resultado[0] = 'success';
		$resultado[1] = $array_dispositivos_gps;
	}else{
		$resultado[0] = 'error';
		$resultado[1] = 'Credenciales incorrectas. Acceso no autorizado para a dispositivo';
	}
}else{
	$resultado[0] = 'error';
	$resultado[1] = 'Parametros de conexión incorrectos';	
}
echo json_encode($resultado);
?>