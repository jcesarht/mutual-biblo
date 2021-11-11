<?php
include("../model.php");
include("../../tabla-responsive-plantilla/data-table.php");
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    $tabla = new Tabla();
    $conexion = new ConexionBaseDeDatos();
    $link = $conexion->conectar();
    $iddis = base64_decode($_POST['iddis']);
    $tipo_programacion = $_POST['tipo_programacion'];
    $msg = '';
    $estado = ''; 
    $resultado = array();
    $table = '';
    $mes = '';
    if($tipo_programacion == 1){
        $sql = "SELECT c.nombre, pu.fecha,pu.id,pu.comando_id  FROM programaciones_unicas pu, comandos c WHERE pu.comando_id = c.id AND pu.estado != 'eliminado' ORDER BY CONCAT(pu.fecha) ASC ";
        $handle = mysqli_query($link,$sql); 
        if($handle->num_rows !== 0){
            while ($row = mysqli_fetch_array($handle)) {
              $resultado[] = $row;
            }
            $total_registro = $handle->num_rows;
            $table = '<table width="100%" border="1">';
            $table .= '<thead><tr ><th><center>Comando</center></th><th align="center"><center>Fecha y Hora</center></th><th><center>Acción</center></th></tr></thead><tbody>';
            for($x=0;$x<$total_registro;$x++){
                $table .= '<tr><td>'.$resultado[$x][0].'</td><td>'.$resultado[$x][1].'</td><td><button onclick="eliminar(\''.base64_encode($resultado[$x][2]).'\',\''.base64_encode($resultado[$x][3]).'\');" class ="btn btn-danger submit">Eliminar <span class="fa fa-trash-o"></span></button></td></tr>';
            }
            $table .= '</tbody></table>';
            $msg = $table;
            $estado = 'success';
        }else{
            $msg = 'No existe comandos únicos programados';
            $estado = 'info';
        }
    }
    if($tipo_programacion == 2){
        $dias_semana = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sábado');
        $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $sql = "SELECT c.nombre, pd.mes, pd.hora, pd.dias_semana,pd.id, pd.comando_id  FROM programaciones_diarias pd, comandos c WHERE pd.comando_id = c.id AND pd.estado != 'eliminado' ORDER BY CONCAT(pd.mes,pd.hora)ASC ";
        $handle = mysqli_query($link,$sql); 
        if($handle->num_rows !== 0){
            $total_registro = $handle->num_rows;
            while ($row = mysqli_fetch_array($handle)) {
              $resultado[] = $row;
            }
            $table = '<table width="100%" border="1">';
            $table .= '<thead><tr ><th><center>Comando</center></th><th align="center"><center>Mes</center></th><th><center>Hora</center></th><th align="center"><center>Días de la semana</center></th><th><center>Acción</center></th></tr></thead><tbody>';
            for($x=0;$x<$total_registro;$x++){
                $dias_de_semana = array();
                $dias_de_semana = explode(":",$resultado[$x][3]);
                $dias = '';
                for($y = 0; $y < 7; $y++){
                    for($z =0; $z < count($dias_de_semana); $z++){
                        if($dias_de_semana[$z] == ($y + 1)){
                            $dias .= $dias_semana[$y].', '; 
                        }
                    } 
                }
                if($resultado[$x][1] < 1){
                   $mes = 'Todos los meses'; 
                }else{
                   $mes = $meses[$resultado[$x][1]-1];
                }
                $table .= '<tr><td>'.$resultado[$x][0].'</td><td>'.$mes.'</td><td>'.$resultado[$x][2].'</td><td align = "right">'.$dias.'</td><td><button onclick="eliminar(\''.base64_encode($resultado[$x][4]).'\',\''.base64_encode($resultado[$x][5]).'\');" class ="btn btn-danger submit">Eliminar <span class="fa fa-trash-o"></span></button></td></tr>';
            }
            $table .= '</tbody></table>';
            $msg = $table;
            $estado = 'success';
        }else{
            $msg = 'No existe comandos programados';
            $estado = 'info';
        }
    }  
    $resultado['msg'] = $msg;
    $resultado['estado'] = $estado;
    echo json_encode($resultado);
}
?>