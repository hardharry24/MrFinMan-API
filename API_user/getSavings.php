<?php
	require("connect.php");
	
	$response = array();
	//date_default_timezone_set('Asia/Kuala_Lumpur');
	if (isset($_GET['username']))
	{		
		$username = $_GET['username'];	
		$dateNow = date('m/Y');
		$sql = "SELECT * FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Total'";

		$totalSavings = null;
		$result = mysqli_query($connect,$sql);
		$fetchSaving = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result))
		{
			$response['code'] = '1';
			$response['totalSavings'] = $fetchSaving['amount'];
			$totalSavings = $fetchSaving['amount'];
		}
		else
		{
			$response['code'] = '0';
			$response['totalSavings'] = '0.0';
		}

		$sql = "SELECT SUM(amount) as amount FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Additional' OR type='Budget Remaining'";
		$result = mysqli_query($connect,$sql);

		$fetchSaving = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result))
		{
			$response['code'] = '1';
			if ($fetchSaving['amount'] == null)
			{
				$totalSavings = '0.0';
			}
			else{
				 $totalSavings += $fetchSaving['amount'];
			}

			$response['totalSavings'] = $totalSavings;
		}
		else
		{
			$response['code'] = '1';
			$response['totalSavings'] = '0.0';
		}

		$sql = "SELECT SUM(amount) as amount FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Additional' AND DATE_FORMAT(saving.dateCreated,'%m/%Y') = '".$dateNow."'";
		$result = mysqli_query($connect,$sql);

		$fetchSaving = mysqli_fetch_assoc($result);
		if ($fetchSaving['amount'] != null)
			$response['SavingsThisMonth'] = $fetchSaving['amount'];
		else
			$response['SavingsThisMonth'] = '0.0';


	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Username!' ;
	}	
	echo "[".json_encode($response)."]";
	
