<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['username']))
	{			
		$username = $_GET['username'];	
		$sql = "SELECT * FROM `biller` JOIN user ON biller.billerId = user.billerId WHERE user.roleId = 2 AND user.username = '".$username."'";
		$billerInfo = mysqli_fetch_assoc(mysqli_query($connect,$sql));
		
		$response['billerId'] = $billerInfo['billerId'];
		$response['billerName'] = $billerInfo['billerName'];
		$response['billerAddress'] = $billerInfo['billerAddress'];
		$response['billerContactno'] =  $billerInfo['billerContactno'];
		$response['billerEmail'] = $billerInfo['billerEmail'];
		$response['userId'] = $billerInfo['userId'];
		$response['lname'] = $billerInfo['lname'];
		$response['fname'] =$billerInfo['fname'];
		$response['mi'] = $billerInfo['mi'];
		$response['email'] = $billerInfo['email'];
		$response['contactNo'] = $billerInfo['contactNo'];
		$response['contactNo'] = $billerInfo['contactNo'];
		$response['password'] = $billerInfo['password'];
	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Parameter' ;
	}	
	echo json_encode($response);
?>
