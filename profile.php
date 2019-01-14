<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();
?>
<style>
	.profile{width: 500px; margin: 0 auto; padding: 30px 50px 50px; background: #f4f4f4;border:1px solid #ddd;}
	
	.profile table tr td input[type="email"] {
    padding: 5px;
    width: 238px;
    border: 1px solid #ddd;

}
    table.tbl {
    margin-left: 67px;
}
.profile table tr td input[type="submit"] {
    padding: 5px;
    border: 1px;
    margin-right: 86px;
    margin-top: 10px;
}
</style>

<div class="main">
<h1>Your Profile</h1>
	<div class="profile"> 
<?php
//update user profile
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['update']) {
	$updateUserPro = $usr->updateUserPro($_POST);
}

//get user profile data
	$userProfile = $usr->userProfile();
	if ($userProfile) {
		while ($result = $userProfile->fetch_assoc()) {
			
		
?>		
	<form action="" method="post">
		<table class="tbl">
			<?php 
				if (isset($updateUserPro)) {
					echo $updateUserPro;
				}
			 ?>
			<tr>
			   <td>Name</td>
			   <td>:</td>
			   <td><input name="name" value="<?php echo $result['name']; ?>"  type="text"></td>
			 </tr>
			 <tr>
			   <td>Username </td>
			   <td>:</td>
			   <td><input name="username" value="<?php echo $result['username']; ?>" type="text"></td>
			 </tr>
			 <tr>
			   <td>Email </td>
			   <td>:</td>
			   <td><input name="email" value="<?php echo $result['email']; ?>" type="email"></td>
			 </tr>
			  <tr>
			 	
			   <td colspan="3" align="center">
			   	<input type="submit" name="update" value="Update">
			   </td>
			 </tr>
       </table>
	   </form>
<?php } } ?>	   
	</div>  
	  
	</div>


<?php include 'inc/footer.php'; ?>