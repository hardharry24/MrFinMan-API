<?php
	require("connect.php");

	$response = array();

	$histname = $_GET['histname'];
	$histDetails = $_GET['histDetails'];
	$dateCreated = $_GET['dateCreated'];
	$icon = $_GET['icon'];
	$userId = $_GET['userId'];
	$type = $_GET['type'];

	$sql = "INSERT INTO `history` (`histActionName`, `histDetails`, `dateCreated`, `isActive`, `icon`,`userid`, `type`) VALUES ('".$histname."', '".$histDetails."', '".$dateCreated."', '0','".$icon."','".$userId."','".$type."')";

   $result = mysqli_query($connect,$sql);
	if ($result)
	{
		$temp['code'] = '1';
		$temp['message'] = "Borrowed Successfuly!";
		array_push($response,$temp);
	}
	else
	{
		$temp['code'] = '0';
		$temp['message'] = "Error!";
		array_push($response,$temp);
	}
	echo json_encode($response);
?>