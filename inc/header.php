<?php
    include_once ("lib/Session.php");
    Session::init();
    include_once ("lib/Database.php");
    include_once ("helpers/Format.php");
	
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});


	$db  = new Database();
	$fm  = new Format();
	$usr = new Users();
	$exm = new Exam();
	$pro = new Process();


header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
header("Pragma: no-cache"); 
header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>
<!doctype html>
<html>
<head>
	<title>Online Exam System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
<style>
	.user{float: right;}
</style>	
</head>
<body>

<div class="phpcoding">
	<section class="headeroption"></section>
		<section class="maincontent">
		<div class="menu">
		<ul>
			<?php 
			$lgn = Session::get("login");
				if ($lgn == false) { ?>
					<li><a href="index.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
				<?php }else{ ?>
			
			<li><a href="profile.php">Profile</a></li>
			<li><a href="exam.php">Exam</a></li>
			
<?php 
	//logout system
	if (isset($_GET['action']) && $_GET['action'] == 'logout' ) {
		Session::destroy();
		header("Location: index.php");
	}
?>			
			<li><a href="?action=logout">Logout</a></li>
		
		</ul>
<div class="user">
	<?php 
		$name = Session::get("name");
	 ?>
	<p> Welcome <strong><?php echo $name; ?></strong></p>
</div>
<?php }  ?>			
		</div>


	