<?php
	session_start();
	include_once("connection.php");
	include_once("toptemplate.php");
	include_once("hmenu.php");
	$date2=date('yy-mm-dd');
if(isset($_GET['submit']))
	{

		unset($_SESSION['searchvalue']);
		$a=$_SESSION['reg_id'];
		if($_GET['txtfrom']== NULL)
		{
			$_SESSION['fromerror']=1;
			header("location:searchfront.php");
		}
		else
		{
			$f=$_GET['txtfrom'];
			$_SESSION['fromvalue']=$f;
		}
		if($_GET['txtto']== NULL)
		{
			$_SESSION['toerror']=1;
			header("location:searchfront.php");
		}
		else
		{
			$t=$_GET['txtto'];
			$_SESSION['tovalue']=$t;
		}
		if(!($f==NULL || $t==NULL))
		{
			$sql1="select * from routedetails  where source like '%".$f."%' AND destination LIKE '%".$t."%' ";
?>
			<html>
			<body>
			<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">People Travelling on Your Route
			</font></p><div class="boxinfo">
			<table border="2">
<?php 

			/*if(strtotime('departuredate') > date('yy-mm-dd') )
	{*/
			$result1=mysql_query($sql1);
			while($row1=mysql_fetch_array($result1))
			{
				$sq=mysql_query("select * from typeoftrip  where reg_id=".$row1['reg_id']);
				$ro=mysql_fetch_array($sq);
				$date1=$ro['departuredate'];
				if($date1 > $date2 )
				{		
					if(!($row1['reg_id']==$a))
					{		
					echo "<tr>";
					$sql2=mysql_query("select * from images  where reg_id=".$row1['reg_id']);
					$row2=mysql_fetch_array($sql2);
					$sql3=mysql_query("select * from signup_details  where reg_id=".$row1['reg_id']);
					$row3=mysql_fetch_array($sql3);
					$sql4=mysql_query("select * from typeoftrip  where reg_id=".$row1['reg_id']);
					$row4=mysql_fetch_array($sql4);
					$sql5=mysql_query("select * from rating where did=".$row1['reg_id']);
					$rating=0;
					$count=1;
					while($row5=mysql_fetch_array($sql5))
					{
											
							$value=$row5['rate'];
							$rating=($value+$rating)/$count	;
							$count++;

					}
					echo "<td><img align='middle'  src='images/".$row2[1]."' height='250px' width='350px' ></td></tr>";	
					echo "<tr><td style='padding-top:-1px;'>Name of passanger:-</td>";
					echo "<td >".$row3['firstname'];
					echo "&nbsp;".$row3['lastname']."</td></tr>";	
					echo "<tr><td>Depature location:-</td><td>".$row1[2]."</td></tr>";
					echo "<tr><td>Arrival location:-</td><td>".$row1[3]."</td></tr>";	
					echo "<tr><td>Depature Date:-</td><td>".$row4[3]."</td></tr>";
					echo "<tr><td>Depature Time:-</td><td>".$row4[4]."</td></tr>";
					echo "<tr><td>Ratings:-</td><td>".$rating."</td></tr>";	
					echo "<td><a href='viewdetails.php?pid=".$row1[0]."'>view details>></a></td>";	
					echo "</tr>";
					echo"<tr>";
					echo"<td><hr></td>";
	
					echo"<td><hr></td>";
					echo"<td><hr></td>";
					echo"<td><hr></td>";		
					echo"</tr>";
				}
			}		
		}
		
	}
}
	else
	{
	?>
<!--	<img src="img/Exclamation.png">No Ride Has Been Found On This Route-->
	
<?php
	}
	if(isset($_SESSION['searchvalue']))
	{
		//unset($_SESSION['searchvalue']);
		$t=$_SESSION['tovalue'];
		$f=$_SESSION['fromvalue'];
		if(!($f==NULL || $t==NULL))
		{	
			$sql1="select * from routedetails  where source like '%".$f."%' AND destination LIKE '%".$t."%' ";
?>
			<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">People Travelling on Your Route
			</font></p><div class="boxinfo">
			<table border="2">
<?php 
			$result1=mysql_query($sql1);
			while($row1=mysql_fetch_array($result1))
			{
				$sq=mysql_query("select * from typeoftrip  where reg_id=".$row1['reg_id']);
				$ro=mysql_fetch_array($sq);
				$date1=$ro['departuredate'];
				if($date1 > $date2 )
				{		
					if(!($row1['reg_id']==$a))
					{
						echo "<tr>";
						$sql2=mysql_query("select * from images  where reg_id=".$row1['reg_id']);
						$row2=mysql_fetch_array($sql2);
						$sql3=mysql_query("select * from signup_details  where reg_id=".$row1['reg_id']);
						$row3=mysql_fetch_array($sql3);
						$sql4=mysql_query("select * from typeoftrip  where reg_id=".$row1['reg_id']);
						$row4=mysql_fetch_array($sql4);
						echo "<td><img align='middle'  src='images/".$row2[1]."' height='250px' width='350px' ></td></tr>";	
						echo "<tr><td style='padding-top:-1px;'>Name of passanger:-</td>";
						echo "<td >".$row3['firstname'];
						echo "&nbsp;".$row3['lastname']."</td></tr>";	
						echo "<tr><td>Depature location:-</td><td>".$row1[2]."</td></tr>";
						echo "<tr><td>Arrival location:-</td><td>".$row1[3]."</td></tr>";	
						echo "<tr><td>Depature Date:-</td><td>".$row4[3]."</td></tr>";
						echo "<tr><td>Depature Time:-</td><td>".$row4[4]."</td></tr>";	
						echo "<td><a href='viewdetails.php?pid=".$row1[0]."'>view details>></a></td>";	
						echo "</tr>";
						echo"<tr>";
						echo"<td><hr></td>";
						echo"<td><hr></td>";
						echo"<td><hr></td>";
						echo"<td><hr></td>";		
						echo"</tr>";
					}
				}		
			}		
		}
}
?>	

	</table>
	</body>
	</div>
	</html> 