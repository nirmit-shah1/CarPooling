<html >
<head>
<title>Admin Page</title>      
<link rel="stylesheet" type="text/css" href="style.css" />
</head>


<body>
<div id="bg">
			<div id="outer">
				<div id="header">
				  <div id="logo">
						<h1>E-PICKUP</h1>
					</div>
					<?php
	session_start();
	include("../connection.php"); 
?>

					<!--<div id="search">
						<form action="" method="post">
							<input class="text" name="search" size="32" maxlength="64" /><input class="button" type="submit" value="Search" />
						</form>
					</div>-->
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

<?php
if(isset($_SESSION['adminusername']))
{
?>
	<!--<div align="right">	<a href="../main login/logout.php">Log out</a></div>-->
	<h3 ><font color="#00CC00">welcome to Admin registration page</font></h3>
	<ul>
	<li><font color="#006600"><a href="state.php">Register State</a></li>
	<li><a href="city.php">Register City</a></li>
	<li><a href="area.php">Register Area</a></li>
	<li><a href="company.php">Register Vehicle company</a></li>
	<li><a href="model.php">Register Vehilce Model</a></li>
</font>
<?php }
else
	header("location:../main login/homepage.php");
?>
</div>
</body>
</html>
