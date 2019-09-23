<?php 
	require("connect.php");
	
	$userId = $_GET['userId'];
	$msg = $_GET['message'];
	$type = $_GET['type'];
	
	
	$sql = " Select deviceToken From user WHERE userId = '".$userId."'";
	$result = mysqli_query($connect,$sql);
	$tokens = array();
	if(mysqli_num_rows($result) > 0 ){
		while ($row = mysqli_fetch_assoc($result)) {
			$tokens[] = $row["deviceToken"];
			//echo "". $row["deviceToken"];

		}
	}

	mysqli_close($connect);
	if ($type == "charge_bill")
	{
		$message = array("message" => "".$msg,"type"=>"charge_bill");
	}

	

	//$msg = '['.json_encode($message).']';

	$message_status = send_notification($tokens, $message);
	echo $message_status;


	function send_notification ($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			 'registration_ids' => $tokens,
			 'data' => $message
			);
		$headers = array(
			'Authorization:key = AAAAliNPb48:APA91bGQgFg-mX32kJWepEEkdvUHyFMdUW_sdffB5KOzN5I0dK6Yp5_jHMm9KpBmKcJU_DZz3xan0J-t2WMwSvBnAC-nya46FGbdQgwGqNVrVOW4j15KdLg_rJePx4Et5feBAN2-Nlid',
			'Content-Type: application/json'
			);
	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
	}
 ?>