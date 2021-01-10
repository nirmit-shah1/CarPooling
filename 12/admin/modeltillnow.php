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
<title>Model Details</title>
</head>
<body>
<br>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Details Of Model</font></p>
<div class="boxinfo" style="padding-bottom:100px;">
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>

<table width="1178" height="65" cellpadding="20">
<thead>
<tr>
<th width="170" align="center" scope="col" background="../simple signup/img/323a45-2880x1800.png" > <font color="#ffffff" size="+2">Model id </font></th>
<th width="92" align="center" scope="col" background="../simple signup/img/323a45-2880x1800.png" ><font color="#ffffff" size="+2">Model name</font></th>
</tr> 
</thead>
<tbody>
<?php
$sql=mysql_query("select * from model ");
while($row=mysql_fetch_array($sql))
{
echo"<tr>";
echo "<td align='center' style='color:#0099FF' >".$row['moid']."</td>";
echo "<td align='center' style='color:#0099FF'>".$row['model_name']."</td>";
echo"</tr>";
}
?>
</tbody>
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