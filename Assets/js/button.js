$(document).ready(function(){
     function showButtonMark() {
         var btn = "" ;

         for(var i = 1 ; i <= 50 ; i++)
         {
                btn+="<button class='btn_user_mark' id = 'btn_"+i+"'>"+i+" </button>";
                if(i % 6 == 0 && i != 1 ) btn +="<br>" ;
         }
         $('.btn_mark').html(btn) ;
     }
     showButtonMark();
});