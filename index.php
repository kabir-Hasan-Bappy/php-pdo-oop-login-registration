<?php include 'inc/header.php';

 include 'lib/User.php';
Session::checkSession();

?>
<?php 
$loginmsg = Session::get('loginmsg');
if (isset($loginmsg)) {
	echo $loginmsg;

}
Session::set('loginmsg', NULL);
?>


<div class="card mt-2">
	<div class="card-header">
		<h2>User List <span class="float-right">Welcome!<strong>
			<?php
			$salutation = Session::get('name');
			if (isset($salutation)) {
				echo $salutation;
			}?></strong></span></h2>
		</div>
		<div class="card-body">
			<table class="table table-striped ">
				<thead>
					
					<tr>
						<th width="20%">Serial No</th>
						<th width="20%">Name</th>
						<th width="20%">User Name</th>
						<th width="20%">Email Address</th>
						<th width="20%">Action</th>
				</thead>
				<tbody>
					<?php 
						$user= new User();
						$userData = $user->getUserData();
						if ($userData) {
							$i=0;
							foreach ($userData as $sdata) {
							$i++;
					?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $sdata['name'];?></td>
						<td><?php echo $sdata['username'];?></td>
						<td><?php echo $sdata['email'];?></td>
						<td>
							<a class="btn btn-primary" href="profile.php?id=<?php echo $sdata['id']; ?>">View</a>
							<a class="btn btn-danger" href="delete.php?id=<?php echo $sdata['id']; ?>" onclick="return confirm('Are you sure want to Delete?')">Delete</a>
						</td>

					</tr>
				<?php } }else{ ?>
					<tr><td class="alert alert-danger font-weight-bold" colspan="5">No User Found.......</td></tr>
				<?php }?>
				</tbody>
			</table>
		</div>
	</div>
	

	<?php include 'inc/footer.php'?>