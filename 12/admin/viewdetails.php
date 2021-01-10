<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{	
	$_SESSION['searchvalue']=1;
	include_once("toptemplate.php");
	include_once("hmenu.php");
	include_once("connection.php");
	$id=$_GET['pid'];
	$_SESSION['pid']=$id;
	$_SESSION['memberid']=$id;
	$sql1=mysql_query("select * from routedetails where reg_id=".$id);
	$sql2=mysql_query("select * from membertravellingdetails where reg_id=".$id);
	$sqlcar=mysql_query("select * from member_signup  where reg_id=".$id);

	$result=mysql_query("select * from signup_details where reg_id=".$id);
	//$result=mysql_query($sql);
	?>
	<html>
		<title>User ride details</title>	
	<body >
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">Detail Information Of Member</font></p>
	<div class="boxinfo">
	<table >

	<?php while($row=mysql_fetch_array($result))
	{
		echo "<tr><td>Name Of Driver:-</td>";
		echo"<td>".$row[1];
		echo "&nbsp;".$row[2]."</td>";
		echo "<td><a href='viewdetailofdriver.php?driverid=$id'>View Profile</a></td></tr>";
		echo "<tr><td>Contact No:-</td>";
		echo "<td>".$row[3]."</td></tr>";
		$row1=mysql_fetch_array($sql1);
		echo "<tr><td>Depature location:-</td><td>".$row1[2]."</td></tr>";
		echo "<tr><td>Arrival location:-</td><td>".$row1[3]."</td></tr>";	
		echo "<tr><td>Intermidiate location 1:-</td><td>".$row1[4]."</td></tr>";	
		echo "<tr><td>Intermidiate location 2:-</td><td>".$row1[5]."</td></tr>";	
		$row2=mysql_fetch_array($sql2);
		echo "<tr><td>Price Per Traveller:-</td><td>".$row2[2]."</td></tr>";	
		echo "<tr><td>Seats avaiable :-</td><td>".$row2[3]."</td></tr>";
		echo "<tr><td>Luggage Allowed:-</td><td>".$row2[4]."</td></tr>";		
		echo "<tr><td>Will Leave:-</td><td>".$row2[5]."</td></tr>";	
		echo "<tr><td>Detour:-</td><td>".$row2[6]."</td>";
		$rowresult=mysql_fetch_array($sqlcar);
		$product=$rowresult['product'];

			$sqlfinalcar=mysql_query("select * from model where moid=".$product);
		$rowmodel=mysql_fetch_array($sqlfinalcar);
		
		if(!($rowmodel))
		{
		echo "<tr><td>Car Model:-</td><td>Not Mention</td>";	
		}
		else
		{
		echo "<tr><td>Car Model:-</td><td>".$rowmodel['model_name']."</td>";
		}
		echo "<td><a href='viewratingandcommentofdriver.php?driverid=$id'> Check Rating And Comments</a></td></tr>";
		echo "<tr><td>Message:-</td><td><a style='margin-right:'10px';  border:'solid';  background-color:'#00CC00';'  href='viewdetailsback.php' target='_blank' class='button-3' ><font color='#FFFFFF' size=+2>SMS To the driver</font></a>";
echo "<td><form action='privatemessage.php'><input style='margin-top:-20px; margin-left:-1px;' type='submit' value='Private Message>>' class='button-3'></form></td></tr>";		
	echo"<tr><td><a href='searchback.php'><u>Back To The Search List</u></a></td></tr>";
	}
	?>
	</div>
		</body>

	</html>
<?php
}
else
	header("location:../index.html");
//<form action='viewdetailsback.php'>
//<input style='margin-top:-20px; margin-left:-1px;' type='submit' value='send message>>
?>