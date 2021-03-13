<?php
    class Contests {
        private $Question ;
        private $Question_ID ;
        private $Question_Answer;
        private $AnserCorrect ;
        private $AnswerAnalysis ;
        function __construct($Question_ID, $Question , $Question_Answer,$AnserCorrect,$AnswerAnalysis)
        {
            $this->Question_ID = $Question_ID ;
            $this->Question = $Question ;
            $this->Question_Answer = $Question_Answer ;
            $this->AnserCorrect = $AnserCorrect;
            $this->AnswerAnalysis = $AnswerAnalysis;
        }
        
        function setQuestionID( $Question_ID) {
            $this->Question_ID = $Question_ID ;
        }
        function getQuestionID() {
            return $this->Question_ID ;
        }
        
        function setQuestion($Question) {
            $this->Question = $Question ;
        }
        
        function getQuestion() {
            return $this->Question ;
        }
        function setQuestionAnswer( $Question_Answer) {
        $this->Question_Answer = $Question_Answer ;
        }
        function getQuestionAnswer() {
            return $this->Question_Answer ;
        }
        function setAnserCorrect($AnserCorrect){
            $this->AnserCorrect = $AnserCorrect;
        }
        function getAnserCorrect(){
            return $this->AnserCorrect ;
        }
        function setAnswerAnalysis($AnswerAnalysis){
            $this->AnswerAnalysis = $AnswerAnalysis ;
        }
        function getAnswerAnalysis() {
            return $this->AnswerAnalysis ;
        }
    }
    class FileModel extends Database {
    
        public function getFilePath($exam_id) {
           // path_file_1 path_file_2 path_file_3
            $sql= "SELECT path_part_1,path_part_2,path_part_3 FROM uploadfile where exam_id = '$exam_id' ";
            $result =  mysqli_query($this->connect,$sql) ;
           
            return ($result);
        }

        public function getAnswerFromFile($id ,$exam_id)
        {
            $data  = $this->getFilePath($exam_id);
            while($rows = mysqli_fetch_array($data)) {
                $result[] = $rows;
            }       
            if($id == 1){
                $file_test = $result[0]['path_part_1'].".xlsx";
            }else if($id == 2) {
                $file_test = $result[0]["path_part_2"].".xlsx";
            }else {
                $file_test = $result[0]["path_part_3"].".xlsx";
            }
            if(file_exists($file_test)) {
               
                require_once('./Library/vendor/autoload.php');
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_test) ;
                $worksheet = $spreadsheet->getActiveSheet();
                $worksheetArray = $worksheet->toArray();
                array_shift($worksheetArray);
                $titleQuestion ="";
                $answerQuestion ="";
                $answerCorrection ="";
                $answerAnalysis ="";
                $id_temp = 1 ;
                $flag = true ;
                $run = 0 ;
                $tempImage = 2 ;
                $arr_question = array();
                $row_question = array() ;
                foreach ($worksheetArray as $key => $value) {
                    $worksheet = $spreadsheet->getActiveSheet();

                    if($value[0] != NULL)
                    {
                        if($flag == false ) {
                          //  echo $id_temp." ".$titleQuestion."<br>";
                            $ctest = new Contests($id_temp,$titleQuestion,$answerQuestion,$answerCorrection,$answerAnalysis);
                            array_push($arr_question, $ctest) ;
                            $titleQuestion ="";
                            $answerQuestion ="";
                            $answerCorrection="";
                            $answerAnalysis="";
                            $run = 0 ;
                        }
                        $flag = true ;
                        $i = 0 ;
                        $id_temp = $value[0];
                        $titleQuestion .= $value[1] ;
                        // $answerAnalysis ="";
                        array_push($row_question,$tempImage) ;
                       // array_push($id_question_num , $id_temp) ;
                        $titleQuestion .= "?";
                    }else{
                        $flag =  false ;
                        $answerQuestion .= "@RT";
                        $check = strtoupper($value[1]);
                        $res= $this->find($check,"EMPTY") ;
                        if($res == true )
                        {
                            $answerQuestion.= $check;
                        }else{
                            $answerQuestion .= $value[1] ;
                        }
                       
                        $run++;
                    }
                    if($value[2] != NULL)
                    {
                        $answerCorrection= $value[2];
                    }
                    if(isset($value[3]) && $value[3] != NULL) {
                        $answerAnalysis =$value[3];
                    }
                 $tempImage++;
                }
        
                if($flag == false ) {
                    $ctest = new Contests($id_temp,$titleQuestion,$answerQuestion,$answerCorrection,$answerAnalysis);
                    array_push($arr_question, $ctest) ;
                    $titleQuestion ="";
                    $answerQuestion ="";
                    $answerCorrection="";
                    $run = 0 ;
                }
                return $arr_question ;
            }
            return 0 ;

        }
        public function CaculateScore($arrUser , $arrAns) 
        {
            $score = 0 ;
            for($i = 0 ; $i < count($arrUser) ; $i++)
            {
                if($arrUser[$i] == $arrAns[$i]) {
                    $score++ ;
                }
            }
            return $score ;
        }
        public function find($start="123", $search="abc"){
        
            for ($i = 0 ; $i < (strlen($search)) ; $i++)
            {
                
                if(!empty($search) && !empty($start) && $search[$i] == $start[$i])  {
                    if($i == (strlen($start))-1) {
                        return true ;
                    }
                    continue ;
                }
                else return false ;
            }
        }
        public function showSolution($id, $exam_id, $answerUser) {
            $html ="";
            for($i = 1 ; $i <= 3 ; $i++) {
                if($i == 1 ) $name = "ĐỀ THI TƯ DUY ĐỊNH LƯỢNG";
                else if($i == 2) $name = "TƯ DUY ĐỊNH TÍNH" ;
                else $name = "BÀI THI KHOA HỌC" ;
                $html .= "<br><h3>".$name."</h3> <br>";
                $html .="<table>";
                $data = $this->getAnswerFromFile($i,$exam_id);
                for($k = 0 ; $k < count($data) ; $k++) {
                    $html .="<tr> <td>".$data[$k]->getQuestion()."</td></tr>";
                    $arr_answer = explode("@RT",$data[$k]->getQuestionAnswer());
                    $flag = 0 ;
                    if($data[$k]->getAnserCorrect() == $answerUser[$i-1][$k]){
                        for($j = 0 ; $j < count($arr_answer) ; $j++)
                        {
                            if($arr_answer[$j] == null) {
                                continue;
                            } 
                            if($this->find($arr_answer[$j],"EMPTY") > 0) {
                                $html .="<tr><td><p> Đáp án điền của thí sinh: ".$answerUser[$i-1][$k]."</p></td></tr>";
                                continue ;
                            }
                            else{
                               
                                if(chr(64+$j) == $data[$k]->getAnserCorrect())
                                {
                                    $html.="<tr><td><p style='color : #3FCB0E;'>".$arr_answer[$j]."</p></td></tr>";
                                }
                               
                                else {
                                   
                                    $html.="<tr><td><p>".$arr_answer[$j]."</p></td></tr>";
                                    
                                }
                               
                            }
                        }
                    }else{
                        if($answerUser[$i-1][$k] ==' ') {
                            for($j = 0 ; $j < count($arr_answer) ; $j++)
                            {
                                    if($arr_answer[$j] == null) {
                                        continue;
                                    } 
                                    
                                    if($this->find($arr_answer[$j],"EMPTY") > 0) {
                                        $html .="<tr><td><p>".$answerUser[$i-1][$k]."</p></td></tr>";
                                        continue ;
                                    }else{
                                    
                                    if(chr(64+$j) == $data[$k]->getAnserCorrect())
                                    {
                                        $html.="<tr><td><p style='color : #ff944d;'>".$arr_answer[$j]."</p></td></tr>";
                                    }
                                    else {
                                        
                                        $html.="<tr><td><p>".$arr_answer[$j]."</p></td></tr>";
                                            
                                    }
                                    
                                }
                            }
                            $html .= "<tr><td><p> Thí sinh không trả lời </p></td></tr>";
                        }else {
                            
                            for($j = 0 ; $j < count($arr_answer) ; $j++)
                            {
                                    if($arr_answer[$j] == null) {
                                        continue;
                                    } 
                                    
                                    if($this->find($arr_answer[$j],"EMPTY") > 0) {
                                        $html .="<tr><td><p>".$answerUser[$i-1][$k]."'</p></td></tr>";
                                        continue ;
                                    }else{
                                    
                                    if(chr(64+$j) == $data[$k]->getAnserCorrect())
                                    {
                                        $html.="<tr><td><p style='color : #3FCB0E;'>".$arr_answer[$j]."</p></td></tr>";
                                    }
                                    else if(chr(64+$j) == $answerUser[$i-1][$k]){
                                        $html.="<tr><td><p style='color : red;'>".$arr_answer[$j]."</p></td></tr>";
                                    }
                                    else {
                                        
                                        $html.="<tr><td><p>".$arr_answer[$j]."</p></td></tr>";
                                            
                                    }
                                    
                                }
                            }
                            
                         
                        }
                    }
                       
                    $html.="<tr><td><p> Đáp án: ".$data[$k]->getAnserCorrect().". ".$data[$k]->getAnswerAnalysis()."</p></td></tr>";
                }
                $html .="</table>";
                $html .="<br>";
              
            }
               
            return $html ;
            
        }
        public function getReadFileExcel($id, $exam_id) {
            
            $data  = $this->getFilePath($exam_id);
            while($rows = mysqli_fetch_array($data)) {
                $result[] = $rows;
            }       
            if($id == 1){
                $file_test = $result[0]['path_part_1'].".xlsx";
            }else if($id == 2) {
                $file_test = $result[0]["path_part_2"].".xlsx";
            }else {
                $file_test = $result[0]["path_part_3"].".xlsx";
            }
            if(file_exists($file_test)) {
               
                require_once('./Library/vendor/autoload.php');
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_test) ;
                $worksheet = $spreadsheet->getActiveSheet();
                $worksheetArray = $worksheet->toArray();
                array_shift($worksheetArray);
                $titleQuestion ="";
                $answerQuestion ="";
                $answerCorrection ="";
                $answerAnalysis ="";
                $id_temp = 1 ;
                $flag = true ;
                $run = 0 ;
                $tempImage = 2 ;
                $arr_question = array();
                $row_question = array() ;
                foreach ($worksheetArray as $key => $value) {
                    $worksheet = $spreadsheet->getActiveSheet();

                   

                    if($value[0] != NULL)
                    {
                        if($flag == false ) {
                          //  echo $id_temp." ".$titleQuestion."<br>";
                            $ctest = new Contests($id_temp,$titleQuestion,$answerQuestion,$answerCorrection,$answerAnalysis);
                            array_push($arr_question, $ctest) ;
                            $titleQuestion ="";
                            $answerQuestion ="";
                            $answerCorrection="";
                            $answerAnalysis="";
                            $run = 0 ;
                        }
                        $flag = true ;
                        $i = 0 ;
                        $id_temp = $value[0];
                        $titleQuestion .= $value[1] ;
                        $answerCorrection= "";
                        $answerAnalysis ="";
                        array_push($row_question,$tempImage) ;
                       // array_push($id_question_num , $id_temp) ;
                        $titleQuestion .= "?";
                    }else{
                        $flag =  false ;
                        $answerQuestion .= "@RT";
                        $check = strtoupper($value[1]);
                        $res= $this->find($check,"EMPTY") ;
                        if($res == true )
                        {
                            $answerQuestion.= $check;
                        }else{
                            $answerQuestion .= $value[1] ;
                        }
                       
                        $run++;
                    }
                 $tempImage++;
                }
        
                if($flag == false ) {
                    $ctest = new Contests($id_temp,$titleQuestion,$answerQuestion,$answerCorrection,$answerAnalysis);
                    array_push($arr_question, $ctest) ;
                    $titleQuestion ="";
                    $answerQuestion ="";
                    $answerCorrection="";
                    $run = 0 ;
                }

                $question_img = array() ;
                foreach ($worksheetArray as $key => $value) {
                    $worksheet = $spreadsheet->getActiveSheet();
                    $k = 1 ;
                    if(!empty($worksheet->getDrawingCollection()[$key]))
                    {
                        $drawing = $worksheet->getDrawingCollection()[$key];
                        $string = $drawing->getCoordinates();
                        $row = intval(substr($string,1,strlen($string))) ;
                        foreach($row_question as $value) {
                            if($value > $row) {
                                $k--;
                                break ;
                            }
                            if($value == $row)
                            {
                                break ;
                            }
                            $k++;
                        }
                       
                        $zipReader = fopen($drawing->getPath(), 'r');
                        $imageContents = '';
                        while (!feof($zipReader)) {
                            $imageContents .= fread($zipReader, 1024);
                        }
                       
    
                        fclose($zipReader);
                        $url = '<td><img  height="50px" width="250px"  src="data:image/jpeg;base64,'. base64_encode($imageContents).'"/></td>';
                        $contest = new Contests($k,$url,'','','');
                        array_push($question_img,$contest) ;
                    }
                } 
                        $html="";
                        $html="<table><tbody>";
                        for($i = 0 ; $i < count($arr_question) ; $i++)
                        {
                            // $html .="<tr><td>  Câu ".$arr_question[$i]->getQuestionID().": ".$arr_question[$i]->getQuestion()."</td></tr>";
                            $html .="<tr><td>".$arr_question[$i]->getQuestion()."</td></tr>";
                            for($j = 0 ; $j< count($question_img) ; $j++) {
                                if($arr_question[$i]->getQuestionID() == $question_img[$j]->getQuestionID())
                                {
                                    $html .="<tr>".$question_img[$j]->getQuestion()."</tr>";
                                    break ;
                                }
                            }
                            $arr_answer = explode("@RT",$arr_question[$i]->getQuestionAnswer());
                        
                            $run = 0 ;
                            for($j = 0 ; $j < count($arr_answer) ; $j++)
                            {
                                if($arr_answer[$j] == null) {
                                    continue;
                                } 
                                if($this->find($arr_answer[$j],"EMPTY") > 0) {
                                    $html .="<tr><td><p><input class = 'list_input' type ='text' name ='".$arr_question[$i]->getQuestionID()."'></p></td></tr>";
                                    continue ;
                                }else{
                                    $html.="<tr><td><p><input class = 'list_question' type = 'radio' value ='".$arr_question[$i]->getQuestionID().chr(65+$run)."' name ='".$arr_question[$i]->getQuestionID()."'>".$arr_answer[$j]."</p></td></tr>";
                                }
                                $run++;
                            }
                        }
                        $html.="</tbody></table>";
                        return $html ;
                }else {
                    echo $file_test ;
                }
            }
        }
    
?>