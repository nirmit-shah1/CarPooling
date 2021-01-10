<?php
	session_start();
	if(isset($_SESSION['adminusername']))
	{
		include_once("toptemplate3.php");
		include("../connection.php");	
			
	if(isset($_SESSION['cid']))
	{
		$cid=$_SESSION['cid'];
		$cityname=$_SESSION['cityname'];
	}
	else
	{
		$cid =$_GET['id'];
		$cityname=$_GET['nm'];
		$_SESSION['cid']=$_GET['id'];
		$_SESSION['cityname']=$_GET['nm'];
	}
	?>
	<html>
	<head>
		<title>Update City name</title>
	</head>
	<body>
	<h2 align="center"><font color="#009900" size="+4">Update City</font></h2>
	<form action="" method="post"><br />
	<table width="477" height="183" >
	<TR	>
		<td><font size="+3">Enter city</font></td>
		<td><input class="text" type="text" name="txt_cityname" value="<?php echo $cityname;?>" /></td>
	</TR>
	<tr>
		<td></td>
		<td>
<?php

			if(isset($_SESSION['city_error']))
			{
				echo "<font color='red'>Enter City Name</font>";
				unset($_SESSION['city_error']);
			}
?>
</td>
</tr>
	<tr>
		<td align="center" colspan="2"><input class="button-3" type="submit" value="Update" name="btn_submit" /></td>
	</tr>
	</table>
	<?php
		if(isset($_POST['btn_submit']))
		{
			$newcity=$_POST['txt_cityname'];
			if(!($_POST['txt_cityname']==NULL))
			{
				echo $cid;
				$query=mysql_query("update city set city_name='$newcity' where cid=".$cid);
				if($query)
				{
					unset($_SESSION['cid']);
					unset($_SESSION['cityname']);
					header("location:city.php");
				}
				else
				{
					echo "<br>Error in updating data";
				}
			}
			else
			{
				$_SESSION['city_error']=1;
				header("location:city_update.php");
			}
		}
	?>
	</form>
	<a href="city.php"><font color="#990000" size="+2"><-Back To City Registration Page</font></a>
	</div>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>