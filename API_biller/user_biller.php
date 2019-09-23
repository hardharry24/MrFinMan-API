
<?php
	require("connect.php");
	//if ($_SERVER['REQUEST_METHOD'] == 'POST')
	//{
		$type =  $_GET['type'];
		$response = array();
		$temp = array();

		if ($type == "insert")
		{
			$userId = $_GET['userId'];
			$billerId = $_GET['billerId'];
			$date = $_GET['dateCreated'];


    		$sql = "SELECT * FROM `biller_user_details` WHERE userId = ".$userId." AND billerId = ".$billerId." ";
    		$results = mysqli_query($connect,$sql);

    		if (!mysqli_num_rows($results) > 0 )
    		{
    			$sqlInsert = "INSERT INTO `biller_user_details` (`userId`, `billerId`, `isActive`, `dateCreated`) VALUES ('".$userId."', '".$billerId."', '1', '".$date."')";

					if (mysqli_query($connect,$sqlInsert))
					{
						$temp["code"] = 1;
		    			$temp["message"] = "Successfuly added to your customer list!";
		    			array_push($response,$temp);
					}
					else
					{
						$temp["code"] = 0;
		    			$temp["message"] = "Error during insert!";
		    			array_push($response,$temp);
					}	
    		}
    		else
    		{
    			$temp["code"] = 0;
    			$temp["message"] = "User Already exist in your list!";
    			array_push($response,$temp);
    		}
    		echo json_encode($response);
		}
		if ($type == "delete")
		{
			$userId = $_GET['userId'];
			$billerId = $_GET['billerId'];


			$sql = "SELECT user.userId,user.lname,user.fname,user.email,user.username,user.contactNo, bills.billId,bills.billName,bills.dateCreated,bills.amount,bills.dueDate,bills.description,bills.paymentType FROM `bills` INNER JOIN user ON user.userId = bills.userId WHERE userId = ".$userId." AND billerId = ".$billerId."  AND bills.isActive = 1";

			//$results = mysqli_query($connect,$sql)
				/*	$temp["code"] = 1;
			    	$temp["message"] = "Ambot ".mysqli_num_rows($results) ;*/
			    	//array_push($response,$temp);
			if (!mysqli_num_rows($results) > 0 )
			{

	    		$sql = "DELETE FROM `biller_user_details` WHERE userId = ".$userId." AND billerId = ".$billerId." ";
	    		if (mysqli_query($connect,$sql))
				{
					$temp["code"] = 1;
			    	$temp["message"] = "Successfuly Deleted to your customer list!";
			    	array_push($response,$temp);
				}
				else
				{
					$temp["code"] = 0;
			    	$temp["message"] = "Error during insert!";
			   		array_push($response,$temp);
				}	
	    	}
	    	else
	    	{
	    			$temp["code"] = 0;
			    	$temp["message"] = "Error during insert!";
			   		array_push($response,$temp);
	    	}
	    	echo json_encode($response);
		}
		else if  ($type == "my_list")
		{
			$billerId = $_GET['billerId'];
			$sql = "SELECT * FROM biller_user_details JOIN user ON biller_user_details.userId = user.userId WHERE biller_user_details.billerId = '".$billerId."' ORDER BY user.lname ASC";
			$result = mysqli_query($connect,$sql);
			
			$response = array();
			
			while($users = mysqli_fetch_assoc($result))
			{
				$temp = array();
				$temp['ID'] = $users['userId'];
				$temp['lastname'] = $users['lname'];
				$temp['firstname'] = $users['fname'];
				$temp['MI'] = $users['mi'];
				$temp['email'] = $users['email'];
				$temp['username'] = $users['username'];
				$temp['contactNo'] = $users['contactNo'];
				array_push($response,$temp);
				
			}
			echo json_encode($response);
		}
	//}
?>

	
