<?php
	require("connect.php");
	/*if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{*/
		$username = $_GET['username'];
		$response = array();	
		$sql = "SELECT `savingId`,saving.categoryId,category.categoryDesc, `amount`,DATE_FORMAT(saving.dateCreated,'%M %Y') as `Date` FROM `saving` JOIN user ON user.userId = saving.userId JOIN category ON category.categoryId = saving.categoryId WHERE user.username = '".$username."' ORDER BY `dateCreated` ASC";
		$result = mysqli_query($connect,$sql);
		
		
		while($savings = mysqli_fetch_assoc($result)) 
		{
			$temp = array();
			$temp['savingId'] = $savings['savingId'];
			$temp['amount'] = $savings['amount'];
			$temp['categoryDesc'] = $savings['categoryDesc'];
			$temp['date'] = $savings['Date'];
			array_push($response,$temp);
		}
		echo json_encode($response);
	//}
?>

