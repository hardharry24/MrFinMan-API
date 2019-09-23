
<?php
	require("connect.php");
	/*if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{*/
		$userID = $_GET['userID'];
		//$userID = '41';
		
		$sql = "SELECT goal.goalId,goal.categoryId,goal.goalName,goal.amount,goal.description,goal.targetDate,goal.dateCreated,category.categoryDesc,category.categoryIcon, goal.isNotify FROM goal INNER JOIN category ON category.categoryId = goal.categoryId WHERE goal.userId  = '".$userID."' AND isDeleted = 0 AND goal.status = 'ongoing'";
		
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($goals = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['goal_ID'] = $goals['goalId'];
			$temp['category_id'] = $goals['categoryId'];
			$temp['goal_name'] = $goals['goalName'];
			$temp['amount'] = $goals['amount'];
			$temp['description'] = $goals['description'];
			$temp['targetDate'] = $goals['targetDate'];
			$temp['dateCreated'] = $goals['dateCreated'];
			$temp['category_Desc'] = $goals['categoryDesc'];
			$temp['icon'] = $goals['categoryIcon'];
			$temp['isNotify'] = $goals['isNotify']; 
			array_push($response,$temp);
		}
		echo json_encode($response);
		
	//}
?>