function getWeather(lat, lon){
	$.getJSON("https://api.openweathermap.org/data/2.5/weather?lat="+lat+"&lon="+lon+"&units=metric&APPID=265d48f61f4cee1ed62db6d95214792b", function(result){
	    $('#prev').html(result.weather[0].description);
	  	var temp=result.main.temp;
	  	$('#temp').html(temp.toFixed(2));
	  	temp=result.main.temp_min;
	  	$('#tempMin').html(temp.toFixed(2));
	  	temp=result.main.temp_max;
	  	$('#tempMax').html(temp.toFixed(2));
	  	$('#hum').html(result.main.humidity);
	  	$('#pres').html(result.main.pressure);
	  	$('#vel').html(result.wind.speed);
	  	var d = new Date();
	  	$('#fecha').html(d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear());
	});
}