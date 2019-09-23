<?php
	require("connect.php");
	
	$response = array();


	date_default_timezone_set('Asia/Kuala_Lumpur');
	/*if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{*/	
		$todo = $_GET['todo'];	
		
		if ($todo == 'Savings')
		{
			$userId = $_GET['userId'];	
			$amount = $_GET['amount'];	
			$dateCreated = $_GET['dateCreated'];	

			$sql = "SELECT * FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.userId = '".$userId."' AND type='Total'";
			$result = mysqli_query($connect,$sql);
			$fetchSaving = mysqli_fetch_assoc($result);

			if (mysqli_num_rows($result))
			{
				$totalSaving = $fetchSaving['amount'] + $amount;
				$sql = "UPDATE `saving` SET `amount`='".$totalSaving."',`dateCreated`='".$dateCreated."' WHERE `savingId`='".$fetchSaving['savingId']."'";
				if (mysqli_query($connect,$sql))
				{
					$response['code'] = '1';
					$response['message'] = 'Successfuly Updated!';
				}
				else
				{
					$response['code'] = '0';
					$response['message'] = 'Error Occured!';
				}
			}
			else
			{

					$sql = "INSERT INTO `saving` (`amount`, `userId`, `dateCreated`,`categoryId`, `type`) VALUES ( '".$amount."', '".$userId."','', '".$dateCreated."', 'Total')";
					if (mysqli_query($connect,$sql))
					{
						$response['code'] = '1';
						$response['message'] = 'Success';
					}
					else
					{
						$response['code'] = '0';
						$response['message'] = 'Error Occured!';
					}
			}
		}
		else if ($todo == 'addSavings')
		{

			$userId = $_GET['userId'];	
			$amount = $_GET['amount'];	
			$categoryId = $_GET['categoryId'];	
			$dateCreated = $_GET['dateCreated'];	

			$sql = "INSERT INTO `saving` (`amount`, `userId`, `dateCreated`,`categoryId`,`type`) VALUES ( '".$amount."', '".$userId."', '".$dateCreated."', '".$categoryId."', 'Additional')";
					if (mysqli_query($connect,$sql))
					{
						$response['code'] = '1';
						$response['message'] = 'Success';
					}
					else
					{
						$response['code'] = '0';
						$response['message'] = 'Error Occured!';
					}
		}
		else if ($todo == 'RemSavings')
		{
			$userId = $_GET['userId'];	
			$amount = $_GET['amount'];	
			$categoryId = $_GET['categoryId'];	
			date_default_timezone_set('Asia/Kuala_Lumpur');
			$dateCheck = date('m/Y', strtotime($_GET['dateCreated']) );	
			$dateCreated = $_GET['dateCreated'];
			//echo "".$dateCreated;

			$sql = "SELECT * FROM `saving` WHERE DATE_FORMAT(saving.dateCreated,'%m/%Y') = '".$dateCheck."' AND `userId` = '".$userId."' AND `categoryId` = '".$categoryId."'";
			$result = mysqli_query($connect,$sql);
			if (  mysqli_num_rows($result) > 0)
			{
				$sql = "UPDATE `saving` SET `amount`='".$amount."' WHERE DATE_FORMAT(saving.dateCreated,'%m/%Y') = '".$dateCreated."' AND `userId` = '".$userId."' AND `categoryId` = '".$categoryId."'";
				if (mysqli_query($connect,$sql))
					{
						$response['code'] = '1';
						$response['message'] = 'Success';
					}
					else
					{
						$response['code'] = '0';
						$response['message'] = 'Error Occured!';
					}
			}
			else
			{
				$sql = "INSERT INTO `saving` (`amount`, `userId`, `dateCreated`,`categoryId`,`type`) VALUES ( '".$amount."', '".$userId."', '".$dateCreated."', '".$categoryId."', 'Budget Remaining')";
					if (mysqli_query($connect,$sql))
					{
						$response['code'] = '1';
						$response['message'] = 'Success';
					}
					else
					{
						$response['code'] = '0';
						$response['message'] = 'Error Occured!';
					}
			}
		}
		else if ($todo == 'update')
		{
			date_default_timezone_set('Asia/Kuala_Lumpur');
			$dateNow = date('m/Y');
			$userId = $_GET['userId'];	
			$amount = $_GET['amount'];	
			$dateCreated = $_GET['dateCreated'];	

			$sql = "UPDATE `saving` SET `amount`='".$amount."',`dateCreated`='".$dateCreated."' WHERE DATE_FORMAT(saving.dateCreated,'%m/%Y') = '".$dateNow."' AND userId= '".$userId."' AND `categoryId` = '27'";
				if (mysqli_query($connect,$sql))
				{
					$response['code'] = '1';
					$response['message'] = 'Successfuly Updated!';
				}
				else
				{
					$response['code'] = '0';
					$response['message'] = 'Error Occured!';
				}


		}
	
		echo "[".json_encode($response)."]";
	//}	
?>