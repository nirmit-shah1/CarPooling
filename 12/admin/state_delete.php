<?php
session_start();
if(isset($_SESSION['adminusername']))
{	
	include_once("..\connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>State delete</title>
</head>
<body>
<?php
	$sid1=$_GET['id'];
	$query=mysql_query("delete from state where sid=".$sid1);
	if($query)
	{
		header("location:state.php");
	}
?>
</body>
</html>
<?php
}
else
	header("location:../index.php");
?>