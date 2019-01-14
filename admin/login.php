<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/loginheader.php');
	include_once ($filepath.'/../classes/Admin.php');
?>

<div class="main">
<h1>Admin Login</h1>
<div class="adminlogin">
<?php 
	$ad = new Admin();

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login']) {
		
		$adminLgn = $ad->adminLogin($_POST);
	}
?>	
	<form action="" method="post">
		<table>
			<tr>
				<td colspan="2"><?php if (isset($adminLgn)) {
					echo  $adminLgn;
				} ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input type="text" name="adminUser"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="adminPass"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="login" value="Login"/></td>
			</tr>
		</table>
	</from>
</div>
</div>
<?php include 'inc/footer.php'; ?>