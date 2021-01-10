<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>REGISTER COMPANY</title>
</head>
<body>
			<div id="bg">
			<div id="outer">
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
				<div id="container">

-->
<?php 
include_once("toptemplate2.php");
?>
<?php
		session_start();
		if(isset($_SESSION['adminusername']))
		{
?>
<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
<form action="companyback.php" method="post">
	<h2 align="center"><font color="#009900" size="+4">Register Company</font></h2>
<table width="746" height="166">
	<tr>
		<td><font size="+3">Enter company</font></td>
		<td><input type="text" class="text" name="txt_company" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" class="button-3" style="margin-left:-12px;" name="btn_submit" value="Insert" />
</td>
</tr>
</table>		
</form>
	<table width="901" height="100" border="1">
	<tr>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">Company Name</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">UPDATE</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">DELETE</font></th>
	</tr>
	
<?php
	
	include_once("../connection.php");
	$selectcompany=mysql_query("select * from company ORDER BY `coid` ASC");
	 while($data=mysql_fetch_array($selectcompany))
	 {
	 	?>
			<tr>
				<td align="center">
		<?php
		echo $data['company_name'];
		?>
				</td>	
				
<?php
			echo "<td align='center' title='Update company Name'><a href=company_update.php?id=".$data['coid']."&name=".$data['company_name']."><font color='#660099'>Update</font></a></td>";
			echo "<td align='center' title='delete company Name'><a href=company_delete.php?id=".$data['coid']."><font color='#660099'>Delete</font></a></td></tr>";
	 }
	 }
	 else
	 	header("location:../main login/homepage.php");
?></table>
	 <a href="area.php"><font color="#990000" size="+2"><-Back To Area Registration Page</font></a>
	 </div>
</body>
</html>
