<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>E-piclup</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.js"></script> 
<script type="text/javascript" src="js/html5.js"></script>
<style type="text/css">
<!--
.style1 {font-family: "Times New Roman", Times, serif}
-->
</style>
<meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Serious Face by FCT</title>
        <link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

		<div id="bg">
			<div id="outer">
				<div id="header">
					<div id="logo">
						<h1>
							<a href="#">Serious Face</a>
						</h1>
					</div>
					<div id="search">
						
					</div>
					<div id="nav">
						<ul>
							<li class="first active">
								<a href="#">Home</a></li>
							<li>
								<a href="#">Services</a></li>
							<li>
								<a href="#">Our Clients</a>	</li>
							<li>
								<a href="#">Support</a>	</li>
							<li>
								<a href="#">Blog</a></li>
							<li>
								<a href="#">About</a></li>
							<li class="last">
								<a href="#">Contact</a></li>
						</ul>
						<br class="clear" />
					</div>
<!--Header : Start-->
<header>
  <div class="style1" id="header-container">
    <h1>&nbsp;</h1>
    <h1><strong><font size="+3">E-PICKUP</font></strong></h1>
  </div>
</header>
<!--Header : End -->
<!--Container : Start-->
<div class="mainw">
    <div class="gnb-title"><h4> Login</h4>
    </div>
    <div id="container">
      <div class="loginbox">
	  <strong>
	  <form action="h2.php" method="post">
		<table>
			<tr>
				<td>
					Username</td><td><input type="text" name="txt_loginid"></td>
				</tr><tr><td></td><td>
				<?php
					if(isset($_SESSION['usernameerror']))
					{
						echo "<font color='red'>please enter username</font>";
						unset($_SESSION['usernameerror']);
					}
				?></td></tr>
				<tr>
					<td>password</td>
					<td>
						<input type="password" name="txt_password">	
					</td>
				</tr><tr><td></td><td>
				<?php
					if(isset($_SESSION['passworderror']))
					{
						echo "<font color='red'>please enter password</font>";
						unset($_SESSION['passworderror']);
					}
					elseif(isset($_SESSION['loginerror']))
					{
						echo "<font color='red'>Invalid username or password</font>";
						unset($_SESSION['loginerror']);
					}
				?></td></tr><tr>
					<td colspan="2" align="center">
			<input type="submit" name="btn_login" value="Login" style="background-color:#FFFF00">
					</td></tr></table>
</strong></form>
      </div>
      <div class="clear"></div>
  </div>
</div>

</body></html>