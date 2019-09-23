<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		$sqlgetId = "SELECT userID FROM user WHERE user.username = '".$username."' LIMIT 1";
		$result_getID = mysqli_query($connect,$sqlgetId);
		
		$result_id = mysqli_fetch_row($result_getID); 
		$userId = $result_id[0];
	
		$sql = "SELECT * FROM `budget` WHERE budget.user_ID = '".$userId."' ORDER BY budget_ID ASC";
		$result = mysqli_query($connect,$sql);
		$response = array();
		
		while($budget = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['user_ID'] = $budget['user_ID'];
			$temp['budget_ID'] = $budget['budget_ID'];
			$temp['startDate'] = $budget['startDate'];
			$temp['endDate'] = $budget['endDate'];
			$temp['amount'] = $budget['amount'];
			$temp['note'] = $budget['note'];
			$temp['datecreated'] = $budget['datecreated'];
			$temp['timecreated'] = $budget['timecreated'];
			$temp['budget_name'] = $budget['budget_name'];
			array_push($response,$temp);
		}
		echo json_encode($response);
	}
?>

