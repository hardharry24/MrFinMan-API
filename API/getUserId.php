<?php
	require("connect.php");
	
	$username = $_POST['username'];
	$sql = "SELECT * FROM user WHERE username = '".$username."'";
	
	$finalArray = array();
	if ($result=mysqli_query($connect,$sql))
	{
		$temp = array();
	   while ($row=mysqli_fetch_row($result))
		{
			$temp['id'] = $row[0];
			echo $temp['id'];
		//	$temp['fname'] = $row[1];
		//	$temp['mi'] = $row[2];
		//	$temp['username'] = $row[2];
		//	array_push($finalArray,$temp);
		}
		//echo json_encode($finalArray);
	}
?>