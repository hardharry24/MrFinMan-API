<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username =  $_POST['username'];
		
		$sql = "SELECT user.username, user_allocation.percentage,user_allocation.isPriority,Category.categoryDesc, Category.categoryIcon,Category.categoryId FROM Category INNER JOIN user_allocation ON Category.categoryId = user_allocation.categoryId INNER JOIN User ON user_allocation.userId = user.userId WHERE (Category.categoryTypeId = 1) AND user.username = '".$username."' ORDER BY `categoryDesc` ASC";
		
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($category = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['Name'] = $category['categoryDesc'];
			$temp['Percentage'] = $category['percentage'];
			$temp['Icon'] = $category['categoryIcon'];
			$temp['catID'] = $category['categoryId'];
			$temp['isPriority'] = $category['isPriority'];//isPriority
			array_push($response,$temp);
		}
		echo json_encode($response);
		
	}
?>


   