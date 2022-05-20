<?php
declare(strict_types = 1);
if(!class_exists("Config")){
	include("./config.class.php");
}
class DBC{
	private static $MySQL;

	// Establecer conexion al servidor MySQL
	public static function Connect() : object{
		self::$MySQL = @new mysqli(Config::GetData("Host"), Config::GetData("User"), Config::GetData("Pass"));
		if(self::$MySQL -> connect_errno){
			throw new Exception("Error al conectar con el servidor ", 1);
		}
		return self::$MySQL;
	}
}
?>