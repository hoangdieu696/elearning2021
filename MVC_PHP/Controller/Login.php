
<?php
       if(isset($_SESSION["user"]))
        {
           
            header("location: ../Exam/index");
        }
    class Login extends Controller{

        public function User()
        {
            $this->view('Login',[]);
        }
        public function checkLogin() {
            
             if(isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password']))
            {
                $user = $_POST['username'] ;
                $pass = $_POST['password'] ;
                $data = $this->model('UserModel');
                $result = $data->checkLogin($user,$pass) ;
                if($result > 0) {

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION["uid"] = $data->getIDUser($user,$pass);
                    $_SESSION["user"] = $data->getUserName($user,$pass);
                    $data = $this->model("ScoreModel") ;
                    $result = $data->getScore($_SESSION["uid"]) ;
                    $getExam = $data->getExamID_Uid($_SESSION["uid"]) ;
                    $exam_id = $getExam[0]['exam_id'] ;
                    $team_id = $getExam[0]['team_id'];
                    $_SESSION["exam_id"] =  $exam_id;
                    $_SESSION["team_id"] =  $team_id;
                   
                    if($data->checkExamID_Uid($_SESSION['uid'])) {
                        $res = $this->model("ReseenModel") ;
                        $res->insertDB($_SESSION['exam_id'], $_SESSION['uid']);
                        header("location: ../Exam/index");
                    }
                    else {
                        unset($_SESSION['user']) ;
                        unset($_SESSION['uid']) ;
                        unset($_SESSION['exam_id']) ;
                        unset($_SESSION['team_id']) ;
                        unset($_SESSION['total']) ;
                        session_destroy();
                        
                           
                            $html = "<script type='text/javascript'>
                                    window.location ='./User';
                            </script>" ;

                        
                         $this->view('Login',['failed'=>$html]);                        
                    }
            
                }else {
                    unset($_SESSION['user']) ;
                    unset($_SESSION['uid']) ;
                    unset($_SESSION['exam_id']) ;
                    unset($_SESSION['team_id']) ;
                    session_destroy();
                    $html = "<script type='text/javascript'>
                     var res = confirm('Tài khoản hoặc mật khẩu không đúng vui lòng nhập lại !!!');
                         if(res == true) {
                            window.location ='./User';
                        }else {
                            window.location ='./User';
                        }
                    </script>" ;
                   $this->view('Login',['failed'=>$html]);
                }
            }else{
                unset($_SESSION['user']) ;
                unset($_SESSION['uid']) ;
                unset($_SESSION['exam_id']) ;
                unset($_SESSION['team_id']) ;
                session_destroy();
                $html = "<script type='text/javascript'>
                var res = confirm('Tài khoản hoặc mật khẩu không đúng vui lòng nhập lại !!!');
                if(res == true) {
                   window.location ='./User';
               }else {
                   window.location ='./User';
               }
            </script>" ;
                $this->view('Login',['failed'=>$html]);
            }
            
        
        }
        
    }
?>