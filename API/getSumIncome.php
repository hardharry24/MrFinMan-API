<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		
		$sql = "SELECT SUM(income.amount) as 'sum' FROM `income` JOIN  user ON income.userId = user.userId WHERE username  = '".$username."' AND `isDeleted`= 0";
		$result = mysqli_query($connect,$sql);
	    $total_income = mysqli_fetch_assoc($result);
		
		$sqls = "SELECT SUM(expense.amount) as 'sum' FROM `expense` JOIN user ON expense.userId = user.userId WHERE username = '".$username."' AND `isDeleted`= 0";
		$results = mysqli_query($connect,$sqls);
		$total_expense = mysqli_fetch_assoc($results);
		
		
		if ($total_income['sum'] != 0 )
			echo $total_income['sum'] - $total_expense['sum'];
		else
			echo '00';
		
		
		mysqli_close($connect);
	}
?>