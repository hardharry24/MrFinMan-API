<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['username']))
	{		
		$username = $_GET['username'];	
		date_default_timezone_set('Asia/Kuala_Lumpur');
		$dateNow = date('m/Y');
		//$dateNow = date('03/2019');
		//echo "".date("Y/m/d");
		$sql = "SELECT SUM(amount) as 'sum' FROM `income`  JOIN user ON income.userId = user.userId WHERE income.categoryId = 28 AND username = '".$username."'";
		$result = mysqli_query($connect,$sql);
	    $total_income = mysqli_fetch_assoc($result);
	    //echo "MY INCOME ".$total_income['sum'];
		    
	    $sql = "SELECT SUM(amount) as 'sum' FROM `income`  JOIN user ON income.userId = user.userId WHERE username = '".$username."' AND income_type='Additional' AND DATE_FORMAT(income.dateCreated,'%m/%Y') = '".$dateNow."'";
		$result = mysqli_query($connect,$sql);
	    $total_Add_income = mysqli_fetch_assoc($result);


		//echo "ADD INCOME ".$total_Add_income['sum'];

	    $sqls = "SELECT SUM(expense.amount) as 'sum' FROM `expense` JOIN user ON expense.userId = user.userId WHERE username = '".$username."' AND `isDeleted`= 0 AND DATE_FORMAT(expense.dateCreated,'%m/%Y') = '".$dateNow."'";
		$results = mysqli_query($connect,$sqls);
		$total_expense = mysqli_fetch_assoc($results);


	    $income = $total_income['sum'] + $total_Add_income['sum'];
	    //echo "INCOME ".$total_expense['sum'];

		if ($total_income['sum']!=0 )
		{
			$response['code'] = '1';


				$sql = "SELECT SUM(amount) as amount FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Additional' AND DATE_FORMAT(saving.dateCreated,'%m/%Y') = '".$dateNow."'";
				$result = mysqli_query($connect,$sql);


				$fetchSaving = mysqli_fetch_assoc($result);
				//echo $income['sum']." - ".$total_expense['sum']."  ".$fetchSaving['amount'];
				if ($fetchSaving['amount'] != null)
					$response['sum'] = ''.($income - $total_expense['sum']) - $fetchSaving['amount'];
				else
					$response['sum'] = ''.($income - $total_expense['sum']) - $fetchSaving['amount'];


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