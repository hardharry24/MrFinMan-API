<?php
	require("connect.php");
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		
		$sqlgetId = "SELECT userID FROM user WHERE user.username = '".$username."' LIMIT 1";
		$result_getID = mysqli_query($connect,$sqlgetId);
		
		$result_id = mysqli_fetch_row($result_getID); 
		$userId = $result_id[0];
	
		
		$sql = "SELECT * FROM `budget` WHERE budget.user_ID = '".$userId."' 
		        AND NOW() >= budget.startDate OR NOW() <= budget.endDate LIMIT 1";
		
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		$budget = mysqli_fetch_row($result); 
		if ($budget != null)
		{
			$temp = array();
			$temp['budget_name'] = $budget[8];
			$temp['amount'] = $budget[4];
			$temp['startDate'] = $budget[2];
			$temp['endDate'] = $budget[3];
			$temp['budget_id'] = $budget[0];
				
			array_push($response,$temp);
			
			echo json_encode($response);
		}
		else
		{
			echo "0";
		}	
		
		
		 
		 
	}
?>