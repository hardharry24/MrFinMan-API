<?php
	require("connect.php");
		$username =  $_GET['username'];
		
		$sql = "SELECT * FROM `user` where username = '".$username."'";
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($user = mysqli_fetch_assoc($result))
		{
			//$temp = array();
			$response['userID'] = $user['userId'];
			$response['lastname'] = $user['lname'];
			$response['firstname'] = $user['fname'];
			$response['MI'] = $user['mi'];
			$response['username'] = $user['username'];
			$response['contactNo'] = $user['contactNo'];
			$response['email'] = $user['email'];
			$response['billerId'] = $user['billerId'];
			$response['password'] = $user['password'];
			$response['roleId'] = $user['roleId'];
		}
		echo json_encode($response);
	
?>


   