<?php
	require("connect.php");
		
		$sql = "SELECT * FROM `biller` ";
		
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($billler = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['id'] = $billler['billerId'];
			$temp['billerName'] = $billler['billerName'];
			$temp['address'] = $billler['billerAddress'];
			$temp['contactno'] = $billler['billerContactno'];
			$temp['email'] = $billler['billerEmail'];
			$temp['isActive'] = $billler['isActive'];   		
			array_push($response,$temp);
		}
		echo json_encode($response);
		
?>
