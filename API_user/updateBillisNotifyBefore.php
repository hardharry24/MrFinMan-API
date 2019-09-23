<?php
	require("connect.php");
	
	$response = array();
	if (isset($_POST['billId']))
	{			
		$billId = $_POST['billId'];	
		$sql = "UPDATE `bills` SET `isNotifyBefore`=1 WHERE `billId`= '".$billId."'";
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
		$response['message'] = 'Empty Bill ID!' ;
	}	
	echo json_encode($response);
	
?>