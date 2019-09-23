<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$categoryID = $_POST['catID'];
		$user_ID = $_POST['user_ID'];
		$percentage = $_POST['percentage'];
		$isPriority = $_POST['isPriority'];


		
		$sql = "SELECT * FROM `user_allocation` WHERE user_allocation.categoryId = ".$categoryID." AND user_allocation.userId= ".$user_ID."";
		$result = mysqli_query($connect,$sql);
		//echo "Length ".mysqli_num_rows($result);
	    //$category = mysqli_fetch_assoc($result);
		
		if (mysqli_num_rows($result) > 0)
		{
			$sql = "UPDATE `user_allocation` SET `percentage`=".$percentage.",`isPriority` = '".$isPriority."' WHERE user_allocation.categoryId ='".$categoryID."' AND user_allocation.userId= ".$user_ID."";
			if (mysqli_query($connect,$sql))
				echo '1';
			else
				echo '2';
		}
		else
		{
			$sqlInsert = "INSERT INTO `user_allocation`(`percentage`, `categoryId`, `userId`,`isPriority`) VALUES ('".$percentage."','".$categoryID."','".$user_ID."','".$isPriority."')";
			if(mysqli_query($connect,$sqlInsert))
				echo '1';
			else
				echo ''.mysqli_error($connect);
		}	
		mysqli_close($connect);
	}
?>