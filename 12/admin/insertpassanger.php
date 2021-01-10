<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{		
	ob_start();
	include_once("connection.php");
	include_once("toptemplate.php");
	include_once("hmenu.php");
	
	$pid=$_SESSION['passengerid'];
	$did=$_SESSION['reg_id'];
	if(isset($_POST['rating']))
	{
		$rate=$_POST['rating'];
	}
	else
		$rate="";
	if(isset($_POST['taComment']))
	{
		$comment=$_POST['taComment'];
	}
	else
	{
		$comment="";
	}
	
	if($rate=="" && $comment=="")
	{
		$_SESSION['error']=1;
		header("location:ratingpassangerdetails.php");
	}
	else
	{
	
		   $sql = "update prating set rate='$rate' , comment='$comment' where pid=$pid AND did=$did ";
			$state=mysql_query($sql);?>
	<html>
	<body>
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+3">Rate the Passanger </font></p>
	<div class="boxinfo" style="padding-bottom: 20px; padding-top:20px;">
	<img src="img/like.png" height="400" width="350" /><br />
	<h2 style="color:#66FF33; font-size:34px;">Thank You For Giving Feedback About Passanger</h2> <br />
	<a href="rateingpassanger.php" style="color:#990000; font-size:29px;">Back To Rating Page</a>
	</div>
	</body>
	</html>		

<?php 
	}
}
else
	header("location:../index.html");
?>