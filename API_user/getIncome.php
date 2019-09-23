<?php
	require("connect.php");
	
	$response = array();
	if (isset($_GET['username']))
	{		
		$username = $_GET['username'];	
		$dateNow = date('m/Y');

		$sql = "SELECT SUM(amount) as 'sum' FROM `income`  JOIN user ON income.userId = user.userId  WHERE income.categoryId = 28 AND  username = '".$username."'  AND income.isDeleted=0";
		$result = mysqli_query($connect,$sql);
	    $total_income = mysqli_fetch_assoc($result);

	    //echo "Income : ".$total_income['sum'];
		    
	    $sql = "SELECT SUM(amount) as 'sum' FROM `income`  JOIN user ON income.userId = user.userId WHERE username = '".$username."' AND income_type='Additional' AND DATE_FORMAT(income.dateCreated,'%m/%Y') = '".$dateNow."' AND income.isDeleted=0";
		$result = mysqli_query($connect,$sql);
	    $total_Add_income = mysqli_fetch_assoc($result);

	  // echo "INCME ".$total_Add_income['sum'];


		if ($total_Add_income['sum'] >0 ||  $total_income > 0)
		{
			$response['code'] = '1';
			
			  $sql = "SELECT SUM(amount) as amount FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Additional' AND DATE_FORMAT(saving.dateCreated,'%m/%Y') = '".$dateNow."'";
				$result = mysqli_query($connect,$sql);	

				$fetchSaving = mysqli_fetch_assoc($result);
				//echo "Total Savings : ".$fetchSaving['amount'];
				//echo " ".$fetchSaving['amount'];
				//echo "".$fetchSaving["amount"];
				if ($fetchSaving['amount'] != null || $fetchSaving['amount'] != 0)
				{

					$response['sum'] = ($total_income['sum'] + $total_Add_income['sum'])  - $fetchSaving['amount'];
				}
				else
				{
					$response['sum'] = $total_income['sum']+$total_Add_income['sum'];
				}
				
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