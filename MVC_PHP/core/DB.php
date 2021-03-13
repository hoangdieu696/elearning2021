<?php
    class Database {
        public $host = "localhost";
        protected $user = "root" ;
        protected $pass ="" ;
        protected $NameDB = "elearning" ;
        protected $connect = NULL;

        public function __construct()
        {
            $this->connect = mysqli_connect($this->host , $this->user , $this->pass) ;
            mysqli_select_db($this->connect,$this->NameDB) ;
            mysqli_query($this->connect,"SET NAMES 'utf8'");
        }         
    }
?>