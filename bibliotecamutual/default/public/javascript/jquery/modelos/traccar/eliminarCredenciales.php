<?php
header('Access-Control-Allow-Origin: *');
include("../model.php");
$conexion = new ConexionBaseDeDatos();
$link = $conexion->conectar();
$id_vehiculo = $_POST["idveh"];
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
		$sql = "UPDATE vinculos SET estado = 'eliminado' WHERE id = '".$id_registro."' ";
		if(mysqli_query($link,$sql) == TRUE){
			$resultado[0] = 'success';
			$resultado[1] = 'Desacoplado con exito.';		
		}else{
			$resultado[0] = 'error';
			$resultado[1] = 'No se puede desacoplar.';
		}
	}
}else{
	$resultado[0] = 'error';
	$resultado[1] = 'Datos enviados inexistentes'; 
} 
echo json_encode($resultado);
?>