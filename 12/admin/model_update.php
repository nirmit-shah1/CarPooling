<?php 
session_start();
if(isset($_SESSION['adminusername']))
{
	include_once("toptemplate3.php");
	include_once("../connection.php");
	if(isset($_SESSION['moid']))
	{
		$moid=$_SESSION['moid'];
		$modelname=$_SESSION['modelname'];
	}
	else
	{
		$moid =$_GET['id'];
		$modelname=$_GET['nm'];
		$_SESSION['moid']=$_GET['id'];
		$_SESSION['modelname']=$_GET['nm'];
	}
?>
	<html>
		<title>Model Update</title>
	<body>
	<h2 align="center"><font color="#009900" size="+4">Update Model name</font></h2>
	<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
	<form action="" method="post"><br />
	<table width="633" height="201">
		<tr><td>
	<font size="+2">Enter model</font></td><td>
<input type="text" class="text" name="txt_modelname" value="<?php echo $modelname;?>" /></td></tr>

<tr>
		<td></td>
		<td>
<?php

			if(isset($_SESSION['model_error']))
			{
				echo "<font color='red'>Enter Car Model Name</font>";
				unset($_SESSION['model_error']);
			}
?>
</td>
</tr>
<tr><td></td><td>
	<input type="submit" value="Update" class="button-3" name="btn_submit" style="margin-left:-1px;" /></td></tr></table>
	<?php
		if(isset($_POST['btn_submit']))
		{
			if(!($_POST['txt_modelname']==NULL))	
			{
				$newmodel=$_POST['txt_modelname'];
				$query=mysql_query("update model set model_name='$newmodel' where moid=".$moid);
				if($query)
					header("location:model.php");
				else
					echo "<br>Error in updating data";
			}
			else
			{
				$_SESSION['model_error']=1;
				header("location:model_update.php");
			}
		}
		
	?>
	<a href="model.php"><font color="#990000" size="+2"><-Back To Model Registration Page</font></a>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>