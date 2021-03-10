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
                    $html.=$this->data->getReadFileExcel($id);
                    echo $html."@@@@";
                }
                $this->view("ExamView");
            }else {
                $this->view("NotificationView");
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