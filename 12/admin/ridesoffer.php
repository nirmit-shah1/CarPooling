<?php 
session_start();
if(isset($_SESSION['adminusername']))
{

include_once("toptemplate3.php");

include_once("connection.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../simple signup/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../simple signup/css/navi.css" media="screen" />
<title>Details Of Rides</title>
</head>
<body>
<br>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">No. Of Rides Offered By Individual Users</font></p>
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
<div class="boxinfo" style="padding-bottom:100px;">		

<?php
$sql="select *  from login ";
$result=mysql_query($sql);
/*$sql3="select *  from signup_details ";
$result3=mysql_query($sql);*/

?>
<table width="1233" height="91" cellpadding="10px" cellspacing="10px" >
<thead>
<tr><th width="306" scope="col" background="../simple signup/img/323a45-2880x1800.png"><font size="+2">Name Of Users</font></th>
<th  width="389" scope="col" background="../simple signup/img/323a45-2880x1800.png" ><font size="+2">No. Of Times Rides offered </th>
<th  width="436" scope="col" background="../simple signup/img/323a45-2880x1800.png"><font size="+2">Details</th>
</tr>
</thead>
<tbody>
<?php
while($row=mysql_fetch_array($result))
{
	/*$sql3="select *  from signup_details ";
	$result3=mysql_query($sql);*/
	$email=$row[1];
	//echo "<tr><td align='center'>".$name."</u></td>";
	$sql1=mysql_query("select * from login where email='".$email."'");
	$row1=mysql_fetch_array($sql1);
	$reg =$row1[0];
	$sql3=mysql_query("select * from signup_details where reg_id=$reg");
	$row3=mysql_fetch_array($sql3);
$sql4=mysql_query("select * from signup_details");
	$row4=mysql_fetch_array($sql4);
	echo "<tr><td align='center' style='color:#0099FF'>".$row3[1]."</u></td>";
	$sql2=mysql_query("select * from routedetails where reg_id='".$reg."'");
	echo "<td align='center' style='color:#0099FF'  >".mysql_num_rows($sql2)."</td>";
	echo "<td align='center' style='color:#0099FF' ><a href=moredetails.php?routeid=".$row['reg_id'].">More Details </a></td></tr>";
	
}
?>
</table><br><br><br>
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>

</body>
</html>
<?php
}
else
	header("location:../index.html");
?>