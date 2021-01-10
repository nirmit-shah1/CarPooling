<?php
	session_start();
	if(isset($_SESSION['adminusername']))
	{ 
		include("../connection.php");
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>delete cityt</title>
	</head>
	<body>
	<?php
		$cid=$_GET['id'];
		$result=mysql_query("delete from city where cid=".$cid);
		if($result)
		{
			header("location:city.php");
		}
		else
		{
			echo "Error in deleting data";
		}
	?>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>
