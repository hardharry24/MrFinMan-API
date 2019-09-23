<?php
	require("connect.php");

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$ID = $_POST['userID'];
		$categoryID = $_POST['categoryID'];
		$deptname = $_POST['debtName'];
		$amount = $_POST['amount'];
		$noteDesc = $_POST['note'];

		


		$targetDate = $_POST['targetDate'];
		$date = $_POST['dateCreated'];
		
		$sql = "SELECT * FROM `debt` WHERE userId = '".$ID."' AND debtName = '".$deptname."' and dueDate = '".$date."'";
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		if (mysqli_num_rows($result)>0)
		{
			echo "Goal already exist!";
		}
		else
		{
			$sql = "INSERT INTO `goal` ( `categoryId`, `goalName`, `amount`, `description`, `targetDate`, `dateCreated`, `userId`) VALUES ('".$categoryID."', '".$goalname."', '".$amount."', '".$noteDesc."', '".$targetDate."', '".$date."', '".$ID."')";
			$result = mysqli_query($connect,$sql);
			if ($result)
				echo "1";
			else
				echo "".mysqli_error($connect);
	
		}		
		
		mysqli_close($connect);
	}
?>


