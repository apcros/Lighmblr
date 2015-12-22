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
		<a class="button button-primary" href="admin.php">Admin</a>
		<hr>';
	}
	function dispTumblrForm() {
		echo "	<h3>Choose your tumblr !</h3>";
		echo "	<form method='POST'>
					<input type='text' name='tumblr'/>
					<button class='button button-primary'>OK !</button>
					<a class='button button-primary' href='admin.php'>Admin</a>
				</form>";
	}

	function dispLoginForm() {
		echo "	<h3>Login</h3>";
		echo "	<form method='POST'>
					<p>Username : <input type='text' name='username'/></p>
					<p>Password : <input type='password' name='password' /></p>
					<button class='button button-primary'>Login</button>
				</form>";
	}

	function dispAdminPage($nbAndSize) {
		echo '<table class="u-full-width">
				  <thead>
				    <tr>
				      <th>Number of cached gifs</th>
				      <th>Total size (Mb)</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td>'.$nbAndSize["nb"].'</td>
				      <td>'.round($nbAndSize["size"]/1024/1024).'</td>
				    </tr>
				    <tr>
				    	<td><a class="button button-danger" href="admin.php?clear=1">Clear cache</a></td>
				    	<td></td>
				    </tr>
				  </tbody>
				</table>
				<a class="button button-primary" href="admin.php?exit=1">Logout</a>';
	}

	function dispLoginError() {

		echo "<b style='color: red;'>Wrong username and/or password </b>";
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
				<div class="container"><a href="index.php"><h1 class="main-top">Lighmblr</h1></a>';
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