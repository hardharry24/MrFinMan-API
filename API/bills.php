
<?php
	require("connect.php");
	//if ($_SERVER['REQUEST_METHOD'] == 'POST')
	//{
		$type =  $_POST['type'];
		$response = array();

		if ($type == "insert")
		{
			$userId = $_POST['userId'];
			$billname = $_POST['billname'];
			$amount = $_POST['amount'];
			$noteDesc = $_POST['note'];
			$targetDate = $_POST['targetDate'];
			$paymentType = $_POST['paymenttype'];
			$date = $_POST['dateCreated'];
			$billerId = $_POST['billerId'];
			
    		$sql = "SELECT * FROM `bills` WHERE billName = '".$billname."'  AND bills.amount = '".$amount."' AND bills.dueDate = '".$targetDate."' AND bills.userId = '".$userId."'";
    		$results = mysqli_query($connect,$sql);

    		if (!mysqli_num_rows($results) > 0 )
    		{
    			$sqlInsert = "INSERT INTO `bills` (`billName`, `userId`, `dateCreated`, `amount`, `balance`, `description`, `dueDate`, `billerId`, `paymentType`, `isActive`) VALUES ('".$billname."', '".$userId."','".$date."', '".$amount."','".$amount."','".$noteDesc."','".$targetDate."', '".$billerId."','".$paymentType."', '1')";
    				
    				$temp = array();
					

					if (mysqli_query($connect,$sqlInsert))
					{
						$billId = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `bills` WHERE `billName` = '".$billname."' AND  `userId` = '".$userId."'"));

						$temp['code'] = '1';
						$temp['message'] = "Success!";
						$temp['billId'] = $billId['billId'];

						array_push($response,$temp);
					}
					else
					{
						$temp['code'] = '0';
						$temp['message'] = "Error!";

						array_push($response,$temp);
					}	
					echo json_encode($response);
    		}
    		else
    		{
    			$temp['code'] = '3';
				$temp['message'] = "Success!";
				//$temp['userId'] = $userId['userId'];
				array_push($response,$temp);
				echo json_encode($response);
    		}
		}
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
		else if ($type == "manage")
		{
			$billerId = $_POST['billerId'];
			$sql = "SELECT user.userId,user.lname,user.fname,user.email,user.username,user.contactNo, bills.billId,bills.billName,bills.dateCreated,bills.amount,bills.dueDate,bills.description,bills.paymentType FROM `bills` INNER JOIN user ON user.userId  = bills.userId WHERE bills.billerId ='".$billerId."'  AND bills.isActive = 1";

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
			
		}
		echo json_encode($response);

	//}
?>

	
