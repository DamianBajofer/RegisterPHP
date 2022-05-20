<?php
if(!class_exists("Register")){
	include("$_SERVER[DOCUMENT_ROOT]/RegisterAndLogin/register.class.php");
}
extract($_GET);
$register = new Register();
echo json_encode($register -> init($username, $password));
$register -> close();
?>