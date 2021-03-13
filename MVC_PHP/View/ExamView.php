
<?php
    if(!isset($_SESSION['exam_id']))
    {
        header("location: ./Exam/index");
    }
    if(!isset($_SESSION['user'])){
            
        header("location: ../");
    }
    if(isset($_POST['answer']))
    {
        require_once('./MVC_PHP/core/Controller.php');
        $data = new Controller() ;
        $arr = $data->model("FileModel");
        $temp = strval($_POST['answer']);
        $dataAnswer = explode("->",$temp) ;
        $tempAnswer ="";
        $tempCorrect="";
        $tempAnalytics="";
        $score = 0 ;
        if(!isset($dataAnswer) && count($dataAnswer) == 0 )
        {
            $score = 0 ;
        }else {
            $ansUser = array() ;
            for($i = 0 ; $i < 50 ; $i++) {
                array_push($ansUser,"SAI@@@");
            }
            for($i = 0 ; $i < count($dataAnswer)-1 ; $i++){
               $tempAnswer .= $dataAnswer[$i]."@@@@";
               $tempData = explode(":",$dataAnswer[$i]);
            //    if(intval($tempData[0]) == $i+1)
            //    array_push($ansUser,$tempData[1]);
                $index = intval($tempData[0]);
                $ansUser[$index-1] = $tempData[1];

            }  
            $result = $data->model("ScoreModel")->insertScore($_SESSION['uid']);
            $id = intval($_POST['_id']);
            $arr_answerCorrection = $arr->getAnswerFromFile($id-1, $_SESSION['exam_id']);
            $answerCorrection = array() ;
            for($i = 0 ; $i < count($arr_answerCorrection) ; $i++) {
                array_push($answerCorrection, $arr_answerCorrection[$i]->getAnserCorrect()) ;
            }
            if($id - 1 == 1 )
            {
                $data->model("ReseenModel")->upd1($_SESSION['uid'],$tempAnswer) ;
            }else if($id - 1 == 2) {
                $data->model("ReseenModel")->upd2($_SESSION['uid'],$tempAnswer) ;
            }else if($id - 1 == 3) {
                $data->model("ReseenModel")->upd3($_SESSION['uid'],$tempAnswer);
            }
           
            $score = $arr->CaculateScore($ansUser,$answerCorrection);
        }

        if($id - 1 == 1) {

            $result = $data->model("ScoreModel")->updateScore($_SESSION['uid'],strval($score),1);
        }else if($id - 1 == 2 ) {
        
            $result = $data->model("ScoreModel")->updateScore($_SESSION['uid'],strval($score),2);
        }else if($id - 1 == 3){
        
            $result = $data->model("ScoreModel")->updateScore($_SESSION['uid'],strval($score),3);
            $result = $this->model("ScoreModel")->getScore($_SESSION["uid"]) ;
            $totalScore  = intval($result[0]["score_part_1"])+ intval($result[0]["score_part_2"]) + intval($result[0]["score_part_3"]) ; 
            if($totalScore != 0 )
            {
                $res1 = $data->model("ExamModel")->updateStatus($_SESSION['exam_id'], $_SESSION['uid'],2) ;
            }
            exit() ;
        }
        // $data->model("Reseen")->upd3($_SESSION['uid'],$arr->getReadFileExcel($id , $_SESSION['exam_id']),"","","");
        echo $arr->getReadFileExcel($id , $_SESSION['exam_id']) ;
        exit();
    }
   
?> 
<html>
    <head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../Assets/js/startExam.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            // $(document).ready(function() {
            //     function disablePrev() { window.history.forward() }
            //     window.onload = disablePrev();
            //     window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
            // });
            //  window.history.back();
        </script>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <h3 style ="text-align: center;" class="text-center"> Thông tin danh sách kỳ thi <br></h3>
        </div>
        <div class="row table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Kì Thi</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                   <?php 
                    //    print_r(count($data['list_exam']))."<br>";
                         echo ($data['list_active'][0]) ." ".intval($data['total']);
                        for($i = 0 ; $i < count($data['list_exam']) ; $i++)
                        {
                            echo "<tr> 
                            <td class='align-middle' scope='col'>".($i+1)."</td>
                            <td class='align-middle' scope='col'>".$data['list_exam'][$i][0]."</td>
                            <td class='align-middle' scope='col'>".$data['list_exam'][$i][1]."</td>
                            <td class='align-middle' scope='col'>".$data['list_exam'][$i][2]."</td>";
                            echo  "<td  class='align-middle justify-content-center ' scope='col'>";
                            
                            if($data['list_active'][$i] == 1 && intval($data['total']) == 0)
                            {
                               echo "<button id='start' style='align-items: center;' class='is_active btn btn-primary '> start </button>";
                            }else if($data['list_active'][$i] == 2 && intval($data['total']) != 0) {
                               echo "<button id='reseen' style='align-items: center; margin-left: 20px;' class='is_active btn btn-primary '> xem lai </button></td>";
                            }
                            echo "</tr>";
                        }
                   ?>
                </tbody>
            </table>
        </div>
    </div>
    </body>
</html>