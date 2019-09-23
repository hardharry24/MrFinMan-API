<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$username =  $_GET['username'];
		$dateNow = date('m/Y');

		$sql = "SELECT userId FROM `user` WHERE username = '".$username."'";
		$user = mysqli_fetch_assoc(mysqli_query($connect,$sql));
	
		$sql = "SELECT expense.categoryId, SUM(expense.amount) AS amount, user_allocation.percentage FROM expense INNER JOIN user_allocation ON expense.categoryId = user_allocation.categoryId AND expense.userId = user_allocation.userId WHERE (expense.userId = '".$user['userId']."') AND DATE_FORMAT(expense.dateCreated,'%m/%Y') = '".$dateNow."'  GROUP BY expense.categoryId";


		$result = mysqli_query($connect,$sql);
		$response = array();
		
		while($cat = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['categoryId'] = $cat['categoryId'];
			$temp['amount'] = $cat['amount'];
			$temp['percentage'] = $cat['percentage'];
			array_push($response,$temp);
		}
		echo json_encode($response);
		
	}
?>


   