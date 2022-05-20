<?php
session_start();
if(isset($_SESSION["username"])){
	return false;
}
if(!class_exists("Config")){
	include("./config.class.php");
}
if(!class_exists("Register")){
	include("./register.class.php");
}
extract($_POST);
if(!isset($username) && !isset($password)){
	echo json_encode(array("status" => false, "code" => Config::$ErrorsCode[4]));
	return false;
}
$register = new Register();
echo json_encode($register -> init($username, $password));
$register -> close();
?>