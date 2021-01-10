<?php
session_start();
include_once("connection.php");
$a=$_SESSION['reg_id'];
$f=$_POST['txtfname'];
$l=$_POST['txtlname'];
$c=$_POST['txtcontact'];
$e=$_POST['txtemail'];
$p=$_POST['txtpass'];
$sql22= "update signup_details set firstname='$f',lastname='$l', contactno='$c' where reg_id=$a";
//echo "update signup_details set firstname='$f',lastname='$l',contactno='$c' where reg_id=$a";
$result22=mysql_query($sql22);
$sqly="update login set email='$e' , password='$p' where reg_id=$a";
//echo "update login set email='$e', password='$p' where reg_id=$a";die();

echo $e;
echo $p;
$resulty=mysql_query($sqly);
if($result22 && $resulty)
{
echo"hello";
}
?>