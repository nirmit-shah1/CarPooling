<?php
include_once("connection.php");
$sql=mysql_query("select * from logincount");
$row=mysql_fetch_array($sql);
while($row=mysql_fetch_array($sql))
{
	echo $row['logincounter']; 
}


?>
