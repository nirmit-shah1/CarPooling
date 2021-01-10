<?php
	session_start();
	include_once("../connection.php");
	if(isset($_SESSION['adminusername']))
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete Area Record</title>
</head>
<body>
<?php
	$aid=$_GET['aid'];
	$result=mysql_query("delete from area where aid=".$aid);
	if($result)
	{
		header("location:area.php");
	}
	else
	{
		echo "Error in deleting data";
	}
	?>

	<a href="area.php">Insert Area</a>

</body>
</html>
<?php
}
else
	header("location:../index.html");
	?>