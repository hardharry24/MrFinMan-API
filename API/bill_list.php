
<?php
	require("connect.php");
	/*if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{*/
		$billerId = $_GET['userID'];
		
		$sql = "SELECT * FROM bills WHERE  bills.billerId = '".$billerId."'";
		
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($bills = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['billId'] = $bills['billId'];
			$temp['billName'] = $bills['billName'];
			$temp['amount'] = $bills['amount'];
			$temp['description'] = $bills['description'];
			$temp['dueDate'] = $bills['dueDate'];
			$temp['balance'] = $bills['balance'];
			$temp['paymentType'] = $bills['paymentType'];
			$temp['dateCreated'] = $bills['dateCreated'];
			$temp['billerId'] = $bills['billerId'];
			$temp['isActive'] = $bills['isActive'];
			array_push($response,$temp);
		}
		echo json_encode($response);
	//}	
?>



