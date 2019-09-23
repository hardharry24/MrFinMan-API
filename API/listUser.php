<?php
	require("connect.php");
	
	$sql = "SELECT `userId`, `lname`, `fname`, `mi`, `email`, `contactNo`, `username`  FROM `user` WHERE `roleId` = 1 AND isActive = 1 ORDER BY lname ASC";
	$result = mysqli_query($connect,$sql);
	
	$response = array();
	
	while($users = mysqli_fetch_assoc($result))
	{
		$temp = array();
		$temp['ID'] = $users['userId'];
		$temp['lastname'] = $users['lname'];
		$temp['firstname'] = $users['fname'];
		$temp['MI'] = $users['mi'];
		$temp['email'] = $users['email'];
		$temp['username'] = $users['username'];
		$temp['contactNo'] = $users['contactNo'];
		array_push($response,$temp);
		
	}
	echo json_encode($response);
	
?>

