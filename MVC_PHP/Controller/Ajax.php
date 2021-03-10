<?php
    class Ajax extends Controller {

        function score()
        {
            echo "response ok!!";
            if(isset($_POST['_id']))
            {
                echo $this->model("FileModel")->getReadFileExcel(intval($_POST['file_id']));
            }
        }
    }
?>