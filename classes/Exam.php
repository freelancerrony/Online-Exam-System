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
	class Exam{
		
		    private $db;
			private $fm;
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

	public function getAllQues(){
		$query = "SELECT * FROM tbl_ques ORDER BY id ASC";
		$result = $this->db->select($query);
		return $result;
	}

	//delete question 
	public function deleteQues($delid){

		$tables = array("tbl_ques", "tbl_ans");
		foreach ($tables as $table) {
			$query = "DELETE FROM $table WHERE quesNo = '$delid' ";
			$delete = $this->db->delete($query);
		}
		
		
		if ($delete) {
			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>Question Deleted Successfully.</span>";
			return $msg;
		}else{
			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>Question Not Deleted!</span>";
			return $msg;
		}
	}

	//get question number
	public function getQuesNumber(){
		$query = "SELECT * FROM tbl_ques ";
		$result = $this->db->select($query);
		$rowCount = $result->num_rows;
		return $rowCount;
	}

	//get question 
	public function getQuestion(){
		$query = "SELECT * FROM tbl_ques ";
		$question = $this->db->select($query);
		$result = $question->fetch_assoc();
		return $result;
	}

	//get question out of total
	public function getQuesByNumber($number){
		$query = "SELECT * FROM tbl_ques WHERE quesNo = '$number' ";
		$question = $this->db->select($query);
		$result = $question->fetch_assoc();
		return $result;
	}

	//add quesiton 
	public function addQuestion($data){
		$quesNo = mysqli_real_escape_string($this->db->link, $data['quesNo']);
		$ques = mysqli_real_escape_string($this->db->link, $data['ques']);

		$ans = array();
		$ans[1] = $data['ans1'];
		$ans[2] = $data['ans2'];
		$ans[3] = $data['ans3'];
		$ans[4] = $data['ans4'];
		$rightans = $data['rightans'];

        $query = "INSERT INTO tbl_ques(quesNo, ques) VALUES('$quesNo', '$ques') ";

		$insert_row = $this->db->insert($query);
		if ($insert_row) {
			foreach ($ans as $key => $answer) {
				if ($answer != '') {
					if ($rightans == $key) {
						 $rquery = "INSERT INTO tbl_ans(quesNo, rightans, ans) VALUES('$quesNo', '1', '$answer') ";
					}else{
						 $rquery = "INSERT INTO tbl_ans(quesNo, rightans, ans) VALUES('$quesNo', '0', '$answer') ";
					}

					$insertrow = $this->db->insert($rquery);
					if ($insertrow) {
						continue;
					}else{
						die("Error...");
					}
				}
			}

			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>Question Added Successfully.</span>";
			return $msg;
		}
	}


	public function ansGet($number){
		$query = "SELECT * FROM tbl_ans WHERE quesNo = '$number' ";
		$result = $this->db->select($query);
		return $result;
	}

	public function getQueByOrder(){
		$query = "SELECT * FROM tbl_ques ORDER BY quesNo ASC";
		$result = $this->db->select($query);
		return $result;
	}
	
	

	}
?>