<?php
	require("connect.php");
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$type = $_POST['type'];
		$response = array();
		if ($type == "user")
		{
			$username = $_POST['username'];
			$code = $_POST['code'];
			$sql = "SELECT * FROM `user` WHERE username = '".$username."' AND confirmationCode = ".$code."";
			$result = mysqli_query($connect,$sql);
			
			if (mysqli_num_rows($result) > 0)
			{
				$sql = "UPDATE `user` SET `isActive` = 1 WHERE `username` = '".$username."'";
				if(mysqli_query($connect,$sql))
				{
					$code = "1";
					$message = "Successfuly Registered!";
					$type = "user";
					array_push($response,array("code"=>$code,"message"=>$message,"type"=>$type));
				}
				else
				{
					$code = "3";
					$message = "".mysqli_error($connect);
					array_push($response,array("code"=>$code,"message"=>$message));
				}
			}
			else
			{
				$code = "0";
				$message = "Incorrect Code!";
				array_push($response,array("code"=>$code,"message"=>$message));
			}
		}
		else if ($type == "reset")
		{
			$username = $_POST['username'];
			$code = $_POST['code'];
			$sql = "SELECT * FROM `user` WHERE username = '".$username."' AND confirmationCode = ".$code."";
			$result = mysqli_query($connect,$sql);
			
			if (mysqli_num_rows($result) > 0)
			{
				$sql = "UPDATE `user` SET `isActive` = 1 WHERE `username` = '".$username."'";
				if(mysqli_query($connect,$sql))
				{
					$code = "1";
					$message = "Successfuly Reset Password!";
					$type = "reset";
					array_push($response,array("code"=>$code,"message"=>$message,"type"=>$type));
				}
				else
				{
					$code = "3";
					$message = "".mysqli_error($connect);
					array_push($response,array("code"=>$code,"message"=>$message));
				}
			}
			else
			{
				$code = "0";
				$message = "Incorrect Code!";
				array_push($response,array("code"=>$code,"message"=>$message));
			}
		}
		else if ($type == "biller")
		{
			$billerId = $_POST['billerId'];
			$code = $_POST['code'];

			$sql = "SELECT * FROM `biller` WHERE billerId = ".$billerId." AND confirmationCode = ".$code."";
			$result = mysqli_query($connect,$sql);
			if (mysqli_num_rows($result) > 0)
			{
				$sql = "UPDATE `biller` SET `isActive` = 1 WHERE `billerId` = ".$billerId."";
				if(mysqli_query($connect,$sql))
				{
					$code = "1";
					$message = "Successfuly Registered!";
					array_push($response,array("code"=>$code,"message"=>$message,"type"=>$type));
				}
				else
				{
					$code = "3";
					$message = "".mysqli_error($connect);
					array_push($response,array("code"=>$code,"message"=>$message));
				}
			}
			else
			{
				$code = "0";
				$message = "Incorrect Code! ";
				array_push($response,array("code"=>$code,"message"=>$message));
			}
		}
		
		echo json_encode($response);
	}
	
?>


