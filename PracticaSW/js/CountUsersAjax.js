function numUsers(){

	
	$.ajax({
        type: "POST",
        url: "../xml/Counter.xml",
        dataType: "xml",
	    cache: false,
	    success: function(users){
	        var cont=$(users).find("usersOnline").children().length;
	        
            $("#usuarios").html(cont);
		}
	});
}