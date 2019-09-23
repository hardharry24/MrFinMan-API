<?php
    date_default_timezone_set('Asia/Kuala_Lumpur');
	$connect = mysqli_connect("localhost","root","","finmandb");
	if(!$connect)
	{
		echo "Connection Failed";
	}
?>


