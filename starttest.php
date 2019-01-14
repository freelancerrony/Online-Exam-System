<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();
	$getQuestion = $exm->getQuestion();
	$totalques = $exm->getQuesNumber();
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
<h1>Welcome To Online Exam</h1>
	<div class="starttest">
		<h2>Test your Knowledage</h2>
		<p>This is multiple choice quiz to test your knowledge</p>
		<ul>
			<li><strong>Number of Question:</strong> <?php echo $totalques; ?></li>
			<li><strong>Question Type: </strong>Multiple Choice</li>
		</ul>
		<a href="test.php?q=<?php echo $getQuestion['quesNo']; ?>">Start Test</a>
	</div>
	
</div>
<?php include 'inc/footer.php'; ?>