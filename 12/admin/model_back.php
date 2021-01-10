<?php
session_start();	
if(isset($_SESSION['adminusername']))
{
	include_once("..\connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Model page</title>
</head>
<body>
<?php
	if(isset($_POST['btn_submit']))
	{
		$company1=$_POST['drp_company'];
		$model1=$_POST['txt_model'];
		$_SESSION['modelname']=$model1;		
		$check="0";
		if(!($company1==$check))
		{
			$_SESSION['drpcompany']=$company1;			
		}
		if(!($company1==$check) && !($model1==NULL))
		{
				unset($_SESSION['modelname']);	
				unset($_SESSION['drpmodel']);	
				$result=mysql_query("select max(moid) as moid1 from model");
				if($data=mysql_fetch_array($result))
				{
					$no = $data['moid1'];
					$no=$no+1;
				}
				else
				{
					$no=1;
				}
				$result2=mysql_query("insert into model values('$company1','$no','$model1')");
				if($result2)
					header("location:model.php");		
				else
				{
					echo "Error in inserting...";
				}
		}
		else
		{	if($company1==$check)
			{
				$_SESSION['companyerror']=0;
				header("location:model.php");		
			}
			if($model1==NULL)
			{
				$_SESSION['modelerror']=0;
				header("location:model.php");
			}
		}
			
	}
	else
	{
		header("location:model.php");
	}	
?>
</table>
<a href="model.php">Go back model registration page</a>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>
