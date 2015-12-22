<?php
	include "tumblr.class.php";
	include "giflib.class.php";
	include "front.class.php";

	$f = new Front();
	$f->dispHead();

	session_start();
	
	if(isset($_POST["tumblr"])) {
		$_SESSION["tumblr"] = htmlspecialchars($_POST["tumblr"]);
	}

	if(isset($_GET["exit"])) {
		unset($_SESSION["tumblr"]); 
		header("location: index.php");
	}

	if(isset($_SESSION["tumblr"])) {

		$f->dispTumblrHead($_SESSION["tumblr"]);

		if (isset($_GET["p"])) {
			$p = htmlspecialchars($_GET["p"]);
			$gifAndTitle = processPage($p);
		} else {
			$gifAndTitle = processPage();
		}

		$f->dispPosts($gifAndTitle);

		if(isset($p)) {
			$f->dispBtnPagination($p);
		} else {
			$f->dispBtnPagination();
		}

	} else {
		$f->dispTumblrForm();
	}

	$f->dispFoot();

function processPage($p = 0) {
	$tumblr = new Tumblr($_SESSION["tumblr"],"fuiKNFp9vQFvjLNvx4sUwti4Yb5yGutBN4Xh10LXZhhRKjWlV4");
	$giflib = new GifLib();

	$clean_array = $tumblr->load($p);
	$clean_array_compressed = array();

	foreach ($clean_array as $key => $post) {
		if(!$giflib->isGifCached($post["gif"])) {
			$giflib->compressGif($post["gif"]);
		}
		$clean_array_compressed[]["title"] = $post["title"];
		$clean_array_compressed[count($clean_array_compressed)-1]["gif"] = "gifs/compressed_".$giflib->gifOrgName($post["gif"]);
	}

	return $clean_array_compressed;
}

?>