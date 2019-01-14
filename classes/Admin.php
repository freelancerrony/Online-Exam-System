<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	class Admin{
			private $db;
			private $fm;
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}


		public function adminLogin($data){

			$adminUser = $this->fm->validation($data['adminUser']);
			$adminPass = $this->fm->validation($data['adminPass']);

			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, md5($adminPass));


			if (empty($adminUser) || empty($adminPass)) {
				$msg = "<span style='color:red; font-size:18px; font-family:sans-serif;'>Field must not be empty!</span>";
				return $msg;
			}

			$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' ";

			$getlgn = $this->db->select($query);
			if ($getlgn != false) {
                $value = $getlgn->fetch_assoc();

                Session::init();
				Session::set("adminlogin", true);
				Session::set("adminUser", $value['adminUser']);
				Session::set("adminId", $value['adminId']);

				header("Location: index.php");

			}else{
				$msg = "<span style='color:red; font-size:18px; font-family:sans-serif;'>Username or Password not Matched!</span>";
				return $msg;
			}

		}
	}
?>