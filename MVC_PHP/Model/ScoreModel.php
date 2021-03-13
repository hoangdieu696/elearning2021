<?php
    class ScoreModel extends Database {

        public function checkExamID_Uid($uid ) {
            $sql = "SELECT exam_id , team_id ,uid FROM score WHERE uid ='$uid' ";
            $result =  mysqli_query($this->connect,$sql) ;
            if(mysqli_num_rows($result) > 0 ) return true ;
            return false ;
        }
        public function getExamID_Uid($uid ) {
            $sql = "SELECT exam_id , team_id ,uid FROM score WHERE uid ='$uid' ";
            $result =  mysqli_query($this->connect,$sql) ;
            while($rows = mysqli_fetch_array($result)) {
                $data[] = $rows; 
            }
            return $data ;
        }
        public function getScore( $user){
            $sql = "SELECT score_part_1, score_part_2, score_part_3 FROM score WHERE uid ='$user' ";
            $result =  mysqli_query($this->connect,$sql) ;
            while($rows = mysqli_fetch_array($result)) {
                $data[] = $rows; 
            }
            return $data ;
        }
        public function updateScore($user , $score, $id) {
            if($id == 1)
            {
                $sql = "UPDATE score SET score_part_1='".$score."'WHERE uid = '$user' ";
            }else  if($id == 2)
            {
                $sql = "UPDATE score SET score_part_2='".$score."'WHERE uid = '$user' ";
            }else  if($id == 3)
            {
                $sql = "UPDATE score SET score_part_3='".$score."'WHERE uid = '$user' ";
            }
           
            return mysqli_query($this->connect,$sql) ;
        }
        public function insertScore($name){
            if($this->checkTableUser($name)== 0)
            {
                $sql = "INSERT INTO score (uid) VALUES('$name')";
                $result = mysqli_query($this->connect , $sql) ;
                if($result > 0) {
                    return true ;
                }else {
                    return false ;
                }
            }
              
        }
        public function checkTableUser($name) {
            $sql = "SELECT * FROM score where uid = '$name'";
            $result = mysqli_query($this->connect , $sql) ;
            return mysqli_num_rows($result) ;
        }
    }
?>