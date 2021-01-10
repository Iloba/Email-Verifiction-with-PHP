<?php 
	
	//Require the Constants
	require 'constants.php';

	//
	$conn = mysqli_connect($server, $user, $password, $db);

	if (!$conn) {
		echo "Connection Not Established";
	}

?>