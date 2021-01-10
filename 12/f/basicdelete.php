<?php 
include_once("toptemplate.php");
include_once("connection.php");
//$ra=$_GET['did'];
function clear($name)
{
$sql=mysql_query("delete from `$name` where reg_id=".$_GET['did']);

}
clear('signup_details');
clear('typeoftrip');
clear('images');
clear('login');
clear('membertravellingdetails');
clear('member_signup');
clear('postal');
clear('routedetails');
?>
<html>
<body>
<p style="background-image:url(img/323a45-2880x1800.png)"><font size="+3" color="#FFFFFF">Notification</font></p>
<div class="boxinfo">
<img src="img/delete-256-000000.png" />The Account Of the User Has Deleted
</div>
<a href="admin.php"><font color="#330000" size="+2"><-Back To Admin Page</font></a>
</body>
</html>
