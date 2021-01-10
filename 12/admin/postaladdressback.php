<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("connection.php");
	$reg_id=$_SESSION['reg_id'];

	if(isset($_POST['submit']))
		{
			if($_POST['txtadd1']==NULL)
			{
				$_SESSION['addfail']=1;
				$_SESSION['add1error']=1;
				header("location:postaladdress.php");
			}
			else
			{
				$a1=$_POST['txtadd1'];
				$_SESSION['add1value']=$a1;
			}
			if($_POST['txtadd2']==NULL)
			{
				$_SESSION['addfail']=1;
				$_SESSION['add2error']=1;
				header("location:postaladdress.php");
			}
			else
			{
				$a2=$_POST['txtadd2'];
				$_SESSION['add2value']=$a2;
			}
			if($_POST['txtpc']==NULL)
			{
				$_SESSION['addfail']=1;
				$_SESSION['pcerror']=1;
				header("location:postaladdress.php");
			}		
			else
			{
				$pc=$_POST['txtpc'];
				$_SESSION['pcvalue']=$pc;
			}
			if($_POST['drpstate']=="--select--")
			{
				$_SESSION['addfail']=1;
				$_SESSION['stateerror']=1;
				header("location:postaladdress.php");
			}
			else
				$state=$_POST['drpstate'];
			/*if($city=="--select--")
			{
				$_SESSION['cityerror']=1;
				header("location:postaladdress.php");
			}*/
		}
		
					//echo "insert into postal values('$reg_id','$a1','$a2','$pc','$state')";
			if(!($a1==NULL || $a2==NULL || $pc==NULL || $state=="--select--"))
			{
				if($_SESSION['updatedata']==1)
				{
					unset($_SESSION['updatedata']);
					$query1=mysql_query("update postal set address1='$a1',address2='$a2',postalcode='$pc',state
='$state' where reg_id=$reg_id");
					if($query1)
					{
						$_SESSION['addupdatesuccess']=1;
						header("location:postaladdress.php");								
					}
					else
					{	
						$_SESSION['addupdatefail']=1;
						header("location:postaladdress.php");								
					}
					
				}
				else
				{
					$sql="insert into postal values('$reg_id','$a1','$a2','$pc','$state')";
					$result=mysql_query($sql);
					if($result)
					{
						$_SESSION['addsuccess']=1;
						header("location:postaladdress.php");
					}
					else
					{
						$_SESSION['addfail']=1;
						header("location:postaladdress.php");
					}
				
				}
			}
}
else
	header("location:../index.html");
		?>