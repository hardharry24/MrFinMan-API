<?php
	require("connect.php");

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

		$ID = $_POST['userID'];
		$categoryID = $_POST['categoryID'];
		$amount = $_POST['amount'];
		$description = $_POST['note'];
		$date = $_POST['dateCreated'];
		$imgReceipt = $_POST['imgReceipt'];

		if ($imgReceipt == "NONE")
		{
			$sql2 = "INSERT INTO `expense` (`userId`, `categoryId`, `amount`, `description`, `dateCreated`,imgReciept) VALUES (".$ID .", '".$categoryID."', '".$amount."', '".$description."', '".$date."','no_image.jpg')";
					if(mysqli_query($connect,$sql2))
					{
						$response['code'] = '1';
						$response['message'] = 'Successfuly Added as Expense!';
					}
					else
					{
						$response['code'] = '0';
						$response['message'] = 'Error Occur '.mysqli_error($connect);
					}
		}
		else
		{
			$target_dir = "upload/receipt";

			$filename = rand()."_".time().".jpeg";

			$target_dir = $target_dir ."/".$filename;

			$response = array();

			if (file_put_contents($target_dir,base64_decode($imgReceipt)))
			{
				$sql2 = "INSERT INTO `expense` (`userId`, `categoryId`, `amount`, `description`, `dateCreated`,imgReciept) VALUES (".$ID .", '".$categoryID."', '".$amount."', '".$description."', '".$date."','".$filename."')";
					if(mysqli_query($connect,$sql2))
					{
						$response['code'] = '1';
						$response['message'] = 'Successfuly Added Expense!';
					}
					else
					{
						$response['code'] = '0';
						$response['message'] = 'Error Occur '.mysqli_error($connect);
					}
			}
			else
			{
				$response['code'] = '0';
				$response['message'] = 'Error Occur upon saving the image!';
			}		
		}

		
		echo '['.json_encode($response).']';
	}
?>