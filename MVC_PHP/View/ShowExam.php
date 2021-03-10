
<html>
    <head>
        <meta charset="utf-8">
            <link rel="stylesheet" type ="text/css" href="../Assets/css/layout.css">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <meta name="viewport" content="width=device-width">
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript" src="../Assets/js/question.js"></script>
            <script type="text/javascript" src="../Assets/js/button.js"></script>        
            <script  type="text/javascript" src="../Assets/js/finish.js"></script>
    
            <script type="text/javascript" src="../Library/MathJax/MathJax.js">
                MathJax.Hub.Config({
                    extensions: ["tex2jax.js","TeX/AMSmath.js","TeX/AMSsymbols.js"],
                    jax: ["input/TeX","output/HTML-CSS"],
                    tex2jax: {
                        inlineMath: [['$','$'],["\\(","\\)"]],
                        processEscapes: true,
                    },
                });
            </script>
            <script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
            <script
                src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML">
            </script>
        </head>
    <body>
        <div class="app">
            <div class="app_header">
                <p> Xin chao bạn <?php echo $_SESSION["user"]?> đã tham gia cuộc thi</p>
            </div>
            <div class="app_container">
                <div class="app_left_container">
                        <p class="text_center"> ĐỀ THI </p>
                        <div class="cmath" id="question">

                        </div>
                </div>
                <div class="app_right_container">
                    <div class="form-right"> 
                        <div class="right_header">
                            <div class="text_center"> 
                                <p>THỜI GIAN </p> <p  style="font-size: 35; margin: 0; padding: 0; margin-bottom: 20px;" id="timer_test"></p></div>
                            <div class="text_center"> <p id="title_test"> </p></div>
                            
                        </div>
                        <div class="right_container">
                                <div class="btn_mark"></div>
                        </div>
                        <div class="right_footer">
                                <button class="btn_next" id="submit"> Phần tiếp theo </button>
                                <button class="btn_next" id="submit-finally" > Nộp bài  </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html> 
