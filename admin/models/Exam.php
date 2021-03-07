<?php
require_once "functions.php";
require_once "DB.php";

class Exam extends DB{

	public function __construct(){
		parent::__construct();
	}

	private function genID(){
		$exam_id = randString(20);
		$check_id = $this->getList("exam_id='$exam_id'");
		while(count($check_id) > 0){
			$exam_id = randString(20);
			$check_id = $this->getList("exam_id='$exam_id'");
		}
		return $exam_id;
	}

	public function getList($cond = "1", $order = ""){
		$list = $this->select("exam", "*", $cond, $order);
		return $list;
	}

	public function getItem($exam_id){
		$tmp = $this->getList("exam_id='$exam_id'");
		if(count($tmp) == 1) return $tmp[0];
		else return "null";
	}

	public function changeStatus($data)
	{
		$tmp = ($data['is_actived'] == 0 ? 1 : 0);
		$this->update("exam", array(
                                    'is_actived' => $tmp),
									"exam_id= '{$data['exam_id']}'");
	}

	// move file
	public $OK = 0;
	public function uploadFiles($data)
	{
		$errors = [];
		
		$data1 = $data['exam_img'];

		$target_dir = "../upload/banners/".randString(6);
		$target_file = $target_dir . basename($data1["name"]);

		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		//check exist
		if (file_exists($target_file)) {
			$errors['file_exist'] = "Ảnh đã tồn tại.";
		}

		// Check file size
		if ($data1["size"] > 5000000) {
		  $errors['file_size'] = "Ảnh quá lớn để upload.";
		}

		// Allow certain file formats
		if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
		  $errors['file_type'] =  "Chỉ upload ảnh định dạng (.jpg, .png, .jpeg, .gif)";
		}

		// Check if $errors is empty to 0 by an error
		$check = empty($errors);
		if ($check) {
		// if everything is ok, try to upload file
			$move = move_uploaded_file($data1["tmp_name"], $target_file);

		  if ($move) {
		  	header('Refresh: 3; url=http://localhost/elearning/admin/?link=exams');
		  	echo '<div class="alert alert-success" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Success!</strong> Ảnh upload thành công!
			</div>';
		  	// notice_and_nextpage("Bạn đã upload thành công!", "http://localhost/elearning/admin/?link=exams");
		  	return 1;
		  } else {
		    notice_and_nextpage("Ảnh upload thất bại. Hãy thử lại!", "./.");
		    return 0;
		  }
		}else{
			notice_and_nextpage("Ảnh upload thất bại. Hãy thử lại!", "./.");
			return 0;
		}
	}

	public function addItem($data){
		var_dump($data['exam_img']); die();
        $this->insert("exam", array('exam_id' => $this->genID(),
                                        'name' => $data['name'],
                                        'start_exam' => $data['start_exam'],
                                        'end_exam' => $data['end_exam'],
                                        'is_actived' => $data['is_actived']
                                    ));
	}

	public function updateItem($data){
		var_dump($data); die();
        $this->update("news", array('news_title' => $data['news_title'],
                                        'news_content' => $data['news_content']),
									"news_id='{$data['news_id']}'");
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

	
	public function removeItem($account_id){
		$this->delete("account", "uid='$account_id'");
	}
}
?> 