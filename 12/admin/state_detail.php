<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="web/css/style.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>city from state</title>
</head>
<body>
<?php
include_once("../connection.php");
echo "<select name='drpcity' class='text'>";
echo "<option value='0'>--select--</option>";
$a=$_GET["q"];
$res=mysql_query("select * from city where sid=".$a."");
//echo "select * from city where sid=".$a."";die();
while ($row=mysql_fetch_array($res))
{
	echo "<option value=".$row['cid'].">".$row['city_name']."</option>";
}
echo "</select>";
?>
</body>
</html>
