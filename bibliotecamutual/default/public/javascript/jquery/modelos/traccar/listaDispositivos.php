<?php
header('Access-Control-Allow-Origin: *');
$usuario = $_POST["usuario"];
$password = $_POST["password"];
$servidor = $_POST["url"];
$protocolo = $_POST["protocolo"];
$resultado = Array();
$login = $protocolo.$usuario.":".$password."@".$servidor."/api/devices/";
$json_dispositivos_gps = @file_get_contents($login);
if($json_dispositivos_gps !== FALSE){
	$array_dispositivos_gps = json_decode($json_dispositivos_gps,true);
	$resultado[0] = 'success';
	$resultado[1] = $array_dispositivos_gps;
}else{
	$resultado[0] = 'error';
	$resultado[1] = 'Credenciales incorrectas. Acceso no autorizado. No se encontró dispositivo alguno. '.$login;
}
echo json_encode($resultado);
?>