<?php
	require("connect.php");
	
	$response = array();
	if (isset($_POST['debtId']) && isset($_POST['balance']))
	{			
		$debtId = $_POST['debtId'];	
		$balance = $_POST['balance'];	

		$sql = "SELECT `amount` FROM `debt` WHERE `debtId`= '".$debtId."'";
		$debtDetails = mysqli_fetch_assoc(mysqli_query($connect,$sql));

		$rem = $debtDetails['amount'] - $balance;

		$sql = "UPDATE `debt` SET `balance`='".$rem."' WHERE `debtId`= '".$debtId."'";
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