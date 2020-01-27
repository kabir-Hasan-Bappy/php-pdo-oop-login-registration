<?php include 'inc/header.php';?>
<?php include 'lib/User.php';
Session::checklogin();?>
<?php
	
	$user = new User();
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])) {

		$userLogin = $user->userLogin($_POST);
	}
?>
		<div class="card mt-2">
			<div class="card-header">
				<h2>User Login</h2>
			</div>
			<div class="card-body">
				<div style="max-width: 600px; margin: 0 auto">
					<?php
						if (isset($userLogin)) {
							echo $userLogin;
						}
					?>
				<form action="" method="POST">
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control" >
					</div>
					<button type="submit" name="login" class="btn btn-success">Log In</button>
				</form>
				</div>
			</div>
		</div>
	
<?php include 'inc/footer.php';?>		
		