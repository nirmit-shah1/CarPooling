<?php
	session_start();
	$_SESSION['reg_id'];
	
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Private Message</title>
<link href="style1.css" type="text/css" rel="stylesheet" />
</head>
<?php
include_once("../connection.php");
include_once("totemplate2.php");
include_once("hmenu.php");
?>
<body>
	<form action="privatemessageback.php" method="post" ><br />

		<table class="trip" cellspacing="10"> 
			<tr>
				<td	>
		Message </td>
				<td><textarea name="txt_message" placeholder="Message to be send" cols="50" rows="5"></textarea>
				</td><tr>
				<td></td><td><?php if(isset($_SESSION['messageerror'])){echo "<font color=red>Enter Message First</font>";unset($_SESSION['messageerror']);}?></td>
			</tr></tr>
			<tr>
				<td colspan="2"><input type="submit" name="btn_message" value="Send Message" />
				</td>
			</tr>
				<?php if(isset($_SESSION['messagesent'])){echo "<tr><td></td><td align=center><font color=green>Message Sent Successfully</font></td></tr>";unset($_SESSION['messagesent']);}?>
		</table>
				
	</form>
</body>
</html>
