<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>login validation</title>
</head>
<body>
	<?php
		session_start();
		include_once("../connection.php");
		$uid=$_POST['txt_loginid'];
		$password=$_POST['txt_password'];
		if($uid==NULL)
		{
			$_SESSION['usernameerror']=1;
			header("location:h2.php");
		}
		if($password==NULL)
		{
			$_SESSION['passworderror']=1;
			header("location:h2.php");
		}
		if(isset($_POST['btn_login']))
		{
			if($uid=="admin" && $password=="123")
			{
				$_SESSION['adminusername']="admin";
				header("location:../admin/admin.php");
			}
			else
			{
				$query=mysql_query("select * from login where username='$uid'");
				if($data=mysql_fetch_array($query))
				{
					echo "Welcome ".$data['username'];
				}
				else
				{
					$_SESSION['loginerror']=1;
					header("location:h1.php");
				}
			}
		}
	?>
</body>
</html>
