<?php
declare(strict_types = 1);
class Login{
	private $MySQL;
	public function __construct(){
		if(!class_exists("DBC")){
			include("$_SERVER[DOCUMENT_ROOT]/RegisterAndLogin/connect.class.php");
		}
		$this -> MySQL = DBC::Connect();
		$this -> MySQL -> select_db(Config::GetData("Database"));
	}

	// Comienzo del login
	public function init(string $user, string $pass) : array {
		$sha1 = $this -> SHA1($user, $pass);
		$sql = "SELECT `id`, `username` FROM `accounts` WHERE `username` = ? && `password` = ?";
		$prepare = $this -> MySQL -> prepare($sql);
		$prepare -> bind_param("ss", $user, $sha1);
		$prepare -> execute();
		$prepare -> bind_result($id, $username);
		$prepare -> fetch();
		if($id){
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $username;
			return array("status" => true, "UserData" => array("id" => $id, "username" => $username));
		}
		return array("status" => false);
	}

	// Codificar contraseña en SHA1
	public function SHA1(string $user, string $pass) : string{
		return sha1(strtoupper("$user:$pass"));
	}

	// Cerrar la conexion MySQL
	public function close() : void{
		$this -> MySQL -> close();
	}

}
?>