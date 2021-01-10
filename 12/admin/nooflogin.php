<?php
include_once("connection.php");
$b=0;
$sql=mysql_query("select * from logincount");
while($row=mysql_fetch_array($sql))
{
 $a=$row['logincounter'];
	$b+=$a;
}
echo $b;
?>
