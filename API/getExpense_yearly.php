<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		$date = $_POST['date'];
		
		$sql = "SELECT SUM(amount) as sum from expense JOIN  user ON expense.userId = user.userId WHERE username = '".$username."' AND DATE_FORMAT(expense.dateCreated,'%Y') = '".$date."' AND `isDeleted`= 0";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_assoc($result);
		$sum = $row['sum'];
	
			
		$response = array();
		$sql = "SELECT category.categoryId,SUM( `amount`) as amount, category.categoryDesc, expense.dateCreated FROM `expense` JOIN category ON expense.categoryId= category.categoryId INNER JOIN user ON user.userId = expense.userId where username ='".$username."' AND DATE_FORMAT(expense.dateCreated,'%Y') = '".$date."' AND `isDeleted`= 0 GROUP BY categoryId";
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
	}
?>