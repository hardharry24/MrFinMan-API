<?php
	require("connect.php");
	
	$type = $_GET['type'];
	$id = $_GET['Id'];


	$response = array();
	if ($type == "DELETE") {
		$sql = "UPDATE `goal` SET `isDeleted`= 1  WHERE `goalId`= '".$id."'";
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
		$sql = "UPDATE `goal` SET `isDeleted`= 0  WHERE `goalId`= '".$id."'";
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

	echo  "[".json_encode($response)."]";

?>