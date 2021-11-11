<?php
header('Access-Control-Allow-Origin: *');
include("../model.php");
$conexion = new ConexionBaseDeDatos();
$link = $conexion->conectar();
$id_programacion = base64_decode($_POST["idpro"]);
$id_comando = base64_decode($_POST["idcom"]);
$tipo_programacion = $_POST["tipo_programacion"];
$resultado = Array();
if(isset($id_programacion)){
	if($tipo_programacion == 1){
		$sql = "UPDATE programaciones_unicas SET estado = 'eliminado' WHERE id = '".$id_programacion."'";
		$handle = mysqli_query($link,$sql); 
		if($handle == TRUE){
			$sql = "UPDATE comandos SET estado = 'eliminado' WHERE id = '".$id_comando."'";
			$handle = mysqli_query($link,$sql); 
			if($handle == TRUE){
				$estado = 'success';
				$msg = 'Programación única eliminado con exito.';
			}else{
				$estado = 'warning';
				$msg = 'No se completó la eliminación del comando. Por favor contacte a soporte ';
			}
		}else{
			$estado = 'error';
			$msg = 'No se eliminó la programación única.';
		}
	}
	if($tipo_programacion == 2){
		$sql = "UPDATE programaciones_diarias SET estado = 'eliminado' WHERE id = '".$id_programacion."'";
		$handle = mysqli_query($link,$sql); 
		if($handle == TRUE){
			$sql = "UPDATE comandos SET estado = 'eliminado' WHERE id = '".$id_comando."'";
			$handle = mysqli_query($link,$sql); 
			if($handle == TRUE){
				$estado = 'success';
				$msg = 'Programación eliminado con exito.';
			}else{
				$estado = 'warning';
				$msg = 'No se completó la eliminación del comando. Por favor contacte a soporte ';
			}
		}else{
			$estado = 'error';
			$msg = 'No se recibió parametros';
		}
	}
}else{
	$estado = 'error';
	$msg = 'Datos enviados inexistentes'; 
} 
$resultado["estado"] = $estado;
$resultado["msg"] = $msg; 
echo json_encode($resultado);
?>