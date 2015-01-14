<?php
/*---------------------------------------------------------------
 * 				AJAX TEMPLATE EXAMPLE
 *--------------------------------------------------------------- */


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
	require( '../config/config.php' 	);
	require( '../config/main.php' 		);

/*
 *---------------------------------------------------------------
 * INITIATE CLASSES
 *---------------------------------------------------------------
 */
	// Database handleing
	$db 		= new db( $config );

/*
 *---------------------------------------------------------------
 * SEARCH FOR THE STATION
 *---------------------------------------------------------------
 */


	foreach ( $_GET AS $key => $value )
	{
		$_GET[$key] = $db->protectPost($value);
	}


	$api_url 		= "http://www.labs.skanetrafiken.se/v2.2/resultspage.asp";
	$api_call 		= "?cmdaction=next&selPointFr=".urlencode($_GET['fromPoint'])."|".urlencode($_GET['fromId'])."|0&selPointTo=".urlencode($_GET['toPoint'])."|".urlencode($_GET['toId'])."|0&LastStart=" . date("Y-m-d%20H:i");
		
	$xml 			= file_get_contents( $api_url . $api_call );
	$xml 			= str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $xml);
	$xml 			= simplexml_load_string($xml);
	$xml			= json_encode($xml);
	$xml			= json_decode($xml, true);
		
	$points 		= $xml['Body']['GetJourneyResponse']['GetJourneyResult']['Journeys']['Journey'];
	$api_response 	= json_encode($points);
	print $api_response; 