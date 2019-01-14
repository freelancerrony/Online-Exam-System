<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();
	$totalques = $exm->getQuesNumber(); 
?>
<div class="main">
<style>
	.test a{background: #f4f4f4; border: 1px solid #ddd; color: #444; display: block;margin-top: 10px; padding: 6px 10px;text-align: center;text-decoration: none;}
</style>
<h1>All Questions & Answer: <?php echo $totalques; ?></h1>
	<div class="test">
		
		<table> 
			<?php 
					$getQues = $exm->getQueByOrder();
					if ($getQues) {
						while ($question = $getQues->fetch_assoc()) {
							
						
			 ?>
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question['quesNo']; ?>: <?php echo $question['ques']; ?> </h3>
				</td>
			</tr>
<?php 
	$number = $question['quesNo'];
	$answer = $exm->ansGet($number);
	if ($answer) {
		while ($result = $answer->fetch_assoc()) {
			
		
?>
			<tr>
				<td>
				 <input type="radio"  />
				 <?php 
				 if ($result['rightans'] == '1') {

				 	echo "<span style='color:green; font-weight:bold;'>".$result['ans']."</span>";
				 }else{
				 	echo $result['ans'];
				 }
				 
				   ?>
				</td>
			</tr>
			
<?php } } ?>

<?php } } ?>			
		</table>
		<a class="starttest" href="starttest.php">Start Again</a>
</div>
 </div>
<?php include 'inc/footer.php'; ?>