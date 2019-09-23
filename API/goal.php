<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$type =  $_POST['type'];
		$id =   $_POST['id'];
		
		$response = array();

		if ($type == "update")
		{
			$ID = $_POST['userID'];
			$categoryID = $_POST['categoryID'];
			$goalname = $_POST['goalname'];
			$amount = $_POST['amount'];
			$noteDesc = $_POST['note'];
			$targetDate = $_POST['targetDate'];
			$date = $_POST['dateCreated'];
			$sql = "UPDATE `goal` SET `goalName`='".$goalname."',`amount`='".$amount."',`description`='".$noteDesc."',`targetDate`='".$targetDate."',`dateCreated`='".$date."',`categoryId`='".$categoryID."' WHERE `goalId`='".$id."'";
			$results = mysqli_query($connect,$sql);
			if ($results)
				echo "1";
			else
				echo "0";

		}
		else if ($type == "retrieve")
		{
			$sql = "SELECT * from goal where goal.goalId = '".$id."'";
			$results = mysqli_query($connect,$sql);
			$goalItem = mysqli_fetch_assoc($results);

			$temp = array();
			$temp['goal_ID'] = $goalItem['goalId'];
			$temp['category_id'] = $goalItem['categoryId'];
			$temp['goal_name'] = $goalItem['goalName'];
			$temp['amount'] = $goalItem['amount'];
			$temp['description'] = $goalItem['description'];
			$temp['targetDate'] = $goalItem['targetDate'];
			array_push($response,$temp);
			echo json_encode($response);
		}
		else if ($type == "delete")
		{
			$sql = "DELETE FROM `goal` WHERE goal.goalId =".$id."";
			$results = mysqli_query($connect,$sql);
			if ($results)
				echo "1";
			else
				echo "0";

		}
	}
?>