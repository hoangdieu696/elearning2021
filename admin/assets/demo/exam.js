//******************************************************************************
//******************************************************************************
function getRequest(link, func){
	var http = new XMLHttpRequest();
	http.open('GET', link);
	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200){
			func(http.responseText);
		}
	}
	http.send(null);
}

function postRequest(link, data, func){
	var http = new XMLHttpRequest();
	http.open('POST', link, true);
	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200){
			func(http.responseText);
		}
	}
	http.send(data);
}