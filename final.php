<?php 
include 'inc/header.php';
 ?>

<?php 
	Session::checkSession();
?>
<style>
	.starttest{border: 1px solid #f4f4f4;margin: 0 auto;padding: 20px; width: 590px;}
.starttest h2 {
    border-bottom: 1px solid #ddd;
    font-size: 20px;
    margin-bottom: 12px;
    text-align: center;
    padding: 7px 0px;
    font-family: verdana;
}
.starttest ul{margin: 0px; padding: 0px; list-style:none;}
.starttest ul li{margin-top: 5px;}
.starttest a{
  background: #f4f4f4 none repeat scroll 0 0;
  bottom: 1px solid #ddd;
  color: #444;
  display: block;
  margin-top: 10px;
  padding: 6px 10px;
  text-align:center;
  text-decoration: none;
}
</style>
<div class="main">
<h1>You are done !</h1>
	<div class="starttest">
		<p>Congrats ! You have just completed the test.</p>
		<p>Final Score:
		<?php if (isset($_SESSION['score'])) {
			echo $_SESSION['score'];
			unset($_SESSION['score']);
		} ?> 
		</p>
		<a href="viewans.php">View Answer</a>
		<a href="starttest.php">Start Again</a>
	</div>
	
</div>
<?php include 'inc/footer.php'; ?>