
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
include_once("connection.php");

echo "<select name='drpmodel'>";
echo "<option value='0'>--select--</option>";
$a=$_GET["q"];
$res=mysql_query("select * from model where company_id=".$a."");

while ($row=mysql_fetch_array($res))
{
	echo "<option value=".$row[0].">".$row[2]."</option>";
}
echo "</select>";
?>
</body>
</html>
