<?php
	require("connect.php");

	
	$type =  $_GET['type'];
	$response = array();
	if ($type == "pending")
	{
		//$date = $_GET['date'];

			$billerId = $_GET['billerId'];
			$sql = "SELECT user.userId,user.lname,user.fname,user.email,user.username,user.contactNo,bills.billId,bills.billName,bills.dateCreated,bills.amount,bills.dueDate,bills.description,bills.paymentType,bills.status FROM `bills` INNER JOIN user ON user.userId = bills.userId WHERE bills.billerId ='".$billerId."' AND bills.isActive = 1 AND STR_TO_DATE(bills.dueDate, '%d/%m/%Y') >= CURRENT_DATE() AND bills.status = 'InProgress' OR bills.paymentType = 'Monthly'";



			$results = mysqli_query($connect,$sql);

			while($bills = mysqli_fetch_assoc($results))
			{
				$temp = array();
				$temp['userId'] = $bills['userId'];
				$temp['lname'] = $bills['lname'];
				$temp['fname'] = $bills['fname'];
				$temp['email'] = $bills['email'];
				$temp['username'] = $bills['username'];
				$temp['contactNo'] = $bills['contactNo'];
				$temp['billId'] = $bills['billId'];
				$temp['billName'] = $bills['billName'];
				$temp['dateCreated'] = $bills['dateCreated'];
				$temp['amount'] = $bills['amount'];
				$temp['dueDate'] = $bills['dueDate'];
				$temp['description'] = $bills['description'];
				$temp['paymentType'] = $bills['paymentType'];
				array_push($response,$temp);
			}
			echo json_encode($response);
	}
	else if ($type == "paid")
	{
		//$date = $_GET['date'];

			$billerId = $_GET['billerId'];
			$sql = "SELECT user.userId,user.lname,user.fname,user.email,user.username,user.contactNo, bills.billId,bills.billName,bills.dateCreated,bills.amount,bills.dueDate,bills.description,bills.paymentType FROM `bills` INNER JOIN user ON user.userId = bills.userId WHERE bills.billerId ='".$billerId."' AND bills.isActive = 1 AND bills.status = 'done'";

			$results = mysqli_query($connect,$sql);

			while($bills = mysqli_fetch_assoc($results))
			{
				$temp = array();
				$temp['userId'] = $bills['userId'];
				$temp['lname'] = $bills['lname'];
				$temp['fname'] = $bills['fname'];
				$temp['email'] = $bills['email'];
				$temp['username'] = $bills['username'];
				$temp['contactNo'] = $bills['contactNo'];
				$temp['billId'] = $bills['billId'];
				$temp['billName'] = $bills['billName'];
				$temp['dateCreated'] = $bills['dateCreated'];
				$temp['amount'] = $bills['amount'];
				$temp['dueDate'] = $bills['dueDate'];
				$temp['description'] = $bills['description'];
				$temp['paymentType'] = $bills['paymentType'];
				array_push($response,$temp);
			}
			echo json_encode($response);
	}
	else if ($type == "overdue")
	{
		$date = $_GET['date'];

			$billerId = $_GET['billerId'];
			$sql = "SELECT user.userId,user.lname,user.fname,user.email,user.username,user.contactNo, bills.billId,bills.billName,bills.dateCreated,bills.amount,bills.dueDate,bills.description,bills.paymentType,bills.status FROM `bills` INNER JOIN user ON user.userId = bills.userId WHERE bills.billerId ='".$billerId."' AND bills.dueDate != '' AND bills.isActive = 1 AND STR_TO_DATE(bills.dueDate, '%d/%m/%Y') <= CURRENT_DATE()";

			$results = mysqli_query($connect,$sql);

			while($bills = mysqli_fetch_assoc($results))
			{
				$temp = array();
				$temp['userId'] = $bills['userId'];
				$temp['lname'] = $bills['lname'];
				$temp['fname'] = $bills['fname'];
				$temp['email'] = $bills['email'];
				$temp['username'] = $bills['username'];
				$temp['contactNo'] = $bills['contactNo'];
				$temp['billId'] = $bills['billId'];
				$temp['billName'] = $bills['billName'];
				$temp['dateCreated'] = $bills['dateCreated'];
				$temp['amount'] = $bills['amount'];
				$temp['dueDate'] = $bills['dueDate'];
				$temp['description'] = $bills['description'];
				$temp['paymentType'] = $bills['paymentType'];
				array_push($response,$temp);
			}
			echo json_encode($response);
	}
?>