<?php
require_once "functions.php";
require_once "DB.php";

class Files extends DB{

	public function __construct(){
		parent::__construct();
	}

	private function genID(){
		$file_id = randString(10);
		$check_id = $this->getList("file_id='$file_id'");
		while(count($check_id) > 0){
			$file_id = randString(10);
			$check_id = $this->getList("file_id='$file_id'");
		}
		return $account_id;
	}

	public function getList($cond = "1", $order = ""){
		$list = $this->select("uploadfile", "*", $cond, $order);
		return $list;
	}

	public function getListByExamId($cond = "1", $order = ""){
		$list = $this->select("uploadfile", "*", $cond, $order);
		return $list;
	}

	public function getItem($file_id){
		$tmp = $this->getList("file_id='$file_id'");
		if(count($tmp) == 1) return $tmp[0];
		else return "null";
	}

	public function getItemByExamId($exam_id)
	{
		$tmp = $this->getListByExamId("exam_id='$exam_id'");
		if(count($tmp) >= 1) return "OK";
		else return "null";
	}

	// move file
	public $target_dir = "../upload/exams/";

	public function uploadFiles($data)
	{
		$errors = [];
		
		$data1 = $data['exam_info']['part_1'];
		$data2 = $data['exam_info']['part_2'];
		$data3 = $data['exam_info']['part_3'];

		$target_file1 = $this->target_dir.date("Ymd").basename($data1["name"]);
		$target_file2 = $this->target_dir . date("Ymd").basename($data2["name"]);
		$target_file3 = $this->target_dir . date("Ymd"). basename($data3["name"]);

		$fileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
		$fileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
		$fileType3 = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));

		//check exist
		if (file_exists($target_file1) || file_exists($target_file2) || file_exists($target_file3)) {
			$errors['file'] = "Files đã tồn tại.";
		}

		// Check file size
		if ($data1["size"] > 5000000 || $data2["size"] > 5000000 || $data3["size"] > 5000000) {
		  $errors['file'] = "Files quá lớn để up load.";
		}

		// Allow certain file formats
		if($fileType1 != "xls" && $fileType1 != "xlsx" && $fileType2 != "xls" && $fileType2 != "xlsx" && $fileType3 != "xls" && $fileType3 != "xlsx") {
		  $errors['file'] =  "Chỉ upload file excel định dạng .xls hoặc .xlsx";
		}

		// Check if $errors is empty to 0 by an error
		$check = empty($errors);
		if ($check) {
		// if everything is ok, try to upload file
			$move1 = move_uploaded_file($data1["tmp_name"], $target_file1);
			$move2 = move_uploaded_file($data2["tmp_name"], $target_file2);
			$move3 = move_uploaded_file($data3["tmp_name"], $target_file3);

		  if ($move1 && $move2 && $move3) {
		  	// notice_and_nextpage("Bạn đã upload thành công!", "http://localhost/elearning/admin/?link=exams");
		  	return 1;
		  } else {
		    // notice_and_nextpage("Bạn đã upload thất bại!", "http://localhost/elearning/admin/?link=exams");
		    return 0;
		  }
		}else{
			
			 // notice_and_nextpage("Bạn đã upload thất bại!", "http://localhost/elearning/admin/?link=exams");
			return 0;
		}
	}

	public function addItem($data){
		// var_dump($data); die();
		$data1 = $data['exam_info']['part_1'];
		$data2 = $data['exam_info']['part_2'];
		$data3 = $data['exam_info']['part_3'];
		
		if($this->uploadFiles($data)){
        	if($this->getItemByExamId($data['exam_id']) == "OK"){
        	$this->update("uploadfile", array(
                                        'path_part_1' => $this->target_dir.date("Ymd").$data1['name'],
                                        'path_part_2' => $this->target_dir.date("Ymd").$data2['name'],
                                        'path_part_3' => $this->target_dir.date("Ymd").$data3['name'],
                                        'size_1' =>$data1['size'],
                                        'size_2' => $data2['size'],
                                        'size_3' => $data3['size']),
        								"exam_id='{$data['exam_id']}'");
        	}else{
        	$this->insert("uploadfile", array('file_id' => 'NULL',
                                        'path_part_1' => $this->target_dir.date("Ymd").$data1['name'],
                                        'path_part_2' => $this->target_dir.date("Ymd").$data2['name'],
                                        'path_part_3' => $this->target_dir.date("Ymd").$data3['name'],
                                        'size_1' =>$data1['size'],
                                        'size_2' => $data2['size'],
                                        'size_3' => $data3['size'],
                                    	'exam_id' => $data['exam_id']));
        	}
        	notice_and_nextpage("Bạn đã upload thành công!", "http://localhost/elearning/admin/?link=exams");
        }else notice_and_nextpage("Bạn đã upload thất bại!", "http://localhost/elearning/admin/?link=exams");
	}

	public function removeItem($file_id){
		$this->delete("uploadfile", "file_id='$file_id'");
	}
}
?>