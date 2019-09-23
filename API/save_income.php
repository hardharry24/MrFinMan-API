<?php
	require("connect.php");

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$type = $_POST['type'];
	

		if ($type == "insert")
		{
			$ID = $_POST['userID'];
			$categoryID = $_POST['categoryID'];
			$amount = $_POST['amount'];
			$typePayment = $_POST['payment'];
			$noteDesc = $_POST['noteDesc'];
			$dateCreated = $_POST['dateCreated'];
			$amountDetails = $_POST['amountDetails'];

			$sql = "SELECT * FROM `income` WHERE userId = ".$ID." AND categoryId =".$categoryID." AND amount = ".$amount." ";
			$result = mysqli_query($connect,$sql);
			
			$response = array();
			if (mysqli_num_rows($result)>0)
			{
				echo "0";
			}
			else
			{
				$sql = "INSERT INTO `income` ( `userId`, `categoryId`,`amountDetails`, `amount`, `description`, `income_type`, `dateCreated`)VALUES (".$ID .", ".$categoryID.",'".$amountDetails."', ".$amount.", '".$noteDesc."','".$typePayment."', '".$dateCreated."')";
				if(mysqli_query($connect,$sql))
					echo "1";
				else
					echo "3".mysqli_error($connect);
			}		
		}
		else if ($type == "update")
		{
			$ID = $_POST['userID'];
			$categoryID = $_POST['categoryID'];
			$amount = $_POST['amount'];
			$typePayment = $_POST['payment'];
			$noteDesc = $_POST['noteDesc'];
			$dateCreated = $_POST['dateCreated'];
			$amountDetails = $_POST['amountDetails'];

			$sql = "UPDATE `income` SET  `amountDetails` = '".$amountDetails."', `amount`=".$amount.",`description`='".$noteDesc."',`income_type`='".$typePayment."',`dateCreated`='".$dateCreated."' WHERE `categoryId` = 28 AND `userId` = ".$ID."";
			if(mysqli_query($connect,$sql))
				echo "1";
			else
				echo "3".mysqli_error($connect);
		}
		mysqli_close($connect);
	}
?>