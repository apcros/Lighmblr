<?php

class Settings
{
	private $jsonFile;

	function __construct($jsonFile)
	{
		$this->jsonFile = json_decode(file_get_contents($jsonFile));
	}

	function get($key) {

		if(isset($this->jsonFile->$key)) {
			return $this->jsonFile->$key;
		} else {
			return false;
		}
	}

	function set($key,$val) {
		//TODO
	}
}
?>