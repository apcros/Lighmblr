<?php

class Settings
{
	private $jsonFile;
	private $jsonName;

	function __construct($jsonName)
	{
		$this->jsonName = $jsonName;
		$this->jsonFile = json_decode(file_get_contents($jsonName));
	}

	function get($key) {

		if(isset($this->jsonFile->$key)) {
			return $this->jsonFile->$key;
		} else {
			return false;
		}
	}
	function getAll() {
		return $this->jsonFile;
	}
	function set($key,$val) {

		if(isset($this->jsonFile->$key)) {
			$this->jsonFile->$key = $val;
			file_put_contents($this->jsonName, json_encode($this->jsonFile));
		}
	}
}
?>