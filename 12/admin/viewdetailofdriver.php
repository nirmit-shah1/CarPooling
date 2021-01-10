<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("toptemplate2.php");
	include_once("connection.php");
	include_once("hmenu.php");
	$reg_id=$_SESSION['reg_id'];
	$id=$_GET['driverid'];
	$pid=$_SESSION['pid'];
	
	$sql=mysql_query("select * from login  where reg_id=$id");
	$row=mysql_fetch_array($sql);
	$sql1=mysql_query("select * from signup_details  where reg_id=$id");
	$row1=mysql_fetch_array($sql1);
	$sql2=mysql_query("select * from images  where reg_id=$id");
	$row2=mysql_fetch_array($sql2);
	$sql3=mysql_query("select * from routedetails  where reg_id=$id");
	?>
	<html>
		<title>Driver Profile</title>
	<body>
	<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Details Of Driver:-</font></p></div><br><br><br>
	<table  cellpadding="20">
	  <?php
	echo "<tr><td colspan='2' ><img align='middle'  src='images/".$row2[1]."' height='250px' width='350px' ></td>";
	echo"</tr>";					
	echo "<tr><td width='221px' style='margin-top:-100px;'>First Name Of User:-</td>";
	echo "<td td width='221px'>".$row1[1]."</td></tr>";
	echo "<tr><td td width='211px'>Last Name Of User:-</td>";
	echo "<td>".$row1[2]."</td></tr>";
	echo "<tr><td>Email-id Of User:-</td>";
	echo "<td>".$row[1]."</td></tr>";
	echo "<tr><td>Contact No Of User:-</td>";
	echo "<td>".$row1[3]."</td></tr>";
	echo "<tr><td>Gender Of User:-</td>";
	echo "<td>".$row1[4]."</td></tr>";
	echo "<tr><td>Basic Info  Of User:-</td>";
	echo "<td td width='211px'>".$row1[5]."</td></tr>";
	echo "<tr><td>No. Of Rides Offered By User:-</td>";
	echo "<td>".mysql_num_rows($sql3)."</td>";
	echo "<td colspan='0'><a href='checkridesofdriver.php?driverid=$id'>Check Rides Offer By User--></a></td>";
	echo "<td></td></tr>"
	?>
	</table>
	<br>
	<?php
	echo"<a href='viewdetails.php?pid=$pid'>";?><font color="#990000" size="+2"><-Back to Driver Details Page</font></a>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>