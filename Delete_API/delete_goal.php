<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$goalName = $_POST['goalName'];
		
		$sql = "DELETE FROM `goal` WHERE goal.goalName = '".$goalName."'";
		
		mysqli_query($connect,$sql);
	}
?>