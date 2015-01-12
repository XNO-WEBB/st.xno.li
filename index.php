<?php
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */

	ini_set('display_errors',1);
	error_reporting(E_ALL|E_STRICT);

/*
 *---------------------------------------------------------------
 * SESSION HANDELING
 *---------------------------------------------------------------
 *
 *	Use this ID for checking if user have actually visited the
 *	page before downloading something, or making a request to 
 *	an AJAX page.
 *
 */
	session_start();

	if ( !isset($_SESSION['id']) )
	{
		$_SESSION['id'] = rand(1000,1000000);
	}


/*
 *---------------------------------------------------------------
 * REQUIRE PHP FUNCTIONS & FILES
 *---------------------------------------------------------------
 */
	require( 'config/config.php' 	);
	require( 'config/main.php' 		);

/*
 *---------------------------------------------------------------
 * INITIATE CLASSES
 *---------------------------------------------------------------
 */
	// Database handleing
	$db 		= new db( $config );

	// Get URL_DATA array
	$url_data = str_replace_limit( baseurl() , "", $_SERVER['REQUEST_URI'], 1);
	$url_data = explode("?", $url_data);
	$url_data = explode("/", $url_data[0]);
	foreach ( $url_data as $key => $data ) 
	{	
		if ( strlen( $data ) > 0 )
		{
			$globalData['url_data'][$key] = $data;
		}
	}
	

/*																
 *---------------------------------------------------------------
 * BUILD PAGE VARIABLE WITH PARTIALS AND OTHER VARIABLES
 *---------------------------------------------------------------
 */
	// Partials
	$globalPage['partials']['top'] 		= get_include_contents( basein("assets/partials/top.php") );
	$globalPage['partials']['navbar'] 	= get_include_contents( basein("assets/partials/navbar.php") );
	$globalPage['partials']['bottom'] 	= get_include_contents( basein("assets/partials/bottom.php") );

/*																
 *---------------------------------------------------------------
 * FIGURE OUT WHAT KIND OF PAGE TO SEND
 *---------------------------------------------------------------
 *
 *	Check if the some URL_DATA isset, otherwise go to Home page
 *	else check if there is a controller for the wanted page, if
 *	there is, send it through.
 *	If both cases are Rejected then its a 404 error	
 *
 */

	if ( !isset($globalData['url_data'][0]) )
	{
		include basein("controllers/home.php");
	}
	elseif ( file_exists( basein("controllers/" . $globalData['url_data'][0] . ".php") ) )
	{
		include basein("controllers/" . $globalData['url_data'][0]);
	}
	else
	{
		include basein("/_errorpages/404.php");
	}