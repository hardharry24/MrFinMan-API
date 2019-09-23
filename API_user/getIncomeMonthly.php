<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['username']) && isset($_GET['date']))
	{		
		$username = $_GET['username'];	
		$dateNow =  $_GET['date'];
		$sql = "SELECT SUM(amount) as 'sum' FROM `income`  JOIN user ON income.userId = user.userId WHERE income.categoryId = 28 AND username = '".$username."' ";
		$result = mysqli_query($connect,$sql);
	    $total_income = mysqli_fetch_assoc($result);

	  
		    
	    $sql = "SELECT SUM(amount) as 'sum' FROM `income`  JOIN user ON income.userId = user.userId WHERE username = '".$username."' AND income_type='Additional' AND DATE_FORMAT(income.dateCreated,'%m/%Y') = '".$dateNow."'";
		$result = mysqli_query($connect,$sql);
	    $total_Add_income = mysqli_fetch_assoc($result);

	    


		if ($total_income['sum']!=0 )
		{
			$response['code'] = '1';
			$response['sum'] = $total_income['sum'] + $total_Add_income['sum'] ;
		}
		else
		{
			$response['code'] = '1';
			$response['sum'] = '0.00' ;
		}
	}	
	else
	{
		$response['code'] = '0';
		$response['message'] = 'Empty Username!' ;
	}	
	echo "[".json_encode($response)."]";
	
?>