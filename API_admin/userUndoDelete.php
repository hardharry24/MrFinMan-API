<?php
	require("connect.php");

	$response = array();

	$userId = $_GET['userId'];
	$todo = $_GET['type'];

	if ($todo == "DELETE")
	{
		$sql = "UPDATE `user` SET `isActive`=0 WHERE `userId` = '".$userId."'";
		if(mysqli_query($connect,$sql))
		{
			$response['code'] = '1';
			$response['message'] = 'Successfuly Deleted!';
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = ''.mysqli_error($connect);
		}
	}
	else if ($todo == "UNDO")
	{
		$sql = "UPDATE `user` SET `isActive`=1 WHERE `userId` = '".$userId."'";
		if(mysqli_query($connect,$sql))
		{
			$response['code'] = '1';
			$response['message'] = 'Successfuly Restored!';
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = ''.mysqli_error($connect);
		}
	}

	

	echo '['.json_encode($response).']';
		
?>