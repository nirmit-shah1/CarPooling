<?php include_once("toptemplate2.php")?>
<?php
	session_start();
	if(isset($_SESSION['adminusername']))
	{
	include("../connection.php");
	$moid =$_GET['id'];
	$modelname=$_GET['nm'];
?>
<h2 align="center"><font color="#009900" size="+4">Update the Model name</font></h2>
<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
<form action="" method="post"><br />
<table width="633" height="201">
	<tr><td>
<font size="+2">Enter model</font></td><td><input type="text" class="text" name="txt_modelname" value="<?php echo $modelname;?>" /></td></tr><tr><td></td><td>
<input type="submit" value="Update" class="button-3" name="btn_submit" style="margin-left:-1px;" /></td></tr></table>
<?php
	if(isset($_POST['btn_submit']))
	{
		$newmodel=$_POST['txt_modelname'];
		echo $moid;
		$query=mysql_query("update model set model_name='$newmodel' where moid=".$moid);
		if($query)
			header("location:model.php");
		else
			echo "<br>Error in updating data";
	}
	}
	else
		header("location:../main login/homepage.php");
?>
<a href="model.php"><font color="#990000" size="+2"><-Back To Model Registration Page</font></a>
</body>
</html>