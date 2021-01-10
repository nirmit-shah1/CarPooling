<?php
	session_start();
	include_once("../connection.php");
	if(isset($_SESSION['stateid']))
	{
		echo "ya";
		$sid1=$_SESSION['stateid'];
		unset($_SESSION['stateid']);
	}
	else
	{
		$sid1=$_GET['id'];
	}
	$sql=mysql_query("select * from state where sid=".$sid1." ");
	$row=mysql_fetch_array($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Updtae state</title>
</head>

<body>
<form action="" method="post">
<table cellspacing="20">
	<tr>
		<td>Enter State name</td>
		<td><input type="text" name="txt_state" value="<?php echo $row['state_name']; ?>" /></td>
	</tr>
	<?php

		if(isset($_SESSION['stateupdate']))
			{
				echo "<font color='red'>please enter proper state</font>";
				unset($_SESSION['stateupdate']);
			}
	?>
</table>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="update_btn_submit" value="submit" />
	</form>
	<a href="state.php" >Go back</a>
	<br />
<?php
	//include_once("../connection.php");
	//$sid1=$_GET['id'];
	if(isset($_POST["update_btn_submit"]))
	{
		
		if(!($statename==NULL))
		{
			echo "no";
			$statename=$_POST['txt_state'];
			$query=mysql_query("update state set state_name='$statename' where sid=".$sid1);
			unset($_SESSION['state']);
			header("location:state.php");
		
		}
		else
		{
			echo "yes";
			$_SESSION['stateid']=$sid1;
			$_SESSION['stateupdate']=0;
			header("location:state_update.php");
		}
		
	}
	else
	{
		echo "yaaaaaaaa";
		unset($_SESSION['stateid']);
		unset($_SESSION['stateupdate']);
	}
?>
</body>
</html>