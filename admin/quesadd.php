<?php include 'inc/header.php'; ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Exam.php');
?>
<div class="main">
	<style>
.body {
    width: 474px;
    padding: 20px;
    border: 2px solid #ddd;
    margin: 0 auto;
}
.body table tr td input[type="number"], input[type="text"] {
    padding: 5px;
    border: 2px solid #ddd;
    width: 261px;
    margin: 5px;
}
.body table tr td input[type="submit"]{padding: 6px; background: #ddd; text-align: center; border-radius: 1px;}
	</style>
<?php 
	$ques = new Exam();
	//add question 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$addQues = $ques->addQuestion($_POST);
	}

	//count question number
	$total = $ques->getQuesNumber();
	$next = $total+1;
?>
<h1>Online Exam System - Add Question</h1>
	<div class="body">
		<form action="" method="post">
		<table>
			<tr>
				<td colspan="3">
					<?php if (isset($addQues)) {
						echo $addQues;
					} ?>
				</td>
			</tr>
			<tr>
				<td>Question No.</td>
				<td>:</td>
				<td>
					<!--get question number-->
					<input type="text" 
					value="<?php if (isset($next)) { echo $next;} ?>" name="quesNo"  >
				</td>
				<td></td>
			</tr>
			<tr>
				<td>Question</td>
				<td>:</td>
				<td><input type="text" name="ques" placeholder="Enter Your Question"></td>
			</tr>
			<tr>
				<td>Choice One</td>
				<td>:</td>
				<td><input type="text" name="ans1" placeholder="Enter Choice One"></td>
			</tr>
			<tr>
				<td>Choice Two</td>
				<td>:</td>
				<td><input type="text" name="ans2" placeholder="Enter Choice Two"></td>
			</tr>
			<tr>
				<td>Choice Three</td>
				<td>:</td>
				<td><input type="text" name="ans3" placeholder="Enter Choice Three"></td>
			</tr>
			<tr>
				<td>Choice Four</td>
				<td>:</td>
				<td><input type="text" name="ans4" placeholder="Enter Choice Four"></td>
			</tr>
			<tr>
				<td>Correct No.</td>
				<td>:</td>
				<td><input type="number" name="rightans" ></td>
			</tr>
			<tr>
				
				<td colspan="3" align="center">
					<input type="submit" name="add"  value="Add A Question" >
				</td>
			</tr>
		</table>
	</form>
	</div>
	


	
</div>
<?php include 'inc/footer.php'; ?>