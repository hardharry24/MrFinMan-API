<?php
	require("connect.php");

	$response = array();
	if (isset($_GET['Token']) && isset($_GET['userId']))
	{
		$token = $_GET['Token'];
		$userId = $_GET['userId'];
		

		$query = "UPDATE `user` SET `deviceToken`='".$token."' WHERE `userId`= '".$userId."'";

		$result = mysqli_query($connect,$query);

		if ($result)
		{
			$response['message'] = "OK";
		}
		else
		{
			$response['message'] = "NOT";
		}

		
		mysqli_close($connect);


	}

	echo json_encode($response);

?>