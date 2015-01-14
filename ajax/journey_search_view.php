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
 * SEARCH THE JOURNEY
 *---------------------------------------------------------------
 */

	foreach ( $_GET AS $key => $value )
	{
		$_GET[$key] = $db->protectPost($value);
	}

	$_GET['baseurl'] = "http://localhost/xno_st.xno.li/";

	$json = file_get_contents( $_GET['baseurl'] . "ajax/journey_search.php?fromPoint=".urlencode($_GET['fromPoint'])."&fromId=".urlencode($_GET['fromId'])."&toPoint=".urlencode($_GET['toPoint'])."&toId=".urlencode($_GET['toId'])."");

	$array = json_decode($json, true);


	/*
	 *---------------------------------------------------------------
	 * GIVE FAST TIME AND TIME UNTIL DESTINATION IS REACHED
	 *---------------------------------------------------------------
	 */

	
	
	function giveRealTime( $skanetrafikenTime )
	{
		$x = explode("T", $skanetrafikenTime);
		$x = $x[1];
		$x = explode(":", $x);
		return $x[0] . ":" . $x[1];
		return $skanetrafikenTime;
	}

	function timeAppart( $first, $second )
	{
		$first  = str_replace(":", "", $first);
		$app  	= new DateTime($first . ":00");
		$second  = str_replace(":", "", $second);
		$depp 	= new DateTime($second . ":00" );

		$interval = $depp->diff($app);

		return $interval->format("%h%i");
	}







	$foreachSecond = false;
	?>
	<?php foreach ( $array AS $num ): ?>
		<div class="row info-row <?php if ( $foreachSecond == true ): print 'second'; $foreachSecond = false; else: $foreachSecond = true; endif; ?>">
			<div class="col-xs-1 text-center"><?php print giveRealTime( ( isset($num['RouteLinks']['RouteLink'][0]['DepDateTime'] ) ? $num['RouteLinks']['RouteLink'][0]['DepDateTime'] : $num['RouteLinks']['RouteLink']['DepDateTime'] ) ); ?></div>
			<div class="col-xs-1 text-center"><?php print giveRealTime( ( isset($num['RouteLinks']['RouteLink'][0]['ArrDateTime'] ) ? $num['RouteLinks']['RouteLink'][0]['ArrDateTime'] : $num['RouteLinks']['RouteLink']['ArrDateTime'] ) ); ?></div>
			<div class="col-xs-2 text-center"><?php //print timeAppart( giveRealTime( $num['RouteLinks']['RouteLink']['DepDateTime'] ), giveRealTime( $num['RouteLinks']['RouteLink']['ArrDateTime'] ) ); ?></div>
			<div class="col-xs-1 text-center"><?php print $num['NoOfChanges']; ?></div>
			<div class="col-xs-2 text-center"><img></div>
			<div class="col-xs-2 text-center"><?php print $num['Prices']['PriceInfo'][0]['Price']; ?> kr</div>
			<div class="col-xs-2 text-center"><img></div>
		</div>
	<?php endforeach; ?>