<?php
    class UserModel extends Database {
        public function checkLogin($user, $pass) {
             $sql = "SELECT * FROM account WHERE username = '$user' AND password = '$pass' " ;
             $result =  mysqli_query($this->connect , $sql) ;
             return mysqli_num_rows($result);
        }
        public function getUserName($user, $pass){
            $sql = "SELECT * FROM account WHERE username = '$user' AND password = '$pass' " ;
            $result =  mysqli_query($this->connect , $sql) ;
            $data = mysqli_fetch_assoc($result);
            return $data['display_name'];
        }
        public function getIDUser($user, $pass){
            $sql = "SELECT * FROM account WHERE username = '$user' AND password = '$pass' " ;
            $result =  mysqli_query($this->connect , $sql) ;
            $data = mysqli_fetch_assoc($result);
            return $data['uid'];
        }
    }
?>