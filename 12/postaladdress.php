<?php
include_once("connection.php");
include_once("hmenu.php");
?>
<html>
<head>
<script language="javascript" type="text/javascript">
function showCity(str)
{
if (str=="")
  {
  document.getElementById("drpcity").innerHTML="";
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
    document.getElementById("drpcity").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","state_detail.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
<div class="boxinfo"><br>
<table width="259" height="96" border="2">
<?php
session_start();
include_once("connection.php");
$a=$_SESSION['regid'];
$sql="select * from signup_details where reg_id = $a";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
	echo "<tr>";
	echo"<td align='left'>First name</td>";
	echo "<td align='left'>".$row[1]."</td>";
	echo "</tr>";
	echo "<tr>";
	echo"<td align='left'>Last name</td>";
	echo "<td align='left'>".$row[2]."</td>";
	echo "</tr>";
}?>
<form action="postaladdressback.php" method="post">
<tr>
<td>Address Line1:</td>
<td><input type="text" name="txtadd1" width="200"></td>
</tr>
<tr>
<td>Address Line2:</td>
<td><input type="text" name="txtadd2" width="200"></td>
</tr>
<tr>
<td>Postal Code</td>
<td><input type="text" name="txtadd1" width="200"></td>
</tr>
<tr>
    <td>state</td>
    <td><select name="drpstate" onchange="showCity(this.value)">
	<option>--select--</option>
	<?php
		$sql=mysql_query("select * from state");
		while($row=mysql_fetch_array($sql))
		{
			/*if(isset($_SESSION['value_sid']))
			{
			if($_SESSION['value_sid']==$row['sid'])
			{?>
					<option value="<?php echo $row['sid'];?>" selected="selected"><?php echo $row['state_name'];unset($_SESSION['value_sid']);?> </option>
					
			}}
			else
			{
				*/?>
				<option value="<?php echo $row['sid'];?>"><?php echo $row['state_name'];?></option>
				<?php
			//}
		}
	?>
	</select>	
		</td>
		</tr>
	<tr>
		<td>city</td>
		<td><div id="drpcity"></div></td>
		</tr>
				
				<tr><td>
		<br>  
		   type:</td><td>
		  <input type="radio" id="chktype" name="rdbtype" value="member"/>member  
		  <input type="radio"  id="chktype" name="rdbtype" value="traveller">traveller
		   </td></tr><tr><td></td><td>
		  	 <?php if(isset($_SESSION['typeerror']))
				{
					echo "<font color='red'>please select type</font>";
					unset($_SESSION['typeerror']);
				}
			?></td></tr>
		   <tr><td colspan="2">
           <input name="submit" type="submit" value="submit" onClick="javascript:return validateMyForm()">
		   </td></tr></table>
		  </form>
		 </div>
		 </body>
		 </html>