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
<title>Area Details</title>
</head>
<body>
<br>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Details Of area</font></p></div>
<div class="boxinfo" style="padding-bottom:100px;">
<thead>
<table width="1178" height="65" cellpadding="20">
<tr>
<th width="170" align="center" style='color:#0099FF' scope="col" background="../simple signup/img/323a45-2880x1800.png" ><font color="#ffffff" size="+2">Area id </font></th>
<th width="92" align="center"style='color:#0099FF' scope="col" background="../simple signup/img/323a45-2880x1800.png" ><font color="#ffffff" size="+2">Area name</font></th>
</tr> 
</thead>
<tbody>
<?php
$sql=mysql_query("select * from area ");
while($row=mysql_fetch_array($sql))
{
echo"<tr>";
echo "<td style='color:#0099FF' align='center'>".$row['aid']."</td>";
echo "<td  style='color:#0099FF' align='center'>".$row['area_name']."</td>";
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