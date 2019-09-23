<?php
	require("connect.php");
	
	$response = array();
	if (isset($_POST['goalId']))
	{			
		$goalId = $_POST['goalId'];	
		$sql = "UPDATE `goal` SET `isNotify`=1 WHERE `goalId`= '".$goalId."'";
		$result = mysqli_query($connect,$sql);
		if ($result)
		{
			$response['code'] = "1";
			$response['message'] = "Success";
			
		}
		else
		{
			$response['code'] = "1";
			$response['message'] = "Error Occured!";
		}
	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Goal ID!' ;
	}	
	echo json_encode($response);
	
?>