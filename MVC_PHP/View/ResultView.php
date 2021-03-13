<?php

?>
<html>
    <head>
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
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
            <div class="header"> 
                <h2 style="text-align: center;">KẾT QUẢ BÀI THI </h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <p><?php ?></p>
                        <p></p>
                        <p></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div id="finish">
                            <?php echo $data['viewer']?>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>