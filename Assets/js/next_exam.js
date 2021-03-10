$(document).ready(function(){

    var id = 2 ;
    function nextExam() {
        document.getElementById('next').onclick = function(){ loadExam(id)};
    }

    function loadExam(id) {
        $.post('',{file_id:id}, function(data){
                console.log(data) ;
        });
    }
});