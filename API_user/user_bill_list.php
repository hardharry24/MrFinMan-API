<?php
	require("connect.php");
	$response = array();
	if (isset($_GET['userId']))
	{
		
		$temp = array();
		$userId = $_GET['userId'];

		$sql = "SELECT `billId`,`billName`,bills.userId,`dateCreated`,`amount`,`balance`,`description`,`dueDate`,bills.billerId,`paymentType`,bills.isActive,biller.billerName,biller.billerAddress,biller.billerContactno, bills.isNotify, user.lname, user.fname, user.mi,bills.isNotifyBefore FROM bills INNER JOIN biller ON biller.billerId = bills.billerId JOIN user ON user.billerId = bills.billerId WHERE user.isBiller = true AND bills.isActive = true AND bills.userId = '".$userId."' AND bills.isActive = 1  ORDER BY bills.dateCreated DESC";

		$result = mysqli_query($connect,$sql);

		if (mysqli_num_rows($result) > 0)
		{
			while($bills = mysqli_fetch_assoc($result))
			{
				$temp['billId'] = $bills['billId'];
				$temp['billName'] = $bills['billName'];
				$temp['amount'] = $bills['amount'];
				$temp['description'] = $bills['description'];
				$temp['dueDate'] = $bills['dueDate'];
				$temp['balance'] = $bills['balance'];
				$temp['paymentType'] = $bills['paymentType'];
				$temp['dateCreated'] = $bills['dateCreated'];
				$temp['dateCreated'] = $bills['dateCreated'];
				$temp['billerId'] = $bills['billerId'];

				$temp['billerName'] = $bills['billerName'];
				$temp['billerAddress'] = $bills['billerAddress'];
				$temp['billerContactno'] = $bills['billerContactno'];
				$temp['billerlname'] = $bills['lname'];
				$temp['billerfname'] = $bills['fname'];
				$temp['billerMIname'] = $bills['mi'];
				$temp['isActive'] = $bills['isActive'];
				$temp['isNotify'] = $bills['isNotify'];
				$temp['isNotifyBefore'] = $bills['isNotifyBefore'];
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

