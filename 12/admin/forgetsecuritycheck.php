<html>
<title>Security Question Check</title>

<?php
ob_start();
session_start();
include_once("toptemplate1.php");
include_once("hmenulogin.php");
include_once("connection.php");

?>
<head>
<script language="javascript" type="text/javascript">
function checkkLength(el) {
  if (el.value.length <= 5) {
    alert("length must be more than 5 characters")
  }
}
</script>
</head>

<body>
<p style="background-image:url(img/323a45-2880x1800.png); margin-top:-60px"><font size="+3" color="#FFFFFF">Change Password</font></p>
	<div class="boxinfo">
<?php

if(isset($_POST['btn_submit']) || isset($_SESSION['sessionerror']))
{
		if(isset($_SESSION['sessionerror']))
		{
			$qid=$_SESSION['qid1'];
			$answer=$_SESSION['answer1'];
		}
		else
		{
			if(isset($_POST['securityquestion']))
			{
				$_SESSION['securityquestionvalue']=$_POST['securityquestion'];
				$qid=$_POST['securityquestion'];
				$_SESSION['qid1']=$qid;
			}
			if($_POST['answer']==NULL)
			{
					$_SESSION['answererror']=1;
					$_SESSION['check']=$_SESSION['email'];
					header("location:forgetpasswordback.php");	
			}
			else
			{			
				unset($_SESSION['check']);
				$answer=$_POST['answer'];
				$_SESSION['answer1']=$answer;
			}
		}
		if(isset($_SESSION['reg_id']))
		{
			$reg_id=$_SESSION['reg_id'];
			$_SESSION['reg_id']=$reg_id;
			$query=mysql_query("select * from usersecurityquestion where reg_id ='".$reg_id."'");
			$data=mysql_fetch_array($query);
			if($qid==$data[1] && $answer==$data[2])
			{
				unset($_SESSION['check']);				
				$data1=mysql_query("select * from login where reg_id='".$reg_id."'");
				if($query1=mysql_fetch_array($data1))	
				{
					//$_SESSION['reg_id']=$query1[0];
					//$_SESSION['email']=$txt_email;
					$data2=mysql_query("select * from signup_details where reg_id=$query1[0]");
					if($query2=mysql_fetch_array($data2))
					{
				?>
					
						<form action="changepassword.php" method="post">
				<table> 
					<tr>
					<td>
						<?php
							 $data3=mysql_query("select * from images where reg_id=$query1[0]");
							 $query3=mysql_fetch_array($data3);
						?>
						<img src="images/<?php echo $query3[1];?>" height="100" width="100"/>
					</td>
					<td >
						<?php echo $query2[1]." ".$query2[2]?>
						
					</td>
					</tr>
					<tr>	
						<td>Change Password</td>
						<td>
							<input onBlur="checkkLength(this)" type="password" name="txt_password" class="text">
						
						</td>
						</tr>
					<?php 
							if(isset($_SESSION['txt_passworderror']))
							{
									echo "<tr><td></td><td><font color=red>Enter password</font></td></tr>";					
									unset($_SESSION['txt_passworderror']);
							}							
					?>
						<tr>
						<td>
							Confirm Change Password
						</td>
						<td>
							<input type="password" onBlur="checkkLength(this)" name="txt_cpassword" class="text" />
						</td>
						</tr>
						<?php
							if(isset($_SESSION['txt_cpassworderror']))
							{
									echo "<tr><td></td><td><font color=red>Enter confirm password</font></td></tr>";					
									unset($_SESSION['txt_cpassworderror']);
							}
							if(isset($_SESSION['cmperror']))
							{
									echo "<tr><td></td><td><font color=red>password doesn't match</font></td></tr>";					
									unset($_SESSION['cmperror']);
							}							
					?><tr>
						<td></td>
						<td>
							<input style="margin-bottom:80px; margin-left:-10px;" type="submit" name="btn_submit" value="submit"  class="button-3"/>
							</form>
	<?php
					}
				}
			}
			else
			{
				
				$_SESSION['check']=$_SESSION['email'];
				$_SESSION['invalidanswer']=1;
				header("location:forgetpasswordback.php");
			}
	}
}
else
{
	header("locaion:forgetpasswordback.php");
}
?>
</body>
</html>
