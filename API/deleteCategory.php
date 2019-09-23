<?php
	require("connect.php");

	$userId = $_GET['userId'];
	$categoryId = $_GET['categoryId'];
	$response = array();
	$sql = "DELETE FROM `user_allocation` WHERE `userId` = '".$userId."' AND `categoryId`= '".$categoryId."'";
	if (mysqli_query($connect,$sql))
	{
		$code = "1";
		$message = "Successfuly Deleted";
		array_push($response,array("code"=>$code,"message"=>$message));
	}
	else
	{
		$code = "0";
		$message = "".mysqli_error($connect);
		array_push($response,array("code"=>$code,"message"=>$message));
	}

	echo json_encode($response);
?>

