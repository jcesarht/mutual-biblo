<?php
class Libros extends ActiveRecord
{
    public function registrarLibro($titulo,$isbn,$nombre_persona,$fecha_entrega = ''){
        $check = false;
        $respuesta = array();
        $this->titulo = $titulo;
        $this->nombre_persona = $nombre_persona;
        $this->isbn = $isbn;
        $this->fecha_entrega = $fecha_entrega;
        $consultar = $this->find("isbn = '".$isbn."'");
        if(count($consultar) == 0){
            if($this->save()){
                $check = true;
                $respuesta = ["estado" => $check,"mensaje" => "Se guardó correctamente el registro"];
            }else{
                $respuesta = ["estado" => $check,"mensaje" => "Error al guardar en la base de datos"];
            }
        }else{
            $respuesta = ["estado" => $check,"mensaje" => "ISBN repetido. No se realizó el prestamo del libro"];
        }
        

        return $respuesta;
    }
    /**
     * Retorna los menús para ser paginados
     *
     * @param int $page  [requerido] página a visualizar
     * @param int $ppage [opcional] por defecto 20 por página
     */
    /*public function getAdmin($page, $ppage=10)
    {
        return $this->paginate("page: $page", "per_page: 3", 'order: id desc');
    }*/
    /*public function getAdmin($usuario,$password){
		$usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
		//$busqueda = filter_var($password, FILTER_SANITIZE_STRING);
		return $this->find_all_by_sql("SELECT a.id,a.nombres,a.apellidos,a.empresa_id FROM admin a WHERE a.login = '".$usuario."' AND a.contra_adm = '".$password."'");
	}
    public function getAdminPorEmail($email){
        $usuario = filter_var($email, FILTER_SANITIZE_STRING);
        //$busqueda = filter_var($password, FILTER_SANITIZE_STRING);
        return $this->find_all_by_sql("SELECT a.id,a.nombres,a.apellidos FROM admin a WHERE a.email = '".$email."' ");
    }
    public function registrarAdmin($nombres,$email,$password,$id_empresa){
        $this->nombres = $nombres;
        $this->contra_adm = $password;
        $this->login = $email;
        $this->email = $email;
        $this->empresa_id = $id_empresa;
        return $this->save();
    }
    public function getSucursal($id_admin){
        return $this->find_all_by_sql("SELECT sucursal_id AS id FROM administradores_sucursales WHERE admin_id = '$id_admin' AND estado != 'eliminado'");
    }
    public function getMenu($id_admin){
        $menu = '<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a></li>';
        $modulo = array();
        $permisos = $this->find_all_by_sql("SELECT vista_id, crear, eliminar, editar FROM administradores_vistas_permisos WHERE admin_id = '$id_admin'  AND (crear != '0' OR eliminar != '0' OR editar != '0' OR consultar != '0') ORDER BY vista_id ASC");
        $total_permisos = count($permisos);
        for($x=0;$x<$total_permisos;$x++){
            $modulo[$x] = substr($permisos[$x]->vista_id,0,2);
        }
        $modulo = array_values(array_unique($modulo));
        $total_registros_modulo = count($modulo);
        for($x = 0;$x<$total_registros_modulo;$x++){
            if($modulo[$x] <= '09'){
                $id_vista = $modulo[$x];
                $auxiliar = $this->find_all_by_sql("SELECT vista, url, icono FROM vistas WHERE id = '".$id_vista."' ");
                $sbmenu = array();
                $cont = 0;
                for($y=0;$y<$total_permisos;$y++){
                    $codigo = substr($permisos[$y]->vista_id,0,4);
                    if(substr($codigo,0,2) == $id_vista){
                        $sbmenu[$cont] = $codigo;
                        $cont++;         
                    }
                }
                $sbmenu = array_values(array_unique($sbmenu));
                $total_registros_sbmodulo = count($sbmenu);
                $submenu = '';
                if($total_registros_sbmodulo != 0){
                    $submenu = '<ul class="nav child_menu">';
                    for($y=0;$y<$total_registros_sbmodulo;$y++){
                        $auxiliar2 = $this->find_all_by_sql("SELECT vista, url, icono FROM vistas WHERE id = '".$sbmenu[$y]."' ");
                        
                        if($auxiliar2[0]->url != '#'){
                            $submenu = $submenu.'<li><a href="'.PUBLIC_PATH.$auxiliar2[0]->url.'">'.$auxiliar2[0]->vista.'</a></li>';
                        }else{
                            $submenu = $submenu.'<li><a href="'.PUBLIC_PATH.'admin/menu/'.base64_encode($sbmenu[$y]).'/'.base64_encode($auxiliar2[0]->vista).'">'.$auxiliar2[0]->vista.'</a></li>';
                        }
                    }
                    $submenu = $submenu.'</ul>';    
                }
                
                if($auxiliar[0]->url != '#'){
                    $menu = $menu.'<li><a href="'.$auxiliar[0]->url.'"><i class="fa '.$auxiliar[0]->icono.'"></i>'.$auxiliar[0]->vista.'<span class="fa fa-chevron-down"></span></a>'.$submenu.'</li>';
                }else{
                    $menu = $menu.'<li><a><i class="fa '.$auxiliar[0]->icono.'"></i>'.$auxiliar[0]->vista.'<span class="fa fa-chevron-down"></span></a>'.$submenu.'</li>';
                }
            }
        }
        return $menu;
    }
    //Se obtiene los codigos de permisos o vistas con las acciones de CRUD
    public function getPermisos($id_admin){
        $permisos = array();
        $permisos_admin = $this->find_all_by_sql("SELECT vista_id, crear, eliminar, editar FROM administradores_vistas_permisos WHERE admin_id = '".$id_admin."'  AND (crear != '0' OR eliminar != '0' OR editar != '0' OR consultar != '0') ORDER BY vista_id ASC");
        for($x = 0;$x < count($permisos_admin);$x++){
            @$permisos[$x]->vista_id = $permisos_admin[$x]->vista_id;
            @$permisos[$x]->crear = (int)$permisos_admin[$x]->crear;
            @$permisos[$x]->eliminar =  (int)$permisos_admin[$x]->eliminar;
            @$permisos[$x]->editar =  (int)$permisos_admin[$x]->editar;
        }
        return $permisos;
    }*/
}
?>