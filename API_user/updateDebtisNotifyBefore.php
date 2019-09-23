<?php
	require("connect.php");
	
	$response = array();
	if (isset($_POST['debtId']))
	{			
		$debtId = $_POST['debtId'];	
		$sql = "UPDATE `debt` SET `isNotifyBefore`=1 WHERE `debtId`= '".$debtId."'";
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
		$response['message'] = 'Empty Debt ID!' ;
	}	
	echo json_encode($response);
	
?>