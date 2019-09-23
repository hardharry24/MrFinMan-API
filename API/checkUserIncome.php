<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$username = $_GET['username'];
		$sql = "SELECT income.amount FROM `income` JOIN user ON user.userId = income.userId WHERE user.username = '".$username."'";
		$result = mysqli_query($connect,$sql);

		if (mysqli_num_rows($result) > 0)
			echo "1";
		else
			echo "0";

		
	}
?>

