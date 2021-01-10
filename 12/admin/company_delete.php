<?php
	session_start();
	include_once("..\connection.php");
	if(isset($_SESSION['adminusername']))
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Alter Company name</title>
</head>
<body>
<?php
	$coid1=$_GET['id'];
	$query=mysql_query("delete from company where coid=".$coid1);
	if($query)
	{
		header("location:company.php");
	}
}
else
	header("location:../index.html");
?>
</body>
</html>
