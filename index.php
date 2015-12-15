<html>
<head>
	<meta name="viewport" content="width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" type="text/css" href="css/skeleton.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Light Lesjoiesducode.fr</title>
</head>

<body>
	<div class="container">
		<a style="text-decoration: none; color: black;"href="index.php"><h3>Les joies du code light</h3></a>
		<hr>
<?php


if (isset($_GET["p"])) {
	$p = htmlspecialchars($_GET["p"]);
	$gifAndTitle = loadGifsAndTitle("http://lesjoiesducode.fr/","page/".$p);
} else {
	$p = NULL;
	$gifAndTitle = loadGifsAndTitle("http://lesjoiesducode.fr/");
}
echo "<div class='info'>".showStats()."</div><hr>";

foreach ($gifAndTitle as $key => $post) {
	echo "<div class='row'>";
		echo "<div class='twelve columns'>";
			echo "<h5>".$post["title"]."</h5>";
			echo "<img src='".$post["gif"]."'/>";
		echo "</div>";
	echo "</div>";
	echo "<hr>";
}

function loadGifsAndTitle($url, $page = "") {
	require "simple_html_dom.php";
	$fullPage = file_get_contents($url.$page);
	$html = new simple_html_dom();
	$html->load($fullPage);

	$postsRaw = $html->find("div.blog-post");

	$arrayClean = array();

	$started = time();
	$logs = array();

	foreach ($postsRaw as $key => $post) {
		$arrayClean[]["title"] = $post->children(0)->children(0)->plaintext;
		$uncompressed_gif_url = $post->children(2)->children(1)->children(0)->src;
		
		//Getting the gif name from the url
		$gif_url_exploded = explode("/", $uncompressed_gif_url);
		$gif_original_name = $gif_url_exploded[count($gif_url_exploded)-1];


		if(!file_exists("gifs/compressed_".$gif_original_name)){
			file_put_contents("gifs/".$gif_original_name, file_get_contents($uncompressed_gif_url));
			$logs[] = compressGif($gif_original_name);
			unlink("gifs/".$gif_original_name);
		}

		$arrayClean[count($arrayClean)-1]["gif"] = "gifs/compressed_".$gif_original_name;
	}
	$finished = time();
	processLogs($logs,$started,$finished);
	return $arrayClean;
}

function compressGif($gifname) {
	return shell_exec("gifs/gifsicle-debian6 -O3 --colors 64 --lossy=350 gifs/".$gifname." -o gifs/compressed_".$gifname." 2>&1");
}

function processLogs($logs, $started, $finished) {
	if(count($logs) > 0) {
		
		echo "<div class='debug'>".count($logs)." gifs compressed in <b>".($finished-$started)." seconds</b><br>";
		foreach ($logs as $key => $value) {
			if ($value == NULL) {
				$value = "OK !";
			}
			echo "[<b>".($key+1)." - ".$value."</b>]<br>";
		}
		echo "</div><hr>";

	}


}

function showStats() {
	$all_files = scandir("gifs/");
	$number_gifs = 0;
	$total_size = 0;

	foreach ($all_files as $key => $file) {
		if(substr($file, -3) == "gif") {
			$number_gifs++;
			$total_size += filesize("gifs/".$file);
		}
	}
	return $number_gifs." total gifs in cache. (".round($total_size/1024/1024)." MB)";
}

function showButton($p = NULL) {
	if ($p == NULL || $p <= 1) {
		echo '<a class="button button-primary" href="index.php?p=2">Next</a>';
	} else {
		echo '
		<a class="button button-primary" href="index.php?p='.($p-1).'">Previous</a>
		<a class="button button-primary" href="index.php?p='.($p+1).'">Next</a>';
	}
}

showButton($p);
?>
		</div>
	</body>
</html>