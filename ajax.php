<?php
include "giflib.class.php";

if(isset($_POST["gifname"])) {
	$gif_clean =  htmlspecialchars($_POST["gifname"]);
	$gif_hackname = "http://dummy/".$gif_clean.".gif"; //Otherwise giflib will do shit
	$g = new Giflib();
	if($g->isCompressionRunning($gif_hackname)){
		echo "NOT READY";
	}else {
		echo "gifs/compressed_".$gif_clean.".gif";
	}

}

?>