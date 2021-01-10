<?php
	session_start();
	include_once("../connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registration page</title>
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
<h2>signup</h2>
<form action="backsignupmain.php" name="registration" id="registration" method="post">
<table>
	<tr>
		<td>
			 First Name:</td><td>
	     	<input type="text" id="txtFname" name="txtfname" value="<?php if(isset($_SESSION['namevalue'])){echo $_SESSION['namevalue'];unset($_SESSION['namevalue']);}?>" ></td></tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['namerror']))
				{
					echo "<font color='red'>please enter name</font>";
					unset($_SESSION['namerror']);	
				}
			?></td></tr></tr><tr><td>
		    	Last Name:</td>
	        <td><input type="text" id="txtlname" name="txtlname" value="<?php if(isset($_SESSION['lnamevalue'])){echo $_SESSION['lnamevalue'];unset($_SESSION['lnamevalue']);}?>"  ></td></tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['lnamerror']))
				{
					echo "<font color='red'>please enter name</font>";
					unset($_SESSION['lnamerror']);
				}
			?></td></tr><tr><td>
			 User Name:</td>
			 <td>
	        	<input type="text" id="txtun" name="txtun" value="<?php if(isset($_SESSION['unamevalue'])){echo $_SESSION['unamevalue'];unset($_SESSION['unamevalue']);}?>"  ></td></tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['unamerror']))
				{
					echo "<font color='red'>please enter user name</font>";
					unset($_SESSION['unamerror']);
				}
			?>	</td></tr><tr><td>
		   	Email-id:</td><td>
            	<input type="email"  id="emailid" name="emailid" value="<?php if(isset($_SESSION['emailvalue'])){echo $_SESSION['emailvalue'];unset($_SESSION['emailvalue']);}?>" /></td></tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['emailerror']))
				{
					echo "<font color='red'>please enter email</font>";
					unset($_SESSION['emailerror']);
				}
			?>	</td></tr><tr><td>
			Gender:</td><td>
		  <input type="radio" name="rdb_gender" value="male"/>male  
		  <input type="radio" name="rdb_gender" value="female">female
		   </td></tr><tr><td></td><td>
		  	 <?php /*if(isset($_SESSION['gendererror']))
				{
					echo "<font color='red'>please select gender</font>";
					unset($_SESSION['gendererror']);
				}*/
			?></td></tr>
		   <tr><td>
			contact no:</td><td>
            	<input type="text" name="txt_phno" value="<?php if(isset($_SESSION['phnovalue'])){echo $_SESSION['phnovalue'];unset($_SESSION['phnovalue']);}?>" /></td></tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['phnoerror']))
				{
					echo "<font color='red'>please enter phone number</font>";
					unset($_SESSION['phnoerror']);
				}
			?>	</td></tr><tr><td>
		     Password:</td><td>
	        	<input type="password"  id="password" name="password"/></td></tr><tr><td></td><td>
				<?php
				if(isset($_SESSION['passerror']))
				{
					echo "<font color='red'>please enter password</font>";
					unset($_SESSION['passerror']);	
				}
				?></td></tr><tr><td>
			 conform Password:</td><td>
	        	<input type="password"  id="conpassword" name="conpassword" /></td></tr><tr><td></td><td>
				<?php if(isset($_SESSION['comparepasserror']))
				{
					echo "<font color='red'>password doesn't match</font>";
					unset($_SESSION['comparepasserror']);
				}
				if(isset($_SESSION['cpasserror']))
				{
					echo "<font color='red'>please enter conform password</font>";
					unset($_SESSION['cpasserror']);
				}
				
				?></td></tr><tr>
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
		   <tr>
		   <td colspan="2">
		  <br>
           <input name="submit" type="submit" value="submit" onClick="javascript:return validateMyForm()">
		   </td></tr></table>
		  </form>
</body>
</html>