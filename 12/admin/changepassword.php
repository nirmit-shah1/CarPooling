<?php
ob_start();
session_start();
include_once("toptemplate1.php");
include_once("hmenulogin.php");
include_once("connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Change password</title>
</head>

<body>
<?php

	if(isset($_POST['btn_submit']))
	{
		if(!($_POST['txt_password']==null))
		{
			$pass=$_POST['txt_password'];
		}
		else
		{
			$_SESSION['sessionerror']=1;
			$_SESSION['txt_passworderror']=1;
			header("loaction:forgetsecuritycheck.php");			
		}
		
		if(!($_POST['txt_cpassword']==null))
		{
			$cpass=$_POST['txt_cpassword'];
		}
		else
		{
			$_SESSION['sessionerror']=1;
			$_SESSION['txt_cpassworderror']=1;
			header("loaction:forgetsecuritycheck.php");			
		}
		if(!($_POST['txt_password']==NULL || $_POST['txt_cpassword']==NULL))
		{
			if($pass==$cpass)
			{
				$reg_id=$_SESSION['reg_id'];
				unset($_SESSION['sessionerror']);						
				$query=mysql_query("update login set password=$pass where reg_id=$reg_id");
				if($query)
				{
					$query1=mysql_query("select * from login where reg_id=$reg_id");
					$data=mysql_fetch_array($query1);
					$_SESSION['email']=$data['email'];
						$_SESSION['emailcommanusername']=$data['email'];
						$_SESSION['reg_id']=$reg_id;
					header("location:comman.php");
				}
			}
			else
			{
				$_SESSION['sessionerror']=1;
				$_SESSION['cmperror']=1;
				header("location:forgetsecuritycheck.php");
			}
		}
		else
		{
			header("location:forgetsecuritycheck.php");
		}
	}
	
?>
</body>
</html>
