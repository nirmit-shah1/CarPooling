<?php
	session_start();
	include_once("toptemplate2.php");
	if(isset($_SESSION['adminusername']))
	{
	include_once("../connection.php");
	$sid1=$_GET['id'];
	$sql=mysql_query("select * from state where sid=".$sid1." ");
	$row=mysql_fetch_array($sql);
?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Updtae state</title>
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
<h3>Update the city</h3>
<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
<h2 align="center"><font color="#009900" size="+4">Update State</font></h2>
<form action="" method="post">
<table width="645" height="213" cellspacing="20">
	<tr>
		<td><font size="+3">Enter State Name </font></td>
		<td><input class="text" type="text" name="txt_state" value="<?php echo $row['state_name']; ?>" /></td>
	</tr>
</table>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" style="margin-top:-110px; margin-left:160px;" class="button-3" name="update_btn_submit" value="update" />
</form>
	<br />
<?php
	if(isset($_POST["update_btn_submit"]))
	{
		$statename=$_POST['txt_state'];
		$query=mysql_query("update state set state_name='$statename' where sid=".$sid1);
		unset($_SESSION['state']);
		header("location:stateback.php");
	}
?>
<br><br>
<a href="state.php"><font color="#990000" size="+2"><-Back to state registration</font></a>
</body>
<?php
}
else
	header("location:../main login/homepage.php");
?>
</div>
</html>