<?php
	require("connect.php");
	
	$response = array();
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$lname = $_POST['lname'];
		$fname = $_POST['fname'];
		$mi = $_POST['mi'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$role = $_POST['roleId'];


		$sql = "INSERT INTO `user` (`lname`, `fname`, `mi`, `email`, `contactNo`, `username`, `password`, `roleId`, `isActive` ) VALUES ('".$lname."', '".$fname."', '".$mi."','".$email."', '".$contact."', '".$username."', '".$password."', '".$role."', '1')";

		$result = mysqli_query($connect,$sql);

		if ($result)
		{
			$response['code'] = "1";
			$response['message'] = "User Added Successfuly!";
		}
		else
		{
			$response['code'] = "0";
			$response['message'] = "Error Occured! ".mysqli_error($connect);
		}


	}
	echo '['.json_encode($response).']';
?>