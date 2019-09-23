<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		
		$sql = "SELECT SUM(amount) as 'sum' FROM `income`  JOIN user ON income.userId = user.userId WHERE username = '".$username."'";
		$result = mysqli_query($connect,$sql);
	    $total_income = mysqli_fetch_assoc($result);
	    
		if ($total_income['sum']!=0 )
			echo $total_income['sum'] ;
		else
			echo '00';
		
		
		mysqli_close($connect);
	}
?>