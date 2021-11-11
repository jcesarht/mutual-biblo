<?php
header('Access-Control-Allow-Origin: *');
include("../model.php");
$conexion = new ConexionBaseDeDatos();
$link = $conexion->conectar();
$id_dispositivo = base64_decode($_POST["iddis"]);
$comando = base64_decode($_POST["comando"]);
$check_programacion = $_POST["check_programacion"];
$tipo_programacion = $_POST["tipo_programacion"];
$nombre_comando = $_POST["nombre_comando"];
$dispositivo = array();
$msg = "";
$estado = "";
if(isset($id_dispositivo)){
	if($check_programacion == 'true'){
		$tipo_programacion = $_POST["tipo_programacion"];
		if($tipo_programacion == 1){
			$fecha_programada = $_POST["fecha_programada"];
			$hora = substr($fecha_programada,11,5);
			$formato = substr($fecha_programada,17,2);
			if($formato === 'PM'){
				$hora_y_minutos = explode(":",$hora);
				$hora = ($hora_y_minutos[0] + 12).":".$hora_y_minutos[1];
				if(substr($hora, 0,2) === "24"){
					$hora = str_replace("24","00",$hora);
				}
			}
			$fecha_programada = str_replace("/", "-", $fecha_programada);
			$fecha_programada = substr($fecha_programada,0,10);
			$dia_semana = date("N",strtotime($fecha_programada)) + 1;
			$fecha_programada = $fecha_programada." ".$hora;
			$mes = explode("-",$fecha_programada);
			$mes = $mes[1];
			$consultar = array();
			$sql = "SELECT c.id  FROM programaciones_diarias pd, comandos c WHERE c.id = pd.comando_id AND c.comando = '".$comando."' AND (pd.mes = '".$mes."' OR pd.mes = '-1') AND dias_semana LIKE '%".$dia_semana."%' AND pd.hora = '".$hora."' AND pd.estado != 'eliminado'";
			$handle = mysqli_query($link,$sql); 
			while ($row = mysqli_fetch_array($handle)){
				$consulta[] = $row;
			}
			if($handle->num_rows !== 0){
				$msg = 'Comando ya esta programado en programaciones repetitivas. No se guardó programación';
				$estado = 'warning';
			}else{
				$sql = "SELECT pu.id FROM programaciones_unicas pu, comandos c WHERE pu.fecha = '".$fecha_programada."' AND pu.comando_id = c.id AND c.comando = '".$comando."' AND pu.estado != 'eliminado' AND pu.estado != 'ejecutado'";
				$handle = mysqli_query($link,$sql); 
				while ($row = mysqli_fetch_array($handle)){
					$consulta[] = $row;
				}
				if($handle->num_rows !== 0){
					$msg = 'Comando ya existe. No se guardó programación';
					$estado = 'warning';	
				}else{
					$sql = "INSERT INTO comandos(`dispositivo_id`, `comando`,`nombre` ,`programacion`, `fecha_at`) VALUES ('".$id_dispositivo."','".$comando."','".$nombre_comando."', '".$tipo_programacion."', NOW())";
					$handle = mysqli_query($link,$sql); 
					if($handle == TRUE){
						$id_comando = mysqli_insert_id($link);
						$sql = "INSERT INTO programaciones_unicas(`comando_id`, `fecha`,`fecha_at`) VALUES ('".$id_comando."','".$fecha_programada."',NOW())";
						$handle = mysqli_query($link,$sql); 
						if($handle == TRUE){
							$estado = 'success';
							$msg = 'Comando programado';
						}else{
							$sql = "DELETE FROM comandos WHERE id = ".$id_comando;
							$handle = mysqli_query($link,$sql); 
							if($handle == TRUE){
								$estado = 'error';
								$msg = 'Comando no programado. Por favor contacte a soporte';
							}else{
								$estado = 'error';
								$msg = 'No se completó la transacción para guardar comando. Por favor contacte a soporte ';
							}
						}
					}
				}
			}
		}
		if($tipo_programacion == 2){
			$mes = $_POST["mes"];
			$hora = $_POST["hora_programada"];
			$dias_semana = "";
			$sql_dias = "";
			for($x=1;$x<=7;$x++){
				if(isset($_POST['dia_'.$x])){
					$dias_semana .= $_POST['dia_'.$x].":";
					$sql_dias .= "pd.dias_semana LIKE '%".$_POST['dia_'.$x]."%' OR ";
				}
				if($x == 7){
					$sql_dias = substr($sql_dias, 0, -3);
				}
			}
			if($dias_semana == ''){
				$estado = 'error';
				$msg = 'Debe escoger los días de la semana';
			}else{
				$consulta = array();
				$sql = "SELECT c.id  FROM programaciones_diarias pd, comandos c WHERE c.id = pd.comando_id AND c.comando = '".$comando."' AND (pd.mes = '".$mes."' OR pd.mes = '-1') AND (".$sql_dias.") AND pd.hora = '".$hora."' AND pd.estado != 'eliminado'";
				$handle = mysqli_query($link,$sql); 
				while ($row = mysqli_fetch_array($handle)){
					$consulta[] = $row;
				}
 				if($handle->num_rows === 0){
					$sql = "INSERT INTO comandos(`dispositivo_id`, `comando`,`nombre`,`programacion`, `fecha_at`) VALUES ('".$id_dispositivo."','".$comando."','".$nombre_comando."', '".$tipo_programacion."', NOW())";
					$handle = mysqli_query($link,$sql); 
					if($handle == TRUE){
						$id_comando = mysqli_insert_id($link);
						$sql = "INSERT INTO programaciones_diarias(`comando_id`, `mes`,`dias_semana`,`hora`,`fecha_at`) VALUES ('".$id_comando."','".$mes."','".$dias_semana."','".$hora."',NOW())";
						$handle = mysqli_query($link,$sql); 
						if($handle == TRUE){
							$estado = 'success';
							$msg = 'Comando programado';
						}else{
							$sql = "DELETE FROM comandos WHERE id = ".$id_comando;
							$handle = mysqli_query($link,$sql); 
							if($handle == TRUE){
								$estado = 'error';
								$msg = 'Comando diario no programado. Por favor contacte a soporte';
							}else{
								$estado = 'error';
								$msg = 'No se completó la transacción para guardar comando. Por favor contacte a soporte ';
							}
						}
					}
				}else{
					$estado = 'info';
					$msg = 'No fue programado porque el comando ya había sido programado';
				}	
			}			
		}
	}else{
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
			$data = array('id' => $comando,'deviceId' => $id_dispositivo);
			$data_string = json_encode($data);
			$url_dispositivos_gps = $protocolo.$servidor."/api/commands/send";
			$credenciales = base64_encode($usuario.":".$password);
			$ch = curl_init($url_dispositivos_gps);
			curl_setopt($ch, CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Basic '.$credenciales));
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			$result = curl_exec($ch);
			curl_close ($ch);
			$estado = 'success';
			$msg = 'Comando enviado';
		}else{
			$estado = 'error';
			$msg = 'Dispositivo no esta enlazado a la plataforma de rastreo';
		} 
	}
}else{
	$estado = 'error';
	$msg = 'Dispositivo no existe.';
}
$resultado["estado"] = $estado;
$resultado["msg"] = $msg;
echo json_encode($resultado);
?>