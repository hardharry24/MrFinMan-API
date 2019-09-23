<?php
	
		    $response = array();
			$code = "0";
			$message = "Email already exist!";
			array_push($response,array("code"=>$code,"message"=>$message));

			echo json_encode($response);
?>