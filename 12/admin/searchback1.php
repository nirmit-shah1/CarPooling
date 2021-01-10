<?php
include_once("connection.php");
if(isset($_POST['submit']))
{
session_start();
$t=$_POST['txtto'];
if($_POST['txtfrom']== NULL)
{
	$_SESSION['fromerror']=1;
	header("location:searchfront.php");
}
else
{
	$f=$_POST['txtfrom'];
	$_SESSION['fromvalue']=$f;
}
if($_POST['txtto']== NULL)
{
	$_SESSION['toerror']=1;
	header("location:searchfront.php");
}
else
{
	$t=$_POST['txtto'];
	$_SESSION['tovalue']=$t;
}
if(!($f==NULL || $t==NULL))
{
	
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
	//$sql2=mysql_query("select *  from signup_details s,file f where s.reg_id=".$row1['reg_id']."  and f.reg_id=".$row1['reg_id'] );
	$sql2=mysql_query("select * from file  where reg_id=".$row1['reg_id']);
	$row2=mysql_fetch_array($sql2);
	//$row3=mysql_fetch_array($sql3);
	echo "<td><img src='images/".$row2['f_name']."' height='50px' width='50px' ></td>";
	
	$sql3=mysql_query("select * from signup_details  where reg_id=".$row1['reg_id']);
	$row3=mysql_fetch_array($sql3);
	
	echo "<td>".$row3['firstname']."</td>";
	echo "<td>".$row3['lastname']."</td>";
	echo "<td>".$row1[2]."</td>";
	echo "<td>".$row1[3]."</td>";
	echo "</tr>";
}

}

}
else
{
	header("location:searchfront.php");
}?>
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
//WHERE source like '%".$f."%' OR destination LIKE '%".$t."%'
?>
</table>
</body>
</html> 