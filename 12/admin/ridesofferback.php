<?php /* 
include_once("toptemplate3.php");
session_start();
include_once("connection.php");
?>
<html>
<body>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">No. Of Rides Offered By Individual Users</font></p></div>
<div class="boxinfo" style="padding-bottom:100px;">		
<?php
$sql="select *  from login ";
$result=mysql_query($sql);
/*$sql3="select *  from signup_details ";
$result3=mysql_query($sql)*/;

?>
<table width="749" height="42" cellpadding="10px" >
<tr><th width="350"><u>Name Of Users</u></th>
<th  width="387"><u>No. Of Times Rides offered </u></th>
</tr>
<?php
while($row=mysql_fetch_array($result))
{
	$sql3="select *  from signup_details ";
echo $sql3;
	$result3=mysql_query($sql3);
	$row3=mysql_fetch_array($result3);
	echo "<tr><td align='center'>".$row3[1]."</u></td>";

	$email=$row[1];
echo $email;
echo "select * from login where email='".$email."'";
	$sql1=mysql_query("select * from login where email='".$email."'");
	$row1=mysql_fetch_array($sql1);
	$reg =$row1[0];

echo "reg".$reg;
echo "qry";
echo "select * from routedetails where reg_id='".$reg."'";die();
	$sql2=mysql_query("select * from routedetails where reg_id='".$reg."'");
	echo "<td align='center'>".mysql_num_rows($sql2)."</td>";
	
	 
}
?>
</table><br><br><br>
<a href="report.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
</div>
</body>
</html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
*/