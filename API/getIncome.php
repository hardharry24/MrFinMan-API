<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$username =  $_GET['username'];
		
		$sql = "SELECT userId FROM `user` WHERE username = '".$username."'";
		$user = mysqli_fetch_assoc(mysqli_query($connect,$sql));


		$sql = "SELECT * FROM `income` WHERe categoryId = 28 AND userId = '".$user['userId']."'";
		$result = mysqli_query($connect,$sql);
		$temp = array();

		$category = mysqli_fetch_assoc($result);

		$response = array();
		if (mysqli_num_rows($result) != 0)
		{
			$temp['code'] = "1";
			$temp['message'] = "OK";
			$temp['description'] = $category['description'];
			$temp['amount'] = $category['amount'];
			$temp['periodId'] = $category['income_type'];
			$temp['dateCreated'] = $category['dateCreated'];
			array_push($response,$temp);
		}	
		else
		{
			$temp = array();
			$temp['code'] = "0";
			$temp['message'] = "Error";
			array_push($response,$temp);
		}
		echo json_encode($response);	
		
	}
?>


