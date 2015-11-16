<?php

class Front
{
	
	function __construct()
	{
	}


	function dispPosts($posts) {

		foreach ($posts as $key => $post) {
			echo "	<div class='row'>
						<div class='twelve columns'>
							<h5>".$post["title"]."</h5>
							<img src='".$post["gif"]."'/>
						</div>
					</div>
					<hr>";
		}

	}

	function dispTumblrHead($name) {
	echo '<a style="text-decoration: none; color: black;"href="index.php"><h3>'.$name.'</h3></a>
		<a class="button button-primary" href="index.php?exit=1">New tumblr ?</a>
		<hr>';
	}
	function dispTumblrForm() {
		echo "	<h3>Choose your tumblr !</h3>";
		echo "	<form method='POST'>
					<input type='text' name='tumblr'/>
					<button class='button button-primary'>OK !</button>
				</form>";
	}

	function dispHead() {
		echo '
			<html>
			<head>
				<meta name="viewport" content="width=device-width">
			    <meta name="mobile-web-app-capable" content="yes">
				<link rel="stylesheet" type="text/css" href="css/skeleton.css">
				<link rel="stylesheet" type="text/css" href="css/style.css">
				<title>Lighmblr !</title>
			</head>
			<body>
				<div class="container">';
	}

	function dispFoot() {
		echo '		</div>
				</body>
			</html>';
	}



	function dispBtnPagination($p = NULL) {
		if ($p == NULL || $p < 1) {
			echo '<a class="button button-primary" href="index.php?p=1">Next</a>';
		} else {
			echo '
			<a class="button button-primary" href="index.php?p='.($p-1).'">Previous</a>
			<a class="button button-primary" href="index.php?p='.($p+1).'">Next</a>';
		}
	}
}

?>