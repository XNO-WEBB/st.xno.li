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


	print $db->sqlConnection();