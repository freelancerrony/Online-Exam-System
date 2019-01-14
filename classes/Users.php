<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 
	class Users{
		
		private $db;
		private $fm;
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
	}

//select user data 
	public function getUserData(){
		$query = "SELECT * FROM tbl_user ORDER BY userId DESC";
		$value = $this->db->select($query);
		return $value;
	}
//delete user 
	public function disableUser($disid){
		$query = " UPDATE tbl_user 
				   SET 
				   status = '1'

				  WHERE  userId = '$disid' ";
		$disableUser = $this->db->update($query);
		if ($disableUser) {
			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>User Disabled !</span>";
			return $msg;
		}else{
			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>User Not Disabled !</span>";
			return $msg;
		}
	}

//enable user 
	public function enableUser($enaid){
		$query = " UPDATE tbl_user 
				   SET 
				   status = '0'

				  WHERE  userId = '$enaid' ";
		$enableUser = $this->db->update($query);
		if ($enableUser) {
			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>User Enabled !</span>";
			return $msg;
		}else{
			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>User Not Enabled !</span>";
			return $msg;
		}
	}

	public function deleteUser($delid){
		$query = "DELETE  FROM tbl_user WHERE userId = '$delid' ";

		$deleteUser = $this->db->delete($query);
		if ($deleteUser) {
			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>User Deleted Successfully.</span>";
			return $msg;
		}else{
			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>User Not Deleted Successfully!</span>";
			return $msg;
		}
	}

	//user registration

	public function userRegistration ($name, $username, $password, $email){
		$name = $this->fm->validation($name);
		$username = $this->fm->validation($username);
		$password = $this->fm->validation($password);
		$email = $this->fm->validation($email);

		$name = mysqli_real_escape_string($this->db->link, $name);
		$username = mysqli_real_escape_string($this->db->link, $username);
		
		$email = mysqli_real_escape_string($this->db->link, $email);

		if ($name == "" || $username == "" || $password == "" || $email == "") {
			echo "<span style = 'color:red;'>Field must not be empty!</span>";
			 
			exit();
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "<span style = 'color:red;'>Invalid Email Address!</span>";
			 
			exit();
		}

		if ($password < 5) {
			echo"<span style = 'color:red;'>Password is too Short!</span>";
			 
			exit();
		}else{
			$query = "SELECT * FROM tbl_user WHERE email = '$email' ";
		    $chekquery = $this->db->select($query);
		if ($chekquery != false) {
			echo "<span style = 'color:red;'>Email Already Exit!</span>";
			 
			exit();
		}else{
			$password = mysqli_real_escape_string($this->db->link, md5($password));
			$query = "INSERT INTO tbl_user(name, username, password, email) VALUES('$name', '$username', '$password', '$email')";
		$insert_rows = $this->db->insert($query);
		if ($insert_rows) {
			echo "<span style = 'color:green;'>Thank you, You have been Registered.</span>";
			 
			exit();
		}else{
			echo "<span style = 'color:red;'>Sorry, Someting went Wrong!!</span>";
			 
			exit();
		}
		}

		
       }

	}

	//userlogin system

	public function userLogin($email, $password){
		$email = $this->fm->validation($email);
		$password = $this->fm->validation($password);
		

		$email = mysqli_real_escape_string($this->db->link, $email);
		

		if ( $email == "" || $password == "") {
			echo "empty";
			 exit();
		}else{
			$password = mysqli_real_escape_string($this->db->link, md5($password));
			$query = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password' ";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
					if ($value['status'] == '1') {
						echo "disable";
						exit();
					}else{
						Session::init();
						Session::set("login", true);
						Session::set("userId", $value['userId']);
						Session::set("username", $value['username']);
						Session::set("name", $value['name']);
					}
			}else{
				echo "error";
				exit();
			}
		}
		

	}

	//user data fetch
	public function userProfile(){
		$userid = Session::get("userId");
		$query = "SELECT * FROM tbl_user WHERE userId = '$userid' ";
		$result = $this->db->select($query);
		return $result;
	}

	//update user profile

	public function updateUserPro($data){
		
		$name = $this->fm->validation($data['name']);
		$username = $this->fm->validation($data['username']);
		$email = $this->fm->validation($data['email']);

		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$username = mysqli_real_escape_string($this->db->link, $data['username']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);

		if ($name == "" || $username == "" || $email == "") {
			$msg =  "<span style = 'color:red;'>Field must not be empty!</span>";
			 
			return $msg;
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg =  "<span style = 'color:red;'>Invalid Email Address!</span>";
			 
			return $msg;
		}
		
		
		$userid = Session::get("userId");
		$query = " UPDATE tbl_user 
				   SET 
				   name = '$name',
				   username = '$username',
				   email = '$email'

				  WHERE  userId = '$userid' ";
		$updateUser = $this->db->update($query);
		if ($updateUser) {
			$msg =  "<span style='color:green; font-size: 18px; font-family:verdana; '>Data Updated Successfully.</span>";
			return $msg;
		}else{
			$msg =  "<span style='color:red; font-size: 18px; font-family:verdana; '>Data Not Updated!</span>";
			return $msg;
		}
	

	}


 }	/*main culry bracess*/
?>