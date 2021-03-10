

<?php

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
        $score = 0 ;
        if(!isset($dataAnswer) && count($dataAnswer) == 0 )
        {
            $score = 0 ;
        }else {
            $ansUser = array() ;
            for($i = 0 ; $i < count($dataAnswer)-1 ; $i++){
               $tempData = explode(":",$dataAnswer[$i]);
               array_push($ansUser,$tempData[1]);
            }  
            $result = $data->model("ScoreModel")->insertScore($_SESSION['uid']);
            $id = intval($_POST['_id']);
            $arr_answerCorrection = $arr->getAnswerFromFile($id-1);
            $answerCorrection = array() ;
            for($i = 0 ; $i < count($arr_answerCorrection) ; $i++) {
                array_push($answerCorrection, $arr_answerCorrection[$i]->getAnserCorrect()) ;
            }
            $score = $arr->CaculateScore($ansUser,$answerCorrection);
        }

        if($id - 1 == 1) {

            $result = $data->model("ScoreModel")->updateScore($_SESSION['uid'],strval($score),1);
        }else if($id - 1 == 2 ) {
        
            $result = $data->model("ScoreModel")->updateScore($_SESSION['uid'],strval($score),2);
        }else if($id - 1 == 3){
        
            $result = $data->model("ScoreModel")->updateScore($_SESSION['uid'],strval($score),3);

            exit() ;
        }
        echo $arr->getReadFileExcel($id) ;
        exit();
    }
   
?>
<html>
    <head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../Assets/js/startExam.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                function disablePrev() { window.history.forward() }
                window.onload = disablePrev();
                window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-9" style="margin-top:20%;">
                        <p style="font-size: 40; font-weight: bold;">Chào mừng bạn:  <span><?php echo $_SESSION["user"] ." ". $_SESSION["uid"]?></span> </p>
                        <p style="font-size: 30;">Bài thi bao gồm 3 phần thi trong 195 phút </p>
                        <p style="font-size: 25; "> Phần 1: Tư duy định tính </p>
                        <p style="font-size: 25;"> Phần 2: Tư duy định lượng </p>
                        <p style="font-size: 25;">Phần 3: Khoa học xã hội </p>
                        <button id="start" style="margin-top: 20; margin-left: 250  ; width: 200px; height: 50px;" class="btn btn-primary"> BẮT ĐẦU</button>
                </div>
            </div>
        </div>
    </body>
</html>