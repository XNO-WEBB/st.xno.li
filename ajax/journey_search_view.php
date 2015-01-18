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

	function apiCall( $call )
	{
		$xml 			= file_get_contents( $call );
		$xml 			= str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $xml);
		$xml 			= simplexml_load_string($xml);
		$xml			= json_encode($xml);
		$xml			= json_decode($xml, true);

		return $xml;
		//http://www.labs.skanetrafiken.se/v2.2/stationresults.asp?selPointFrKey=81216&selDirection=0&inpTime=20:20&inpDate=150126
	}
	
	
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
		$app  		= new DateTime($first);
		$depp 		= new DateTime($second);

		$interval 	= $depp->diff($app);

		$min 		= $interval->format("%i");
		$h			= $interval->format("%H");

		if ( strlen($min) == 1 )
		{
			$min = "0" . $min;
		}
		if ( strlen($h) == 1 )
		{
			$h = "0" . $h;
		}



		return $h . ":" . $min;
	}

	
	$foreachSecond = false;
	?>
	<?php foreach ( $array AS $num ): ?>
		<?php 
		$departureTime = giveRealTime( ( isset($num[0]['DepDateTime'] ) ? $num[0]['DepDateTime'] : $num['DepDateTime'] ) );
		$arrivalTime   = giveRealTime( ( isset($num[0]['ArrDateTime'] ) ? $num[0]['ArrDateTime'] : $num['ArrDateTime'] ) );
		?>
		<div class="row info-row <?php if ( $foreachSecond == true ): print 'second'; $foreachSecond = false; else: $foreachSecond = true; endif; ?>">
			<div class="col-xs-2	col-sm-1	col-md-1	col-lg-1 wrap-it"><?php print $departureTime; ?></div>
			<div class="col-xs-2	col-sm-1	col-md-1	col-lg-1 wrap-it"><?php print $arrivalTime; ?></div>
			<div class="col-xs-2	col-sm-2	col-md-2	col-lg-2 wrap-it"><?php print timeAppart( $departureTime, $arrivalTime );; ?></div>
			<div class="col-xs-2	col-sm-2	col-md-2	col-lg-2 wrap-it"><?php print $num['NoOfChanges']; ?></div>
			<div class="hidden-xs	col-sm-2	col-md-2	col-lg-2 wrap-it">&nbsp;</div>
			<div class="col-xs-2	col-sm-2	col-md-2	col-lg-2 wrap-it"><span style="position: absolute"><?php print $num['Prices']['PriceInfo'][0]['Price']; ?> kr</span></div>
			<div class="col-xs-1	col-sm-2	col-md-2	col-lg-2 wrap-it">&nbsp;</div>
			<div class="close-j">
				<div class="col-xs-12" style="padding-top: 10px;">
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-5">FRÅN-TILL</div>
						<div class="col-xs-2">LÄGE</div>
						<div class="col-xs-2">TID</div>
						<div class="col-xs-1">INFO</div>
					</div>
					<?php foreach( $num['RouteLinks']['RouteLink'] AS $key => $value ): ?>
					<div class="row" style="padding: 7px 0px;">
						<div class="col-xs-1"><?php print $value['Line']['TransportModeId']; ?></div>
						<div class="col-xs-5"><?php print $value['From']['Name']; ?><br> - <?php print $value['To']['Name']; ?></div>
						<div class="col-xs-2"></div>
						<div class="col-xs-2"><?php print giveRealTime($value['DepDateTime']); ?><br><?php print giveRealTime($value['ArrDateTime']); ?></div>
						<div class="col-xs-1"></div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>











