<?php
/*
 *-------------------------
 * STR REPLACE LIMIT
 *-------------------------
 *
 * Because the normal str_replace_limit doesent have a limit.
 * Usefull when you know you only want to replace a string once.
 *
 */

function str_replace_limit($search, $replace, $string, $limit = 1) 
{
  if (is_bool($pos = (strpos($string, $search))))
    return $string;

  $search_len = strlen($search);

  for ($i = 0; $i < $limit; $i++) {
    $string = substr_replace($string, $replace, $pos, $search_len);

    if (is_bool($pos = (strpos($string, $search))))
      break;
  }
  return $string;
}

/*
 *-------------------------
 * BASEURL FUNCTION
 *-------------------------
 *
 *	The baseurl function is used to cordinate file paths to the application folder
 *	ex. localhost/programname/thisprogram/, for localprogramming with other files
 *	likes CSS, Jquery and such
 *
 */

function baseurl( $url="" )
{
	$rootfolder = $_SERVER['PHP_SELF'];
	$rootfolder = str_replace("/index.php", "", $rootfolder);
	$rootfolder = $rootfolder . '/' . $url;
	$rootfolder = rawurlencode($rootfolder);
	$rootfolder = str_replace("%2F", "/", $rootfolder);
	return $rootfolder;
}

/*
 *-------------------------
 * BASE IN FUNCTION
 *-------------------------
 *
 *	This function makes it quick and easy to include files with php.
 *
 */

function basein( $url="" )
{
	return $_SERVER['DOCUMENT_ROOT'] . urldecode( baseurl( $url ) );
}

/*
 *-------------------------
 * GET INCLUDE CONTENTS
 *-------------------------
 *
 *	With a normal include contents the contents will load with PHP directly.
 * 	not "generating" the PHP script within its files.
 *	get_include_contents will generate it files contents
 *
 */

function get_include_contents($filename) 
{
   	if (is_file($filename)) 
   	{
      		ob_start();
       	include $filename;
       	return ob_get_clean();
   	}
   	return false;
}

/*
 *---------------------------------------------------------------
 * DATABASE CLASS
 *---------------------------------------------------------------
 *
 *	MYSQL Database handleing, SELECT statements quick queries to use,
 *
 */

class db 
{

	protected 	$host;
	protected 	$user;
	protected 	$password;
	protected 	$database;

	protected 	$mysqli;

	private 		$config;
	
	public function __construct( $config )
	{
		$this->hostname	= $config['mysqli']['address'];
		$this->username	= $config['mysqli']['username'];
		$this->password = $config['mysqli']['password'];
		$this->database = $config['mysqli']['database'];
		
		$this->config 	= $config;

		$this->sqlConnect();
	}

	public function sqlConnect()
	{
		$this->mysqli = new mysqli( $this->hostname, $this->username, $this->password, $this->database );
		$this->mysqli->set_charset("utf8");	
	}

	public function protectPost( $string )
	{	
		$string = $mysqli->real_escape_string( $string );
		$string = strip_tags( $string );
		
		return $string;
	}

	public function sqlSelect( $query )
	{
		$results = $this->mysqli->query( $query );

		$i = 0;
		$a = array();

		while ( $r = $results->fetch_assoc() ) {
			$a[] = $r;
			$i++;
		}

		return $a;
	}

	public function sqlUpdate( $query )
	{
		$this->mysqli->query( $query );
	}

	public function sqlInsert( $query )
	{
		$this->mysqli->query( $query );
	}

	public function sqlDelete( $query )
	{
		$this->mysqli->query( $query );
	}

	public function sqlConnection()
	{
		if ( $this->mysqli->connect_error ) 
		{
   			return false;
		}
		else
		{
			return true;
		}
	}
	
}

?>