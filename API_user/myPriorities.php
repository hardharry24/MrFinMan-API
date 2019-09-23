<?php
	require("connect.php");
	
	$response = array();
	$temp = array();
	/*if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{*/

		$todo = $_GET['todo'];
		if ($todo == "LIST")
		{
			$userId = $_GET['userId'];
			$sql = "SELECT * FROM `user_priorities` JOIN category ON category.categoryId = user_priorities.categoryId WHERE user_priorities.isActive = 1 AND user_priorities.userId = '".$userId."'";
			$result = mysqli_query($connect,$sql);
			while($pr = mysqli_fetch_assoc($result))
			{
				
				$temp['pId'] = $pr['pId'];
				$temp['categoryId'] = $pr['categoryId'];
				$temp['categorDesc'] = $pr['categoryDesc'];
				$temp['icon'] = $pr['categoryIcon'];
				$temp['percentage'] = $pr['percentage'];

				array_push($response,$temp);
			}
		}
		else if ($todo == "INSERT")
		{
			
			$categoryId = $_GET['categoryId'];
			$percentage = $_GET['percentage'];
			$userId = $_GET['userId'];


			$sql = "SELECT * FROM user_priorities WHERE categoryId = '".$categoryId."' AND isActive=1 AND userId = '".$userId."'";
			$result = mysqli_query($connect,$sql);
	
			if (mysqli_num_rows($result))
			{
				$temp['code'] = '0';
				$temp['message'] = "Category is already exist!";
				array_push($response,$temp);
			}
			else
			{
				$sql = "INSERT INTO `user_priorities` (`categoryId`, `percentage`, `isActive`,`userId`) VALUES ( '".$categoryId."', '".$percentage."', '1','".$userId."')";
				$result = mysqli_query($connect,$sql);
				if ($result)
				{
					$temp['code'] = '1';
					$temp['message'] = "Category Successfuly Added!";
					array_push($response,$temp);
				}
				else
				{
					$temp['code'] = '0';
					$temp['message'] = "Error Occured!";
					array_push($response,$temp);
				}
			}
			
		}
		else if ($todo == "CHECK")
		{

			$sql = "SELECT SUM(percentage) as sum FROM priorities WHERE isActive=1";
			$result = mysqli_query($connect,$sql);
			$pr = mysqli_fetch_assoc($result);

			if ($pr['sum'] == 100)
			{
				$temp['code'] = '1';
				$temp['total'] = $pr['sum'];
				$temp['message'] = "100%";
				array_push($response,$temp);
			}
			else 
			{
				$temp['code'] = '0';
				$temp['total'] =$pr['sum'];
				$temp['message'] = "Percentage is not equal to 100%!";
				array_push($response,$temp);
			}

		}
		else if ($todo == "UPDATE")
		{
			$pId = $_GET['pId'];
			$categoryId = $_GET['categoryId'];
			$percentage = $_GET['percentage'];

			$sql = "UPDATE `priorities` SET `categoryId`='".$categoryId."',`percentage`='".$percentage."' WHERE pId = '".$pId."'";
			$result = mysqli_query($connect,$sql);
			if ($result)
			{
				$temp['code'] = '1';
				$temp['message'] = "Category Successfuly Updated!";
				array_push($response,$temp);
			}
			else
			{
				$temp['code'] = '0';
				$temp['message'] = "Error Occured!";
				array_push($response,$temp);
			}
		}
		else if ($todo == "DELETE")
		{
			$pId = $_GET['pId'];

			$sql = "UPDATE `priorities` SET isActive=0 WHERE pId = '".$pId."'";
			$result = mysqli_query($connect,$sql);
			if ($result)
			{
				$temp['code'] = '1';
				$temp['message'] = "Category Successfuly Deleted!";
				array_push($response,$temp);
			}
			else
			{
				$temp['code'] = '0';
				$temp['message'] = "Error Occured!";
				array_push($response,$temp);
			}
		}
		else if ($todo == "UNDO")
		{
			$pId = $_GET['pId'];

			$sql = "UPDATE `priorities` SET isActive=1 WHERE pId = '".$pId."'";
			$result = mysqli_query($connect,$sql);
			if ($result)
			{
				$temp['code'] = '1';
				$temp['message'] = "Category Successfuly Deleted!";
				array_push($response,$temp);
			}
			else
			{
				$temp['code'] = '0';
				$temp['message'] = "Error Occured!";
				array_push($response,$temp);
			}
		}

		
	echo json_encode($response);
?>