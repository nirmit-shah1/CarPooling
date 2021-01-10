<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />

<title>Update Area Details</title>
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
				<div id="container">--
<h3>Update the area</h3>-->
<?php 
include_once("toptemplate2.php");
?>
<?php 
session_start();
if(isset($_SESSION['adminusername']))
{
		include_once("../connection.php");
?>
<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
<form action="" method="post">
<?php
	include("../connection.php");
	$aid=$_GET['aid'];
	$area_name=$_GET['name'];
	//echo $aid;
	?>
	<h2 align="center"><font color="#009900" size="+4">Register Area</font></h2>
	<?php
	echo "<font size='+2'>You are going to update area name of following:-</font><br /><br /><br />";
	$result1=mysql_query("select * from area where aid='$aid'");
	if($data1=mysql_fetch_array($result1))
	{
		$result2=mysql_query("select * from state where sid=".$data1['sid']."");
		if($data2=mysql_fetch_array($result2))
		{	
			echo "<font size='+2'>State name is :-</font>";
			echo "<font size='+2'>".$data2['state_name']."</font><br /><br />";
		}
		$result3=mysql_query("select * from city where cid =".$data1['cid']."");
		if($data3=mysql_fetch_array($result3))
		{	
			echo "<font size='+2'>City name is :-</font>";
			echo "<font size='+2'>".$data3['city_name']."</font><br />";
		}
	}
?>
<br /><br />
<table width="426" height="128">
		<tr>
			<td width="216"><font size='+2'>Enter Area</font></td>
			<td width="198"><input type="text" class="text" name="txt_area" value="<?php echo $area_name; 
			?>" />
		  </td>
		</tr>
		<tr>
		<td></td>
		<td><br />
			<input style="margin-left:-1px;" type="submit" class="button-3" name="update" value="update" />
		</td>
		</tr>
</table>
<?php
		if(isset($_POST['update']))
		{
			$name=$_POST['txt_area'];
			$data=mysql_query("update area set area_name='$name' where aid=".$aid);
			if($data)
				header("location:area.php");
			else
				echo "Error in updating Details...";
		}
}
else
	 	header("location:../main login/homepage.php");
?><br /><br /><br />
<a href="area.php"><font color="#990000" size="+2"><-Back To Area Registration Page</font></a>
</body>
</html>
