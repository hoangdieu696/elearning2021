<?php
if(!defined('__CONTROLLER__')) define('__CONTROLLER__', 'true');
require_once "models/Account.php";
require_once "models/Files.php";
require_once "models/Exam.php";

class Controller{
    protected $accountObj;
    protected $filesObj;
    protected $examObj;

    public function __construct(){
        $this->accountObj = new Account;
        $this->filesObj = new Files;
        $this->examObj = new Exam;

        sessionInit();
        setTimeZone();
    }
}
?>