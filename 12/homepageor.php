<!DOCTYPE html>
<html>
<head>
<title>Home page</title>
<link href="../singupdiv.css" rel="stylesheet" type="text/css">
</head>
<body>
<svg height="100" width="2500">
  <defs>
    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%"
      style="stop-color:rgb(255,255,0);stop-opacity:1" />
      <stop offset="100%"
      style="stop-color:rgb(255,0,0);stop-opacity:1" />
    </linearGradient>
  </defs>
  <ellipse cx="100" cy="70" rx="1700" ry="55" fill="url(#grad1)" />
  <text fill="#ffffff" font-size="45" font-family="Verdana"
  x="50" y="86">E-PICKUP</text>
Sorry, your browser does not support inline SVG.
</svg>
<?php
	session_start();
	include("../connection.php"); 
?>
<form action="signup.php" method="post">
		<div align="right">Not a member yet<input type="submit" name="btn_register" value="Register" style="background-color:#FFFF00"></div>
	</form><hr color="#FF0000" >			
<img src="Moving-Car-Animation-Photoshop-PSD.gif" width="1500" height="150">
<hr color="#FF0000" >			
		<form action="login.php" method="post">
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
				?></td></tr>
				<tr>
					<td colspan="2" align="center">
			<input type="submit" name="btn_login" value="Login" style="background-color:#FFFF00">
					</td></tr></table>
			</form>
</body>
</html>