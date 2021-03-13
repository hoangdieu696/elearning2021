<?php
    if(!isset($_SESSION['user'])){
        
        header("location: ../");
    }
    class Exam extends Controller{
        protected $data ;
        protected $user ;
        function __construct()
        {
            $this->data = $this->model("FileModel");
        }
        function index(){

            if(isset($_SESSION['user']))
            {
                if(isset($_POST['file_id']))
                {
                    $html ="";
                    $id= intval($_POST['file_id']);
                    $id = 1;
                    $html.=$this->data->getReadFileExcel($id, $_SESSION['exam_id']);
                    // $result = $this->model("ReseenModel")->upd1(($_SESSION['uid']),strval($html),"","","");
                    // if($result == 0 ) echo "<script> alert(Khong thanh cong) </script>";
                    // else echo "<script> alert( Thanh cong) </script>";
                    echo $html."@@@@";
                }
                $arr_exam =  $this->model("ExamModel")->getExam($_SESSION['exam_id']) ;
                $res_active = $this->model("ExamModel")->activeUser($_SESSION['exam_id']);
                $result = $this->model("ScoreModel")->getScore($_SESSION["uid"]) ;
                $totalScore = 0 ;
                $totalScore  = intval($result[0]["score_part_1"])+ intval($result[0]["score_part_2"]) + intval($result[0]["score_part_3"]) ; 
                $this->view("ExamView",["list_exam" => $arr_exam , "list_active" => $res_active, "total" => $totalScore]);
            }else {
                $this->view("NotificationView");
            }
           
            
        }
        function result() {
            if(!isset($_SESSION['user']))
            {
                $this->view("NotificationView");
            }else{
                $data = $this->model("ReseenModel")->getAnswerFromUser($_SESSION['uid'], $_SESSION['exam_id']);
                // print_r($data)."<br>";
                // print_r($data[0]['answer_1']);
                $tmp_ans_1 = explode("@@@@",$data[0]['answer_1']) ;
                $ans_1 = array() ;
                $allAns = array() ;
                for($i = 0 ;  $i < count($tmp_ans_1)-1 ; $i++)
                {
                    $tempData = explode(":",$tmp_ans_1[$i]) ;
                    if( $tempData[1] == 'zzzz' ) array_push($ans_1, ' ') ;
                    else array_push($ans_1,$tempData[1]) ;
                }
                $tmp_ans_2 = explode("@@@@",$data[0]['answer_2']) ;
                $ans_2 = array() ;
                for($i = 0 ;  $i < count($tmp_ans_2)-1 ; $i++)
                {
                    $tempData = explode(":",$tmp_ans_2[$i]) ;
                    if( $tempData[1] == 'zzzz' ) array_push($ans_2, ' ') ;
                    else array_push($ans_2,$tempData[1]) ;
                }
                $tmp_ans_3 = explode("@@@@",$data[0]['answer_3']) ;
                $ans_3 = array() ;
                for($i = 0 ;  $i < count($tmp_ans_3)-1 ; $i++)
                {
                    $tempData = explode(":",$tmp_ans_3[$i]) ;
                    if( $tempData[1] == 'zzzz' ) array_push($ans_3, ' ') ;
                    else array_push($ans_3,$tempData[1]) ;
                }
                array_push($allAns,$ans_1);
                array_push($allAns,$ans_2);
                array_push($allAns,$ans_3);
                // print_r($allAns);
                // print_r($data);
                
                // echo "<br>" ;
                // print_r($data[0]['answer_2']);
                // $tmp_ans_1 = explode("@@@@",$data[0]['answer_1']) ;
                // echo "<br>" ;
                // print_r($data[0]['answer_3']);
                $result = $this->model("FileModel")->showSolution($_SESSION['uid'], $_SESSION['exam_id'],$allAns);
                $this->view("ResultView",["viewer" => $result]);
            }
        }
        function show(){
            if(!isset($_SESSION['user']))
            {
                $this->view("NotificationView");
            }else{

                $this->view("ShowExam");
            }
           
           
        }
        function score() {
            if(!isset($_SESSION['user']))
            {
                $this->view("NotificationView");
            }else{

                $data = $this->model("ScoreModel") ;
                $result = $data->getScore($_SESSION["uid"]);
                $totalScore = intval($result[0]["score_part_1"])+ intval($result[0]["score_part_2"]) + intval($result[0]["score_part_3"]) ; 
                $this->view("ScoreExam" , ["score" => $totalScore]) ;
            }
        }
    }
?>