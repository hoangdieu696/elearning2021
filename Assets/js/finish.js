$(document).ready(function(){
   var id = 1 ;
   var sec , min ;
   var timer ;
   var count = 3600 ;
   var is_btn = false ;
   var refresh = false;
   function hiddenSubmitFinally() {
      document.getElementById('submit-finally').style.visibility="hidden" ;
   }
   hiddenSubmitFinally();
  //  if(id == 1) 
  //  {
  //   timerTest(count);
  //   $('#title_test').html("TƯ DUY ĐỊNH LƯỢNG");
  //  }

   window.onload = function() 
   {
     
     console.log("LOADING----------------------------------------------------------------\n") ;
      id =  parseInt(sessionStorage.getItem("id_file")) ;
      count = parseInt(sessionStorage.getItem("count")) ;
      if(isNaN(id))
      {
         id = 1 ;
      }
      if(isNaN(count)){
          if(id == 1 ) count = 4500 ;
          else if(id == 2) count = 3600 ;
          else if(id == 3) count = 3600 ;
          else count = 0 ;
      }
      console.log(count+ " : " + id +"\n") ;
      if(id == 1)
      {
        $('#title_test').html("TƯ DUY ĐỊNH LƯỢNG");
        timerTest(count);
        refresh = true ;
      }
      else if(id == 2) {
        $('#title_test').html("TƯ DUY ĐỊNH TÍNH");
        timerTest(count);
        refresh = true ;
        postData(id);
      //   clickAnswer();
      //    inputUser();
       }else if(id == 3) {
        $('#title_test').html("BÀI THI KHOA HỌC");
        document.getElementById('submit-finally').style.visibility ="visible" ;
        timerTest(count);
        refresh = true ;
        postData(id);
       }
      Remove_Mark_Question() ;
      Remove_User_Select() ;
   }

    var renderWindow = {
        formula : document.getElementById("question"),
        update: function(data) {
            this.formula.innerHTML = data ;
            MathJax.Hub.Queue(["Typeset",MathJax.Hub,this.formula]);
        }
    };
   function Remove_Mark_Question() {
      for(var i = 1 ; i <= 50 ; i++){
          var element = document.getElementById("btn_"+String(i));
          element.classList.remove('addColor');
        //$('btn_'+i).removeClass('addColor');
      }
    }
    function Remove_User_Select() {
        for(var i  = 1 ; i <= 50 ; i++)
        {
            var element = document.getElementsByName(String(i)) ;
            if(element.length == 1 ){
                  element[0].value = "";
                  continue;
            }
            for(var j = 0 ; j < element.length ; j++)
            {
                element[j].checked = false ;
            }
        }
    }
      document.getElementById('submit-finally').onclick = function() {
         id++;
         sessionStorage.removeItem('count');
         sessionStorage.removeItem('id_file');
         $.post("./Exam/show",{_id:String(id),answer: getAnswerFinish()},function(data){
            console.log(data);
            document.getElementById('submit-finally').style.visibility ="hidden" ;
            window.location='./score' ;
         });
         //    
         
            
      }
      document.getElementById('submit').onclick = function(){ 
        
        var res = confirm("Bạn có chăc chắn nộp bài không hay không") ;
        if(res == true )
        {
          id++ ; 
          sessionStorage.removeItem('count');
          sessionStorage.removeItem('id_file');
          refresh =false ;
          is_btn = true ;
          clearInterval(timer);
            if(id == 2) {
              count = 3600 ;
              $('#title_test').html("TƯ DUY ĐỊNH TÍNH");
            
            
           }else if(id == 3) {
            document.getElementById('submit-finally').style.visibility ="visible" ;
            // clickAnswer();
            // inputUser();
            $('#title_test').html("BÀI THI KHOA HỌC");
            count = 3600 ;

          }
           finishTest(id,count) ;  
         
        } ;
      }
      function finishTest(id,count) {
            postData(id,count);
            Remove_Mark_Question() ;
            Remove_User_Select() ;
      }
   
      function postData(id,count){
         console.log(getAnswerFinish());
         var result = getAnswerFinish();
        
         $.post('Exam/show.php',{_id:String(id), answer: result}, function(data){
              console.log(data);
              var arr = data.split('@@@@');
               if (refresh ==  0 ) timerTest(count);
               renderWindow.update(data) ;
               clickAnswer();
               inputUser();
          });
      }
      function getAnswerFinish() 
      {
         var arr="";
         for(var i = 1 ; i <= 50 ; i++)
            {
              var x = document.getElementsByName(i);
              var is_ans = 0 ;
              arr += i+":";
               if(x.length == 1 )
               {
                  arr += String(x[0].value)+"->";
                  continue ;
               }
              for(var j = 0 ; j < x.length ; j++ )
              {
                  if(x[j].checked == true )
                  {
                    is_ans = 1 ;
                    arr += String(String.fromCharCode(j+65))+"->" ;
                    break ;
                  }
              }
              if(!is_ans) {
                 arr+="zzzz"+"->";
              }
            }
            return arr;
             
      }
      function timerTest(count) {
       
        timer = setInterval(function(){
         
         var timerTest ="";
         var seconds = "" ;
         var minutes ="";
         if(count >= 0 )
         {
            console.log("id-file", id ) ;
            if(count/60 < 10 ) minutes= "0";
            minutes += parseInt(count/60)+" : ";
            if(count%60 < 10 ) seconds+="0";
            seconds += parseInt(count%60);
            sessionStorage.setItem("id_file",id);
            sessionStorage.setItem("count",count);
         }
        
         $('#timer_test').html(minutes+seconds) ;
         if(count <= -1 )
         {

            clearInterval(timer)
           
            if(is_btn == false ) alert("Bạn đã hoàn thi bài thi. Vui lòng chuyển sang bài thi tiếp theo !!!") ;
            id++;
            sessionStorage.clear();
            postData(id);
            // if(id == 2) {
            //   $('#title_test').html("TƯ DUY ĐỊNH TÍNH");
            // }else {
            //   $('#title_test').html("BÀI THI KHOA HỌC");
            // }
            
         }
         count--;
        },1000);
       
        
     }
    
     function inputUser() {
      // $("#list_input").on('input',function(evt){
      //     console.log(evt.target.value + " : " + evt.target.name) ;
         
      // }) 

      document.querySelectorAll('.list_input').forEach(item=> {
          item.addEventListener('input', event=>{
              var tempID = getNumber(event.target.name) ;
              console.log(tempID);
              eventColorButton(tempID);
          })
      });
  }
  function clickAnswer() {
      document.querySelectorAll('.list_question').forEach(item => {
          item.addEventListener('click',event=>{

              var data = event.target.value ;
             
              var tempID = getNumber(data) ;
              console.log(tempID) ;
              eventColorButton(tempID);
          })
      });
  }
  function getNumber(data)
  {
      var tempID =  parseInt(data[0]) ;
      if((data[1] >='0' && data[1] <='9')) {
         tempID = tempID*10  + parseInt(data[1]) ;
      }
      return tempID ;
  }
  function eventColorButton(tempID) {
      var x = document.getElementById("btn_"+tempID);
      x.className += " addColor";
  }

     
      
});