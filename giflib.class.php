<?php

/**
* 
*/
include "settings.class.php";
class GifLib
{
	private $settings;

	function __construct()
	{
		$this->settings = new Settings("gisicle.json");
	}

	function isGifCached($giflink) {
	
		return file_exists("gifs/compressed_".$this->gifOrgName($giflink));
	}

	function compressGif($giflink) {
		$gifname = $this->gifOrgName($giflink);
		if($this->settings->get("colors")) {
			$colors = $this->settings->get("colors");
		} else {
			$colors = 64;
		}

		if($this->settings->get("compression_rate")) {
			$compression_rate = $this->settings->get("compression_rate");
		} else {
			$compression_rate = 350;
		}

		$output = shell_exec("screen -dmS compression-".substr($gifname, 0, -4)." scripts/launchCompression.sh ".$colors." ".$compression_rate." ".$gifname." ".$giflink." 2>&1");
	}

	function isCompressionRunning($giflink) {
		$gifname = $this->gifOrgName($giflink);
		$output = shell_exec("screen -ls | grep compression-".substr($gifname, 0, -4));
		if($output != "") {
			return true;
		} else {
			return false;
		}
	}

	function gifOrgName($giflink) {
		$gif_url_exploded = explode("/", $giflink);
		
		return $gif_url_exploded[count($gif_url_exploded)-1];
	}

	function nbAndSize() {
		$all_files = scandir("gifs/");
		$nbAndSize = array();
		$nbAndSize["nb"] = 0;
		$nbAndSize["size"] = 0;
 
	 	foreach ($all_files as $key => $file) {

	 		if(substr($file, -3) == "gif" && $file != "compressed_blank.gif") {
	 			$nbAndSize["nb"]++;
	 			$nbAndSize["size"] += filesize("gifs/".$file);
	 		}
	 	}
	 		return $nbAndSize;

	}

	function clearCache() {
		$all_files = scandir("gifs/");
		foreach ($all_files as $key => $file) {

	 		if(substr($file, -3) == "gif" && $file != "compressed_blank.gif") {
	 			unlink("gifs/".$file);
	 		}
	 	}
	}

}

?>