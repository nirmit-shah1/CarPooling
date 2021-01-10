<?php
session_start();
if(isset($_SESSION['adminusername']))
{	
	include_once("toptemplate3.php");
	include_once("connection.php");
	
	if(isset($_SESSION['$regid']))
		{
			$reg_id=$_SESSION['$regid'];
		}
		else
		{
			$reg_id=$_GET['id'];
			$_SESSION['$regid']=$_GET['id'];
		}
	$sql="select * from signup_details where reg_id=".$reg_id;
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$sql1="select * from login where reg_id=".$reg_id;
		$result1=mysql_query($sql1);
		$row1=mysql_fetch_array($result1);
		
	//$a=$_SESSION['reg_id'];
	if(isset($_POST['submit']))
	{
	
		if($_POST['txtfname']!=NULL)
		{		
			$f=$_POST['txtfname'];
			$_SESSION['fnamevalue']=$f;
			
		}
		else
		{
			$_SESSION['fnameerror']=1;
			
		}
		if($_POST['txtlname']!=NULL)
		{		
			$l=$_POST['txtlname'];
			$_SESSION['lnamevalue']=$l;
		}
		else
		{
			$_SESSION['lnameerror']=2;
		}
		if($_POST['txtcontact']!= NULL)
		{		
			$c=$_POST['txtcontact'];
			$_SESSION['contactvalue']=$c;
		}
		else
		{
			$_SESSION['contacterror']=3;
		}
		if($_POST['txtemail']!= NULL)
		{		
			$e=$_POST['txtemail'];
			$_SESSION['emailvalue']=$e;
		}
		else
		{
			$_SESSION['emailerror']=4;
		}
		if($_POST['txtpass'] != NULL)
		{		
			$p=$_POST['txtpass'];
			$_SESSION['passvalue']=$p;
		}
		else
		{
			$_SESSION['passerror']=5;
		}

if(!($_POST['txtfname']==NULL || $_POST['txtlname']==NULL || $_POST['txtcontact']==NULL  || $_POST['txtemail']==NULL || $_POST['txtpass']==NULL))
		{
				unset($_POST['submit']);
				unset($_SESSION['fnamevalue']);
				unset($_SESSION['lnamevalue']);
				unset($_SESSION['contactvalue']);
				unset($_SESSION['passvalue']);
				unset($_SESSION['emailvalue']);
				
		
			$sql22= "update signup_details set firstname='$f',lastname='$l', contactno='$c' where reg_id=".$reg_id;
			//echo "update signup_details set firstname='$f',lastname='$l',contactno='$c' where reg_id=$a";
			$result22=mysql_query($sql22);
			$sqly="update login set email='$e' , password='$p' where reg_id=".$reg_id;
			//echo "update login set email='$e', password='$p' where reg_id=$a";die();
			
			echo $e;
			echo $p;
			$resulty=mysql_query($sqly);
			if($result22 && $resulty)
			{
				header("location:basicupdatebackinfo.php");
			}
}

	}
?>
	<html>
	<body>
<title>Update Page</title>
	<p style="background-image:url(img/323a45-2880x1800.png)"><font size="+3" color="#FFFFFF">Update Information of User</font></p>
	<div class="boxinfo">
	<form action="" method="post">
		<table style="margin-bottom:80px;" width="578" height="442">
		<tr>
			<td  align="center"> First name:</td>
			<td align="center"><input type="text" class="text" name="txtfname" value="<?php if(!isset($_SESSION['fnameerror'])){echo $row[1]; unset($_SESSION['fnameerror']);}?>"></td>	</tr>
			<?php
				if(isset($_SESSION['fnameerror']))
				{
			
				echo "<tr><td></td><td ><font color='#FF0000'>&nbsp;&nbsp;&nbsp;Enter first name</font></td></tr>";
				unset($_SESSION['fnameerror']); 
				
				 }
					 
				?>
	<?php /*		if(isset($_SESSION['fnamevalue'])) 
			{echo $_SESSION['fnamevalue'];unset($_SESSION['fnamevalue']);}else{echo $row[1];}
			?>">
			</td></tr>
			
				<?php
				if(isset($_SESSION['fnameerror']))
				{
			
				echo "<tr><td></td><td ><font color='#FF0000'>&nbsp;&nbsp;&nbsp;Enter First name</font></td></tr>";
				unset($_SESSION['fnameerror']);
				 }
					 */
				?>
			
		
		<tr>
			<td align="center">Last name:</td>
			<td align="center"><input type="text" class="text" name="txtlname" value="<?php if(!isset($_SESSION['lnameerror'])){echo $row[2]; unset($_SESSION['lnameerror']);}?>"></td>	</tr>
			<?php
				if(isset($_SESSION['lnameerror']))
				{
			
				echo "<tr><td></td><td ><font color='#FF0000'>&nbsp;&nbsp;&nbsp;Enter Last name</font></td></tr>";
				unset($_SESSION['lnameerror']); 
				
				 }
					 
				?>
		<tr>
			<td align="center">Contact no:</td>
			<td align="center"><input type="text" class="text" name="txtcontact" value="<?php if(!isset($_SESSION['contacterror'])){echo $row[3]; unset($_SESSION['contacterror']);}?> "> </td></tr>
			<?php
				if(isset($_SESSION['contacterror']))
				{
			
				echo "<tr><td></td><td ><font color='#FF0000'>&nbsp;&nbsp;&nbsp;Enter Contact number</font></td></tr>";
				unset($_SESSION['contacterror']);
				 }
					 
				?>
		<tr>
			<td align="center">Email-Id:</td>
			<td align="center"><input type="text" class="text" name="txtemail" value=" <?php if(!isset($_SESSION['emailerror'])){echo $row1[1]; unset($_SESSION['emailerror']);}?> "> </td></tr>
			<?php
				if(isset($_SESSION['emailerror']))
				{
			
				echo "<tr><td></td><td ><font color='#FF0000'>&nbsp;&nbsp;&nbsp;Enter Email Id number</font></td></tr>";
				unset($_SESSION['emailerror']);
				 }
					 
				?>
		<tr>
			<td align="center">Password:</td>
			<td align="center"><input type="text" class="text" name="txtpass" value="<?php if(!isset($_SESSION['passerror'])){echo $row1[2]; unset($_SESSION['passerror']);}?> "> </td></tr>
			<?php
				if(isset($_SESSION['passerror']))
				{
			
				echo "<tr><td></td><td ><font color='#FF0000'>&nbsp;&nbsp;&nbsp;Enter Password</font></td></tr>";
				unset($_SESSION['passerror']);
				 }
					 
				?>
		<tr>
			<td align="center" colspan="2"><input type="submit" class="button-3" value="update" name="submit"></td>
		</tr>
		</table>
	</form>
	</div>
		<a href="admin.php"><font color="#330000" size="+2"><-Back To Admin Page</font></a>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>