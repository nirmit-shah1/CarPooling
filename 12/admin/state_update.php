<?php
session_start();
if(isset($_SESSION['adminusername']))
{	
	include_once("toptemplate3.php");
	include_once("../connection.php");
	if(isset($_SESSION['sid1']))
	{
		$sid1=$_SESSION['sid1'];
		$sql=mysql_query("select * from state where sid=".$sid1." ");
		$row=mysql_fetch_array($sql);
	}
	else
	{
		$sid1=$_GET['id'];
		$_SESSION['sid1']=$_GET['id'];
		$sql=mysql_query("select * from state where sid=".$sid1." ");
		$row=mysql_fetch_array($sql);
	}
?>
<h2 align="center"><font color="#009900" size="+4">Update State</font></h2>
<form action="" method="post">
<table width="645" height="213" cellspacing="20">
	<tr>
		<td><font size="+3">Enter State Name </font></td>
		<td><input class="text" type="text" name="txt_state" value="<?php echo $row['state_name']; ?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td>
<?php

			if(isset($_SESSION['state_error']))
			{
				echo "<font color='red'>please enter proper state</font>";
				unset($_SESSION['state_error']);
			}
?>
</td>
</tr>
</table><br />
<br />
<br />

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" style="margin-top:-110px; margin-left:160px;" class="button-3" name="update_btn_submit" value="update" />
</form>
	<br />
<?php
	if(isset($_POST["update_btn_submit"]))
	{
		$statename=$_POST['txt_state'];
		if(!($_POST['txt_state']==NULL))
		{
			$query=mysql_query("update state set state_name='$statename' where sid=".$sid1);
			unset($_SESSION['state']);
			unset($_SESSION['sid1']);
			header("location:stateback.php");
		}
		else
		{
			$_SESSION['state_error']=1;
			header("location:state_update.php");
		}
	}
?>
<br><br>
<a href="state.php"><font color="#990000" size="+2"><-Back to state registration</font></a>
</body>
</div>
</html>
<?php
}
else
	header("location:../index.php");
?>