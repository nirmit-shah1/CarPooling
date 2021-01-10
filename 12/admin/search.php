<html>
<body>
<form action="#" method="get">
From<input type="text" name="txtFrom" />
<?php
if(isset($_SESSION['frmerror']))
{
echo"enter your source";
unset($_SESSION['frmerror']);
}
?>
To<input type="text" name="txtTo" />
<?php
if(isset($_SESSION['toerror']))
{
echo"enter your source";
unset($_SESSION['toerror']);
}
?>
<input type="submit" value="search" name="submit" />
</form>
</body>
</html>
<?php
include_once("connection.php");
if(isset($_POST['submit']))
{
session_start();
//WHERE source like '%".$f."%' OR destination LIKE '%".$t."%'

$f=$_POST['txtFrom'];
$t=$_POST['txtTo'];
/*if($f == NULL)
{
	$_SESSION['fromerror']=1;
}
if($t == NULL)
{
	$_SESSION['toerror']=1;
}

*/
//$a=$_SESSION['reg_id'];
//select reg_id from routedetails where source= '$f' AND destination= '$t' 
//echo $f,$t;
/*$sql="SELECT * FROM routedetails WHERE source like '%".$f."%' OR destination LIKE '%".$t."%'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$s=$row[2];
$d= $row[3];
}*/
$sql1="select * from routedetails  where source like '%".$f."%' AND destination LIKE '%".$t."%' ";
//echo $sql1;

?>
<html>
<body>
<table border="2">
<?php $result1=mysql_query($sql1);
while($row1=mysql_fetch_array($result1))
{
echo "<tr>";
	echo "<td>".$row1[1]."</td>";
	$sql2=mysql_query("select *  from signup_details where reg_id=".$row1['reg_id']);
	$row2=mysql_fetch_array($sql2);
	echo "<td>".$row2['firstname']."</td>";
	echo "<td>".$row2['lastname']."</td>";
	echo "<td>".$row1[2]."</td>";
	echo "<td>".$row1[3]."</td>";
	echo "</tr>";
}

}
?>
<?php
/*if($f==$s and $t==$d)
{*/
/*$sql1="select * from routedetails  where source like '%".$f."%' AND destination LIKE '%".$t."%' ";
//echo $sql1;
$result1=mysql_query($sql1);
while($row1=mysql_fetch_array($result1))
{
echo "<tr>";
	echo "<td>".$row1[1]."</td>";
	$sql2=mysql_query("select *  from signup_details where reg_id=".$row1['reg_id']);
	$row2=mysql_fetch_array($sql2);
	echo "<td>".$row2['firstname']."</td>";
	echo "<td>".$row2['lastname']."</td>";
	echo "<td>".$row1[2]."</td>";
	echo "<td>".$row1[3]."</td>";
	ec9.ho "</tr>";
}
*/
?>
</table>
</body>
</html> 