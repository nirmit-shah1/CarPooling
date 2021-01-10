<html>
<body>
<?php 
include_once("connection.php");
include_once("toptemplate3.php");
?>
<?php
$sql="select * from signup_details";
$result=mysql_query($sql);
?>
				
				<div class="boxinfo" style="padding-bottom:100px;">
			<font size="+2">Users Register on the site:-</font><?php echo"<font size='+2'>". mysql_num_rows($result)."</font>";?>
				</div>
</div>	
</body>
</html>