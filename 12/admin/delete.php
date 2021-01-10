<?php
	session_start();
	$reg_id=$_SESSION['reg_id'];
	if(isset($_SESSION['emailcommanusername']))
	{
		include_once("connection.php");
		include_once("toptemplate.php");
		include_once("hmenu.php");
?>
	<html>
	<head>
		<title>Delete account</title>
	</head>
	<body>
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">Delete Account</font></p> 
	<div class="boxinfo">
	<p style="margin-bottom:40px;">If you are unhappy with your account or blog for any reason, we can probably help.
	Feel free to contact us.<br /><br />
	However, if you wish to leave E-pickup, you can do so.<br /><br />
	You can easily delete the account by clicking the delete button given below.<br /><br />
	This will delete all information about you and after deleting your account you will no longer been notify by E-pickup site about activities going in the site.<br /><br />
	The email-id and password allocated will no longer be use to access the E-pickup site.<br /><br />
	<form action="deleteback.php" method="post">
	<input style="margin-top:-48px; margin-left:1px;background-color:#FF0000;" class="button-3"  type="submit" value="Delete Account &gt;&gt;" />
	</form>
	</div>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>