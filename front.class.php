<?php

class Front
{
	
	function __construct()
	{
	}


	function dispPosts($posts) {


		foreach ($posts as $key => $post) {

			echo '	<div class="row center-align">
				        <div class="col s12 offset-m3 m6">
				          <div class="card">
				            <div class="card-image">
				              <img src="'.$post["gif"].'"/>
				            </div>
				            <div class="card-content">
				            <b>'.$post["title"].'</b>
				            </div>
				          </div>
				        </div>
				      </div>';
		}

	}

	function dispTumblrHead($name) {
	echo '<h5>'.$name.'</h5>
		<a class="waves-effect waves-light btn blue darken-3" href="index.php?exit=1"><i class="material-icons left">swap_vertical_circle</i>New tumblr ?</a>
		<a class="waves-effect waves-light btn deep-purple darken-3" href="admin.php"><i class="material-icons left">settings</i>Admin</a>
		<br>';
	}
	function dispTumblrForm() {
		echo "	<h3>Choose your tumblr !</h3>";
		echo "	<form method='POST'>
					        <div class='input-field col s6'>
					          <i class='material-icons prefix'>language</i>
					          <input id='icon_prefix' name='tumblr' type='text' class='validate'>
					          <label for='icon_prefix'>Tumblr Domain</label>
					        </div>
					<button class='waves-effect waves-light btn blue darken-3'><i class='material-icons left'>cached</i>Save & Load</button>
					<a class='waves-effect waves-light btn deep-purple darken-3' href='admin.php'><i class='material-icons left'>settings</i>Admin</a>
				</form>";
	}

	function dispLoginForm() {
		echo "	<form method='POST'>
					<p><b>Username : </b><input type='text' name='username'/></p>
					<p><b>Password : </b><input type='password' name='password' /></p>
					<button class='waves-effect waves-light btn blue darken-3'><i class='material-icons left'>lock</i>Login</button>
				</form>";
	}

	function dispAdminPage($nbAndSize) {
		echo '
 <div class="row">
      <div class="col s12">
        <div class="card-panel">
			<table class="u-full-width">
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
				    	<td><a class="waves-effect waves-light btn red darken-3" href="admin.php?clear=1"><i class="material-icons left">clear</i>Clear cache</a></td>
				    	<td></td>
				    </tr>
				  </tbody>
				</table>
        </div>
      </div>
    </div>
				<a class="waves-effect waves-light btn orange darken-3" href="admin.php?exit=1"><i class="material-icons left">exit_to_app</i>Logout</a>';
	}

	function dispLoginError() {
		echo ' <div class="row">
			      <div class="col s12">
			        <div class="card-panel red darken-3">
			        	<span class="white-text">Wrong username and/or password </span>
			        </div>
			       </div>
			    </div>';
	}
	function dispHead() {
		echo '
			  <!DOCTYPE html>
			  <html>
			    <head>
			      <!--Import Google Icon Font-->
			      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			      <!--Import materialize.css-->
			      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

			      <!--Let browser know website is optimized for mobile-->
			      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			    </head>

			    <body>
			      <!--Import jQuery before materialize.js-->
			      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
			      <script type="text/javascript" src="js/materialize.min.js"></script>
				<div class="container center-align"><a href="index.php"><h2 style="text-decoration: none; color: black;" class="main-top">Lighmblr</h2></a>';
	}

	function dispFoot() {
		echo '		</div>
				</body>
			</html>';
	}



	function dispBtnPagination($p = NULL) {
		if ($p == NULL || $p < 1) {
			echo '
			  <ul class="pagination">
			    <li class="disabled"><a href="#"><i class="material-icons">chevron_left</i></a></li>
			    <li class="waves-effect"><a href="index.php?p=1"><i class="material-icons">chevron_right</i></a></li>
			  </ul>
			';
		} else {
			echo '
			  <ul class="pagination">
			    <li class="waves-effect"><a href="index.php?p='.($p-1).'"><i class="material-icons">chevron_left</i></a></li>
			    <li class="waves-effect"><a href="index.php?p='.($p+1).'"><i class="material-icons">chevron_right</i></a></li>
			  </ul>
			';
		}
	}
}
?>