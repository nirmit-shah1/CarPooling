<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("toptemplate.php");
	include_once("hmenu.php");
	include_once("../connection.php");
?>
<html>
<title>Profile</title>
<body>
<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+3">Profile</font></p>
<div class="boxinfo">
<br><br><br>
<table width="259" height="96" border="2" style="margin-top:-40px;">
<?php
		if(isset($_SESSION['basicsuccess']))
		{
			unset($_SESSION['basicsuccess']);
			echo "<tr><td colspan='2'bgcolor='#e3f4d7'><font color=black style='background-color:#e3f4d7;'>Your basic information has been succesfully inserted.</p></font></td></tr>"; //<img height='30px' background-color:#e3f4d7 width='30px' src='img/green-tick.jpg'>
		}
		if(isset($_SESSION['basicfail']))
		{
			unset($_SESSION['basicfail']);
			echo "<tr bgcolor='#FFbaba'><td colspan='2'><font color=black>Please correct the error(s) listed below</font></td></tr>"; 
		}
$reg_id=$_SESSION['reg_id'];
$sql="select * from signup_details where reg_id = $reg_id";
$result=mysql_query($sql);
$sql1="select * from login where reg_id = $reg_id";
$result1=mysql_query($sql1);

while($row=mysql_fetch_array($result))
{
	echo "<tr>";
	echo"<td align='left'>First name</td>";
	echo "<td align='left'>".$row[1]."</td>";
	echo "</tr>";
	echo "<tr>";
	echo"<td align='left'>Last name</td>";
	echo "<td align='left'>".$row[2]."</td>";
	echo "</tr>";
	echo "<tr>";
	echo"<td align='left'>Contact no</td>";
	echo "<td align='centre'>".$row[3]."</td>";
	echo "</tr>";
	$bio =$row['bio'];
}
while($row1=mysql_fetch_array($result1))
{
	echo "<tr>";
	echo"<td align='left'>E-mail id</td>";
	echo "<td align='left'>".$row1[1]."</td>";
	echo "</tr>";
	
}
?>
<tr>
<td height="10">Basic info.</td>
<td>
<form action="mainprofileback.php" method="post">
<textarea min="10" name="txtarea" style="height:76px" placeholder="Please dont insert any sensetive or personal information about you."><?php echo $bio;?></textarea></td>

</tr>
<tr>
<td >
</td>
<td>
<?php 
if(isset($_SESSION['bio']))
{
echo"<font color='red'>please insert the basic information</font>";
unset($_SESSION['bio']);
}
?>
</td>
</tr>
<tr>
<td align="right"><input style="margin-top:-20px; margin-left:180px; margin-bottom:2px; " type="submit" value="submit" class="button-3" ></td>
</tr>
</table>
</form>
</div>
</body>
</html>
<?php
}
else
	header("location:../index.php");
?>
