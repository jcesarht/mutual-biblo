<?php

class ConfigDataBase{
	private $config = '';
	function ConfigDataBase(){
		$limite_default_folder = realpath(null);
		$limite_default_folder = substr($limite_default_folder, 0,(strpos($limite_default_folder, "default")+7));
		$directorio = $limite_default_folder; 
		$this->config = @parse_ini_file($directorio.'/app/config/databases.ini')
		or die ('Hay un problema con la configuración.<br /> Contacte a soporte técnico.');
	}
	function getHost(){
		return $this->config['host'];
	}
	function getNameDataBase(){
		return $this->config['name'];
	}
	function getPassword(){
		return $this->config['password'];
	}
	function getUser(){
		return $this->config['username'];
	}
} 
?>