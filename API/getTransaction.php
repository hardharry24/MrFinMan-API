<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username =  $_POST['username'];
		$sqlgetId = "SELECT userID FROM user WHERE user.username = '".$username."' LIMIT 1";
		$result_getID = mysqli_query($connect,$sqlgetId);
		
		$result_id = mysqli_fetch_row($result_getID); 
		$userId = $result_id[0];
		
		$sql = "SELECT * FROM `transaction_details` WHERE transaction_details.userID = '".$userId."' ORDER BY date DESC";
		$result = mysqli_query($connect,$sql);
		$response = array();
		
		while($transaction_details = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['transac_id'] = $transaction_details['transac_id'];
			$temp['type'] = $transaction_details['type'];
			$temp['category_name'] = $transaction_details['category_name'];
			$temp['amount'] = $transaction_details['amount'];
			$temp['date'] = $transaction_details['date'];
			$temp['budget_id'] = $transaction_details['budget_id'];
			$temp['userID'] = $transaction_details['userID'];
			array_push($response,$temp);
		}
		echo json_encode($response);
		
	}
?>


   