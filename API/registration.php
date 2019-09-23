<?php
	require("connect.php");
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$lname = $_POST['lname'];
		$fname = $_POST['fname'];
		$mi = $_POST['mi'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$userType = $_POST['userType']; 
		$codeConf = $_POST['codeConfirmation'];


		
		$sql = "SELECT * FROM `user`  WHERE email = '".$email."'";
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		if (mysqli_num_rows($result) > 0)
		{
			$code = "0";
			$message = "Email already exist!";
			array_push($response,array("code"=>$code,"message"=>$message));
			//echo $message;
		}
		else
		{
			$sql = "SELECT * FROM `user`  WHERE contactNo = '".$contact."'";
			$result = mysqli_query($connect,$sql);

			if (mysqli_num_rows($result) > 0)
			{
				$code = "1";
				$message = "Contact number is already existed!";
				array_push($response,array("code"=>$code,"message"=>$message));
			}
			else
			{
				$sql = "SELECT * FROM `user`  WHERE username = '".$username."'";
				$result = mysqli_query($connect,$sql);

				if (mysqli_num_rows($result) > 0)
				{
					$code = "2";
					$message = "Username is already taken!";
					array_push($response,array("code"=>$code,"message"=>$message));
				}
				else
				{
					$sql ="INSERT INTO `user`( `lname`, `fname`, `mi`, `email`, `contactNo`, `username`, `password`, `roleId`,`confirmationCode` )VALUES ('".$lname."',
					'".$fname."','".$mi."','".$email."','".$contact."','".$username."','".$password."','".$userType."',".$codeConf.")";
					if (mysqli_query($connect,$sql))
					{
						$code = "3";
						$message = "Successfuly Save!";
						array_push($response,array("code"=>$code,"message"=>$message));
					}
					else
					{
						$code = "4";
						$message = $codeConf."".mysqli_error($connect);
						array_push($response,array("code"=>$code,"message"=>$message));
					}
				}
			}


		}
		echo json_encode($response);
	}
	
?>


