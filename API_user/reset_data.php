<?php
	require("connect.php");
	$userId = $_GET['userId'];
	$sqlExpense = "DELETE FROM `expense` WHERE userId = ".$userId;
	$sqlIncome = "DELETE FROM `income` WHERE userId = ".$userId;
	$sqlSaving = "DELETE FROM `saving` WHERE userId = ".$userId;

	$result = mysqli_query($connect,$sqlExpense);
	$result = mysqli_query($connect,$sqlIncome);
	$result = mysqli_query($connect,$sqlSaving);
?>


   