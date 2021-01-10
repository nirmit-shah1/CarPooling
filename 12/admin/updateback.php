<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("../connection.php");
	if(isset($_POST['submit']))
	{
		if($_POST['utxtfname']==NULL)
		{
			$_SESSION['infofail']=1;
			$_SESSION['ufnamerror']=1;
			header("location:updatemain.php");
		}
		else
		{
			$nam=$_POST['utxtfname'];
			$_SESSION['unamevalue']=$nam;
		}
		if($_POST['utxtlname']==NULL)
		{
			$_SESSION['infofail']=1;
			$_SESSION['ulnamerror']=1;
			header("location:updatemain.php");
		}		
		else
		{
			$lnam=$_POST['utxtlname'];
			$_SESSION['ulnamevalue']=$lnam;
		}
		if($_POST['utxt_phno']==NULL)
		{
			$_SESSION['infofail']=1;
			$_SESSION['uphnoerror']=1;
			header("location:updatemain.php");
		}
		else
		{
			$phno=$_POST['utxt_phno'];
			$_SESSION['uphnovalue']=$phno;
		}
		if($_POST['urdb_gender']==NULL)
		{
			$_SESSION['infofail']=1;
			$_SESSION['ugendererror']=1;
			header("location:updatemain.php");
		}
		else
		{
			$gender=$_POST['urdb_gender'];
			if($gender=="male")
			{
				$_SESSION['ugendervalue']=$gender;
			}
			if($gender=="female")
			{
				$_SESSION['ugendervalue']=$gender;
			}
		}	
		if($_POST['uemailid']==NULL)
		{
			$_SESSION['infofail']=1;
			$_SESSION['uemailerror']=1;
			header("location:updatemain.php");
		}
		else
		{
			$email=$_POST['uemailid'];
			$_SESSION['uemailvalue']=$email;
		}	
		if($_POST['upassword']==NULL)
		{
			$_SESSION['infofail']=1;
			$_SESSION['upasserror']=1;
			header("location:updatemain.php");
		}
		else
		{
			$pass=$_POST['upassword'];
		}
		}
		if(!($nam==NULL || $lnam==NULL || $phno==NULL || $gender==NULL || $email==NULL || $pass==NULL))
		{
		
		echo $nam;
		echo $lnam;
		echo $phno;
		echo $gender;
		echo $email;
		echo $pass;	
		$a=$_SESSION['reg_id'];
				unset($_SESSION['unamevalue']);
				unset($_SESSION['ulnamevalue']);
				unset($_SESSION['uphnovalue']);
				unset($_SESSION['ugendervalue']);
				unset($_SESSION['uemailvalue']);
				$sql1="update login set email='$email' ,password='$pass' where reg_id='$a'";
				$sql="update signup_details set firstname='$nam' ,lastname='$lnam' ,contactno='$phno', gender='$gender' where reg_id='$a'";
				$result=mysql_query($sql);
				$result1=mysql_query($sql1);
				if($result && $result1)
				{
					$_SESSION['infosuccess']=1;
					header("location:updatemain.php");
				}
				else
				{
					header("location:updatemain.php");
				} 	
		}
}
else
	header("location:../index.html");
?>
		