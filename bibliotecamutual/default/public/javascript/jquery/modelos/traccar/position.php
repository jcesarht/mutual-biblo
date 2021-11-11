<?php
header('Access-Control-Allow-Origin: *');
$usuario = $_POST["usuario"];
$password = $_POST["password"];
$servidor = $_POST["url"];
$protocolo = $_POST["protocolo"];
$atributo = $_POST["atributo"];
$id_posicion = $_POST["idpos"];
$id_dispoisitvo = '';
$from = '';
$to = '';
$indice = 0;
if(isset($_POST['iddev'])){
	$id_dispoisitvo = $_POST["idpos"];
	$from = $_POST['from']."T05:30:00Z";
	$to = $_POST['to']."T18:00:00Z";
	$login = $protocolo.$usuario.":".$password."@".$servidor."/api/positions?iddev=".$id_dispoisitvo."&&from=".$from."&&to=".$to;
}else{
	$login = $protocolo.$usuario.":".$password."@".$servidor."/api/positions?id=".$id_posicion;
}
$resultado = Array();
$json_dispositivos_gps = @file_get_contents($login);
if($json_dispositivos_gps !== FALSE){
	$array_dispositivos_gps = json_decode($json_dispositivos_gps,true);
	if(count($array_dispositivos_gps) > 1){
		$indice = (count($array_dispositivos_gps)-1);
	}
	if($atributo === 'totalDistance' || $atributo === 'distance' || $atributo === 'motion' || $atributo === 'hours'){
		$resultado[0] = 'success';
		$resultado[1] = $array_dispositivos_gps[$indice]["attributes"][$atributo];
	}else if($atributo === 'deviceId' || $atributo === 'type' || $atributo === 'protocol' || $atributo === 'serverTime' || $atributo === 'deviceTime' || $atributo === 'fixTime' || $atributo === 'outdated' || $atributo === 'valid' || $atributo === 'latitude' || $atributo === 'longitude' || $atributo === 'altitude' || $atributo === 'speed' || $atributo === 'course' || $atributo === 'address' || $atributo === 'accuracy' || $atributo === 'network' || $atributo === 'attributes'){
		$resultado[0] = 'success';
		$resultado[1] = $array_dispositivos_gps[$indice][$atributo];

	}else{
		$resultado[0] = 'error';
		$resultado[1] = 'Debe enviar el atributo correctamente.';
	}

}else{
	$resultado[0] = 'error';
	$resultado[1] = 'Credenciales incorrectas. Acceso no autorizado para atributos';
}
echo json_encode($resultado);
?>
