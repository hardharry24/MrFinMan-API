<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username =  $_POST['username'];
		
		$sql = "SELECT category.category_ID,  category.icon, category.category_Desc, category_details.percentage FROM category_details LEFT OUTER JOIN category ON 
		       category_details.category_ID = category.category_ID INNER JOIN user ON category_details.user_ID = user.userID WHERE 
			    user.username = '".$username."' AND category.type = 'expense' ORDER BY `category_details_ID` ASC";
		
		
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($category = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['Name'] = $category['category_Desc'];
			$temp['Percentage'] = $category['percentage'];
			$temp['Icon'] = $category['icon'];
			$temp['catID'] = $category['category_ID'];
			array_push($response,$temp);
		}
		echo json_encode($response);
		
	}
?>


   