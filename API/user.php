<?php
	require("connect.php");

	$response = array();

			$sql = "SELECT `userId`,`lname`,`fname`,`mi`,`email`,`contactNo`,`username`,`roleId`,`isActive`,`isLock` FROM `user` WHERE `isActive` =1";

			$results = mysqli_query($connect,$sql);

			while($user = mysqli_fetch_assoc($results))
			{
				$temp = array();
				$temp['userId'] = $user['userId'];
				$temp['lname'] = $user['lname'];
				$temp['fname'] = $user['fname'];
				$temp['mi'] = $user['mi'];
				$temp['email'] = $user['email'];
				$temp['username'] = $user['username'];
				$temp['contactNo'] = $user['contactNo'];
				$temp['roleId'] = $user['roleId'];
				$temp['isActive'] = $user['isActive'];
				$temp['isLock'] = $user['isLock'];
				array_push($response,$temp);
			}
			echo json_encode($response);
		
?>