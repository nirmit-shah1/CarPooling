<?php
session_start();
if(isset($_SESSION['adminusername']))
{

include_once("toptemplate3.php");
include_once("connection.php");

$id=$_GET['routeid'];
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../simple signup/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../simple signup/css/navi.css" media="screen" />
<title>Details Of user Rides</title>
</head>

<body>
<?php
$result=mysql_query("select * from signup_details where reg_id=$id");
$row=mysql_fetch_array($result);
?>
<br>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Rides Offered By:-<?php echo $row[1]; ?></font></p></div>
<a href="ridesoffer.php"><font color="#990000" size="+2"><-Back to Rides Offer Page</font></a>
<table width="1442" height="68" cellpadding="10px" >
<thead>  
<tr>
<th width="342" scope="col" background="../simple signup/img/323a45-2880x1800.png" >Departure Location</th>
<th width="325" scope="col" background="../simple signup/img/323a45-2880x1800.png">Arrival Location</th>
<th width="314" scope="col" background="../simple signup/img/323a45-2880x1800.png">Intermidiate Location 1</th>
<th width="342" scope="col" background="../simple signup/img/323a45-2880x1800.png">Intermidiate Location 2</th>
<th width="342" scope="col" background="../simple signup/img/323a45-2880x1800.png">More details</th>
  </tr>
</thead>
<tbody>
                                                                                                                <?php 
$result1=mysql_query("select * from routedetails where reg_id=$id");
while($row1=mysql_fetch_array($result1))
{
echo "<tr>";
echo "<td align='center' style='color:#0099FF'>".$row1[2]."</td>";
echo "<td align='center' style='color:#0099FF'>".$row1[3]."</td>";
echo "<td align='center' style='color:#0099FF'>".$row1[4]."</td>";
echo "<td align='center' style='color:#0099FF'>".$row1[5]."</td>";
echo "<td align='center' style='color:#0099FF' ><a href=moredetailsofridesadmin.php?routeid=".$row1['mid']."&driverid=".$row1['reg_id'].">More Details </a></td></tr>";
}

?>
       
</table>
<a href="ridesoffer.php"><font color="#990000" size="+2"><-Back to Rides Offer Page</font></a>
</div>
</body>
</html>

<?php
}
else
	header("location:../index.html");
?>