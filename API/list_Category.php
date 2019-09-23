<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "SELECT * FROM `category` where categoryTypeId = 1 AND NOT category.categoryId = 31 ORDER BY categoryDesc ASC";
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($category = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['ID'] = $category['categoryId'];
			$temp['Desc'] = $category['categoryDesc'];
			$temp['Icon'] = $category['categoryIcon'];
			array_push($response,$temp);
		}
		echo json_encode($response);
	}
?>

