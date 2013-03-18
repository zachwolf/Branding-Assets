<?php 

	/*

	// for debugging:

	function writeToFile($file, $string, $obj) {

		$ws = "\n\r\n\r";

		fwrite($file, $string);
		fwrite($file, $ws);

		fwrite($file, is_array($obj) || is_object($obj) ? print_r($obj, true) : $obj);
		fwrite($file, $ws);
		
	}

	$myFile = "test.txt";
	$fh = fopen($myFile, 'w') or die("can't open file");

	writeToFile($fh, "\$_GET", $_GET);

	fclose($fh);

	*/

	try {

		$test_against 		= array("name" => "", 				// github username
															"secret_key" => ""); 	// configured secret key in hook URL

		$payload 					= $_POST[payload];
		$stripped_payload = stripcslashes($payload);
		$json 						= json_decode($stripped_payload, true);

		$pusher_name 			= $json[pusher][name];
		$secret_key				= $_GET[secret_key];

		if($pusher_name !== $test_against[name]) {
			throw new Exception($pusher_name . " does not have correct permissions", 1);
		}

		if($secret_key !== $test_against[secret_key]) {
			throw new Exception("Secret keys don't match.", 1);
		}

		`git pull`;

	} catch (Exception $e) {
		die($e->getMessage());
	}

