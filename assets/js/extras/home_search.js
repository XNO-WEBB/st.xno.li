function home_search()
{
	var array = [];

	$(".search_input").each(function(){
		var input 		= $(this);
		var parent 		= input.parent();
		var placeHolder = parent.children(".placeholder");

		if ( placeHolder.html().length == 0 )
		{
			input.animate({
				backgroundColor: "#333",
				color: "#fff"
			}, 300);
		}
		else
		{
			array.push( placeHolder.html() );
			array.push( placeHolder.data("id") );
		}

	});

	if ( array.length == 4 )
	{
		window.location.href = baseurl + "journey/" + array[0] + "/" + array[1] + "/" + array[2] + "/" + array[3];
	}
}


$(function(){

	$(".search_input").click(function(){
		$(this).animate({
			backgroundColor: "#fff",
			color: "#000"
		}, 300);
	});

    $("html").html( navigator.geolocation.getCurrentPosition( showPosition ) );

    function showPosition(position) {
    	var valLength = $("#from").data("id");
    	if ( valLength.length == 0 )
    	{
    		$.ajax({
    			url: baseurl + "ajax/station_coordinates_search.php",
    			type: "GET",
    			data: {
    				x: position.coords.latitude,
    				y: position.coords.longitude 
    			},
    			success: function(response)
    			{
    				jsonResponse = JSON.parse( response );
	
    				var fromDiv = $("#from");
	
    				fromDiv.html( jsonResponse[0]['Name'] );
					fromDiv.data( "id", jsonResponse[0]['Id'] );
    			}
    		});
    	}
	}

	var request;
	$(".search_input").keyup(function(event){

	/*	if ( typeof request !== 'undefined' )
		{
			request.abort();
		} */
		
		var input 		= $(this);
		var parent 		= input.parent();
		var placeHolder = parent.children(".placeholder");
	
		request = $.ajax({
			url: baseurl + "ajax/station_search.php",
			type: "GET",
			data: {
				stationName: input.val()
			},
			success: function( response )
			{
				jsonResponse = JSON.parse( response );
	
				placeHolder.html( jsonResponse[0]['Name'] );
				placeHolder.data( "id", jsonResponse[0]['Id'] );
			}
		});


		
	});

});