<?php
	session_start();
	include_once("connection.php");
	//WHERE source like '%".$f."%' OR destination LIKE '%".$t."%'
	if(isset($_SESSION['emailcommanusername']))
	{
		$f=$_POST['txtFrom'];
		$t=$_POST['txtTo'];
		$a=$_SESSION['reg_id'];
		//echo $f,$t;
		$sql="SELECT * FROM routedetails WHERE source like '%".$f."%' OR destination LIKE '%".$t."%'";
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result))
		{
			$s=$row[2];
			$d= $row[3];
		}
		if($f==$s and $t==$d)
		{
			$sql1="select reg_id from routedetails where source= '$f' AND destination= '$t' ";
			$result1=mysql_query($sql1);
			while($row1=mysql_fetch_array($result1))
			{
				$ra=$row1[0];
				//echo $ra;
				$_SESSION['routerid']=$ra;
			}
		}
		$sql2="select * from signup_details where reg_id=$ra";
		$result2=mysql_query($sql2);
		while($row=mysql_fetch_array($result2))
		{
			echo $row[1];
			echo $row[2];
			echo $row[3];
		}
		/*if($result1)
		{
		echo"hello";
		?>
		<html>
		<body>
		<a href="searchinfo.php">info</a>
		</body>
		</html>
		<?php }
		else
		{
		echo "bye";
		}	
		*/
	}
	else
		header("location:../index.php");
?>