<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/Session.php';
	Session::init();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login & Registration</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</head>
<?php 
if (isset($_GET['action']) && ($_GET['action'] == 'logout') ) {

	Session::logout();
}

?>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-sm bg-light">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">Login and Registration</a>
				</div>
				<ul class="navbar-nav float-right">
					

					<?php

						$id = Session::get('id');
						$userlogin = Session::get('login');
						if ($userlogin == true) {
					?><li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a></li>
					<li class="nav-item"><a class="nav-link" href="?action=logout">Logout</a></li>
				<?php } else {?>
					<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
					<li class="nav-item"><a class="nav-link" href="register.php">Registration</a></li>
				<?php }?>
				</ul>
			</div>
		</nav>
