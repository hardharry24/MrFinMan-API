<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['username']))
	{		
		$username = $_GET['username'];	
		$sql = "SELECT * FROM `biller` JOIN user ON biller.billerId = user.billerId WHERE user.username = '".$username."' AND  user.roleId = 2";
		$result = mysqli_query($connect,$sql);
		while($res = mysqli_fetch_assoc($result))
		{
			$response['billerId'] = $res['billerId'];
			$response['billerName'] = $res['billerName'];
			$response['billerContactno'] = $res['billerContactno'];
			$response['billerEmail'] = $res['billerEmail'];
		}
	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Username!' ;
	}	
	echo "[".json_encode($response)."]";
	
?>