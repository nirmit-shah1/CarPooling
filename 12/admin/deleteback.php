<html>
<head>
	<title>Delete account</title>
</head>
<body>
<?php
	session_start();
	$reg_id=$_SESSION['reg_id'];
	if(isset($_SESSION['emailcommanusername']))
	{
		include_once("connection.php");
		include_once("toptemplate2.php");
?><br><br>
	<form action="" method="post"> 
		 <table align="center" width="348" height="216" cellpadding="5">
			<tr>
				<td style="padding-top:20px">Email-Id</td>
				<td><input class="text" type="text" name="txt_loginid"></td>
		  </tr><tr><td height="34"></td>
		  <td>
				<?php
					if(isset($_SESSION['usernamenullerror']))
					{
						echo "<font color='red'>please enter username</font>";
						unset($_SESSION['usernamenullerror']);
					}
				?></td></tr>
				<tr>
						<td>Password</td>
					<td>
						<input class="text" type="password" name="txt_password">	
					</td>
				</tr><tr><td height="36"></td>
				<td>
				<?php
					if(isset($_SESSION['passwordnullerror']))
					{
						echo "<font color='red'>please enter password</font>";
						unset($_SESSION['loginerror']);
						unset($_SESSION['passwordnullerror']);
					}
					elseif(isset($_SESSION['loginerror']))
					{
						echo "<font color='red'>Invalid username or password</font>";
						unset($_SESSION['loginerror']);
					}
				?></td></tr><tr><td></td></tr>
				<tr>
					<td colspan="2" align="center">
			<input style="margin-top:-10px; margin-left:89px; margin-bottom:10px;" class="button-3" type="submit" name="btn_login" value="Delete account" >
				  </td></tr></table>
			</form>
<?php	
		if(isset($_POST['btn_login']))
		{
			if($_POST['txt_loginid']==NULL)
			{
				$_SESSION['usernamenullerror']=1;
				header("location:deleteback.php");
			}
			else
			{
				$uid=$_POST['txt_loginid'];	
			}
			if($_POST['txt_password']==NULL)
			{
				$_SESSION['passwordnullerror']=1;
				header("location:deleteback.php");
			}
			else
			{
				$password=$_POST['txt_password'];
			}
				$query=mysql_query("select * from login where email='$uid'");
				if($data=mysql_fetch_array($query))
				{
					if($password==$data['password'])
					{
						/*function clear($name)
						{
							$sql=mysql_query("delete from `$name` where reg_id='".$reg_id."'");
						}*/
						$sql=mysql_query("delete from signup_details where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from typeoftrip where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from images where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from login where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from membertravellingdetails where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from member_signup where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from postal where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from routedetails where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from comment where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from counter where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from logincount where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from prating where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from rating where reg_id='".$reg_id."'");
						$sql=mysql_query("delete from usersecurityquestion where reg_id='".$reg_id."'");
						
						/*clear('signup_details');
						clear('typeoftrip');
						clear('images');
						clear('login');
						clear('membertravellingdetails');
						clear('member_signup');
						clear('postal');
						clear('routedetails');*/
							
							header("location:deleteaccountmessage.php");
					}
					else
					{
						$_SESSION['loginerror']=1;
						header("location:deleteback.php");
					}
				}
				else
				{
					$_SESSION['loginerror']=1;
					header("location:deleteback.php");
				}
		}
	?>
<?php
	}
	else
		header("location:../index.html");
?>
</body>
</html>