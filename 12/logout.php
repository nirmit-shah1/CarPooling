<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>log outt</title>
</head>

<body>
<?php
if(isset($_SESSION['adminusername']))
{
	unset($_SESSION['adminusername']);
session_destroy();	
header("location:index.html");
	
}
if(isset($_SESSION['emailcommanusername']))
{
	unset($_SESSION['emailcommanusername']);
	session_destroy();
	header("location:index.html");
}
?>
</body>
</html>
