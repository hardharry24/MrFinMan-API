<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username =  $_POST['username'];
		
		$sql = "SELECT * FROM `user` where username = '".$username."'";
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($user = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['userID'] = $user['userId'];
			$temp['lastname'] = $user['lname'];
			$temp['firstname'] = $user['fname'];
			$temp['MI'] = $user['mi'];
			$temp['username'] = $user['username'];
			$temp['contactNo'] = $user['contactNo'];
			$temp['email'] = $user['email'];
			$temp['billerId'] = $user['billerId'];
			$temp['roleId'] = $user['roleId'];
			array_push($response,$temp);
		}
		echo json_encode($response);
	}
?>


   