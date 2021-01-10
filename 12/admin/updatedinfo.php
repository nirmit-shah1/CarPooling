0<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{	
	include_once("toptemplate.php");
	include_once("connection.php");
	include_once("hmenu.php");
?>
	<html>
	<body>
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+3">Updated Information</font></p>
	<div class="boxinfo">
	<br><br><br>
	<table width="259" height="96" border="2">
<?php
	
	$a=$_SESSION['reg_id'];
	$sql="select * from signup_details where reg_id = $a";
	$result=mysql_query($sql);
	$sql1="select * from login where reg_id = $a";
	$result1=mysql_query($sql1);
	
	while($row=mysql_fetch_array($result))
	{
		echo "<tr>";
		echo"<td align='left'>First name</td>";
		echo "<td align='left'>".$row[1]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo"<td align='left'>Last name</td>";
		echo "<td align='left'>".$row[2]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo"<td align='left'>Contact no</td>";
		echo "<td align='centre'>".$row[3]."</td>";
		echo "</tr>";
	}
	while($row1=mysql_fetch_array($result1))
	{
		echo "<tr>";
		echo"<td align='left'>E-mail id</td>";
		echo "<td align='left'>".$row1[1]."</td>";
		echo "</tr>";
		
	}
?>
	</table>
	</div>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>