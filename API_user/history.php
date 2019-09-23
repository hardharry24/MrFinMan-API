
<?php
	require("connect.php");
		
		$response = array();
		if (isset($_GET['username']))
		{
			$username =  $_GET['username'];
			$sql = "SELECT * FROM `history` JOIN user ON user.userId = history.userid WHERE user.username = '".$username."' ORDER BY history.dateCreated DESC";

			$results = mysqli_query($connect,$sql);

			while($history = mysqli_fetch_assoc($results))
			{
				$temp = array();
				$temp['id'] = $history['id'];
				$temp['name'] = $history['histActionName'];
				$temp['details'] = $history['histDetails'];
				$temp['date'] = $history['dateCreated'];
				$temp['icon'] = $history['icon'];
				$temp['userid'] = $history['userid'];
				array_push($response,$temp);
			}
			echo json_encode($response);
		}

?>

	
