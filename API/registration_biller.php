<?php
	require("connect.php");
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		$billername = $_POST['billername'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$code = $_POST['code'];

		
		$sql = "SELECT * FROM `biller` WHERE billerEmail = '".$email."'";
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
			$sql = "SELECT * FROM `biller`  WHERE billerContactno = '".$contact."'";
			$result = mysqli_query($connect,$sql);

			if (mysqli_num_rows($result) > 0)
			{
				$code = "1";
				$message = "Contact is already exist!";
				array_push($response,array("code"=>$code,"message"=>$message));
			}
			else
			{
					$sql ="INSERT INTO `biller`( `billerName`, `billerAddress`, `billerContactno`, `billerEmail`,`confirmationCode`) VALUES('".$billername."','".$address."','".$contact."','".$email."','".$code."')";
					$results = mysqli_query($connect,$sql);
					if ($results)
					{
						$sql = "SELECT * FROM `biller` WHERE `billerName` ='".$billername."'"; //
						$results = mysqli_query($connect,$sql);
						$billId = mysqli_fetch_assoc($results);

						$biller_id = $billId['billerId'];

						$sql = "UPDATE `user` SET `isBiller` = 1 , billerId = '".$biller_id."',`isActive` = 1  WHERE `username` = '".$username."'";//.$biller_id.
						if (mysqli_query($connect,$sql))
						{
							$code = "3";
							$message = "Successfuly Save!";
							array_push($response,array("code"=>$code,"message"=>$message,"billerId"=>$biller_id));
						}
						else
						{
							$code = "4";
							$message = "".mysqli_error($connect);
							array_push($response,array("code"=>$code,"message"=>$message));
						}
					}
					else
					{
						$code = "5";
						$message = "".mysqli_error($connect);
						array_push($response,array("code"=>$code,"message"=>$message));
					}
			}

		}
		echo json_encode($response);
	}
	
?>


