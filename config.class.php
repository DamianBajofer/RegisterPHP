<?php
declare(strict_types = 1);
class Config{
	
	// Credenciales de MySQL
	private static $MySQLData = array(
		"Host" => 		"127.0.0.1",
		"Port" => 		"3306",
		"User" => 		"root",
		"Pass" => 		"",
		"Database" => 	"website1"
	);

	public static $SiteData = array(
		"Domain" => "http://localapps.com/RegisterAndLogin/"
	);

	public static function GetData(string $data) : string{
		return self::$MySQLData[$data];
	}
}
?>