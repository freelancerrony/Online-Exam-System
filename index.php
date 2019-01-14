<?php include 'inc/header.php'; ?>
<?php 
	Session::checkLogin();
?>

<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table class="tbl">
			
		 <span class="empty" style="display: none; color: red;">Field must not be Empty!</span>
	    <span class="error" style="display: none; color: red;">Email or Password not Matched!</span>
	     <span class="disable" style="display: none; color: red;">User Id Disabled!</span>

			 <tr>
			   <td>Email</td>
			   <td><input name="email" id="email" type="text"></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" id="password" type="password"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" id="loginsubmit" value="Login">
			   </td>
			 </tr>
       </table>
	   </form>
	   <p>New User ? <a href="register.php">Signup</a> Free</p>
	  
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>