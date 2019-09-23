<?php
	require("connect.php");
	
	
		$lname = $_POST['lname'];
		$fname = $_POST['fname'];
		$mi = $_POST['mi'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$usernameFrom = $_POST['usernameFrom'];
		$username = $_POST['username'];
		$password = $_POST['password'];


		$sql = "SELECT * FROM `user`  WHERE email = '".$email."' AND NOT username = '".$usernameFrom."'";
		$result = mysqli_query($connect,$sql);


		$sql = "SELECT * FROM `user`  WHERE email = '".$email."' AND NOT username = '".$usernameFrom."'";
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		if (mysqli_num_rows($result) > 0)
		{
			$response['code'] = "0";
			$response['message'] = "Email already exist!";
		}
		else
		{
			$sql = "SELECT * FROM `user`  WHERE contactNo = '".$contact."' AND NOT username = '".$usernameFrom."'";
			$result = mysqli_query($connect,$sql);

			if (mysqli_num_rows($result) > 0)
			{
				$response['code'] = "1";
				$response['message'] = "Contact number is already existed!";
			}
			else
			{
				$sql = "SELECT * FROM `user`  WHERE username = '".$username."' AND NOT username = '".$usernameFrom."'";
				$result = mysqli_query($connect,$sql);

				if (mysqli_num_rows($result) > 0)
				{
					$response['code'] = "2";
					$response['message'] = "Username is already taken!";
				}
				else
				{
					$sql ="UPDATE `user` SET `lname`='".$lname."',`fname`='".$fname."',`mi`='".$mi."',`email`='".$email."',`contactNo`='".$contact."',`username`='".$username."',`password`='".$password."' WHERE username = '".$usernameFrom."'";
					if (mysqli_query($connect,$sql))
					{
						$response['code'] = "3";
						$response['message'] = "Successfuly Updated Record!";
					}
					else
					{
						$response['code'] = "4";
						$response['message'] = $codeConf."".mysqli_error($connect);
					}
				}
			}


		}
		echo json_encode($response);
	
	
?>


