
<?php
session_start();
if(isset($_SESSION['adminusername']))
{
header("location:../admin/admin.php");
}
if(isset($_SESSION['emailcommanusername']))
{
header("location:../admin/comman.php");
}

?>
<html>
<title>Registration page</title>

</html>
<?php

include_once("toptemplate.php");
include("../admin/hmenusignup.php");
	include_once("../connection.php");

?>
<html >
<head>
<script type="text/javascript" language="javascript">
function validateMyForm ( )
 { 
    var isValid = true;
	var email = document.getElementById('txtemail');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
    if ( document.registration.txtFirst.value == "" )
	{ 
    alert ( "Please type your  First Name" ); 
    isValid = false;
    }
	else if ( document.registration.txtLast.value == "" ) 
	{ 
            alert ( "Please type your Last Name" ); 
            isValid = false;
    } 
</script>
<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '»';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>

<title>Registration page</title>
<script language="javascript" type="text/javascript">
function checkkLength(el) {
  if (el.value.length <= 5) {
    alert("length must be more than 5 characters")
  }
}

function checkLength(el) {
  if (el.value.length != 10) {
    alert("length must be exactly 10 numbers")
  }
}
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
<br />
<h2 style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+3">Sign Up</font></h2>

<div class="boxinfo">

<form action="backsignupmain.php" name="registration" id="registration" method="post"><br />
<table width="400" height="550">
	<tr>
		<td>
			 First Name:</td><td>
	     	<input type="text" class="text" id="txtFname" name="txtfname" placeholder="first name" value="<?php if(isset($_SESSION['namevalue'])){echo $_SESSION['namevalue'];unset($_SESSION['namevalue']);}?>" onKeyUp="this.value = this.value.replace(/[^a-z,A-z]/g,'')"></td></tr>
				<?php
				if(isset($_SESSION['namerror']))
				{?> <tr><td></td><td><?php
					echo "<font color='red'>please enter name</font>";
					unset($_SESSION['namerror']);	
					?> </td></tr><?php
				}
			?></tr><tr><td>
		    	Last Name:</td>
	        <td><input type="text" class="text" id="txtlname" name="txtlname" placeholder="Last name"
 value="<?php if(isset($_SESSION['lnamevalue'])){echo $_SESSION['lnamevalue'];unset($_SESSION['lnamevalue']);} ?>"onKeyUp="this.value = this.value.replace(/[^a-z,A-z]/g,'')"  ></td></tr>
				<?php
				if(isset($_SESSION['lnamerror']))
				{?><tr><td></td><td><?php
					echo "<font color='red'>please enter name</font>";
					unset($_SESSION['lnamerror']);?></td></tr><?php
				}
			?>
			<tr><td>
		   	Email-id:</td><td>
            	<input type="Email Id" class="text" placeholder="Email ID" id="emailid" name="emailid" value="<?php if(isset($_SESSION['emailvalue'])){echo $_SESSION['emailvalue'];unset($_SESSION['emailvalue']);}?>" /></td></tr>
				<?php
				if(isset($_SESSION['emailerror']))
				{?><tr><td></td><td><?php
					echo "<font color='red'>please enter email</font>";
					unset($_SESSION['emailerror']);?></td></tr><?php
				}
			?>	<tr><td>
		     Password:</td><td>
	        	<input onBlur="checkkLength(this)"  type="password"  placeholder="password(Min 6 characters)"  class="text" id="password" name="password"  maxlength="10"/></td></tr>
				<?php
				if(isset($_SESSION['passerror']))
				{?><tr><td></td><td><?php
					echo "<font color='red'>please enter password</font>";
					unset($_SESSION['passerror']);	?></td></tr><?php
				}
				?><tr><td>
			 confirmn Password:</td><td>
	        	<input type="password"  placeholder="password" class="text" id="conpassword" name="conpassword" /></td></tr>
				<?php if(isset($_SESSION['comparepasserror']))
				{?><tr><td></td><td><?php
					echo "<font color='red'>password doesn't match</font>";
					unset($_SESSION['comparepasserror']);
				}
				elseif(isset($_SESSION['cpasserror']))
				{?><tr><td></td><td><?php
					echo "<font color='red'>please enter conform password</font>";
					unset($_SESSION['cpasserror']);
				?></td></tr><?php
				}
				?>
			<tr><td>
			Gender:</td><td>&nbsp;&nbsp;
		  <input type="radio" name="rdb_gender" checked="checked"  value="male" <?php if(isset($_SESSION['gendervalue']))
		  {
		  	if($_SESSION['gendervalue']=="male")
		  	{	
				echo "checked='checked'";
				unset($_SESSION['gendervalue']);
			}
		  } 	?>/>male  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="radio" name="rdb_gender"  value="female" <?php if(isset($_SESSION['gendervalue']))
		  {
		  	if($_SESSION['gendervalue']=="female")
		  	{	
				echo "checked='checked'";
				unset($_SESSION['gendervalue']);
			}
		  } 	?> >female
		   </td></tr>
		  	 <?php if(isset($_SESSION['gendererror']))
				{?><tr><td></td><td><?php
					echo "<font color='red'>please select gender</font>";
					unset($_SESSION['gendererror']);?></td></tr><?php
				}
			?>
		   <tr><td>
			Contact no:</td><td><input name="txt_phno" type="text" class="text" id="groupidtext" style="width: 160px;" onBlur="checkLength(this)" placeholder="contact no." value="<?php if(isset($_SESSION['phnovalue'])){echo $_SESSION['phnovalue'];unset($_SESSION['phnovalue']);}?>" maxlength="10" onKeyUp="this.value = this.value.replace(/[^0-9]/g,'')" /></td>
		   </tr>
            	<!--<input type="text" max="10" size="10" placeholder="contact no." name="txt_phno" class="text"  />-->
				<?php
				if(isset($_SESSION['phnoerror']))
				{?><tr><td></td><td><?php
					echo "<font color='red'>please enter phone number</font>";
					unset($_SESSION['phnoerror']);
				?></td></tr><?php
				}
			?>	
		   <tr>
		   		<td >
					Select security question
				</td>
				<td>
					<select name="securityquestion" class="text">
				<?php
					$query=mysql_query("select * from securityquestion");
					while($data=mysql_fetch_array($query))
					{
						
						if(isset($_SESSION['securityquestionvalue']))
						{
							if($_SESSION['securityquestionvalue']==$data[0])
							{
								echo "<option value=$data[0] selected=selected>$data[1]</option>";					
								unset($_SESSION['securityquestionvalue']);
							}
							else
							{
								echo "<option value=$data[0]>$data[1]</option>";					
							}
						}
						else
						{
							echo "<option value=$data[0]>$data[1]</option>";					
						}
					}
				?>
				</td>
		   </tr>
		   <tr>
		   		<td>Enter Answer</td>
				<td>
					<input type="text" name="question" onkeyup="this.value = this.value.replace(/[^a-z,A-Z]/g,'')" class="text" value="<?php if(isset($_SESSION['questionvalue'])){echo $_SESSION['questionvalue'];unset($_SESSION['questionvalue']);}?>"/>
				</td>
		   </tr>
		   <?php
				if(isset($_SESSION['questionerror']))
				{?><tr><td></td><td><?php
					echo "<font color='red'>please enter answer</font>";
					unset($_SESSION['questionerror']);
				?></td></tr><?php
				} 
		   		if(isset($_SESSION['inserterror']))
				{
					?>		   <tr><td colspan="2" align="center"><?php
					echo "<font color='red'>Error In inserting</font>";
					unset($_SESSION['inserterror']);?></td>
		   </tr><?php
				}?>
		   <tr>
		   <td colspan="2">
		  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <!--<button class="button" style="vertical-align:middle" value="submit" onclick="javascript:return validateMyForm()"><span>Submit</span></button>-->
		  <input class="button-3" style="margin-top:-40px; margin-left:199px;" name="submit" type="submit" value="submit" onClick="javascript:return validateMyForm()" /></td>
		   </tr>
		   
		   </table>
  </form>
</div>
</div>
</body>
</html>