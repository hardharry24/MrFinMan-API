<?php
	require("connect.php");
	
	$response = array();
	if (isset($_POST['goalId']) && isset($_POST['targetDate']) && isset($_POST['todo']))
	{			
		$goalId = $_POST['goalId'];	
		$todo = $_POST['todo'];	
		$targetDate = $_POST['targetDate'];	
		if ($todo == "DUEDATE")
		{
			$sql = "UPDATE `goal` SET `targetDate`= '".$targetDate."' WHERE `goalId`= '".$goalId."'";
			$result = mysqli_query($connect,$sql);
			if ($result)
			{
				$response['code'] = "1";
				$response['message'] = "Success";
				
			}
			else
			{
				$response['code'] = "1";
				$response['message'] = "Error Occured!";
			}
		}
		else if ($todo == "DELETE")
		{
			$sql = "UPDATE `goal` SET `isDeleted`= '1' WHERE `goalId`= '".$goalId."'";
			$result = mysqli_query($connect,$sql);
			if ($result)
			{
				$response['code'] = "1";
				$response['message'] = "Success";
				
			}
			else
			{
				$response['code'] = "1";
				$response['message'] = "Error Occured!";
			}
		}
		
	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Goal ID!' ;
	}	
	echo json_encode($response);
	
?>