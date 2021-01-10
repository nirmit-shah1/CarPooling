<?php
session_start();
include_once("connection.php");
include_once("totemplate.php");

$reg_id=$_SESSION['reg_id'];
$id=$_GET['senderid'];
echo $reg_id; 
echo $id;
$sql1=mysql_query("select * from images where reg_id=$id");
$sql2=mysql_query("select * from signup_details where reg_id=$id");
$sql3=mysql_query("select * from prating where did=$reg_id");

