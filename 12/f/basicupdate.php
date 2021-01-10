<?php
include_once("toptemplate2.php");
include_once("connection.php");
$reg_id=$_GET['id'];
//$a=$_SESSION['reg_id'];
$sql="select * from signup_details where reg_id=".$reg_id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$sql1="select * from login where reg_id=".$reg_id;
$result1=mysql_query($sql1);
$row1=mysql_fetch_array($result1);
if(isset($_POST['submit']))
{
$f=$_POST['txtfname'];
$l=$_POST['txtlname'];
$c=$_POST['txtcontact'];
$e=$_POST['txtemail'];
$p=$_POST['txtpass'];
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
?>
<html>
<body>
<p style="background-image:url(img/323a45-2880x1800.png)"><font size="+3" color="#FFFFFF">Update Information of User</font></p>
<div class="boxinfo">
<form action="" method="post">
<table width="578" height="442">
<tr>
<td align="center"> First name:</td>
<td align="center"><input type="text" class="text" name="txtfname" value="<?php echo $row[1];?>"></td></tr>
<tr><td align="center">Last name:</td>
<td align="center"><input type="text" class="text" name="txtlname" value="<?php echo $row[2];?>"></td></tr>
<tr><td align="center">Contact no:</td>
<td align="center"><input type="text" class="text" name="txtcontact" value="<?php echo $row[3];?>"> </td></tr>
<tr><td align="center">Email-Id:</td>
<td align="center"><input type="text" class="text" name="txtemail" value="<?php echo $row1[1];?>"> </td></tr>
<tr><td align="center">Password:</td>
<td align="center"><input type="text" class="text" name="txtpass" value="<?php echo $row1[2];?>"> </td></tr>
<tr><td align="center" colspan="2"><input type="submit" class="button-3" value="update" name="submit"></td></tr></table>
</form>
</div>
<a href="admin.php"><font color="#330000" size="+2"><-Back To Admin Page</font></a>
</body>
</html>
