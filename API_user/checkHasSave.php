<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['username']))
	{		
		$username = $_GET['username'];	
		date_default_timezone_set('Asia/Kuala_Lumpur');
		$dateNow = date('m/Y');
		//echo "".$dateNow;
		 $sql = "SELECT * FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Additional' AND DATE_FORMAT(saving.dateCreated,'%m/%Y') = '".$dateNow."'";
		 $result = mysqli_query($connect,$sql);
		
		if (mysqli_num_rows($result))
		{
			$fetch = mysqli_fetch_assoc($result);
			$response['code'] = '1';
			$response['message'] = 'true';
			$response['amount'] = $fetch['amount'];
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = 'false';
			$response['amount'] = '0.00';
		}
	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Username!' ;
	}	
	echo "[".json_encode($response)."]";
	
?>