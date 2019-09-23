<?php
	require("connect.php");
	$category = "Health";
	$categoryType = "Income";
	
	
	$sql = "SELECT * FROM `category` WHERE category_Desc = '".$category."' AND category_Type = '".$categoryType."'";
	$result = mysqli_query($connect,$sql);
	
	$response = array();
	if (mysqli_num_rows($result)>0)
	{
		echo '0';
	}
	else
	{
		$sql = "INSERT INTO category(category_Desc,category_Type)values('".$category."','".$categoryType."')";
		$result = mysqli_query($connect,$sql);
		
		echo '1';
	}		
	mysqli_close($connect);
?>