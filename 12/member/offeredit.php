<?php 
	session_start();
if(isset($_SESSION['emailcommanusername']))
{
	$reg_id=$_SESSION['reg_id'];
	include_once("../connection.php");
	include_once("toptemplate2.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit your offer Details</title>
</head>
<body>
		<?php
			if(isset($_SESSION['check']))
			{
				$_SESSION['midedit']=$_GET['mid'];
				$_SESSION['rid']=$_GET['rid'];
				unset($_SESSION['check']);
				header("location:memberroutedetailsupdate.php");
			}
			else
			{
				header("location:offerdetails.php");
			}
		?>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>