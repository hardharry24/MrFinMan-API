<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['todo']))
	{		
		$todo = $_GET['todo'];
		if ($todo == "CANCEL")
		{
			$billId = $_GET['billId'];
			$sql = "UPDATE `bills` SET `isActive` = 0, `status` = 'cancel' WHERE `billId` = '".$billId."'";
			$result = mysqli_query($connect,$sql);
			if ($result)
			{
				$response['code'] = '1';
		     	$response['message'] = "Successfuly Canceled!";
			}
			else
			{
				$response['code'] = '0';
		     	$response['message'] = "Error Occured!";
			}
		}
		else if ($todo == "EDIT")
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
		     	$response['message'] = "Successfuly Canceled!";
			}
			else
			{
				$response['code'] = '0';
		     	$response['message'] = "Error Occured!";
			}
		}






		// $username = $_GET['username'];	
		// $dateNow = date('m/Y');
		// $sql = "SELECT * FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Total'";

		// $totalSavings = null;
		// $result = mysqli_query($connect,$sql);
		// $fetchSaving = mysqli_fetch_assoc($result);

		// if (mysqli_num_rows($result))
		// {
		// 	$response['code'] = '1';
		// 	$response['totalSavings'] = $fetchSaving['amount'];
		// 	$totalSavings = $fetchSaving['amount'];
		// }
		// else
		// {
		// 	$response['code'] = '0';
		// 	$response['totalSavings'] = '0.0';
		// }

		// $sql = "SELECT SUM(amount) as amount FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Additional' OR type='Budget Remaining'";
		// $result = mysqli_query($connect,$sql);

		// $fetchSaving = mysqli_fetch_assoc($result);
		// if (mysqli_num_rows($result))
		// {
		// 	$response['code'] = '1';
		// 	if ($fetchSaving['amount'] == null)
		// 	{
		// 		$totalSavings = '0.0';
		// 	}
		// 	else{
		// 		 $totalSavings += $fetchSaving['amount'];
		// 	}

		// 	$response['totalSavings'] = $totalSavings;
		// }
		// else
		// {
		// 	$response['code'] = '1';
		// 	$response['totalSavings'] = '0.0';
		// }

		// $sql = "SELECT SUM(amount) as amount FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Additional' AND DATE_FORMAT(saving.dateCreated,'%m/%Y') = '".$dateNow."'";
		// $result = mysqli_query($connect,$sql);

		// $fetchSaving = mysqli_fetch_assoc($result);
		// if ($fetchSaving['amount'] != null)
		// 	$response['SavingsThisMonth'] = $fetchSaving['amount'];
		// else
		// 	$response['SavingsThisMonth'] = '0.0';


	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Username!' ;
	}	
	echo "[".json_encode($response)."]";
	
