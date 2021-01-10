<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>update city</title>
</head>
<body>
<div id="bg">
			<div id="outer">
				<div id="header">
				  <div id="logo">
						<h1>E-PICKUP</h1>
					</div>
				

					<div id="search">
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
<h3>Update the city</h3>
<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
<?php 
include_once("toptemplate2.php");
?>

<?php
	session_start();
	if(isset($_SESSION['adminusername']))
	{
		include("../connection.php");
		$cid =$_GET['id'];
		$cityname=$_GET['nm'];
?>
<h2 align="center"><font color="#009900" size="+4">Update City</font></h2>
<form action="" method="post"><br />
<table width="477" height="183" >
<TR	>
<td><font size="+3">Enter city</font></td>
<td><input class="text" type="text" name="txt_cityname" value="<?php echo $cityname;?>" /></td>
</TR>
<tr>
<td align="center" colspan="2"><input class="button-3" type="submit" value="Update" name="btn_submit" /></td></tr>
</table>
<?php
	if(isset($_POST['btn_submit']))
	{
		$newcity=$_POST['txt_cityname'];
		echo $cid;
		$query=mysql_query("update city set city_name='$newcity' where cid=".$cid);
		if($query)
		{
			header("location:city.php");
		}
		else
		{
			echo "<br>Error in updating data";
		}
	}
	}
	else
	 	header("location:../main login/homepage.php");
?>
</form>
<a href="city.php"><font color="#990000" size="+2"><-Back To City Registration Page</font></a>

</div>
</body>
</html>