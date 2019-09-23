<?php
	require("connect.php");

	$response = array();

	$userId = $_GET['userId'];
	$todo = $_GET['todo'];

	if ($todo == "LOCK")
	{
		$sql = "UPDATE `user` SET `isLock`=1 WHERE `userId` = '".$userId."'";
		if(mysqli_query($connect,$sql))
		{
			$response['code'] = '1';
			$response['message'] = 'Successfuly Lock!';
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = ''.mysqli_error($connect);
		}


		// $response['code'] = 'LOCK '.$userId;
		// $response['message'] = ''.mysqli_error($connect);
	}
	else if ($todo == "UNLOCK")
	{
		$sql = "UPDATE `user` SET `isLock`=0 WHERE `userId` = '".$userId."'";
		if(mysqli_query($connect,$sql))
		{
			$response['code'] = '1';
			$response['message'] = 'Successfuly Un-Lock!';
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = ''.mysqli_error($connect);
		}

		// $response['code'] = 'UNLOCK '.$userId;
		// $response['message'] = ''.mysqli_error($connect);
	}

	

	echo '['.json_encode($response).']';
		
?>