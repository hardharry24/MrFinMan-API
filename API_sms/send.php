<?php
	// Authorisation details.
	if (isset($_GET['pnumber']) && isset($_GET['message'])) {
		
		//$username = "teamcipherfinman@gmail.com";
		//$hash = "6cb226de8c77d090b5e223ccb77dbec2ddbfdaa007033992a5763f7bcb9b1fa6";

		$username = "chuanickie1998@gmail.com";
		$hash = "1c7db837620d1133c0c88b9950d7ccfcd27b5528c029043214ecc15b13e7bf3a";

		// Config variables. Consult http://api.txtlocal.com/docs for more info.
		$test = "0";

		// Data for text message. This is the text message data.
		$sender = "Mr. FinMan"; // This is who the message appears to be from.
		$numbers = $_GET['pnumber']; // A single number or a comma-seperated list of numbers
		$message = $_GET['message'];
		// 612 chars or less
		// A single number or a comma-seperated list of numbers
		$message = urlencode($message);
		$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
		$ch = curl_init('http://api.txtlocal.com/send/?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); // This is the result from the API
		curl_close($ch);

		echo "[".$result."]";
	}
	
?>