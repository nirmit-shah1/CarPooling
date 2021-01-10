<?php 
session_start();
if(isset($_SESSION['adminusername']))
{
include_once("toptemplate3.php");
include_once("connection.php");
$sql=mysql_query("select * from logincount order by date desc");
?>
<html>
<title> Login Details</title>
<body>
<br>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Login Details</font></p>
<div class="boxinfo">
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
<table width="1275" height="64" align="center" cellpadding="20">
<thead>
<tr><th width="311" height="58" background="../simple signup/img/323a45-2880x1800.png"scope="col" ><font color="#ffffff" size="+2">Registration id</font></th>
<th width="299" background="../simple signup/img/323a45-2880x1800.png" scope="col" ><font color="#ffffff" size="+2">Name Of User</font></th>
<th width="337" background="../simple signup/img/323a45-2880x1800.png" scope="col" ><font color="#ffffff" size="+2">No. Of Time User Login</th>
<th width="156" background="../simple signup/img/323a45-2880x1800.png" scope="col" ><font color="#ffffff" size="+2">Dates</font></u></th>
</tr></thead>
<tbody>
<?php
while($row=mysql_fetch_array($sql))
{
echo"<tr>";
$logincountid = $row['reg_id'];
$sql2=mysql_query("select firstname from signup_details where reg_id=$logincountid");
$row2=mysql_fetch_array($sql2);
echo"<td align='center' style='color:#0099FF'>". $row['reg_id']."</td>";
echo "<td align='center' style='color:#0099FF'>".$row2['firstname']."</td>";
echo "<td align='center' style='color:#0099FF'>".$row['logincounter']."</td>";
echo "<td align='center' style='color:#0099FF'>".$row['date']."</td></tr>";
}
?>
</tbody>
</table>
<br><br>
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
</div>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>