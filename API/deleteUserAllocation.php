<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['username']))
	{		
		$username = $_GET['username'];	
		$sql = "SELECT * FROM `user` WHERE user.username='".$username."'";
		$result = mysqli_query($connect,$sql);
		$result = mysqli_fetch_assoc($result);
		$userId = $result["userId"];

		$sqlDelete = "DELETE FROM `user_allocation` WHERE `userId` = '".$userId."'";
		$result = mysqli_query($connect,$sqlDelete);

		if ($result)
		{
			$response['code'] = '1';
			$response['message'] = 'Success!' ;
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = 'Error Occured!' ;
		}
	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Username!' ;
	}	
	echo "[".json_encode($response)."]";
	
?>