<?php
include_once("toptemplate.php");
include_once("hmenu.php");
?>
<html>
<body>
<div class="boxinfo">
<form action="updateback.php" method="post">
<table border="2">
<tr>
<td>First name:-</td>
<td><input type="text" name="txtufname" placeholder="first name"></td> 
</tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['ufnamerror']))
				{
					echo "<font color='red'>please enter name</font>";
					unset($_SESSION['ufnamerror']);	
				}
			?></td></tr></tr><tr><td>
<tr>
<td>Last name:-</td>
<td><input type="text" name="txtulname" placeholder="last name"></td> 
</tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['ulnamerror']))
				{
					echo "<font color='red'>please enter name</font>";
					unset($_SESSION['ulnamerror']);
				}
			?></td></tr>
<tr><td>
		   	Email-id:</td><td>
            	<input type="email" placeholder="Email Id"  name="uemailid">
			</td></tr>
			<tr><td></td><td>
				<?php
				if(isset($_SESSION['uemailerror']))
				{
					echo "<font color='red'>please enter email</font>";
					unset($_SESSION['uemailerror']);
				}
			?>	</td></tr>
			Password:</td><td>
	        	<input type="password"  placeholder="password" name="upassword"/></td></tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['upasserror']))
				{
					echo "<font color='red'>please enter password</font>";
					unset($_SESSION['upasserror']);	
				}
				?>
				</td></tr>
				<tr><td>
			Gender:</td><td>
		  <input type="radio" name="rdb_ugender" value="male" 
		  <?php if(isset($_SESSION['ugendervalue']))
		  {
		  	if($_SESSION['ugendervalue']=="male")
		  	{	
				echo "checked='checked'";
				unset($_SESSION['ugendervalue']);
			}
		  } 	?>/>male  
		  <input type="radio" name="rdb_ugender" value="female" 
		  <?php if(isset($_SESSION['ugendervalue']))
		  {
		  	if($_SESSION['ugendervalue']=="female")
		  	{	
				echo "checked='checked'";
				unset($_SESSION['ugendervalue']);
			}
		  } 	?> >female
		   </td></tr><tr><td></td><td>
		  	 <?php if(isset($_SESSION['ugendererror']))
				{
					echo "<font color='red'>please select gender</font>";
					unset($_SESSION['ugendererror']);
				}
			?></td></tr>
		   <tr><td>
			contact no:</td><td>
            	<input type="text" name="txt_uphno" /></td></tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['phnoerror']))
				{
					echo "<font color='red'>please enter phone number</font>";
					unset($_SESSION['phnoerror']);
				}
			?>	</td></tr>
			</form>
			</table>
			</div>
			</body>
			</html>