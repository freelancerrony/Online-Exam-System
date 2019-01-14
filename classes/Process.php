<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	/**
	 * Question
	 */
	class Process{
		
		    private $db;
			private $fm;
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function processData($data){
			$selectAns = $this->fm->validation($data['ans1']);
			$selectAns = mysqli_real_escape_string($this->db->link, $selectAns);

			$number = $this->fm->validation($data['number']);
			$number = mysqli_real_escape_string($this->db->link, $number);

			$next = $number+1;

			if (!isset($_SESSION['score'])) {
				$_SESSION['score'] = '0';
			}

			$total = $this->gettotal();
			$right = $this->rightans($number);
			if ($right == $selectAns) {
				$_SESSION['score']++;
			}

			if ($number == $total) {
				header("Location: final.php");
				exit();
			}else{
				header("Location: test.php?q=".$next);
			}
		}

	
	private function gettotal(){
		$query = "SELECT * FROM tbl_ques ";
		$result = $this->db->select($query);
		$rowCount = $result->num_rows;
		return $rowCount;
	}

	private function rightans($number){
		$query = "SELECT * FROM tbl_ans WHERE quesNo = '$number' AND rightans = '1' ";
		$question = $this->db->select($query)->fetch_assoc();
		$result = $question['id'];
		return $result;
	}
	

	}
?>