<?php

	$message = array("message" => "Hello","code"=>"1");

	$msg =  "[".json_encode($message)."]";

	echo "".$msg;
?>