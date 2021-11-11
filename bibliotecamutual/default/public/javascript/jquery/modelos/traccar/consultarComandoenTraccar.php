<?php
header('Access-Control-Allow-Origin: *');
include("../model.php");
$conexion = new ConexionBaseDeDatos();
$link = $conexion->conectar();
$id_dispositivo = base64_decode($_POST["iddis"]);
$resultado = array();
$msg = '';
$estado = '';
$usuario ='';
$password='';
$servidor='';
$protocolo='';
$dispositivo = array();
$url_dispositivos_gps = '';
$sql = "SELECT usuario_track, pass_track, servidor, protocolo FROM vinculos WHERE vhtrack_id  = '".$id_dispositivo."' AND estado != 'eliminado' LIMIT 1";
$handle = mysqli_query($link,$sql); 
while ($row = mysqli_fetch_array($handle)){
	$dispositivo[] = $row;
}
if($handle->num_rows !== 0){
	$usuario = $dispositivo[0][0];
	$password = $dispositivo[0][1];
	$servidor = $dispositivo[0][2];
	$protocolo = $dispositivo[0][3];
	mysqli_free_result($handle);
	$url_dispositivos_gps = $protocolo.$usuario.":".$password."@".$servidor."/api/commands?deviceId=".$id_dispositivo;
	$json_response_gps = @file_get_contents($url_dispositivos_gps);
	$array_comandos_gps = json_decode($json_response_gps,true);
	$total_comandos = count($array_comandos_gps);
	if($total_comandos != 0){
		$msg = $array_comandos_gps;
		$estado = "success";
	}else{
		$msg = "No existe comandos guardos en la plataforma de rastreo.";
		$estado = "warning";
	}
}else{
	$msg = 'No existe comandos guardados para el dispositivo';
	$estado = "warning";
}

$resultado["estado"] = $estado;
$resultado["msg"] = $msg;
echo json_encode($resultado);
?>