<?php
require_once "Controller.php";
class ViewController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function getIndex(){
        $check = $this->accountObj->checkLoggedIn();
        if($check == "Role_None"){
            getView("login", array('title' => 'Thi thử đại học Quốc gia - Trang quản trị'));
        }
        else{
            // var_dump($this->accountObj->getItem($_SESSION['Medic_uid'])['display_name']); 
            getView("home", array('title' => 'Thi thử đại học Quốc gia - Trang quản trị',
                                'fullname' => $this->accountObj->getItem($_SESSION['Medic_uid'])['display_name']));
        }
    }

    public function getExamsManage(){
        if($this->accountObj->checkLoggedIn() != "Role_Admin") nextpage("./.");
        getView("exams.manage", array('title' => 'Thi thử đại học Quốc gia - Trang quản trị',
                                        'fullname' => $this->accountObj->getItem($_SESSION['Medic_uid'])['display_name'],
                                        'exam' => $this->examObj->getList()
                                    ));
    }

    public function getAccountsManage(){
        if($this->accountObj->checkLoggedIn() != "Role_Admin") nextpage("./.");
        getView("accounts.manage", array('title' => 'Thi thử đại học Quốc gia - Trang quản trị',
                                        'fullname' => $this->accountObj->getItem($_SESSION['Medic_uid'])['display_name'],
                                        'email' => $this->accountObj->getItem($_SESSION['Medic_uid'])['username'],
                                        'password' => $this->accountObj->getItem($_SESSION['Medic_uid'])['password'],
                                        'phone' => $this->accountObj->getItem($_SESSION['Medic_uid'])['phone'],
                                        'create_at' => $this->accountObj->getItem($_SESSION['Medic_uid'])['create_at'],
                                        'create_by' => $this->accountObj->getItem($_SESSION['Medic_uid'])['create_by']
                                        ));
    }

    public function addUser(){
        if($this->accountObj->checkLoggedIn() != "Role_Admin") nextpage("./.");
        getView("user.add", array('title' => 'Thi thử đại học Quốc gia - Trang quản trị',
                                'fullname' => $this->accountObj->getItem($_SESSION['Medic_uid'])['display_name']));
    }

    // public function getListTeam(){
    //     if($this->accountObj->checkLoggedIn() != "Role_Admin") nextpage("./.");
    //     getView("exams.manage", array('title' => 'Thi thử đại học Quốc gia - Trang quản trị',
    //                                     'fullname' => $this->accountObj->getItem($_SESSION['Medic_uid'])['display_name'],
    //                                     'exam' => $this->examObj->getList()
    //                                 ));
    // }
}
?>