<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>REGISTER STATE</title>
<link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="bg">--
			<div id="outer">--
				<div id="header">
				  <div id="logo">
						<h1>E-PICKUP</h1>
					</div>
				

					<!--<div id="search">
						<form action="" method="post">
							<input class="text" name="search" size="32" maxlength="64" /><input class="button" type="submit" value="Search" />
						</form>
					</div>
					<div id="nav">
						<ul>
							<li>
								<a href="../main login/homepage.php">Home</a></li>
							<li>
								<a href="#">Services</a></li>
							<li>
								<a href="#">Our Clients</a></li>
							<li>
								<a href="#">Support</a></li>
							<li>
								<a href="#">Blog</a></li>
							<li>
								<a href="#">About</a></li>
							<li class="last">
								<a href="../main login/logout.php">Logout</a></li>
						</ul>
						
						<br class="clear" />
					</div>
				</div>
				<div id="container">-->
<?php 
include_once("toptemplate2.php");
?>
<form action="stateback.php" method="post">
<?php
		session_start();
if(isset($_SESSION['adminusername']))
{
?>
<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
<h2 align="center"><font color="#009900" size="+4">Register State</font></h2>
<table width="489" cellspacing="20">
	<tr>
		<td><font size="+3">Enter State</font></td>
		<td><input type="text" class="text" name="txt_state" /></td>
	</tr>
	<tr>
		<td></td>
		<td>
<?php

			if(isset($_SESSION['state']))
			{
				echo "<font color='red'>please enter proper state</font>";
				unset($_SESSION['state']);
			}
?>
</td>
</tr>
<tr>
<td colspan="2" align="center">
		<br>
		
		<input  name="btn_submit" class="button-3" type="submit" value="Click to add state"  /></td>
</tr>
</form></Table><br /><br /><br /><br />
<table border="3" width="650" height="88" ">
	<tr> 
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">SID</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">State Name</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">UPDATE</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">DELETE</font></th>
	</tr>
	
<?php
	
	include_once("../connection.php");
	$selectstate=mysql_query("select * from state ORDER BY `sid` ASC");
	 while($data=mysql_fetch_array($selectstate))
	 {
	 	?>
			<tr >
				<td align="center">
		<?php
	 	echo $data['sid'];
		?>
				</td>
				<td align="center" >
		<?php
		echo $data['state_name'];
		?>
				</td>	
				
		<?php
			echo "<td align='center' title='Update State Name'><a href=state_update.php?id=".$data['sid']."><font color='#660099'>Update</font></a></td>";
			echo "<td align='center' title='delete State Name'><a href=state_delete.php?id=".$data['sid']."><font color='#660099'>delete</font></a></td></tr>";
	 }
?>
</tr>
</table><br />

<a href="admin.php"><font color="#990000" size="+2"><-Back To Admin Registration Page</font></a>
<?php
}
else
{
	header("location:../main login/homepage.php");
}
?>
</body>
</html>
