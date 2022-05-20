<?php
declare(strict_types = 1);
class Register{
	private $MySQL;
	public function __construct(){
		if(!class_exists("DBC")){
			include("./connect.class.php");
		}
		$this -> MySQL = DBC::Connect();
		$this -> MySQL -> select_db(Config::GetData("Database"));
	}

	// Comienzo del registro
	public function init(string $user, string $pass) : array {
		$sha1 = $this -> SHA1($user, $pass);
		if($this -> UserExists($user)){
			return array("status" => false, "message" => "Nombre de usuario en uso.", "code" => Config::$ErrorsCode[1]);
		}
		$sql = "INSERT INTO `accounts`(`username`,`password`) VALUES(?,?)";
		$prepare = $this -> MySQL -> prepare($sql);
		$prepare -> bind_param("ss", $user, $sha1);
		$prepare -> execute();
		$prepare -> store_result();
		if($prepare -> affected_rows){
			return array("status" => true, "message" => "Registrado con exito!");
		}
		return array("status" => false, "message" => "Error al registrar!", "code" => Config::$ErrorsCode[3]);
	}

	// Codificar contraseña en SHA1
	public function SHA1(string $user, string $pass) : string{
		return sha1(strtoupper("$user:$pass"));
	}

	// Verificar usuario existente
	public function UserExists(string $username) : bool {
		$sql = "SELECT * FROM `accounts` WHERE `username` = ?";
		$prepare = $this -> MySQL -> prepare($sql);
		$prepare -> bind_param("s", $username);
		$prepare -> execute();
		$prepare -> store_result();
		return $prepare -> num_rows ? true : false;
	}

	// Cerrar la conexion MySQL
	public function close() : void{
		$this -> MySQL -> close();
	}

}
?>