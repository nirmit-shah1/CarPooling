<?php
session_start();
if(isset($_SESSION['adminusername']))
{
	include_once("../connection.php");
	include_once("toptemplate3.php");
	if(isset($_SESSION['sid1']))
	{
		unset($_SESSION['sid1']);
	}
					
?>
<html>
<title> Add State</title>
<form action="stateback.php" method="post">
<h2 align="center"><font color="#009900" size="+4">Add State</font></h2>
<table width="489" cellspacing="20">
	<tr>
		<td><font size="+3">Enter State</font></td>
		<td><input type="text" class="text" name="txt_state" /></td>
	</tr>
	<tr>
		<td></td>
		<td>
<?php

			if(isset($_SESSION['state']))
			{
				echo "<font color='red'>please enter proper state</font>";
				unset($_SESSION['state']);
			}
?>
</td>
</tr>
<tr>
<td colspan="2" align="center">
		<br>
		<input  name="btn_submit" class="button-3" type="submit" value="Click to add state"  /></td>
</tr>
</form></Table><br /><br /><br /><br />
<table border="3" width="650" height="88" ">
	<tr> 
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">No.</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">State Name</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">UPDATE</font></th>
		<th bgcolor="#242424" background="img/bg_box_head.jpg"style="border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;"><font color="#FFFFFF">DELETE</font></th>
	</tr>
	
<?php
	$selectstate=mysql_query("select * from state ORDER BY `sid` ASC");
	 while($data=mysql_fetch_array($selectstate))
	 {
	 	?>
			<tr >
				<td align="center">
		<?php
	 	echo $data['sid'];
		?>
				</td>
				<td align="center" >
		<?php
			echo $data['state_name'];
		?>
				</td>	
				
		<?php
			echo "<td align='center' title='Update State Name'><a href=state_update.php?id=".$data['sid']."><font color='#660099'>Update</font></a></td>";
			echo "<td align='center' title='delete State Name'><a href=state_delete.php?id=".$data['sid']."><font color='#660099'>delete</font></a></td></tr>";
	 }
?>
</tr>
</table><br />

<a href="admin.php"><font color="#990000" size="+2"><-Back To Admin Registration Page</font></a>

</body>
</html>
<?php
}
else
	header("location:../index.html");
?>