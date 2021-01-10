
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>model from company</title>
</head>
<body>
<?php
include_once("../connection.php");

/*$a=$_GET["q"];

$res=mysql_query("select * from model where coid=".$a."");
echo "select * from model where coid=".$a;
while($row=mysql_fetch_array($res))
{
echo $row[0]."<br>"; 
echo $row['model_name']; ?>
	
<?php }*/
$a=$_GET["q"];
$res=mysql_query("select * from model where coid=".$a."");

echo "<td>";

?>
<select name="drpproduct">

<?php
/*echo "<select name='prd' style='
  padding: 5px;
  box-shadow: inset 1px 1px 2px 0 #c9c9c9;
	border: solid 1px #000000;
  box-shadow: inset 1px 1px 2px 0 #000000;
  transition: box-shadow 0.3s;'>";*/
//echo "<option value='0' class='text'>--select--</option>";
//echo "select * from city where sid=".$a."";die();
while ($row=mysql_fetch_array($res))
{
echo $row[0];?>
<option value="<?php echo $row[0]; ?>"><?php echo $row['model_name']; ?> </option>
<?php }
echo "</select>";
echo "</td>";
?>
</body>
</html>
