<?php
	require("connect.php");
	
	$type = $_GET['type'];
	$id = $_GET['Id'];
	$tbl = $_GET['tbl'];


	$response = array();
	if ($tbl == "Expense")
	{
		if ($type == "DELETE") {
			$sql = "UPDATE `expense` SET `isDeleted`= 1  WHERE `expenseId`= '".$id."'";
			if(mysqli_query($connect,$sql))
			{
				$response['code'] = '1';
				$response['message'] = 'Successfuly Deleted!';
			}
			else
			{
				$response['code'] = '0';
				$response['message'] = ''.mysqli_error($connect);
			}

		}
		else if ($type == "UNDO")
		{
			$sql = "UPDATE `expense` SET `isDeleted`= 0  WHERE `expenseId`= '".$id."'";
			if(mysqli_query($connect,$sql))
			{
				$response['code'] = '1';
				$response['message'] = 'Successfuly Restored!';
			}
			else
			{
				$response['code'] = '0';
				$response['message'] = ''.mysqli_error($connect);
			}
		}
	}
	else
	{
		if ($type == "DELETE") {
			$sql = "UPDATE `income` SET `isDeleted`= 1  WHERE `incomeId`= '".$id."'";
			if(mysqli_query($connect,$sql))
			{
				$response['code'] = '1';
				$response['message'] = 'Successfuly Deleted!';
			}
			else
			{
				$response['code'] = '0';
				$response['message'] = ''.mysqli_error($connect);
			}

		}
		else if ($type == "UNDO")
		{
			$sql = "UPDATE `income` SET `isDeleted`= 0  WHERE `incomeId`= '".$id."'";
			if(mysqli_query($connect,$sql))
			{
				$response['code'] = '1';
				$response['message'] = 'Successfuly Restored!';
			}
			else
			{
				$response['code'] = '0';
				$response['message'] = ''.mysqli_error($connect);
			}
		}

	}
	echo  "[".json_encode($response)."]";

?>