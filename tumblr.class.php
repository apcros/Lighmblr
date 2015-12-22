<?php

/**
* 
*/
class Tumblr
{
	private $api_key;
	private $url;
		
	function __construct($url,$api_key)
	{
		$this->setTumblr($url);
		$this->api_key = $api_key;

	}

	function setTumblr($tumblr) {
		$cleaned_name = str_replace("http://", "", $tumblr);
		$this->url = $cleaned_name;
	}
	function load($page = 0,$postsPerPage = 4) {

		$tumblr_json = json_decode(file_get_contents("https://api.tumblr.com/v2/blog/".$this->url."/posts?api_key=".$this->api_key."&limit=".$postsPerPage."&offset=".($page*$postsPerPage)));

		$clean_output = array();

			foreach ($tumblr_json->response->posts as $key => $current_post) {

				$clean_output[]["title"] = $current_post->title;
				preg_match("/src=\"(.*\.gif)\"/", $current_post->body, $regex_array);
				if(isset($regex_array[1])) {
					$clean_output[count($clean_output)-1]["gif"] = $regex_array[1];
				} else {
					$clean_output[count($clean_output)-1]["gif"] = "blank.gif";
				}
				

			}

		return $clean_output;
	}

}
?>