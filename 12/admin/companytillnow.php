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
<title>Company Details</title>
</head>

<body>
<br>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+2">Details Of Company</font></p></div>

<div class="boxinfo" style="padding-bottom:100px;">
<a href="report1.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
<thead>
<table width="1178" height="65" cellpadding="20">
<tr>
<th width="170" align="center" style='color:#0099FF' scope="col" background="../simple signup/img/323a45-2880x1800.png" ><font color="#ffffff" size="+2">Company id </font></th>
<th width="92" align="center" style='color:#0099FF' scope="col" background="../simple signup/img/323a45-2880x1800.png"><font color="#ffffff" size="+2">Company name</font></th>
</tr> 
</thead>
<tbody>
<?php
$sql=mysql_query("select * from company ");
while($row=mysql_fetch_array($sql))
{
echo"<tr>";
echo "<td align='center' style='color:#0099FF'>".$row['coid']."</td>";
echo "<td align='center' style='color:#0099FF'>".$row['company_name']."</td>";
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