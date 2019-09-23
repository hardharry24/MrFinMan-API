<?php
	require("connect.php");
	
	$response = array();
	
	if (isset($_GET['username']) && isset($_GET['type']))
	{		
		$temp = array();

		if ($_GET['type'] == "DAILY")
		{
			$username = $_GET['username'];
			$date = $_GET['date'];

			$sql = "SELECT SUM(amount) as sum from expense JOIN user ON expense.userId = user.userId WHERE username = '".$username."'  AND DATE_FORMAT(expense.dateCreated,'%d/%m/%Y') =  '".$date."' AND `isDeleted`= 0";
			$result = mysqli_query($connect,$sql);
			$row = mysqli_fetch_assoc($result);
			$sum = $row['sum'];

			$temp['code'] = '1';
			if($sum == null)
				$temp['amount'] = '0.0';
			else
				$temp['amount'] = $sum;
			array_push($response,$temp);
		}
		if ($_GET['type'] == "WEEKLY")
		{
			$username = $_GET['username'];
			$date = $_GET['date'];
			$exp = explode(' ', $date);

			$sql = "SELECT SUM(amount) as sum from expense JOIN user ON expense.userId = user.userId WHERE username = '".$username."'  AND  DATE_FORMAT(expense.dateCreated,'%d/%m/%Y') BETWEEN '".$exp[0]."' AND '".$exp[1]."' AND `isDeleted`= 0";
			$result = mysqli_query($connect,$sql);
			$row = mysqli_fetch_assoc($result);
			$sum = $row['sum'];

			$temp['code'] = '1';
			if($sum == null)
				$temp['amount'] = '0.0';
			else
				$temp['amount'] = $sum;
			array_push($response,$temp);
		}
		if ($_GET['type'] == "MONTHLY")
		{
			$username = $_GET['username'];
			$date = $_GET['date'];

			$sql = "SELECT SUM(amount) as sum from expense JOIN user ON expense.userId = user.userId WHERE username = '".$username."'  AND DATE_FORMAT(expense.dateCreated, '%m/%Y') =  '".$date."' AND `isDeleted`= 0";
			$result = mysqli_query($connect,$sql);
			$row = mysqli_fetch_assoc($result);
			$sum = $row['sum'];

			$temp['code'] = '1';
			if($sum == null)
				$temp['amount'] = '0.0';
			else
				$temp['amount'] = $sum;
			array_push($response,$temp);
		}
	}	
	else
	{
		$temp['code'] = '0';
		$temp['message'] = 'Empty Username!';
		array_push($response,$temp);
	}	
	echo json_encode($response);
	
?>