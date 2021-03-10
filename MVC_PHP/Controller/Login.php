
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
                    $totalScore = intval($result[0]["score_part_1"])+ intval($result[0]["score_part_2"]) + intval($result[0]["score_part_3"]) ; 
                    if($totalScore == 0) {
                        header("location: ../Exam/index");
                    }else {
                        $this->view("NotificationView");
                        unset( $_SESSION["user"]) ;
                        unset( $_SESSION["uid"] );
                    }
                }else {
                    $html = "<script type='text/javascript'>
                        alert('Tài khoản hoặc mật khẩu không đúng vui lòng nhập lại !!!');
                    </script>" ;
                   $this->view('Login',['failed'=>$html]);
                }
            }else{
                $html = "<script type='text/javascript'>
                alert('Tài khoản hoặc mật khẩu không đúng vui lòng nhập lại !!!');
            </script>" ;
                $this->view('Login',['failed'=>$html]);
            }
            
        
        }
        
    }
?>