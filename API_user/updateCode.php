<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['username']))
	{		
		$username = $_GET['username'];
		$code = $_GET['code'];		
		$sql = "UPDATE user SET confirmationCode = '".$code."' WHERE user.username = '".$username."'";
		 $result = mysqli_query($connect,$sql);
		
		if ($result)
		{
			$response['code'] = '1';
			$response['message'] = 'true';
			$response['code2'] = $code;
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