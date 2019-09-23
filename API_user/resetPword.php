<?php
	require("connect.php");
	
	$response = array();
		$username = $_POST['username'];	
		$password = $_POST['password'];	

		//echo "".$username;
		 $sql = "UPDATE user SET password = '".$password."'  WHERE username = '".$username."' ";
		 $result = mysqli_query($connect,$sql);
		
		if ($result)
		{
			$response['code'] = '1';
			$response['username'] = ''.$username;
			$response['message'] = 'Successfuly Updated!';
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = 'Error!';
		}
	
	echo "[".json_encode($response)."]";
	
?>