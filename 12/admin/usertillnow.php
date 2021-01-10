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
<title>Registered User Page</title>
</head>
<body>
<br>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Details Of Registered Users</font></p></div>
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
<thead>
<table width="1178" height="65" cellpadding="20">
<tr>
  <th width="170" scope="col" background="../simple signup/img/323a45-2880x1800.png" align="center" ><font color="#ffffff">Registration id </font></th>
  <th width="92" scope="col" background="../simple signup/img/323a45-2880x1800.png" align="center"><font color="#ffffff">First name</font></th>
  <th width="90" align="center" scope="col" background="../simple signup/img/323a45-2880x1800.png"><font color="#ffffff">Last name</th>
  <th width="77" align="center" scope="col" background="../simple signup/img/323a45-2880x1800.png"><font color="#ffffff">Contact no.</th>
  <th width="66" align="center" scope="col" background="../simple signup/img/323a45-2880x1800.png"><font color="#ffffff">Gender</th>
<th width="157" align="center" scope="col" background="../simple signup/img/323a45-2880x1800.png"><font color="#ffffff"> Registration Date</font></th>
<th width="342" style="color:#ffffff" scope="col" background="../simple signup/img/323a45-2880x1800.png">Details</th>
</thead>
<tbody>

<?php
$sql=mysql_query("select * from signup_details ");
while($row=mysql_fetch_array($sql))
{
echo"<tr>";
echo "<td align='center'  style='color:#0099FF'>".$row['reg_id']."</td>";
echo "<td align='center'  style='color:#0099FF'>".$row['firstname']."</td>";
echo "<td align='center'  style='color:#0099FF'>".$row['lastname']."</td>";
echo "<td align='center'  style='color:#0099FF'>".$row['contactno']."</td>";
echo "<td align='center'  style='color:#0099FF'>".$row['gender']."</td>";
echo "<td align='center'  style='color:#0099FF'>".$row['date']."</td>";
echo "<td align='center'  style='color:#0099FF'><a href=usertillnowdetails.php?detailsid=".$row['reg_id'].">More Details </a></td></tr>";
echo"</tr>";
}
?> 
</table>
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
</tbody>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>