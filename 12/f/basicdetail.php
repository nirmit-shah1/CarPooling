<?php 
include_once("connection.php");
$sql="select * from signup_details";
$result=mysql_query($sql); 
//echo $result;
?>
<table border="2">
<tr><th>reg_id</th><th>first name</th><th>last name</th><th>contact no</th><th>gender</th><th>bio</th><th>Update</th><th>delete</th>
<?php
while($row=mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>".$row[0]."</td>";
echo "<td>".$row[1]."</td>";
echo "<td>".$row[2]."</td>";
echo "<td>".$row[3]."</td>";
echo "<td>".$row[4]."</td>";
echo "<td>".$row[5]."</td>";
echo "<td><a href='basicupdate.php?id=".$row[0]."'>Update</a></td>";
echo "<td><a href='basicdelete.php?id=".$row[0]."'>delete</a></td>";
echo "</tr>";
}


?>