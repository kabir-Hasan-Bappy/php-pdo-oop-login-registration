<?php
include 'lib/User.php';
include_once 'inc/header.php';
Session::checkSession();
?>

<?php
if (isset($_GET['id'])) {
	$userid = (int)$_GET['id'];
	$sessId = Session::get('id');
	if ($sessId != $userid) {
		header('Location: index.php');
	}
	
}
	$user = new User();

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatepass'])) {

		$updatepass = $user->updatepass($userid, $_POST);
	}

?>
<div class="card mt-2">
	<div class="card-header">
		<h2>Change Password <span class="float-right"><a class="btn btn-secondary" href="profile.php?id=<?php echo $userid; ?>">Back</a></span></h2>
	</div>
	<div class="card-body">
		<div style="max-width: 600px; margin: 0 auto">
			<?php 
			if (isset($updatepass)) {
				
				echo $updatepass;
			}
			?>
			
			<form action="" method="POST">
				<div class="form-group">
					<label for="oldPass">Old Password</label>
					<input type="password" name="oldpass" class="form-control">
				</div>
				<div class="form-group">
					<label for="newpass">New Password</label>
					<input type="password" name="newpass" class="form-control">
				</div>
				<button type="submit" name="updatepass" class="btn btn-success">Update</button>
		</div>
	</div>
</div>

<?php include 'inc/footer.php';?>		
