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
<title>State Details</title>
</head>

<body>
<br>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Details Of States</font></p></div>
<div class="boxinfo">
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
<table width="985" height="65" cellpadding="20">
<thead>
<tr>
<th width="434" align="center"  scope="col" background="../simple signup/img/323a45-2880x1800.png" ><font color="#ffffff" size="+2">State id </u></font></th>
<th width="463" align="center" scope="col" background="../simple signup/img/323a45-2880x1800.png"><font color="#ffffff" size="+2">State name</font></th>
</tr></thead> 
<?php
$sql=mysql_query("select * from state ");
while($row=mysql_fetch_array($sql))
{
echo"<tr>";
echo "<td style='color:#0099FF' align='center'>".$row['sid']."</td>";
echo "<td style='color:#0099FF' align='center'>".$row['state_name']."</td>";
echo"</tr>";
}
?>
</table>
<br /><br />
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
</div>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>