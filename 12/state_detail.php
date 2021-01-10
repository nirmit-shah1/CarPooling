<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
include("../connection.php");
$a=$_GET["q"];

/*$res=mysql_query("select * from city where sid=".$a."");
echo "select * from city where state_name=".$a."";die();
*/
echo "<select name='drpcity'>";
echo "<option>--select--</option>";
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
