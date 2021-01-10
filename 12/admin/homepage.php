<html >
<head>
<title>Login Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css"  media="all" />	
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="web/css/responsiveslides.css">
<script src="web/js/jquery.min.js"></script>
<script src="web/js/responsiveslides.min.js"></script>
		  <script>
		    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 2500,
			        speed: 600
			      });
			});
		  </script>


<!--<meta name="keywords" content="" />
        <meta name="description" content="" />
		<meta content="vtf-8">
		<meta name="viewport" content="width=device-width;intial scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Serious Face by FCT</title>
        <link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />-->
</head>
<body>
<!---start-header---->
			<div class="header">
				<div class="wrap">
				<div class="logo">
					<!--<a href="index.html"><img src="carshare.png" title="logo" /></a>-->
					<p><font color="#CCCCCC" size="+4">Car Pooling</p></font>
				</div>
				<div class="top-nav">
					<ul>
						<li><a href="index.html"><font size="+1">Home</font></a></li>
						<li class="active"><a href="homepage.php"><font size="+1">login</font></a></li>
						<li><a href="simple signup/signup.php"><font size="+1">Sign up</font></a></li>
						<li><a href="admin/aboutus.php"><font size="+1">About us</font></a></li>
						<li><a href="admin/contactus.php"><font size="+1">Contact us</font></a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
<?php include_once("admin/hmenulogin.php");?>	
<!--<div id="bg">
			<div id="outer">
				<div id="header">
				  <div id="logo">
						<h1>E-PICKUP</h1>
					</div>
					<?php
	session_start();
	
	include_once("connection.php"); 

?>


				<div id="tb" >-->
				<p style="background-image:url(admin/img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+3">Login</font></p>
				<div  class="boxinfo" style="margin-top: -15px;">
		<form action="login.php" method="post"> 
		   <table align="center" width="348" height="216">
			<tr>
				<td style="padding-top:20px">Email-Id</td>
				<td><input class="text" type="text" name="txt_loginid"></td>
		  </tr>
		  <tr>
		  	<td height="34"></td>
		  	<td>
				<?php
					if(isset($_SESSION['usernamenullerror']))
					{
						echo "<font color='red'>please enter username</font>";
						unset($_SESSION['usernamenullerror']);
					}
				?></td></tr>
				<tr>
						<td>Password</td>
					<td>
						<input class="text" type="password" name="txt_password">	
					</td>
				</tr><tr><td height="36"></td>
				<td>
				<?php
					if(isset($_SESSION['passwordnullerror']))
					{
						echo "<font color='red'>please enter password</font>";
						unset($_SESSION['loginerror']);
						unset($_SESSION['passwordnullerror']);
					}
					elseif(isset($_SESSION['loginerror']))
					{
						echo "<font color='red'>Invalid username or password</font>";
						unset($_SESSION['loginerror']);
					}
				?></td></tr>
				<tr>
					
				  	<td><a href="admin/forgetpassword.php" style="margin-top:-10px; margin-left: -150px;  margin-bottom:10px;       height: 18px; background-color:ff9224" class="button-3"   name="btn_login" value="Forget Password" ><font color="#FFFFFF">Forget Password</font></a></td>
			
					<td colspan="3" align="center">
				
			<input style="margin-top:-10px; margin-left:5px; margin-bottom:10px;" class="button-3" type="submit" name="btn_login" value="Login" ></form>
<form action="simple signup/signup.php" method="post">
				  </td>	<td><input style="margin-top:-10px;  margin-bottom:10px; background-color:ff9224" class="button-3"  type="submit" name="btn_login" value="Register" ></td></table>
			</form>
			</div>
				</div>
</div>
</div>
</body>
</html>