<?php
	require("connect.php");
	
	$response = array();
	
	if (isset($_GET['username']) && isset($_GET['categoryId']))
	{		
		$temp = array();
		$username = $_GET['username'];
		$categoryId = $_GET['categoryId'];
		$date = date('m/Y');

		$sql = "SELECT SUM(amount) as sum from expense JOIN user ON expense.userId = user.userId WHERE user.username = '".$username."'  AND expense.categoryId = '".$categoryId."'  AND DATE_FORMAT(expense.dateCreated, '%m/%Y') =  '".$date."' AND expense.isDeleted= 0";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_assoc($result);
		$sum = $row['sum'];

		$temp['code'] = '1';
		if($sum == null)
			$temp['amount'] = '0.0';
		else
			$temp['amount'] = $sum;
		array_push($response,$temp);
	
	}	
	else
	{
		$temp['code'] = '0';
		$temp['message'] = 'Empty Username!';
		array_push($response,$temp);
	}	
	echo json_encode($response);
	
?>