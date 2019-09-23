<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$userId =  $_GET['userId'];
		$categoryId =  $_GET['categoryId'];
		$amount =  $_GET['amount'];
		$remAmount =  $_GET['remAmount'];
		$date = $_GET['date'];
		$dateCheck =  date("d/m/Y",strtotime($_GET['date']));

		$response = array();

		$query = "SELECT * FROM budget_report WHERE budget_report.userId = '".$userId."' AND budget_report.categoryId = '".$categoryId."' AND DATE_FORMAT(date,'%d/%m/%Y') = '".$dateCheck."'";
		$result = mysqli_query($connect,$query);
		if (mysqli_num_rows($result))
		{
			$response['code'] = '0';
			$response['message'] = "Naa";
		}
		else
		{
			$response['code'] = '0';
			$response['message'] = "NUMBER OF ROWS ";

			$query = "INSERT INTO `budget_report` (`userId`, `categoryId`, `amount`, `remAmount`, `date`) VALUES ('".$userId."', '".$categoryId."', '".$amount."', '".$remAmount."', '".$date."')";
			$result = mysqli_query($connect,$query);
			if ($result)
			{
				$response["code"] = "1";
				$response["message"] = "Success";
			}
			else
			{
				$response["code"] = "0";
				$response["message"] = "Fail";
			}
		}
		echo json_encode($response);
	}
?>