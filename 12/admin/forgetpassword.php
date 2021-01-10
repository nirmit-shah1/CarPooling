<html>
	<head>
		<title>Forget Password</title>
<?php
ob_start();
session_start();
include_once("toptemplate1.php");
include_once("hmenulogin.php");
if(isset($_SESSION['email']))
	unset($_SESSION['email']);
if(isset($_SESSION['check']))
	unset($_SESSION['check']);
?>

	</head>
	<body><br>
<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">Forget Password</font></p>
<div class="boxinfo" style=" padding-bottom: 227px;">	
	<form action="forgetpasswordback.php">
			<br /><font color="red"></font>
		<table>
			<tr>
<td>Enter E-Mail Id:
				<td>
			<input type="text" class="text" name="txt_email" placeholder="your E-mail"/></td>
			</tr>
			
			<?php if(isset($_SESSION['txt_emailerror']))
			{
			echo "<tr><td style=padding-left:50px; margin-left:50px;><font color=red>Enter Email</font></td></tr>";
			unset($_SESSION['txt_emailerror']);
			}
			?></table>
		<br><br><br><input style="background-color: #FF9900;" type="submit" class="button-3" class="text" name="btn_search" value="search" />
		</form>
		<form action="../homepage.php" method="post" >
			<input type="submit"  name="btn_cancel" value="Login" class="button-3" />
		</form>
	</div>
	</body>
</html>
	
			