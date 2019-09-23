<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['userId_1']) && isset($_GET['userId_2']))
	{		
		$userId_1 = $_GET['userId_1'];	
		$userId_2 = $_GET['userId_2'];

		$sql = "SELECT * FROM `messages` JOIN user ON user.userId = messages.userId WHERE user.userId = $userId_1 OR user.userId = $userId_2 ORDER BY messages.created ASC";
		$results = mysqli_query($connect,$sql);

		while($msg = mysqli_fetch_assoc($results))
		{
			$temp = array();
			$temp['id'] = $msg['id'];
			$temp['userId'] = $msg['userId'];
			$temp['created'] = $msg['created'];
			$temp['message'] = $msg['message'];
			if ($msg['roleId'] == 1)
				$temp['type'] = 'USER';
			else if ($msg['roleId'] == 2)
				$temp['type'] = 'BILLER';
			
			array_push($response,$temp);
		}
		
	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Username!' ;
	}	
	echo json_encode($response);

	
?>