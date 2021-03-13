$(document).ready(function(){
    var part_id = 1;
    var count = 3600 ;
    var flag = true ;
    var tempID = 1;
    var renderWindow = {
        formula : document.getElementById("question"),
        update: function(data) {
            this.formula.innerHTML = data ;
            MathJax.Hub.Queue(["Typeset",MathJax.Hub,this.formula]);
        }
    };
    $.post('./Exam/index',{file_id:part_id},function(data){

        var arr = data.split('@@@@') ;
        arr[0] = arr[0].replace("\\\\","\\\\\\\\");
        renderWindow.update(arr[0]);
        clickAnswer();
        inputUser();
    });  
    function inputUser() {
        // $("#list_input").on('input',function(evt){
        //     console.log(evt.target.value + " : " + evt.target.name) ;
           
        // }) 

        document.querySelectorAll('.list_input').forEach(item=> {
            item.addEventListener('input', event=>{
                tempID = getNumber(event.target.name) ;
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
              for(var j = 0 ; j < 4 ; j++)
              {
                  element[j].checked = false ;
              }
          }
      }

    
});