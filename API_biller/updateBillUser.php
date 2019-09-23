<?php
	require("connect.php");
	
	$response = array();
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$billId = $_POST['billId'];
		$billname = $_POST['billname'];
		$amount = $_POST['amount'];
		$dueDate = $_POST['dueDate'];
		$sql =  "UPDATE `bills` SET `billName`= '".$billname."',`amount`='".$amount."',`dueDate` = '".$dueDate."' WHERE `billId` = '".$billId."'";
		$result = mysqli_query($connect,$sql);
		if ($result)
		{
			$response['code'] = '1';
			$response['message'] = "Successfuly Updated!";
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = "Error Occured!";
		}
		echo "[".json_encode($response)."]";
	}
	
?>

