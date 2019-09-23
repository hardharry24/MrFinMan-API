<?php
	require("connect.php");
	
	$response = array();
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$userId = $_POST['userId'];
		$lname = $_POST['lname'];
		$fname = $_POST['fname'];
		$mi = $_POST['mi'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$username = $_POST['username'];
		$role = $_POST['roleId'];



		$sql = "UPDATE `user` SET `lname`='".$lname."',`fname`='".$fname."',`mi`='".$mi."',`email`='".$email."',`contactNo`='".$contact."',`username`='".$username."',`roleId`='".$role."' WHERE `userId`='".$userId."'";

		$result = mysqli_query($connect,$sql);

		if ($result)
		{
			$response['code'] = "1";
			$response['message'] = "User Details Successfuly Updated!";
		}
		else
		{
			$response['code'] = "0";
			$response['message'] = "Error Occured!";
		}


	}
	echo '['.json_encode($response).']';
?>