<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	$_SESSION['reg_id'];
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Private Message</title>
	<link href="style1.css" type="text/css" rel="stylesheet" />
	</head>
	<?php
include_once("toptemplate2.php");
	include_once("hmenu.php");
	?>
	<body>
		<form action="privatemessageback.php" method="post" ><br />
	
			<table class="trip" cellspacing="10"> 
				<tr>
					<td	>
			Message </td>
					<td><textarea name="txt_message" placeholder="Message to be send" cols="50" rows="5"></textarea>
					</td></tr>
					<?php if(isset($_SESSION['messageerror'])){echo "<tr><td><font color=red>Enter Message First</font></td></tr>";unset($_SESSION['messageerror']);}?>
				<tr>
					<td colspan="2"><input type="submit" name="btn_message" class="text" value="Send Message" />
					</td>
				</tr>
					<?php if(isset($_SESSION['messagesent'])){echo "<tr><td></td><td align=center><font color=green>Message Sent Successfully</font></td></tr>";unset($_SESSION['messagesent']);}?>
					<?php if(isset($_SESSION['ownmessageerror'])){echo "<tr><td></td><td align=center><font color=red>Message Cannot sent to yourself </font></td></tr>";unset($_SESSION['ownmessageerror']);}?>
			</table>
					
		</form>
	<a href="searchback.php"> view results</a>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>