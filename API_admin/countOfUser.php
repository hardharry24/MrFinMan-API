<?php
	
	require("connect.php");

	$response = array();
	//$sql = "SELECT user.roleId, role.roleName, COUNT(user.userId) AS count FROM user INNER JOIN role ON user.roleId = role.roleId GROUP BY user.roleId";

	//$result = mysqli_query($connect,$sql);

	$sql = "SELECT COUNT(user.userId) as userActive FROM user WHERE user.isActive = 1 AND user.roleId = 1";
	$result = mysqli_query($connect,$sql);
	$usersActive = mysqli_fetch_assoc($result);
	$activeUser["activeUser"] = $usersActive["userActive"];
	array_push($response,$activeUser);

	$sql = "SELECT COUNT(user.userId) as userActive FROM user WHERE user.isActive = 0 AND user.roleId = 1";
	$result = mysqli_query($connect,$sql);
	$usersInActive = mysqli_fetch_assoc($result);
	$InActiveUser["InactiveUser"] = $usersInActive["userActive"];
	array_push($response,$InActiveUser);

	$sql = "SELECT COUNT(user.userId) as userActive FROM user WHERE user.isActive = 1 AND user.roleId = 2";
	$result = mysqli_query($connect,$sql);
	$billerActive = mysqli_fetch_assoc($result);
	$activeBiller["activeBiller"] = $billerActive["userActive"];
	array_push($response,$activeBiller);

	$sql = "SELECT COUNT(user.userId) as userActive FROM user WHERE user.isActive = 0 AND user.roleId = 2";
	$result = mysqli_query($connect,$sql);
	$billerInActive = mysqli_fetch_assoc($result);
	$InActiveBiller["InactiveBiller"] = $billerInActive["userActive"];
	array_push($response,$InActiveBiller);

	


	/*while($users = mysqli_fetch_assoc($result))
	{
		$temp = array();
		$temp['roleId'] = $users['roleId'];
		$temp['roleName'] = $users['roleName'];
		$temp['count'] = $users['count'];

		array_push($response,$temp);

	}*/
	echo json_encode($response);

?>