<?php
include_once("connection.php");
session_start();
$did=$_SESSION['memberid'];
$pid=$_SESSION['reg_id'];
$row1=mysql_query($sql1);
		$sql=mysql_query("select * from signup_details where reg_id=".$pid); 
		$row=mysql_fetch_array($sql);
		$sql1=mysql_query("select * from signup_details where reg_id=".$did); 
		$row1=mysql_fetch_array($sql1);
		$str="http://mobi1.blogdns.com/httpmsgid/SMSSenders.aspx?UserID=uicahm&UserPass=uic999&Message=Name of Passenger:-$row[1]$row[2]Contact no.:-$row[3];This person would like to share ride with you &MobileNo=$row1[3]&GSMID=INFORM";
		header("location:$str");
		/*if($str)
		{
		echo"hello";
		}*/
		echo "hello";
$count=0;
$rateid=0;
	$query1=mysql_query("select max(rateid) as rateid1 from rating");
	while($data1=mysql_fetch_array($query1))
	{
		$rateid=$data1['rateid1'];
		$rateid++;
	}
	$query=mysql_query("select * from rating");
	while($data=mysql_fetch_array($query))
	{
		
		if($data['pid']==$pid && $data['did']==$did)
		{
			$count=1;
		}
	}
	if(!($count==1))	
	{
		$sql1=mysql_query("insert into  prating values ('$rateid','$pid','$did',' ',' ')");
		$sql1=mysql_query("insert into  rating values ('$rateid','$pid','$did',' ',' ')");
	}
?>
<!--<html>
<body>
<form action="" name="" method="post">
<tr>
	<td><input type="submit" name="submit" value="submit" /></td>
</tr>
</form>
</body>
</html>-->	