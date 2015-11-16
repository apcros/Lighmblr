<?php

/**
* 
*/
class GifLib
{

	function __construct()
	{

	}

	function isGifCached($giflink) {
	
		return file_exists("gifs/compressed_".$this->gifOrgName($giflink));
	}

	function compressGif($giflink) {
		$gifname = $this->gifOrgName($giflink);
		file_put_contents("gifs/".$gifname, file_get_contents($giflink));
		$output = shell_exec("gifs/gifsicle-debian6 -O3 --colors 64 --lossy=350 gifs/".$gifname." -o gifs/compressed_".$gifname." 2>&1");
		unlink("gifs/".$gifname);
	}


	function gifOrgName($giflink) {
		$gif_url_exploded = explode("/", $giflink);
		return $gif_url_exploded[count($gif_url_exploded)-1];
	}
}

?>