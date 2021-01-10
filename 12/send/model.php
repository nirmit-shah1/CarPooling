<?php include_once("toptemplate2.php")?>
<html>
<head>
<title>Model registration</title>
</head>
<body>
				

					<!--<div id="search">
						<form action="" method="post">
							<input class="text" name="search" size="32" maxlength="64" /><input class="button" type="submit" value="Search" />
						</form>-->

<?php
session_start();
if(isset($_SESSION['adminusername']))
{
?>
<!--<div align="right"><a href="../main login/logout.php">Logout</a></div>-->
<h2 align="center"><font color="#009900" size="+4">Register vehicle company model </font></h2>
<form action="model_back.php" method="post" ><br />
<table width="513" height="156" cellspacing="">
	<tr>
		<td><font size="+3">Select company</font></td>
		<td><select class="text" name="drp_company" >
		<option value="0">---select---</option>
	<?php
	include_once("..\connection.php");	
	$result=mysql_query("select * from company");
	while($data=mysql_fetch_array($result))
	{
		?>
		<option value="<?php echo $data['coid'];?>" ><?php echo $data['company_name'];?></option>
		<?php 
	}
?>
	</select>
	<br />
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
<?php
	//session_start();
	if(isset($_SESSION['companyerror']))
	{
		echo "<font color='red'>please select proper company</font>";
		unset($_SESSION['companyerror']);
	}
?>
		
	<tr>
		<td><font size="+3">Enter model</font></td>
		<td><input type="text" class="text" name="txt_model" value="<?php if(isset($_SESSION['modelname']))
	{echo $_SESSION['modelname'];unset($_SESSION['modelname']);}
	else{echo "";}
		?>"/></td>
	</tr>
	<tr>
		<td></td>
		<td>
<?php
	
	if(isset($_SESSION['modelerror']))
	{
		echo "<font color='red'>please enter model of car</font>";
		unset($_SESSION['modelerror']);
	}
?>
</table>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="btn_submit" style="margin-left:210px;" class="button-3" value="Insert" />

</form>
<br /><br /><br /><br />
<table width="807" height="131" cellspacing="10">
	<tr>
		<th align="center" bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">company Name</font></th>
		<th align="center" bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">Model Name</font></th>
		<th align="center" bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">UPDATE</font></th>
		<th align="center" bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">DELETE</font></th>
	</tr>
	
<?php
	
	$result1=mysql_query("select * from model");
	while($data=mysql_fetch_array($result1))
	{
		$result2=mysql_query("select * from company where coid=".$data['coid']);
	
		?>
			<tr>
				<td>
		<?php
			if($data1=mysql_fetch_array($result2))
			{
				echo $data1['company_name']; 
			}
		?>
				</td>
				<td>
		<?php
			echo $data['model_name'];
		?>
				</td>
				
				<td>
		<?php
			echo "<a href='model_delete.php?id=".$data['moid'].">delete</a>";
		?>
		
				</td>
			</tr>
		<?php
			echo "<td align='center' title='Update model Name'><a href=model_update.php?id=".$data['moid']."&nm="					            .$data['model_name']."><font color='#660099'>Update</font></a></td>";
			echo "<td align='center' title='delete model Name'><a href=model_delete.php?id=".$data['moid']."><font color='#660099'>Delete</font></a></td></tr>";
	}
?>
</table>
<a href="area.php"><font color="#990000" size="+2"><-Back To Admin Registration Page</font></a>
<?php 
	}
	else
		header("location:../main login/homepage.php");
?>
</body>
</html>