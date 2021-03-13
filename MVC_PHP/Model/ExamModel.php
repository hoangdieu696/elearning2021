<?php 
    class ExamModel extends Database {

        public function getExam($exam_id) {
            $sql = "SELECT name,start_exam,end_exam,is_actived FROM exam where exam_id ='$exam_id'";
            $result =  mysqli_query($this->connect,$sql) ;
            while($rows = mysqli_fetch_array($result)) {
                $data[] = $rows ;
            }
            return $data ;
        }
        public function updateStatus($exam_id , $uid, $submit) {
            $sql = "UPDATE exam SET is_actived = '$submit' where exam_id ='$exam_id'";
            $result =  mysqli_query($this->connect , $sql) ;
        }
        public function activeUser($exam_id)
        {
            $sql = "SELECT name,start_exam,end_exam,is_actived FROM exam where exam_id ='$exam_id'";
            $result =  mysqli_query($this->connect,$sql) ;
            while($rows = mysqli_fetch_array($result)) {
                $data[] = $rows ;
            }
            $res = array() ;
            for($i = 0 ; $i < count($data) ; $i++)
            {
                $start = $data[$i][1];
                $end = $data[$i][2] ;
                $is_active = $data[$i][3];
                $newStart = date("Y-m-d H:i:s",strtotime($start));
                $newEnd = date("Y-m-d H:i:s",strtotime($end));
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $vn = date("Y-m-d H:i:s") ;
                
                // echo $newEnd. " ". $newStart." ". $vn." ". $is_active."<br>";
                
                if($newEnd >= $vn && $vn >= $newStart && $is_active == 1) {
                    array_push($res,1) ;
                }else if($is_active == 2){
                    array_push($res,2) ;
                }else {
                    array_push($res,0) ;
                }
            }
            return $res;
        }
    }
?>