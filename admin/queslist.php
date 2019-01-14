<?php include 'inc/header.php'; ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Exam.php');
?>
<?php 
	$ques = new Exam();
	$getQues = $ques->getAllQues();

	if (isset($_GET['delid'])) {
		$delid = (int)$_GET['delid'];
		$deleteQues = $ques->deleteQues($delid);
	}
?>
<div class="main">
<h1>Online Exam System - Question List</h1>
<?php 
	//show message for delete question
	if (isset($deleteQues)) {
		echo $deleteQues;
	}
?>
	
<table class="tblone">
	<tr>
		<th>No.</th>
		<th>Question Name</th>
		<th>Action</th>
	</tr>
<?php 
//get question 
if (isset($getQues)) {
	$i=0;
	while ($result = $getQues->fetch_assoc()) {
		$i++; ?>	
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $result['ques'] ?></td>
		<td>

			<a onclick = "return confirm('Are you sure to Delete Question?');" href="?delid=<?php echo $result['quesNo']; ?>">Delete ||</a>
			<a href="?updid=<?php echo $result['quesNo']; ?>">Update</a>
		</td>
	</tr>
<?php }  } ?>	
</table>

	
</div>
<?php include 'inc/footer.php'; ?>