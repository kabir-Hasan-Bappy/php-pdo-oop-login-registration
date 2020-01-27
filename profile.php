<?php
include 'lib/User.php';
include_once 'inc/header.php';
Session::checkSession();
?>

<?php
if (isset($_GET['id'])) {
	$userid = (int)$_GET['id'];
	$user = new User();
}

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update'])) {

		$userUpdate = $user->userUpdate($userid, $_POST);
	}

?>
<div class="card mt-2">
	<div class="card-header">
		<h2>Profile <span class="float-right"><a class="btn btn-secondary" href="index.php">Back</a></span></h2>
	</div>
	<div class="card-body">
		<div style="max-width: 600px; margin: 0 auto">
			<?php 
			if (isset($userUpdate)) {
				
				echo $userUpdate;
			}
			?>
			<?php 
				$userdata = $user->getUserById($userid);
				if ($userdata) {
					
					?>
			<form action="" method="POST">
				<div class="form-group">
					<label for="name">Full Name</label>
					<input type="name" name="name" class="form-control" value="<?php echo $userdata->name;?>">
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="username" name="username" class="form-control" value="<?php echo $userdata->username;?>">
				</div>
				<div class="form-group">
					<label for="email">Email Address</label>
					<input type="email" name="email" class="form-control" value="<?php echo $userdata->email;?>">
				</div>

				<?php

				$sessId = Session::get('id');
				if ($sessId == $userid) {

				?>
				<button type="submit" name="update" class="btn btn-success">Update</button>
				<a class="btn btn-info" href="changepass.php?id=<?php echo $userid; ?>">Change Password</a>
			<?php } ?>
			</form>
		<?php } ?>
		</div>
	</div>
</div>

<?php include 'inc/footer.php';?>		
