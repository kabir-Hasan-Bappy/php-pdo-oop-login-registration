<?php include_once 'inc/header.php';?>
<?php include_once 'lib/User.php';
Session::checklogin();
?>
<?php
	
	$user = new User();
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])) {

		$userRegi = $user->userregistration($_POST);
	}
?>

		<div class="card mt-2">
			<div class="card-header">
				<h2>User Login</h2>
			</div>
			<div class="card-body">
				<div style="max-width: 600px; margin: 0 auto">
					<?php
						if (isset($userRegi)) {
							echo $userRegi;
						}
					?>
				<form action="" method="POST">
					<div class="form-group">
						<label for="name">Full Name</label>
						<input type="name" name="name" class="form-control">
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="username" name="username" class="form-control">
					</div>
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<button type="submit" name="register" class="btn btn-info">Register</button>
				</form>
				</div>
			</div>
		</div>
	
<?php include 'inc/footer.php';?>		
		