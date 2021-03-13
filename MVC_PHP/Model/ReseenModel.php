<?php

        class ReseenModel extends Database {

            public function insertDB($exam_id , $uid ) {
                if($this->checkExist($exam_id) == false )
                {
                    $sql = "INSERT INTO reseen(id,uid,exam_id) values(null, '$uid', '$exam_id' )";
                    $result = mysqli_query($this->connect, $sql) ;
                }
             
            }
            public function checkExist($exam_id) {
                $sql = "SELECT * FROM reseen where exam_id = '$exam_id'" ;
                $result = mysqli_query($this->connect , $sql );
                if(mysqli_num_rows($result) > 0 ) return true ;
                return false ;
            }
            public function upd1($uid, $answer=NULL ) {
                
                    $sql = "UPDATE reseen SET answer_1 = '$answer' where uid = '$uid'"  ;
                    $result = mysqli_query($this->connect, $sql) ;
              
                    return $result;
 
            }
            public function upd2($uid , $answer =NULL ) {
                
                    $sql = "UPDATE reseen SET answer_2 = '$answer'  where uid = '$uid'" ;
                    $result = mysqli_query($this->connect, $sql) ;
                    return $result;
               
            }
            public function upd3($uid , $answer=NULL  ) {
               
                    $sql = "UPDATE reseen SET answer_3 = '$answer' where uid = '$uid'" ;
                    $result = mysqli_query($this->connect, $sql) ;
                    return $result;
             
            }
            public function getAnswerFromUser($uid , $exam_id) {
                $sql = "SELECT answer_1,answer_2,answer_3 FROM reseen where uid = '$uid' and exam_id = '$exam_id'" ;
                $result = mysqli_query($this->connect, $sql) ;
                while($rows = mysqli_fetch_array($result)) {
                    $data[] = $rows ;
                }
                return $data;
            }
        }

?>