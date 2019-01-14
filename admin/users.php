<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Users.php');
?>
<!-- select data -->
<?php 
	$usr = new Users();
	$userData = $usr->getUserData();
?>
<!-- remove data -->
<?php 
//user enable 
	if (isset($_GET['dis'])) {
		$disid = $_GET['dis'];
		$usrDis = $usr->disableUser($disid);
	}

//user disable
	if (isset($_GET['ena'])) {
		$enaid = $_GET['ena'];
		$usrEna = $usr->enableUser($enaid);
	}

//user disable
	if (isset($_GET['delid'])) {
		$delid = $_GET['delid'];
		$delUser = $usr->deleteUser($delid);
	}

	
?>
<div class="main">
	<h1>Admin Panel - Manage User</h1>
	<?php
	//disable message 
		if (isset($usrDis)) {
			echo $usrDis;
		}
	//enable message
	if (isset($usrEna)) {
			echo $usrEna;
		}
	//delete message
	if (isset($delUser)) {
			echo $delUser;
		}	
	 ?>
	<div class="manageuser">
		<table class="tblone">
			<tr>
			<th>No</th>
			<th>Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>Action</th>
			</tr>

<?php 
	if (isset($userData)) {
		$i=0;
		while ($result = $userData->fetch_assoc()) {
			$i++; ?>			
			<tr>
				<td><?php echo $i; ?></td>
				<!-- disable color setup -->
				<?php 
					if ($result['status'] == '1') { ?>
						<td style='color:red;'><?php echo $result['name']; ?></td>
					<?php }else{  ?>
				<td><?php echo $result['name']; ?></td>
			   <?php } ?>

				<td><?php echo $result['username']; ?></td>
				<td><?php echo $result['email'] ?></td>
				<td>
					<?php 
						if ($result['status'] == '0') { ?>
							<a onclick = "return confirm('Are you really sure to Disable?'); " href="?dis=<?php echo $result['userId']; ?>">Disable </a>
					<?php 	}else{  ?>

					<a onclick = "return confirm('Are you really sure to Enable?'); " href="?ena=<?php echo $result['userId']; ?>">Enable</a>	
					
					<?php } ?>
					  || <a onclick = "return confirm('Are you really sure to Delete?'); " href="?delid=<?php echo $result['userId']; ?>">Remove</a>
					
				</td>
			</tr>
<?php } } ?>			
		</table>
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>