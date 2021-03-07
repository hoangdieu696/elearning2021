<?php
require_once "functions.php";
require_once "DB.php";

class Account extends DB{

	public function __construct(){
		parent::__construct();
	}

	private function genID(){
		$account_id = randString(20);
		$check_id = $this->getList("uid='$account_id'");
		while(count($check_id) > 0){
			$account_id = randString(20);
			$check_id = $this->getList("uid='$account_id'");
		}
		return $account_id;
	}

	public function getList($cond = "1", $order = ""){
		$list = $this->select("account", "*", $cond, $order);
		return $list;
	}

	public function getItem($account_id){
		$tmp = $this->getList("uid='$account_id'");
		if(count($tmp) == 1) return $tmp[0];
		else return "null";
	}

	public function addItemUser($data)
	{
		var_dump($data); die();
	}

	public function login($username, $password){
		sessionInit();
		$check = $this->getList("username='$username' AND password='$password'");
		
		if(count($check) == 1){
			$_SESSION['Medic_user'] = $username;
			$_SESSION['Medic_pass'] = $password;
			$_SESSION['Medic_uid']  = $check[0]['uid'];
			return "loginOK";
		}
		else{
			return "loginFailed";
		}
	}

	public function logout(){
		sessionInit();
		unset($_SESSION['Medic_user']);
		unset($_SESSION['Medic_pass']);
		unset($_SESSION['Medic_uid']);
	}

	public function checkLoggedIn(){
		sessionInit();
		if(!isset($_SESSION['Medic_user']) || !isset($_SESSION['Medic_pass'])) return "Role_None";
		$check = $this->getList("username='{$_SESSION['Medic_user']}' AND password='{$_SESSION['Medic_pass']}' AND role='Role_Admin'");
		if(count($check) != 1){
			$this->logout();
			return "Role_None";
		}
		else{
			return "Role_Admin";
		}
	}

	public function checkUsername($username){
		return count($this->getList("username='$username'")) == 0;
	}

	public function checkPassword($password, $password2){
		if(strlen($password) < 8)
			return 1; // password is too short
		elseif($password != $password2)
			return 2; // password is mismatch
		else
			return 0; // OK
	}

	public function changePassword($new_pass, $new_pass2){
		$mess = "Bạn sẽ đăng xuất ngay lập tức!";
		$messFail1 = "Hãy đặt mật khẩu mới có độ dài >= 8";
		$messFail2 = "Mật khẩu nhập lại không trùng khớp";
		if($this->checkPassword($new_pass, $new_pass2) == 0){
			$this->update("account", array('password' => $new_pass), "uid='{$_SESSION['Medic_uid']}'");
			$this->logout();
			header('Refresh: 0.2; url=http://localhost/elearning/admin/');
		}
		else{
			if($this->checkPassword($new_pass, $new_pass2) == 1){
				echo "<script>alert(\"$messFail1\");</script>";
			}else echo "<script>alert(\"$messFail2\");</script>";
			header('Refresh: 0.2; url=http://localhost/elearning/admin/');
		}
	}

	public function removeItem($account_id){
		$this->delete("account", "uid='$account_id'");
	}
}
?>