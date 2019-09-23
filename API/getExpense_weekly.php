<?php
	require("connect.php");
		$username = $_GET['username'];
		$dateFrom = $_GET['dateFrom'];
		$dateTo = $_GET['dateTo'];

		$sql = "SELECT SUM(amount) as sum from expense JOIN  user ON expense.userId = user.userId WHERE username = '".$username."' AND expense.dateCreated  BETWEEN '".$dateFrom."' AND '".$dateTo."' AND `isDeleted`= 0";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_assoc($result);
		$sum = $row['sum'];


		$response = array();
		$sql = "SELECT category.categoryId,SUM( `amount`) as amount, category.categoryDesc, expense.dateCreated FROM `expense` JOIN category ON expense.categoryId= category.categoryId INNER JOIN user ON user.userId = expense.userId where username ='".$username."' AND expense.dateCreated BETWEEN '".$dateFrom."' AND '".$dateTo."' AND `isDeleted`= 0 GROUP BY categoryId";

		$result = mysqli_query($connect,$sql);
		
		while($category = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['catID'] = $category['categoryId'];
			$temp['Name'] = $category['categoryDesc'];
			$temp['Percentage'] =  round($category['amount'] / $sum * 100,2);
			$temp['dateCreated'] = $category['dateCreated'];
			array_push($response,$temp);
		}
		echo json_encode($response);
	
?>