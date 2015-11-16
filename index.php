<html>
<head>
	<meta name="viewport" content="width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" t
ype="text/css" href="css/skeleton.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Lighmblr !</title>
</head>

<body>
	<div class="container">
		
<?php
	include "tumblr.class.php";
	include "giflib.class.php";
	session_start();
	if(isset($_POST["tumblr"])) {$_SESSION["tumblr"] = htmlspecialchars($_POST["tumblr"]);}
	if(isset($_GET["exit"])) {unset($_SESSION["tumblr"]); header("location: index.php");}
	if(isset($_SESSION["tumblr"])) {
		echo '<a style="text-decoration: none; color: black;"href="index.php"><h3>'.$_SESSION["tumblr"].'</h3></a>
		<a class="button button-primary" href="index.php?exit=1">New tumblr ?</a>
		<hr>';
		if (isset($_GET["p"])) {
			$p = htmlspecialchars($_GET["p"]);
			$gifAndTitle = processPage($p);
		} else {
			$gifAndTitle = processPage();
		}


		foreach ($gifAndTitle as $key => $post) {
			echo "<div class='row'>";
				echo "<div class='twelve columns'>";
					echo "<h5>".$post["title"]."</h5>";
					echo "<img src='".$post["gif"]."'/>";
				echo "</div>";
			echo "</div>";
			echo "<hr>";
		}

		if(isset($p)) {
			showButton($p);
		} else {
			showButton();
		}

	} else {
		echo "	<h3>Choose your tumblr !</h3>";
		echo "	<form method='POST'>
					<input type='text' name='tumblr'/>
					<button class='button button-primary'>OK !</button>
				</form>";
	}


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







function showButton($p = NULL) {
	if ($p == NULL || $p < 1) {
		echo '<a class="button button-primary" href="index.php?p=1">Next</a>';
	} else {
		echo '
		<a class="button button-primary" href="index.php?p='.($p-1).'">Previous</a>
		<a class="button button-primary" href="index.php?p='.($p+1).'">Next</a>';
	}
}

?>
		</div>
	</body>
</html>