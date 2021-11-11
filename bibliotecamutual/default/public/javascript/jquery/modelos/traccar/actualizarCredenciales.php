<?php
header('Access-Control-Allow-Origin: *');
include("../model.php");
$resultado = Array();
$conexion = new ConexionBaseDeDatos();
$link = $conexion->conectar();
$id_vehiculo = $_POST["idveh"];
$servidor = $_POST["url"];
$protocolo = $_POST["protocolo"];
$usuario = $_POST["usuario"];
$password = $_POST["password"];
$id_dispositivo = $_POST["id_dispositivo"];
$id_framework = $_POST["framework"];
$id_registro = '';
$vehiculo = Array();
$resultado = Array();
if(isset($id_vehiculo)){
	$sql = "SELECT id FROM vinculos WHERE vhadmin_id  = '".$id_vehiculo."' AND estado != 'eliminado' LIMIT 1";
	$handle = mysqli_query($link,$sql); 
	while ($row = mysqli_fetch_array($handle)){
		$vehiculo[] = $row;
	}
	mysqli_free_result($handle);
	if(count($vehiculo)!= 0){
		$id_registro = $vehiculo[0][0];
		$sql = "UPDATE vinculos SET framework_id = '".$id_framework."', protocolo = '".$protocolo."', servidor = '".$servidor."', usuario_track = '".$usuario."', pass_track = '".$password."', vhtrack_id = '".$id_dispositivo."',fecha_at = NOW() WHERE id = '".$id_registro."' ";
		if(mysqli_query($link,$sql) == TRUE){
			$resultado[0] = 'success';
			$resultado[1] = 'Acoplo actualizado correctamente';		
		}else{
			$resultado[0] = 'error';
			$resultado[1] = 'No se puede actualizar.';
		}
	}else{
		$resultado[0] = 'success';
		$resultado[1] = 'Acoplado correctamente';
		$sql = "INSERT INTO vinculos (`vhadmin_id`, `vhtrack_id`, `framework_id`, `usuario_track`,`pass_track`,`protocolo`,`servidor`,`fecha_at`) VALUES ('".$id_vehiculo."',".$id_dispositivo.", '".$id_framework."','".$usuario."','".$password."', '".$protocolo."', '".$servidor."', NOW())";
		$handle = mysqli_query($link,$sql); 
		if($handle == TRUE){
			$resultado[0] = 'success';
			$resultado[1] = 'Acoplado correctamente';		
		}else{
			$resultado[0] = 'error';
			$resultado[1] = 'No se acopló correctamente.'.mysqli_error($link);
		}
	}
}else{
	$resultado[0] = 'error';
	$resultado[1] = 'Datos enviados inexistentes'; 
} 
echo json_encode($resultado);
?>