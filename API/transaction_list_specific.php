<?php
	require("connect.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		$type =  $_POST['type'];
		$date = $_POST['date'];
		$catname = $_POST['catname'];

	
		if ($type=="Day")
		{
			$sql = "SELECT expenseId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, Expense.amount, Expense.description, Expense.dateCreated, Expense.imgReciept FROM Category INNER JOIN Expense ON Category.categoryId = Expense.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = expense.userId WHERE user.username = '".$username."' AND DATE_FORMAT(expense.dateCreated,'%d/%m/%Y') = '".$date."' AND  Category.categoryDesc = '".$catname."' AND `isDeleted`= 0
			UNION
			 SELECT incomeId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, income.amount, income.description, income.dateCreated,income.imgReciept FROM Category INNER JOIN income ON Category.categoryId = income.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = income.userId  WHERE user.username = '".$username."' AND DATE_FORMAT(income.dateCreated,'%d/%m/%Y') = '".$date."' AND  Category.categoryDesc = '".$catname."' AND `isDeleted`= 0  ORDER BY dateCreated DESC";
		}
		else if ($type=="Week")
		{
			$exp = explode(' ', $date);

			$sql = " SELECT expenseId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, Expense.amount, Expense.description, Expense.dateCreated, Expense.imgReciept FROM Category INNER JOIN Expense ON Category.categoryId = Expense.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = expense.userId WHERE user.username = '".$username."' AND  Category.categoryDesc = '".$catname."' AND  Expense.dateCreated BETWEEN '".$exp[0]."' AND '".$exp[1]."'  AND `isDeleted`= 0
			UNION
			 SELECT incomeId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, income.amount, income.description, income.dateCreated,income.imgReciept FROM Category INNER JOIN income ON Category.categoryId = income.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = income.userId  WHERE user.username = '".$username."' AND  Category.categoryDesc = '".$catname."' AND income.dateCreated BETWEEN '".$exp[0]."' AND '".$exp[1]."' AND `isDeleted`= 0 ORDER BY dateCreated DESC";
		}
		else if ($type=="Month")
		{
			$sql = " SELECT expenseId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, Expense.amount, Expense.description, Expense.dateCreated, Expense.imgReciept FROM Category INNER JOIN Expense ON Category.categoryId = Expense.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = expense.userId WHERE user.username = '".$username."' AND  Category.categoryDesc = '".$catname."' AND DATE_FORMAT(expense.dateCreated,'%M') = '".$date."'  AND `isDeleted`= 0
			UNION
			 SELECT incomeId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, income.amount, income.description, income.dateCreated,income.imgReciept FROM Category INNER JOIN income ON Category.categoryId = income.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = income.userId  WHERE user.username = '".$username."' AND  Category.categoryDesc = '".$catname."' AND DATE_FORMAT(income.dateCreated,'%M') = '".$date."' AND `isDeleted`= 0  ORDER BY dateCreated DESC";
		}
		else if ($type=="Year")
		{
			$sql = "SELECT expenseId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, Expense.amount, Expense.description, Expense.dateCreated, Expense.imgReciept FROM Category INNER JOIN Expense ON Category.categoryId = Expense.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = expense.userId WHERE user.username = '".$username."' AND  Category.categoryDesc = '".$catname."' AND DATE_FORMAT(expense.dateCreated,'%Y') = '".$date."'  AND `isDeleted`= 0
			UNION
			 SELECT incomeId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, income.amount, income.description, income.dateCreated,income.imgReciept FROM Category INNER JOIN income ON Category.categoryId = income.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = income.userId  WHERE user.username = '".$username."' AND  Category.categoryDesc = '".$catname."' AND DATE_FORMAT(income.dateCreated,'%Y') = '".$date."' AND `isDeleted`= 0  ORDER BY dateCreated DESC";
		}
		else if ($type=="All")
		{
			$sql = "SELECT expenseId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, Expense.amount, Expense.description, Expense.dateCreated, Expense.imgReciept FROM Category INNER JOIN Expense ON Category.categoryId = Expense.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = expense.userId WHERE user.username = '".$username."' AND  Category.categoryDesc = '".$catname."'  AND `isDeleted`= 0 
			UNION
			 SELECT incomeId as Id, Category.categoryDesc, Category.categoryIcon, Category_type.categoryTypeName, income.amount, income.description, income.dateCreated,income.imgReciept FROM Category INNER JOIN income ON Category.categoryId = income.categoryId INNER JOIN Category_type ON Category.categoryTypeId = Category_type.categoryTypeId INNER JOIN user ON user.userId = income.userId  WHERE user.username = '".$username."' AND  Category.categoryDesc = '".$catname."' AND `isDeleted`= 0  ORDER BY dateCreated DESC";
		}


		
		$result = mysqli_query($connect,$sql);
		
		$response = array();
		
		while($transactions = mysqli_fetch_assoc($result))
		{
			$temp = array();
			$temp['Id'] = $transactions['Id'];
			$temp['Name'] = $transactions['categoryDesc'];
			$temp['icon'] = $transactions['categoryIcon'];
			$temp['type'] = $transactions['categoryTypeName'];
			$temp['amount'] = $transactions['amount'];
			$temp['note'] = $transactions['description'];
			$temp['dateCreated'] = $transactions['dateCreated'];
			$temp['imgReciept'] = $transactions['imgReciept'];   		//imgReciept
			array_push($response,$temp);
		}
		echo json_encode($response);
		
	}
?>


