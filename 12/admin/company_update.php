<?php 
	session_start();
	if(isset($_SESSION['adminusername']))
	{
		include_once("toptemplate3.php");
		include_once("../connection.php");
		if(isset($_SESSION['coid1']))
	{
		$coid1=$_SESSION['coid1'];
		$name=$_SESSION['name'];
	}
	else
	{
		$coid1 =$_GET['id'];
		$name=$_GET['name'];
		$_SESSION['coid1']=$_GET['id'];
		$_SESSION['name']=$_GET['name'];
	}
?>
<h2 align="center"><font color="#009900" size="+4">Update company name</font></h2>
<p align="center">&nbsp;</p>
<form action="" method="post">
<table width="738" height="160">
	<tr>
		<td><font size="+3">Updated company name</font></td>
		<td><input type="text" name="txt_company" class="text" value="<?php echo $name; ?>" /></td>
	</tr>
	<tr>
		<td><?php if(isset($_SESSION['companyerror']))
			{
				echo "<font color='red'>Enter Company name</font>";
				unset($_SESSION['companyerror']);
			}?>
		</td>
	</tr>
		<tr><td></td>
		<td><input type="submit" style="margin-left:-1px;" class="button-3" name="update_btn_submit" value="Update" /></td>	
</table>

</form>
<?php
		if(isset($_POST["update_btn_submit"]))
		{
			$companyname=$_POST['txt_company'];
			if($companyname==NULL)
			{
				$_SESSION['companyerror']=0;	
				header("location:company_update.php");
			}
			else
			{
				$query=mysql_query("update company set company_name='$companyname' where coid='$coid1'");
				if($query)
					header("location:company.php");
			}
		}
?>
<a href="company.php"><font color="#990000" size="+2"><-Back To Company Registration Page</font></a>
</body>
</html>
<?php
	}
	else
	 	header("location:../index.html");
?>	