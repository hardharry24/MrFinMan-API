<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$budget_ID = $_POST['budget_id'];
		$username = $_POST['username'];
		$catname = $_POST['categoryname'];
		$amount = $_POST['amount'];
		$type = $_POST['type'];
		
		$dateCreated = date("d/m/Y");
		
		$sqlgetId = "SELECT userID FROM user WHERE user.username = '".$username."' LIMIT 1";
		$result_getID = mysqli_query($connect,$sqlgetId);
		
		$result_id = mysqli_fetch_row($result_getID); 
		$userId = $result_id[0];
		
		$sqlgetCatID = "SELECT * FROM `category` WHERE category_Desc = '".$catname."' ";
		$result_getCatID = mysqli_query($connect,$sqlgetCatID);
		$result_catid = mysqli_fetch_row($result_getCatID); 
		$categoryID = $result_catid[1];
		
		
		$sqlquery = "INSERT INTO `transaction_details` ( `type`, `category_name`, `amount`, `date`, `budget_id`, `userID`) 
		             VALUES ('".$type."','".$categoryID."' ,'".$amount."', '".$dateCreated."', ".$budget_ID.", ".$userId.")";
		 
		$result = mysqli_query($connect,$sqlquery);
		 
		if ($result) 
		{
			echo "1";
		}
		else
		{
			echo "". mysqli_error($connect);
		}
		
	
	}
?>