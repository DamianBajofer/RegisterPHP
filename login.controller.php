<?php
session_start();
if(isset($_SESSION["username"])){
	echo json_encode(array("status" => true, "UserData" => array("id" => $_SESSION["id"], "username" => $_SESSION["username"])));
	return false;
}
if(!class_exists("Login")){
	include("$_SERVER[DOCUMENT_ROOT]/RegisterAndLogin/login.class.php");
}
extract($_GET);
$login = new Login();
echo json_encode($login -> init($username, $password));
$login -> close();
?>