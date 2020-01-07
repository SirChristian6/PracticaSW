XMLHttpRequestObject = new XMLHttpRequest();
XMLHttpRequestObject.onreadystatechange = function(){
	if (XMLHttpRequestObject.readyState==4){
		var obj = document.getElementById('preguntas');
		var preguntas=XMLHttpRequestObject.responseXML.getElementsByTagName('p');
		var email=XMLHttpRequestObject.responseXML.getElementsByTagName('assessmentItem');
		var correctResponse=XMLHttpRequestObject.responseXML.getElementsByTagName('correctResponse');
		var txt="<table border=1> <tr> <th> E-mail del Autor</th> <th> Pregunta </th> <th> Respuesta </th></tr>";
		var i;
		for (i = 0; i < email.length; i++) {
			txt +="<tr><td>" +email[i].getAttribute('author')+"</td><td>"+preguntas[i].childNodes[0].nodeValue+"</td><td>"
			+correctResponse[i].getElementsByTagName('value')[0].childNodes[0].nodeValue + "</td></tr>";
		}
		txt+="</table>";
		obj.innerHTML=txt;
	}
}
function verPreguntas(){
	XMLHttpRequestObject.open("GET","../xml/Questions.xml?q="+ new Date().getTime());
	XMLHttpRequestObject.send(null);
}