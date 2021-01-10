<?php 
session_start();
if(isset($_SESSION['adminusername']))
{

include_once("toptemplate3.php");
include_once("connection.php");

$id=$_GET['detailsid'];
//syntax for displaying data
$sql=mysql_query("select * from login  where reg_id=$id");
$row=mysql_fetch_array($sql);
$sql1=mysql_query("select * from signup_details  where reg_id=$id");
$row1=mysql_fetch_array($sql1);
$sql2=mysql_query("select * from images  where reg_id=$id");
$row2=mysql_fetch_array($sql2);
$sql3=mysql_query("select * from routedetails  where reg_id=$id");
?>
<html>
<body>
<title>More Details Of User</title>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Details Of User:-</font></p></div>
<div class="boxinfo" style="padding-bottom:100px;">
<table  cellpadding="20">
<?php
echo "<tr><td colspan='2'><img align='middle'  src='images/".$row2[1]."' height='250px' width='350px' ></td></tr>";					
echo "<tr><td>First Name Of User:-</td>";
echo "<td>".$row1[1]."</td></tr>";
echo "<tr><td>Last Name Of User:-</td>";
echo "<td>".$row1[2]."</td></tr>";
echo "<tr><td>Email-id Of User:-</td>";
echo "<td>".$row[1]."</td></tr>";
echo "<tr><td>Contact No Of User:-</td>";
echo "<td>".$row1[3]."</td></tr>";
echo "<tr><td>Gender Of User:-</td>";
echo "<td>".$row1[4]."</td></tr>";
echo "<tr><td>Basic Info  Of User:-</td>";
echo "<td>".$row1[5]."</td></tr>";
echo "<tr><td>Registration Date  Of User:-</td>";
echo "<td>".$row1[6]."</td></tr>";
echo "<tr><td>No. Of Rides Offered By User:-</td>";
echo "<td>".mysql_num_rows($sql3)."</td></tr>";
?>
</table><br />
<a href="usertillnow.php"><font color="#990000" size="+2"><-Back to Registered User Page</font></a>
</div>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>