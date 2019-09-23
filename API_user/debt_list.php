<?php
	require("connect.php");
	$response = array();
	if (isset($_GET['userId']))
	{
		
		$temp = array();
		$userId = $_GET['userId'];

		$sql = "SELECT `debtId`,debt.categoryId,category.categoryDesc,category.categoryIcon,`dateCreated`,`amount`,`debtName`,`period`,`noDays`,`equivalent`,`balance`,`dueDate`,`description`, debt.isNotify,debt.isNotifyBefore FROM `debt` JOIN category ON category.categoryId = debt.categoryId WHERE `isDeleted` = 0 AND userId = '".$userId."'";

		$result = mysqli_query($connect,$sql);

		if (mysqli_num_rows($result) > 0)
		{
			while($debt = mysqli_fetch_assoc($result))
			{
				$temp['debtId'] = $debt['debtId'];
				$temp['categoryId'] = $debt['categoryId'];
				$temp['categoryDesc'] = $debt['categoryDesc'];
				$temp['debtName'] = $debt['debtName'];
				$temp['dateCreated'] = $debt['dateCreated'];
				$temp['amount'] = $debt['amount'];

				$temp['period'] = $debt['period'];
				$temp['noDays'] = $debt['noDays'];
				$temp['equivalent'] = $debt['equivalent'];
				$temp['balance'] = $debt['balance'];

				$temp['dueDate'] = $debt['dueDate'];
				$temp['description'] = $debt['description'];
				$temp['icon'] = $debt['categoryIcon'];
				$temp['isNotify'] = $debt['isNotify'];
				$temp['isNotifyBefore'] = $debt['isNotifyBefore'];
				//array_push($response,$temp);
				$output[] =$temp;
				$temp = $output;
			}
			$response['code'] = '1';
			$response['output'] = $temp;
		}
		else
		{
			$response['code'] = '0';
			$response['output'] = $temp;
		}
		

		echo json_encode($response);
	}
	else
	{
		$response['code'] = '0';
		echo json_encode($response);
	}
?>

