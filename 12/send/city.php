<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>city registration</title>
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
				<div id="cntainer">-->
<?php 
include_once("toptemplate2.php");
?>
				
<?php
session_start();
	if(isset($_SESSION['adminusername']))
	{ 
?>
<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
<h2 align="center"><font color="#009900" size="+4">Register City</font></h2>
<form action="city_back.php" method="post" >
<table width="655" height="167" cellspacing="">
	<tr>
		<td><font size="+3">Select State</font></td>
		<td><select class="text" name="drp_state" >
		<option value="0">---select---</option>
	<?php
	include_once("..\connection.php");	
	$result=mysql_query("select * from state");
	while($data=mysql_fetch_array($result))
	{
		?>
		<option value="<?php echo $data['sid'];?>" ><?php echo $data['state_name'];?></option>
		<?php }
?>
	</select>
	
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
<?php
	//session_start();
	if(isset($_SESSION['stateerror']))
	{
		echo "<font color='red'>please select proper state</font>";
		unset($_SESSION['stateerror']);
	}
?>
		
	<tr>
		<td><font size="+3">Enter city</font></td>
		<td><input type="text" name="txt_city" class="text" value="<?php if(isset($_SESSION['cityname']))
	{echo $_SESSION['cityname'];unset($_SESSION['cityname']);}
	else{echo "";}
		?>"/></td>
	</tr>
	<tr>
		<td></td>
		<td>
<?php
	
	if(isset($_SESSION['cityerror']))
	{
		echo "<font color='red'>please enter city</font>";
		unset($_SESSION['cityerror']);
	}
?>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="btn_submit" type="submit" style="margin-left:120px;" class="button-3" value="Insert" />
</form><br /><br /><br /><br /><br /><br />
<table width="854" height="157" cellspacing="10">
	<tr>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">State Name</font></th>
		<!--<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">CID</font></th>-->
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">City Name</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">UPDATE</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">DELETE</font></th>
	</tr>
	
<?php
	
	$result1=mysql_query("select * from city");
	while($data=mysql_fetch_array($result1))
	{
		$result2=mysql_query("select * from state where sid=".$data['sid']);
	
		?>
			<tr>
				<td>
		<?php
			if($data1=mysql_fetch_array($result2))
			{
				echo $data1['state_name']; 
			}
		?>
				</td>
				<!--<td>
		<?php
			//echo $data['cid'];
		?>
				</td>-->
				<td>
		<?php
			echo $data['city_name'];
		?>
				</td>				
		<?php
			echo "<td align='center' title='Update State Name'><a href=city_update.php?id=".$data['cid']."&nm=".$data['city_name']."><font color='#FF0000'>Update</font></a></td>";
			echo "<td align='center' title='delete State Name'><a href=city_delete.php?id=".$data['cid']."><font color='#FF0000'>Delete</font></a></td></tr>";
	}
	}
	else
	 	header("location:../main login/homepage.php");
?>
</table>
<a href="admin.php"><font color="#990000" size="+2"><-Back To Admin Registration Page</font></a>

</div>
</body>
</html>