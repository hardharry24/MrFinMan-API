<?php
	require("connect.php");
	$response = array();
	$sql = "SELECT * FROM `priorities` WHERE  `isActive` = 1";
	$result = mysqli_query($connect,$sql);
	
	while($pr = mysqli_fetch_assoc($result))
	{
			$temp = array();
			$temp['pId'] = $pr['pId'];
			$temp['categoryId'] = $pr['categoryId'];
			$temp['percentage'] = $pr['percentage'];
			array_push($response,$temp);
	}
	echo json_encode($response);
?>
