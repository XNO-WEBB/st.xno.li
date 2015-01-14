$(function(){


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

	$(".search_input").keyup(function(event){
		var input 		= $(this);
		var parent 		= input.parent();
		var placeHolder = parent.children(".placeholder");

		$.ajax({
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