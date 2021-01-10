<html>
<body>
<?php 
include_once("connection.php");
include_once("toptemplate3.php");
$sql="select * from signup_details";
$result=mysql_query($sql);
?>

	<div class="full_w">
				<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">No. Of User Registered To The Site</font></p></div>
				<div class="boxinfo" style="padding-bottom:100px;">
			<font size="+2">Users Register on the site:-</font><?php echo"<font size='+2'>". mysql_num_rows($result)."</font>";?>
<br><br>
<a href="report.php"><font color="#990000" size="+2"><-Back to Report Page</font></a>
</div>
</div>
</body>
</html>