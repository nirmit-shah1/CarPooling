<html>
<title>Driver Rating List</title>
<body>	

	<?php 
		session_start();
	if(isset($_SESSION['emailcommanusername']))
	{
		if(isset($_SESSION['did']))
		{
			unset($_SESSION['did']);
		}
		include_once("connection.php");
		include_once("toptemplate.php");
		include_once("hmenu.php");
		$pid=$_SESSION['reg_id'];
	?>
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+3">Rate the Driver </font></p>
	<div class="boxinfo" style="padding-bottom: 200px; padding-top:20px;">
	<?php 
		$sql=mysql_query("select * from rating where pid=$pid");
		if(mysql_num_rows($sql)>=1)
		{
		
		while($row=mysql_fetch_array($sql))
	{
			$did=$row['did'];
			$sql1=mysql_query("select * from signup_details where reg_id=$did");
			$row1=mysql_fetch_array($sql1);
	
	?>
	</body>
	<body>
		<h1 style="color: #FF6600; font-size:38px;">
	<?php echo "$row1[1] $row1[2]";?></h1>
	<br>
		<h2 style="color: #0066CC; font-size:18px;">
	<?php	
	echo "<a style='color: #0066CC;' href='ratingdetails.php?driverid=".$did."'>Rate And Comment $row1[1] $row1[2]</a>"?></h2>			
	<?php
	}
	}
	else
	{
	?>
	<img src="img/Exclamation.png" height="350" width="300" >
	<p style="color:#0000FF"><b>First You have to travel with any driver then only you can rate any driver.</b></p>
	<?php
	}
	?>
	<div>
	</body>
	 </html>
<?php
}
else
	header("location:../index.html");
?>