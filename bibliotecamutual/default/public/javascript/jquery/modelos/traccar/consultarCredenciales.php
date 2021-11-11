<?php
header('Access-Control-Allow-Origin: *');
include("../model.php");
$conexion = new ConexionBaseDeDatos();
$link = $conexion->conectar();
$id_vehiculo = $_POST["idveh"];
$vehiculo = Array();
$resultado = Array();
if(isset($id_vehiculo)){
	$sql = "SELECT usuario_track AS usuario, pass_track AS password, protocolo, servidor, vhtrack_id AS dispositivo FROM vinculos WHERE vhadmin_id  = '".$id_vehiculo."' AND estado != 'eliminado' LIMIT 1";
	$handle = mysqli_query($link,$sql); 
	while ($row = $handle->fetch_array()) { 
		$vehiculo[] = $row;
	}
	mysqli_free_result($handle);
	if(count($vehiculo)!= 0){
		$resultado[0] = 'success';
		$resultado[1] = $vehiculo;
	}else{
		$resultado[0] = 'error';
		$resultado[1] = 'Unidad no acoplada.';
	}
}else{
	$resultado[0] = 'error';
	$resultado[1] = 'Parametro incorrecto'; 
}
echo json_encode($resultado);
?>