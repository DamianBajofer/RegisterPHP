<?php
session_start();
if(!class_exists("Config")){
	include("./config.class.php");
}
if(isset($_SESSION["username"])){
	session_destroy();
}
header("Location: ".Config::$SiteData["Domain"]);
?>