<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['username']))
	{		
		$username = $_GET['username'];	
		$date =  $_GET['date'];	
		$sql = "select SUM(amount) as amount from debt JOIN user ON user.userId = debt.userId WHERE user.username = '".$username."' AND date_format(str_to_date(dueDate, '%m/%d/%Y'), '%m/%Y') = '".$date."' ";
		 $result = mysqli_query($connect,$sql);
		
		if (mysqli_num_rows($result))
		{
			$fetch = mysqli_fetch_assoc($result);
			
			if ($fetch['amount'] != null)
			{
				$response['dbtAmount'] = $fetch['amount'];
				$response['code'] = '1';
				$response['message'] = 'true';
			}
			else
			{
				$response['dbtAmount'] = "0.0";
				$response['code'] = '0';
				$response['message'] = 'false';
			}
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = 'false';
		}
	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Username!' ;
	}	
	echo "[".json_encode($response)."]";
	
?>