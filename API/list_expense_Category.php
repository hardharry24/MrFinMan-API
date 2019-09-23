<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		
		$sql = "SELECT * FROM `category` WHERE type='expense' ORDER BY category_Desc";
		
		
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($category = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['Name'] = $category['category_Desc'];
			$temp['Icon'] = $category['icon'];
			$temp['catID'] = $category['category_ID'];
			array_push($response,$temp);
		}
		echo json_encode($response);
		
	}
?>


   