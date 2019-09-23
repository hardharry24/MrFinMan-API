<?php
	require("connect.php");
	
	$response = array();
	$temp = array();
	/*if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{*/

		$todo = $_GET['todo'];

		if ($todo == "BORROW")
		{
			$username = $_GET['username'];
			$amtBorrow = $_GET['amount'];
		
			

			$result = mysqli_query($connect,"SELECT sum(amount) as amount FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username =  '".$username."' AND type='Additional'");

			$totSavings = mysqli_fetch_assoc($result);
			if ($totSavings["amount"] != null)
				$totalSavings = $totSavings["amount"];
			else
				$totalSavings = 0;


			$sql = "SELECT * FROM `saving` JOIN user ON user.userId = saving.userId WHERE user.username = '".$username."' AND type='Additional' ORDER BY dateCreated DESC";
			$result = mysqli_query($connect,$sql);
			while($savings = mysqli_fetch_assoc($result))
			{
				$id = $savings['savingId'];
				$amount =  $savings['amount'];
				
				if ($amtBorrow == $amount  )
				{
					//echo "Update ".$id."=0 ";
					$amtBorrow = 0;
					update($id,0);
					break;
					
			    }				
				else if($amtBorrow > $amount)
				{
					//echo "Update amount 0 ".$id;
					//echo "Update ".$id."=0 ";
					update($id,0);
					$amtBorrow = $amtBorrow - $amount;
					
				}
				else
				{
					$amount = $amount -  $amtBorrow;
					//echo "Update ".$id."=".$amount." ";
					update($id,$amount);
					//echo "Update ".($amount = $amount -  $amtBorrow)." =ID ".$id;
					$amtBorrow =0;
					
				}
			}
		}

		function update($id,$amount)
		{
			$response = array();
			$temp = array();
			require("connect.php");	
			$sql = "UPDATE `saving` SET `amount`='".$amount."' WHERE savingId = '".$id."'";
				$result = mysqli_query($connect,$sql);
				if ($result)
				{
					
				}
		}
?>

