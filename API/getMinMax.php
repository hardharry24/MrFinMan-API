
<?php
	require("connect.php");
	//if ($_SERVER['REQUEST_METHOD'] == 'POST')
	//{
		$userID = $_GET['userId'];
		$response = array();

		$sql = "SELECT MAX(dateCreated) as maxDate,MIN(dateCreated) as minDate FROM `expense` where expense.userId = '".$userID."'";
		
		$result = mysqli_query($connect,$sql);
		$dates = mysqli_fetch_assoc($result);
		if ($dates['maxDate'] != NULL && $dates['minDate'] != NULL)
		{
			$min = new DateTime($dates['minDate']);
			$max = new DateTime($dates['maxDate']);
			//$min =date("m/d/Y  H:i:s", );

			$temp = array();
			$temp["code"] = "1";
			$temp["minDate"] = $min->format('m/d/Y H:i:s');
			$temp["maxDate"] = $max->format('m/d/Y H:i:s');
			array_push($response,$temp);
		}
		else
		{
			$temp = array();
			$temp["code"] = "0";
			$temp["minDate"] = NULL;
			$temp["maxDate"] = NULL ;
			array_push($response,$temp);
		}
		echo json_encode($response);
	//}
?>



