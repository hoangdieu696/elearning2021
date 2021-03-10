<?php
        
         

?>

<html>
    <head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body style="align-items: center; margin-top: 20%;">

            <div style="margin: 0;">
            <p class="text" style="font-size: 40; text-align: center;"> Chúc mừng bạn <?php echo $_SESSION['user']?>  đã hoàn thành bài thi của mình </p>
            <p class="text" style="font-size: 40; text-align: center;"> Tổng số điểm ba bài thi bạn đạt được là <span style="color: red;"><?php if(isset($data['score'])){ echo $data['score'];}?></span>/150</p>
            </div>
            <?php unset($_SESSION['user']) ;session_destroy();?>
            
    </body>
</html>