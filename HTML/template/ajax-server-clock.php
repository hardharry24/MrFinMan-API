<?Php
//***************************************
// This is downloaded from www.plus2net.com //
// You can distribute this code with the link to www.plus2net.com ///
// Please don't  remove the link to www.plus2net.com ///
// This is for your learning only not for commercial use. ///////
// The author is not responsible for any type of loss or problem or damage on using this script.//
// You can use it at your own risk. /////
//*****************************************
// ini_set('display_errors', true);//Set this display to display  all erros while testing and developing the script
//////////////////////////////
?>
<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title></title>

<script type="text/javascript">
function AjaxFunction()
{
var httpxml;
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
		  try
   			 		{
   				 httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    				}
  			catch (e)
    				{
    			try
      		{
      		httpxml=new ActiveXObject("Microsoft.XMLHTTP");
     		 }
    			catch (e)
      		{
      		alert("Your browser does not support AJAX!");
      		return false;
      		}
    		}
  }
function stateck() 
    {
    if(httpxml.readyState==4)
      {
document.getElementById("msg").innerHTML=httpxml.responseText;
document.getElementById("msg").style.background='#f1f1f1';
      }
    }
	var url="ajax-server-clock-demock.php";
url=url+"?sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
tt=timer_function();
  }

///////////////////////////
function timer_function(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('AjaxFunction();',refresh)
}

</script>

</head>
<body>

<div id="msg"></div>
<br>
<input type=button value='Get Server Time' onclick="timer_function();">

<center>
<br><br><a href='http://www.plus2net.com' rel='nofollow'>plus2net.com : Ajax PHP SQL HTML free tutorials and scripts</a></center> 

</body>
</html>
