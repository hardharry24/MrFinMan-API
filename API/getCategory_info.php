<?php
//getCategory_info
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		$budget_id = $_POST['budget_id'];
		
		$sqlgetId = "SELECT userID FROM user WHERE user.username = '".$username."' LIMIT 1";
		$result_getID = mysqli_query($connect,$sqlgetId);
		
		$result_id = mysqli_fetch_row($result_getID); 
		$userId = $result_id[0];
		
		$sql = "SELECT * FROM `category` ";
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($category = mysqli_fetch_assoc($result))
		{
			$temp = array();
			
			array_push($response,$temp);
			
		}
		echo json_encode($response)
	}
?>