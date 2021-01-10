<hmtl>
<head>
<script language="javascript" type="text/javascript">
function checkkLength(el) {
  if (el.value.length <= 5) {
    alert("length must be more than 5 characters")
  }
}

function checkLength(el) {
  if (el.value.length != 10) {
    alert("length must be exactly 10 numbers")
  }
}
</script>
<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	$reg=$_SESSION['reg_id'];
	include_once("toptemplate.php");
	include_once("hmenu.php");
	include_once("connection.php");
	$sql=mysql_query("select * from signup_details where reg_id=$reg");
	$row=mysql_fetch_array($sql);
	$sql1=mysql_query("select * from login where reg_id=$reg");
	$row1=mysql_fetch_array($sql1);
	?>
	<html>
	<title>Change profile information</title>
	<body>
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF">Update information</font></p>
	<div class="boxinfo">
	
	<form action="updateback.php" method="post">
	<table border="2">
	
	<?php
		if(isset($_SESSION['infosuccess']))
		{
			unset($_SESSION['infosuccess']);
			echo "<tr bgcolor='#e3f4d7'><td colspan='2'><font color=black>Information Updated successfully</font></td></tr>"; 
		}
		if(isset($_SESSION['infofail']))
		{
			unset($_SESSION['infofail']);
			echo "<tr bgcolor='#FFbaba'><td colspan='2'><font color=black>Please correct the error(s) listed below</font></td></tr>"; 
		}
	?>
	<tr >
	<td>First name:-</td>
	<td><input class="text" type="text" name="utxtfname" value="<?php echo $row[1];?>"></td> 
	</tr><tr><td></td><td>
					<?php
					if(isset($_SESSION['ufnamerror']))
					{
						echo "<font color='red'>please enter name</font>";
						unset($_SESSION['ufnamerror']);	
					}
				?></td></tr></tr>
	<tr>
	<td>Last name:-</td>
	<td><input type="text" class="text" name="utxtlname" placeholder="last name" value="<?php echo $row[2];?>"></td> 
	</tr><tr><td></td><td>
					<?php
					if(isset($_SESSION['ulnamerror']))
					{
						echo "<font color='red'>please enter last name</font>";
						unset($_SESSION['ulnamerror']);
					}
				?></td></tr>
	<tr><td>
				Email-id:</td><td>
					<input type="email" class="text" placeholder="Email Id"  name="uemailid" value="<?php echo $row1[1];?>">
				</td></tr>
				<tr><td></td><td>
					<?php
					if(isset($_SESSION['uemailerror']))
					{
						echo "<font color='red'>please enter email</font>";
						unset($_SESSION['uemailerror']);
					}
				?>	</td></tr>
				<tr><td>Password:</td><td>
					<input type="password" class="text"  placeholder="password" value="<?php echo $row1[2];?>" name="upassword"/></td></tr><tr><td></td><td>
					<?php
					if(isset($_SESSION['upasserror']))
					{
						echo "<font color='red'>please enter password</font>";
						unset($_SESSION['upasserror']);	
					}
					?>
					</td></tr>
					<tr><td>
				Gender:</td><td>
			  &nbsp;&nbsp;&nbsp;<input type="radio" name="urdb_gender" checked="checked" value="male" 
			  <?php if(isset($_SESSION['ugendervalue']))
			  {
				if($_SESSION['ugendervalue']=="male")
				{	
					echo "checked='checked'";
					unset($_SESSION['ugendervalue']);
				}
			  } 	?>/>male  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <input type="radio" name="urdb_gender"  value="female" 
			  <?php if(isset($_SESSION['ugendervalue']))
			  {
				if($_SESSION['ugendervalue']=="female")
				{	
					echo "checked='checked'";
					unset($_SESSION['ugendervalue']);
				}
			  } 	?> >female
			   </td></tr><tr><td></td><td>
				 <?php if(isset($_SESSION['ugendererror']))
					{
						echo "<font color='red'>please select gender</font>";
						unset($_SESSION['ugendererror']);
					}
				?></td></tr>
			   <tr><td>
				contact no:</td><td>
					<input type="text" name="utxt_phno" class="text" value="<?php echo $row[3];?>" maxlength="10" onKeyUp="this.value = this.value.replace(/[^0-9]/g,'')" /></td></tr><tr><td></td><td>
					<?php
					if(isset($_SESSION['uphnoerror']))
					{
						echo "<font color='red'>please enter phone number</font>";
						unset($_SESSION['uphnoerror']);
					}
				?>	</td></tr>
				<tr>
			   <td colspan="2">
			  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <!--<button class="button" style="vertical-align:middle" value="submit" onclick="javascript:return validateMyForm()"><span>Submit</span></button>-->
			  <input name="submit" class="button-3" style="margin-top:-10px;" type="submit" value="submit" onClick="javascript:return validateMyForm()" /></td>
			   </tr>
			</form>
		</table>
		</div>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>