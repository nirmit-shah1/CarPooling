<?php 
include_once("toptemplate2.php");
?>

<?php
	session_start();
	if(isset($_SESSION['adminusername']))
	{
		include_once("../connection.php");
		$coid1=$_GET['id'];
		$name=$_GET['name'];
?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Updtae state</title>
<link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>
<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>
<div id="bg"
			<div id="oute">
				<!--<div id="header">
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
<h2 align="center"><font color="#009900" size="+4">Update the company name</font></h2>
<p align="center">&nbsp;</p>
<form action="" method="post">
<table width="738" height="160">
	<tr>
		<td><font size="+3">Updated company name</font></td>
		<td><input type="text" name="txt_company" class="text" value="<?php echo $name; ?>" /></td>
	</tr>
	<tr>
		<td><?php if(isset($_SESSION['company']))
			{
				echo "<font color='red'>please enter proper company name</font>";
				unset($_SESSION['company']);
			}?>
		</td>
	</tr>
		<tr><td></td>
		<td><input type="submit" style="margin-left:-1px;" class="button-3" name="update_btn_submit" value="Update" /></td>	
</table>

</form>
<?php
		if(isset($_POST["update_btn_submit"]))
		{
		$companyname=$_POST['txt_company'];
			if($companyname==NULL)
			{
				$_SESSION['company']=0;	
			}
	$query=mysql_query("update company set company_name='$companyname' where coid='$coid1'");
		if($query)
		header("location:companyback.php");
	}
	}
	else
	 	header("location:../main login/homepage.php");
?>
<a href="company.php"><font color="#990000" size="+2"><-Back To Company Registration Page</font></a>
</body>
</html>	