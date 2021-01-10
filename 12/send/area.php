<?php 
include_once("toptemplate2.php");
?>
<?php
session_start();
include("../connection.php");
if(isset($_SESSION['adminusername']))
{
?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Area registration</title>
<link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />
<!--
<script language="javascript" type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js"></script>
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
xmlhttp.open("GET","city_detail.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
<div id="bg">
			<div id="outer">
				<div id="header">
				  <div id="logo">
						<h1>E-PICKUP</h1>
					</div>
				

					<!--<div id="search">
						<form action="" method="post">
							<input class="text" name="search" size="32" maxlength="64" /><input class="button" type="submit" value="Search" />
						</form>
					</div>
					<div id="nav">
						<ul>
							<li>
								<a href="../main login/homepage.php">Home</a></li>
							<li>
								<a href="#">Services</a></li>
							<li>
								<a href="#">Our Clients</a></li>
							<li>
								<a href="#">Support</a></li>
							<li>
								<a href="#">Blog</a></li>
							<li>
								<a href="#">About</a></li>
							<li class="last">
								<a href="../main login/logout.php">Logout</a></li>
						</ul>
						
						<br class="clear" />
					</div>
				</div>
				<div id="container">--
<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
<h2 align="center"><font color="#009900" size="+4">Register Area</font></h2>
<form action="area_back.php" method="post">
<table width="653" height="312">
	<tr>
    <td width="99"><font size="+3">State</td>
    <td width="204"><select class="text" name="drpstate" onchange="showCity(this.value)">
	<option value="0">--select--</option>
	<?php
		$sql=mysql_query("select * from state");
		while($row=mysql_fetch_array($sql))
		{
			?>
				<option value="<?php echo $row['sid'];?>"><?php echo $row['state_name'];?></option>
				<?php
			//}
		}
	?>
	</select>	
	  </td>
  </tr>
		<tr>
			<td></td>
			<td>
			<?php
				if(isset($_SESSION['error_sid']))
				{
					echo "<font color='red'>select state</font>";
					unset($_SESSION['error_sid']);
				}
			?>
		</td>
		</tr>
			 <tr>
		<td><font size="+3">city</font></td>
		<td><div id="drpcity"></div></td>
		</tr>
		<tr>
			<td></td>
			<td>
			<?php
				if(isset($_SESSION['error_cid']))
				{
					echo "<font color='red'>select city</font>";;
					unset($_SESSION['error_cid']);
				}
			?>
		</td>
		</tr>
		<tr>
			<td><font size="+2">Enter area</font></td>
			<td><input type="text" name="txt_area" class="text" value="<?php 
			if(isset($_SESSION['value_area_name'])){echo $_SESSION['value_area_name'];
				unset($_SESSION['value_area_name']);}?>"/></td>
		
		</tr>
		<tr>
		<td></td>
			<td>
			<?php
				if(isset($_SESSION['error_area_name']))
				{
					echo "<font color='red'>Enter area name</font>";
					unset($_SESSION['error_area_name']);
				}
			?>
			</td>
		</tr>
		<tr>
		<td>
		</td>
		<td><input class="button-3" style="margin-left:0px;" type="submit" name="btn_insert" value="insert" /></td>
		</tr>
</table><br /><br />
<table width="925" height="87" border="1">
	<tr>
		<th align="center"bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">State name</th>
		<th align="center" bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">City name</th>
		<th align="center" bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">Area name</th>
		<th align="center" bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">Update</th>
		<th align="center" bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">Delete</th>
	</tr>
	<?php
			$result=mysql_query("select * from area");
			while($data=mysql_fetch_array($result))
			{
	?>
	<tr>
		<td align="center">
		<?php
				$result2=mysql_query("select * from state where sid=".$data['sid']." ");
				if($data1=mysql_fetch_array($result2))
				{
					echo $data1['state_name'];
				} 
		?>
		</td>
		<td align="center">
			<?php 	
					$result2=mysql_query("select * from city where cid=".$data['cid']." ");
					if($data1=mysql_fetch_array($result2))
					{
						echo $data1['city_name'];
					} 
			?>
		</td>
		<td align="center">
			<?php
				echo $data['area_name'];	
			?>
		</td>
		<td align="center">
			<?php
				echo "<a href=area_update.php?aid=".$data['aid']."&name=".$data['area_name']."><font color='#660099'>Update</font></a>";
			?>
		</td>
		<td align="center">
			<?php
				echo "<a href=area_delete.php?aid=".$data['aid']."><font color='#660099'>Delete</font></a>";
			?>
	</tr>
	<?php
		}
	?>
</table>
<p>&nbsp;</p>
<a href="admin.php"><font color="#990000" size="+2"><-Back To Admin Registration Page</font></a>

  </body>
  <?php
}
else
	header("location:../main login/homepage.php");
?>
</p>
</html>