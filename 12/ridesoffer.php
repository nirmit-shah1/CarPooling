<?php 
include_once("connection.php");
$sql="select *  from signup_details ";
$result=mysql_query($sql);
while($row-mysql_fetch_array($result))
{
	echo row[1];
	echo row[2];
}
?>