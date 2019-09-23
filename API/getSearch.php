<?php
	require("connect.php");
		$searchItem = $_GET['item'];
		$sql = "SELECT * FROM `user` WHERE `username` like '%".$searchItem."%' OR  `email` like '%".$searchItem."%'";
		$result = mysqli_query($connect,$sql);
	    
		$response = array();
		while ($fullname = mysqli_fetch_assoc($result)) {
			$temp = array();
			$temp['ID'] = $fullname['userId'];
			$temp['lastname'] = $fullname['lname'];
			$temp['firstname'] = $fullname['fname'];
			$temp['MI'] = $fullname['mi'];
			$temp['email'] = $fullname['email'];
			$temp['username'] = $fullname['username'];
			$temp['contactNo'] = $fullname['contactNo'];
			array_push($response,$temp);
		}
		echo json_encode($response);
?>