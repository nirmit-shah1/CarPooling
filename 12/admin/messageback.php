<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
		include_once("../connection.php");
		$reg_id=$_SESSION['reg_id'];
		$receiverid=$reg_id;
?>
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>private messages</title>
		</head>
		
		<body>
<?php

		if(isset($_SESSION['senderid']))
			$senderid=$_SESSION['senderid'];
		else
			header("location:personalmessage.php");
		if($_POST['txt_message']==NULL)
		{
			header("location:personalmessage.php");	
		}
		else
		{
			$message=$_POST['txt_message'];
			$query1=mysql_query("select max(messageid) as messageid1 from privatemessage");
			if($data1=mysql_fetch_array($query1))
			{
				$messageid=$data1['messageid1'];
				$messageid++;
			}
			$query2=mysql_query("insert into privatemessage values ('$messageid','$receiverid','$senderid','$message',1)");
			if($query2)
			{
				header("location:personalmessage.php");
			}
		}
?>
		</body>
		</html>
<?php

}
else
	header("location:../index.html");
?>