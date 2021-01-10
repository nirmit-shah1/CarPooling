<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{

	include_once("connection.php");
	include_once("toptemplate.php");
	include_once("hmenu.php");
?>
	<html>
	<head>
	<title>Postal Address</title>
	<script language="javascript" type="text/javascript">
	function showCity(str)
	{
	if (str=="")
	  {
	  document.getElementById("city").innerHTML="";
	  return;
	  } 
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		
		document.getElementById("city").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","state_detail.php?q="+str,true);
	xmlhttp.send();
	}
	</script>
	</head>
	<body>
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+3">Enter Postal Address</font></p> 
	<div class="boxinfo"><br>
		<table width="259" height="96" border="2">
		<?php
			if(isset($_SESSION['addsuccess']))
			{
				unset($_SESSION['addsuccess']);
				echo "<tr bgcolor='#e3f4d7'><td colspan='2'><font color=black>Address inserted successfully</font></td></tr>";
			}
			if(isset($_SESSION['addfail']))
			{	
			unset($_SESSION['addfail']);
			echo "<tr bgcolor='#FFbaba'><td colspan='2'><font color=black>Please correct the error(s) listed below</font></td></tr>"; 
			}
			if(isset($_SESSION['addupdatesuccess']))
			{
				unset($_SESSION['addupdatesuccess']);
				echo "<tr bgcolor='#e3f4d7'><td colspan='2'><font color=black>Address changed successfully</font></td></tr>";
			}
			if(isset($_SESSION['addupdatefail']))
			{	
			unset($_SESSION['addupdatefail']);
			echo "<tr bgcolor='#FFbaba'><td colspan='2'><font color=black>Error in updating</font></td></tr>"; 
			}
			
		?>
	<?php
	$a=$_SESSION['reg_id'];
	$sql="select * from signup_details where reg_id = $a";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result))
	{
		echo "<tr>";
		echo"<td align='left'>First name</td>";
		echo "<td align='left'>&nbsp;&nbsp;&nbsp;".$row[1]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo"<td align='left'>Last name</td>";
		echo "<td align='left'>&nbsp;&nbsp;&nbsp;".$row[2]."</td>";
		echo "</tr>";
	}
	$query1=mysql_query("select * from postal where reg_id = $a");
	if(mysql_num_rows($query1)>0)
	{
		$_SESSION['updatedata']=1;
		$data1=mysql_fetch_array($query1);
		$count=1;
	}
	else
	{
		$_SESSION['updatedata']=0;
		$count=0;
	}			
			
?>
		<form action="postaladdressback.php" method="post">
			<tr>
				<td>Address Line1:</td>
				<td><input class="text" type="text" placeholder="Address line 1" name="txtadd1" width="200" value="<?php 
					
				if($count==1)
					echo $data1['address1'];
				?>"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php
					if(isset($_SESSION['add1error']))
					{
						echo "<font color='red'>please enter Address</font>";
						unset($_SESSION['add1error']);	
					}
					?></td>
			</tr>
			<tr>
				<td>Address Line2:</td>
				<td><input type="text" class="text" name="txtadd2" width="200" placeholder="Address line 2" value="<?php 
				if($count==1)
					echo $data1['address2'];
				?>"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php
					if(isset($_SESSION['add2error']))
					{
						echo "<font color='red'>please enter Address</font>";
						unset($_SESSION['add2error']);	
					}
					?>
				</td>
			</tr>
			<tr>
				<td>Postal Code</td>
				<td><input class="text" type="text" name="txtpc" width="200" placeholder="Postal Code" value="<?php 
				if($count==1)
					echo $data1['postalcode'];
				?>"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php
					if(isset($_SESSION['pcerror']))
					{
						echo "<font color='red'>please enter Postal Address</font>";
						unset($_SESSION['pcerror']);	
					}
					?>
				</td>
			</tr>
			<tr>
				<td>state</td>
<!--onChange="showCity(this.value)"-->
				<td>&nbsp;&nbsp;&nbsp;<select name="drpstate" class="text">
					<option value="--select--">--select--</option>
					<?php
					$sql=mysql_query("select * from state");
					while($row=mysql_fetch_array($sql))
					{
						if($count==1)
						{
							if($data1['state']==$row['sid'])
							{?>
						<option value="<?php echo $row['sid'];?>" selected="selected"><?php echo $row['state_name'];?></option>			<?php
							}
							else
							{?>
					<option value="<?php echo $row['sid'];?>"><?php echo $row['state_name'];?></option>		
							<?php }
						}
						else
						{
				?>
					
					<option value="<?php echo $row['sid'];?>"><?php echo $row['state_name'];?></option>
							<?php
						}
					}
				?>
		</select>	
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
				<?php
					if(isset($_SESSION['stateerror']))
					{
						echo "<font color='red'>Select state</font>";
						unset($_SESSION['stateerror']);	
					}
					
				?>
				</td>
			</tr>
			<!--<tr>
				<td>city</td>
				<td><div id="city"></div></td>
			</tr>-->	 
			<tr>
				<td colspan="2">
			   <input style="margin-top:-18px; margin-left:120px; margin-bottom:4px;" name="submit" type="submit" value="Add address" class="button-3" onClick="javascript:return validateMyForm()">
			   </td>
			</tr>
		</table>
	  </form>
	</body>
	</html>
<?php
}
else
	header("location:../index.php");
?>