<?php

include "front.class.php";
include "giflib.class.php";
$f = new Front();
$g = new Giflib();
session_start();

define("USERNAME_BACKEND", "admin");
define("PASSWORD_BACKEND", "admin");

$f->dispHead();

if(isset($_GET["exit"])) {
		unset($_SESSION["login"]); 
}

if(isset($_POST["username"]) && isset($_POST["password"])) {
	if($_POST["username"] == USERNAME_BACKEND && $_POST["password"] == PASSWORD_BACKEND) {
		$_SESSION["login"] = 1;
	} else {
		$f->dispLoginError();
	}
}

if(isset($_SESSION["login"])) {

	if(isset($_GET["clear"])) {
		$g->clearCache();
	}

	$f->dispAdminPage($g->nbAndSize());

} else {

	$f->dispLoginForm();

}


$f->dispFoot();

?>