<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style1.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Your ride offer</title>
</head>

<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	$reg_id=$_SESSION['reg_id']; 
	include_once("../connection.php");
	include_once("toptemplate2.php");	
?>

<body><br />
<?php
	include_once("hmenu.php");
if(isset($_POST['btn_all']))
{
	?>
<div class="boxinfo">
	<?php
	$query1=mysql_query("select  * from routedetails where reg_id=$reg_id order by mid desc");
				while($data1=mysql_fetch_array($query1))
				{
				?>
				<table class="trip" cellpadding="15">
	<tr>
		<td width="100">Departure point:</td>
		<td width="281">

	<?php
					echo $data1['source'];
	?>
	</td>
		<td width="119"></td>
	</tr>
	<tr>
		<td>Arraival point:</td>
		<td>
			<?php
				echo $data1['destination'];		
			?>
		</td><td></td>
	</tr>
	<tr>
		<td>Departure date:</td>
		<td>
			<?php
				$query2=mysql_query("select * from typeoftrip where mid='".$data1['mid']."'");
				if($data2=mysql_fetch_array($query2))
				{
					  	$date=$data2['departuredate'];
						$m=substr($date,5,2);
						$d=substr($date,8,2);
						$y=substr($date,0,4);
						echo $d,"/",$m,"/",$y;
						$time=$data2['departuretime'];
						echo ' '.$time;
				}
			?>
		</td><td></td>
	</tr>
	<tr>
		<td colspan="3">
			<?php
				$query3=mysql_query("select * from membertravellingdetails where mid='".$data1['mid']."'");
				if($data3=mysql_fetch_array($query3))
				{	?>
						Luggage allowed:
					<?php
					echo $data3['luggage'];		
					?>
					</td>
	</tr>
	<tr>
	<td colspan="3">
					<?php
					echo "Leave:"." ".$data3['leave'];
					?>
		</td>
		</tr>
		<tr><td colspan="2">
					<?php
						echo $data3['detour'];
				?>
			</td>
			<td title="Update route details">
			<?php
				echo "<a href=offeredit.php?mid=".$data3['mid']."&rid=".$data2['rid'].">Edit</a>";
				$_SESSION['check']=1;
			?>
			</td>
		</tr>
				<?php
				}?>
</table><br />
	<?php
	}

}
else
{
?>
<div class="boxinfo">
<?php
$query=mysql_query("select * from routedetails where reg_id=$reg_id");
if(mysql_num_rows($query)>0)
{
?>
<table class="trip" cellpadding="15">
	<tr>
		<td width="100">Departure point:</td>
		<td width="281">
			<?php 
				$query=mysql_query("select  max(mid) as mid1 from routedetails where reg_id=$reg_id");
				if($data=mysql_fetch_array($query))
				{
					$query1=mysql_query("select * from routedetails where mid='".$data['mid1']."'");
					if($data1=mysql_fetch_array($query1))
					{
					echo $data1['source'];
				
			?>		</td>
		<td width="119"></td>
	</tr>
	<tr>
		<td>Arraival point:</td>
		<td>
			<?php
				echo $data1['destination'];
					}
			?>
		</td><td></td>
	</tr>
	<tr>
		<td>Departure date:</td>
		<td>
			<?php
				$query2=mysql_query("select * from typeoftrip where mid='".$data['mid1']."'");
				if($data2=mysql_fetch_array($query2))
				{
					  	$date=$data2['departuredate'];
						$m=substr($date,5,2);
						$d=substr($date,8,2);
						$y=substr($date,0,4);
						echo $d,"/",$m,"/",$y;
						$time=$data2['departuretime'];
						echo ' '.$time;
				}
			?>
		</td><td></td>
	</tr>
	<tr>
		<td colspan="3">
			<?php
				$query3=mysql_query("select * from membertravellingdetails where mid='".$data['mid1']."'");
				if($data3=mysql_fetch_array($query3))
				{	?>
						Luggage allowed:
					<?php
					echo $data3['luggage'];
					?>
					</td>
	</tr>
	<tr>
	<td colspan="3">
					<?php
					echo  "Leave:"." ".$data3['leave'];
					?>
		</td>
		</tr>
		<tr><td colspan="3">
					<?php
						echo $data3['detour'];
				}
			?>
		</td>
	</tr>
</table>

<form action="" method="post">
	<input class="button" type="submit" name="btn_all" value="Click To view all rides" />
</form>
<?php
			}
			}
			else
				echo "You don't have any ride offers";	
}
?>
</div>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>