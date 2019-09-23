<?php
require("connect.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		$username =  $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM user WHERE username = '".$username."' AND password ='".$password."'";
		$result = mysqli_query($connect,$sql);
		$response = array();
		
		if (mysqli_num_rows($result) >0 )
		{
			$fetch = mysqli_fetch_assoc($result);
			$type = "".$fetch['roleId'];
			if ($fetch['isActive'] != "0")
			{
				if ($fetch['isLock'] == true)
				{
					$code = "3";
					$message = "Oops! Your account is currently de-activated by the administrator!";
					array_push($response,array("code"=>$code,"message"=>$message));
				}
				else
				{
					$code = "1";
					$message = "Successfuly Logged In!";
					array_push($response,array("code"=>$code,"message"=>$message,"type"=>$type));
				}
			}
			else
			{
				$code = "0";
				$message = "Oops! Account Not Yet Verified!";

				
				if ($type == 2)
					$params = $fetch['billerId'];
				else if ($type == 1)
					$params = $fetch['username'];

				$fullname = "".$fetch['lname'].", ".$fetch['fname']." ";
			
				array_push($response,array("code"=>$code,"message"=>$message,"type"=>$type,"params"=>$params,"fullname"=>$fullname));
			}
		}
		else
		{
			$code = "2";
			$message = "Invalid Credentials!";
			array_push($response,array("code"=>$code,"message"=>$message));
		}
		echo json_encode($response);
}
?>
