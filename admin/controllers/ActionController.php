<?php
require_once "Controller.php";
class ActionController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function login($loginData){
        // var_dump($loginData['username']);
        $loginResp = $this->accountObj->login($loginData['username'], $loginData['password']);
         // _hash($loginData['password'])
        if($loginResp == "loginOK"){
            nextpage("./.");
        }
        else{
            // die();
            notice_and_nextpage("Bạn đã sai email hoặc mật khẩu!", "./.");
        }
    }

    public function logout(){
        $this->accountObj->logout();
        nextpage("./.");
    }

    // Exams
    // new exam
    public function addExamAct($data){
        if($this->accountObj->checkLoggedIn() == "Role_None") return;
        $data['exam_img'] = $_FILES;
        // var_dump($data); die();
        $this->examObj->addItem(($data));
        nextpage("./?link=exams");
    }

    public function getExamsAct($data){
        if($this->accountObj->checkLoggedIn() == "Role_None") return;
        echo json_encode($this->examObj->getItem($data['exam_id']));
    }


    public function updateStatusExamAct($data)
    {
        if($this->accountObj->checkLoggedIn() == "Role_None") return;
        $tmp = $this->examObj->getItem($data['exam_id']);
        $this->examObj->changeStatus($tmp);
        nextpage("./?link=exams");
        echo "UpdateStatusExamOK";
        # code...
    }

    

    // Change pass
    public function changePassAct($data){
        if($this->accountObj->checkLoggedIn() == "Role_None") return;
        $this->accountObj->changePassword($data['new_pass'], $data['new_pass2']);
    }

    // filesize
    public function uploadFilesAct($data){
        if($this->accountObj->checkLoggedIn() == "Role_None") return;
        $data['exam_info'] = $_FILES;
        $this->filesObj->addItem(($data));
        // die();
        nextpage("./?link=exams");
        echo "AddFilesOK";
    }

    //check exist files
    public function checkFilesExistAct($data)
    {
        if($this->accountObj->checkLoggedIn() == "Role_None") return;
        echo json_encode($this->filesObj->getItemByExamId($data['exam_id']));
    }


    //user list
    public function uploadUsersAct($data){
        if($this->accountObj->checkLoggedIn() == "Role_None") return;
        $data['users_info'] = $_FILES;
        $this->accountObj->addItemUser(($data));
        die();
        nextpage("./?link=exams");
        echo "AddFilesOK";
    }



}
?>