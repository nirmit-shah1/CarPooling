<?php
session_start();
include_once("connection.php");
$a=$_SESSION['regid'];
$sql="select * from signup_details where reg_id = $a";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
	echo $row[1];
	echo $row[2];
}
?>