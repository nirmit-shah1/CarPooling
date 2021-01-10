<?php
session_start();
if(isset($_SESSION['adminusername']))
{
		
	include_once("toptemplate3.php");
?>
<html>
<body>
<p style="background-image:url(img/323a45-2880x1800.png)"><font size="+3" color="#FFFFFF">Notification</font></p>
<div class="boxinfo">
<img src="img/green-tick.jpg">User Information has successfully Updated
</div>
<a href="basicupdate.php"><font color="#330000" size="+2"><-Back To Update Page</font></a><br><br><a href="admin.php"><font color="#330000" size="+2"><-Back To Admin Page</font></a>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>