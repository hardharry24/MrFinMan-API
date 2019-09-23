
<?php
	require("connect.php");

	$response = array();
	
	$type = $_POST['type'];
	if ($type == "INSERT")
	{
		$userId = $_POST['userId'];
		$debtName = $_POST['debtName'];
		$categoryId = $_POST['categoryId'];
		$dateCreated = $_POST['dateCreated'];
		$amount = $_POST['amount'];

		$no = $_POST['noDays'];
		$equi = $_POST['equi'];
		$balance = $_POST['balance'];

		$period = $_POST['period'];
		$dueDate = $_POST['dueDate'];
		$description = $_POST['description'];

		$sql = "SELECT * FROM debt WHERE debtName = '".$debtName."' AND userId = '".$userId."'";
		$result = mysqli_query($connect,$sql);
	
		if (mysqli_num_rows($result)>0)
		{
			$response['code'] = '0';
			$response['message'] = "Debt Name is already exist";
		}
		else
		{
			
			$sql = "INSERT INTO `debt` ( `categoryId`, `dateCreated`, `amount`, `debtName`, `period`,`noDays`,`equivalent`,`balance`, `dueDate`, `userId`, `description`) VALUES ( '".$categoryId."','".$dateCreated."', '".$amount."', '".$debtName."', '".$period."','".$no."','".$equi."','".$balance."', '".$dueDate."', '".$userId."', '".$description."')";
			if (mysqli_query($connect,$sql))
			{
				$response['code']='1';
				$response['message'] = "Successfuly Added to your debt list!";
			}
			else
			{
				$response['code']='0';
				$response['message'] = "".mysqli_error($connect);
			}
		}
		echo '['.json_encode($response).']';
	}
	else if ($type == "LIST")
	{
		$userId = $_POST['userId'];
		$sql = "SELECT `debtId`,debt.categoryId,category.categoryDesc,category.categoryIcon,`dateCreated`,`amount`,`debtName`,`period`,`noDays`,`equivalent`,`balance`,`dueDate`,`description`, debt.isNotify,debt.isNotifyBefore FROM `debt` JOIN category ON category.categoryId = debt.categoryId WHERE `isDeleted` = 0 AND userId = '".$userId."'";

		$result = mysqli_query($connect,$sql);
		while($debt = mysqli_fetch_assoc($result))
		{
			$temp = array();
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
			array_push($response,$temp);

		}
		echo json_encode($response);

	}
	else if ($type == "UPDATE")
	{
		$userId = $_POST['userId'];
		$debtName = $_POST['debtName'];
		$categoryId = $_POST['categoryId'];
		$dateCreated = $_POST['dateCreated'];
		$amount = $_POST['amount'];
		$period = $_POST['period'];
		$dueDate = $_POST['dueDate'];
		$description = $_POST['description'];
		$debtId = $_POST['debtId'];
		$no = $_POST['noDays'];
		$equi = $_POST['equi'];
		$balance = $_POST['balance'];
		$period = $_POST['period'];

		$sql = "UPDATE `debt` SET `categoryId`='".$categoryId."',`dateCreated`='".$dateCreated."',`period` = '".$period."',`equivalent` = '".$equi."',`noDays` = '".$no."',`amount`='".$amount."',`debtName`='".$debtName."',`period`='".$period."',`dueDate`='".$dueDate."',`userId`='".$userId."',`description`='".$description."' WHERE  `debtId`='".$debtId."'";

		if (mysqli_query($connect,$sql))
		{
				$response['code']='1';
				$response['message'] = "Successfuly Updted your debt!";
		}
		else
		{
				$response['code']='0';
				$response['message'] = "".mysqli_error($connect);
		}
		echo '['.json_encode($response).']';
	}
	
?>



