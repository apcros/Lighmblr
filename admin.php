<?php

include "front.class.php";
include "giflib.class.php";
include_once "settings.class.php";
$f = new Front();
$g = new Giflib();
$s = new Settings("gisicle.json");

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
	if(isset($_POST["gifsicle_settings"])) {
		$PostAr = $_POST;
		unset($PostAr["gifsicle_settings"]);
		foreach ($PostAr as $key => $value) {
			$s->set($key,$value);
		}
	}
	if(isset($_GET["clear"])) {
		$g->clearCache();
	}

	$f->dispAdminPage($g->nbAndSize(),$s->getAll());

} else {

	$f->dispLoginForm();

}


$f->dispFoot();

?>