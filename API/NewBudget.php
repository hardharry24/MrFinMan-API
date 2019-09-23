<?php
	require("connect.php");
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$startDate =  $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$amount =  $_POST['amount'];
		$note =  $_POST['note'];
		$datecreated = date("d/m/Y");
		$timecreated = $_POST['timecreated'];
		$budget_name = $_POST['budget_name'];
		$username =  $_POST['username'];
		
		$sqlgetId = "SELECT userID FROM user WHERE user.username = '".$username."' LIMIT 1";
		$result_getID = mysqli_query($connect,$sqlgetId);
		
		$result_id = mysqli_fetch_row($result_getID); 
		$userId = $result_id[0];
		
		$startDate = date("d/m/Y");
		$endDate = date("d/m/Y");
		
		$sql = "SELECT * FROM `budget` WHERE budget.user_ID = '".$userId."' AND budget.startDate >= '".$startDate."' 
		        AND budget.endDate <=  '".$endDate."' AND budget.budget_name = '".$budget_name."'";
		
		$result = mysqli_query($connect,$sql);
		$result_id = mysqli_fetch_row($result); 
		//echo "".$result_id[2];
		if (!mysqli_num_rows($result) >0)
		{
			$sqlgetId = "INSERT INTO `budget` (`user_ID`, `startDate`, `endDate`, `amount`, `note`,
						`datecreated`, `timecreated`, `budget_name`) 
						 VALUES ('".$userId."', '".$startDate."', '".$endDate."', '".$amount."', '".$note."', 
						 '".$datecreated."', '".$timecreated."', '".$budget_name."')";
			$result = mysqli_query($connect,$sqlgetId);
			
			if ($result)
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "2";
		}
	}
?>