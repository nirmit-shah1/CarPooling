<html>
<title>Particular ride detail</title>
<body>
<?php 
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("toptemplate3.php");
	include_once("connection.php");
	include_once("hmenu.php");
	$driverid = $_SESSION['driverid'];													
	echo "<a href='checkridesofdriver.php?driverid=$driverid'>";?><font color="#990000" size="+2"><-Back to Rides Details Page</font></a>
	<?php
	$rideid=$_GET['rideid'];
	$sql1=mysql_query("select * from routedetails  where mid=$rideid");
	$sql2=mysql_query("select * from membertravellingdetails  where mid=$rideid");
	$sql3=mysql_query("select * from typeoftrip  where mid=$rideid");
	?>
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">Details of Ride</font></p>
		
	<div class="boxinfo">
		<table >
	<?php
	while($row1=mysql_fetch_array($sql1))
	{
	$row2=mysql_fetch_array($sql2);
	$row3=mysql_fetch_array($sql3);
			echo "<tr><td>Depature location:-</td><td>".$row1[2]."</td></tr>";
			echo "<tr><td>Arrival location:-</td><td>". $row1[3]."</td></tr>";
			echo "<tr><td>Intermidiate location 1:-</td><td>". $row1[4]."</td></tr>";
			echo "<tr><td>Intermidiate location 2:-</td><td>". $row1[5]."</td></tr>";
			echo "<tr><td>Price Per Traveller:-</td><td>". $row2[2]."</td></tr>";
			echo "<tr><td>Seats avaiable :-</td><td>". $row2[3]."</td></tr>";
			echo "<tr><td>Luggage Allowed:-</td><td>". $row2[4]."</td></tr>";
			echo "<tr><td>Will Leave:-</td><td>". $row2[5]."</td></tr>";
			echo "<tr><td>Detour:-</td><td>". $row2[6]."</td></tr>";
			echo "<tr><td>Date Of Ride:-</td><td>". $row3[3]."</td></tr>";
			echo "<tr><td>Time Of Ride:-</td><td>". $row3[4]."<br>";
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