<?php
/**
 * @package AutoComplex
 * @version 0.1
 */
/*
Plugin Name: AutoComplex
Plugin URI: http://math.hawaii.edu/wordpress/bjoern/
Description: Provides a shortcode for nondeterministic automatic complexity. Example: [complexity string="0110"] is replaced by the string 3.
Author: Bjoern Kjos-Hanssen
Version: 0.1
Author URI: http://math.hawaii.edu/wordpress/bjoern/
*/

class run { // an optimal run for automaton complexity
	public $string = "";
	public $complexity = "";
	public $witness = "";
	public $witnessArray = array();

	public function curl($request = "http://math.hawaii.edu/") {
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $request);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	/*
	for use when combining curl and https (ssl), courtesy of:
	http://stackoverflow.com/questions/316099/cant-connect-to-https-site-using-curl-returns-0-length-content-instead-what-c
	*/
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
	//
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
	}

	
	function __construct($string) {
		$this->string = $string;
		

		$len = strlen($string);
		$datum = json_decode(
			$this->curl(
				"http://math.hawaii.edu/~bjoern/complexity-api/?string=$string"
			)
		);
		$this->complexity = $datum->complexity;
		$this->witness = $datum->witness;
		$this->witnessArray = str_split($this->witness);
		$this->witnessArray = array_map('hexdec', $this->witnessArray);// replace (a, 8) by (10, 8) for example.
	}	
}

function complexity_of( $atts ) {
	extract( shortcode_atts( array(
		'string' => '',//default
		'witness' => '0',//default
	), $atts ) );
	$myRun = new run($string);
	return (string) $myRun->complexity;
}
add_shortcode( 'complexity', 'complexity_of' );
?>

