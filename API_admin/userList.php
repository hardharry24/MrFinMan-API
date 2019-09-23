<?php
	require("connect.php");

	$response = array();
	$todo = $_GET['todo'];
	if ($todo == "DELETED")
	{
			$sql = "SELECT `userId`,`lname`,`fname`,`mi`,`email`,`contactNo`,`username`,`roleId`,`isActive`,`isLock` FROM `user` WHERE `isActive` =0";

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
	}
	else if ($todo == "ACTIVE")
	{
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
	}
	else if ($todo == "RESTORE")
	{
		$temp = array();
		$userId = $_GET['userId'];
		$sql = "UPDATE `user` SET `isActive`= 1 WHERE `userId`='".$userId."'";

		$result = mysqli_query($connect,$sql);

		if ($result)
		{
			$temp['code'] = "1";
			$temp['message'] = "User Successfuly Restored!";
			array_push($response,$temp);
		}
		else
		{
			$temp['code'] = "0";
			$temp['message'] = "Error Occured!";
			array_push($response,$temp);
		}
		
		echo json_encode($response);
	}
?>