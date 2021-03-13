$(document).ready(function(){
    sessionStorage.removeItem('count');
    sessionStorage.removeItem('id_file');
    $('#start').click( function(){

            // $.post('./Exam/index',{file_id :"123"}, function(data){
            //     console.log(data) ;
            // });
         window.location="./show";
    });

    $('#reseen').click(function(){
        window.location="./result";
    })
});