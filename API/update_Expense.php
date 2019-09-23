<?php
	require("connect.php");

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$expId = $_POST['Id'];
		$ID = $_POST['userID'];
		$categoryID = $_POST['categoryID'];
		$amount = $_POST['amount'];
		$description = $_POST['note'];
		$date = $_POST['dateCreated'];
		$imgReceipt = $_POST['imgReceipt'];


		if ($imgReceipt == "NONE")
		{
			$sql = "UPDATE `expense` SET `categoryId`='".$categoryID."',`amount`='".$amount."',`description`='".$description."',`dateCreated`='".$date."' WHERE expenseId = '".$expId."'";
			if(mysqli_query($connect,$sql))
					{
						$response['code'] = '1';
						$response['message'] = 'Successfuly Updated Expense!';
					}
					else
					{
						$response['code'] = '0';
						$response['message'] = 'Error Occur '.mysqli_error($connect);
					}

		}else{

			$target_dir = "upload/receipt";

			$filename = rand()."_".time().".jpeg";

			$target_dir = $target_dir ."/".$filename;

			$response = array();

			if (file_put_contents($target_dir,base64_decode($imgReceipt)))
			{
				$sql2 ="UPDATE `expense` SET `categoryId`='".$categoryID."',`amount`='".$amount."',`description`='".$description."',`dateCreated`='".$date."', `imgReciept`='".$filename."' WHERE expenseId = '".$expId."'";

					if(mysqli_query($connect,$sql2))
					{
						$response['code'] = '1';
						$response['message'] = 'Successfuly Updated Expense!';
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