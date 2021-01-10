<?php
session_start();
if(isset($_SESSION['username']))
{
	if($_SESSION['username'] == "admin")
		header("location:../Admin/1.html");
	else
		header("location:../User/index.php");
}
$conn=mysqli_connect("localhost","root","","project");
?>	

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Modern an Admin Panel Category Flat Bootstrap Responsive Website Template | Register :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />

		<link href="../css/style.css" rel="stylesheet" type="text/css"  media="all" />
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
	else if ( document.registration.txtUsername.value == "" ) 
	{ 
            alert ( "Please type your Username" ); 
            isValid = false;
    }
/*	else if ( document.registration.pwdPass.value.length < 8 )
	{ 
            alert ( "Please Enter your Password" ); 
            isValid = false;
    }*/
	else if ( document.registration.pwdPass1.value.length < 8 )
	{ 
            alert ( "Password does not match" ); 
            isValid = false;
    }

	else if ( document.registration.txtCountry.value == "" ) 
	{ 
            alert ( "Please type your Country" ); 
            isValid = false;
    } 
	 
	else if ( document.registration.cmbState.value == "" )
	{ 
            alert ( "Please Enter your State" ); 
            isValid = false;
    }
	else if ( document.registration.txtPincode.value == "" )
	{ 
            alert ( "Please Enter your Pincode" ); 
            isValid = false;
    }
	else if ( document.registration.txtContact.value.length < 10 )
	 { 
            alert ( "Please Enter your Contact" ); 
            isValid = false;
    }
	else if ( document.registration.txtEmail.value == "" )
	{ 
            alert ( "Please Enter your Email" ); 
            isValid = false;
    }
	else if ( document.registration.cmbQuestion.value == "" )
	{ 
            alert ( "Please Enter your Question" ); 
            isValid = false;
    }
	else if ( document.registration.txtAnswer.value == "" )
	{ 
            alert ( "Please Enter your Answer" ); 
            isValid = false;
    }

return isValid;
}
</script>

<script language="javascript" type="text/javascript">
function showcity(str)
{
if (str=="")
  {
  document.getElementById("drp_city").innerHTML="";
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
  		document.getElementById("drp_city").innerHTML=xmlhttp.responseText;
  	}
  }
xmlhttp.open("GET","city_detail.php?q="+str,true);
xmlhttp.send();
}
</script>

<style>
body
{
	margin-top:0px;
}
body#login
{

	background:url(images/bg.jpg)no-repeat;
	background-size:cover;
  -webkit-background-size:cover;
  -moz-background-size:cover;
  -o-background-size:cover;
  -ms-background-size:cover;

}
input[type=text]
{
	margin-top:30px;
	height:10px;
	background-color:#222224;
	display:block;
	margin-left:39em;
	width: 22%;
	padding: 15px;
	color: #999;
	font-size: 0.85em;
	outline: none;
	font-weight: 300;
	border: none;
	border-radius: 2px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	-o-border-radius: 2px;
}
input[type=password]
{
	background-color:#222224;
	display:block;
	margin-left:39em;
	margin-top:35px;
	width: 22%;
	height:10px;
	padding: 15px;
	color: #999;
	font-size: 0.85em;
	outline: none;
	font-weight: 300;
	border: none;
	border-radius: 2px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	-o-border-radius: 2px;
}
input[type="submit"], .btn-success1
{
  margin-left:1px;
  font-size: 14px;
  font-weight: 300 !important;
  color: #fff;
  cursor: pointer;
  outline: none;
  padding: 10px 15px;
  width: 23.2em;
  border: none;
  background: rgb(6, 217, 149);
  border-radius: 2px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  -o-border-radius: 2px;
  text-transform: uppercase;
}
input[type="submit"]:hover, .btn-success1:hover{
  background:rgb(1, 200, 136);
  color:#fff !important;
}
ul.new li.new_left{
  margin-left:14em;
}
ul.new li.new_left p, p.sign{
  font-weight:300;
} 
p.sign a, ul.new li.new_left p a{
  color:#000;
}
ul.new li.new_right{
  margin-right:31em;
}
.checkbox2
{
	width:200%;
}
.select1
{
	height:40px;
	background-color:#222224;
	display:block;
	width: 110%;
	padding: 10px;
	color: #999;
	font-size: 0.85em;
	outline: none;
	font-weight: 300;
	border: none;
	border-radius: 2px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	-o-border-radius: 2px;
}
</style>



</head>
<body id="login">
<?php include("../header.php"); ?>

<!--  <div class="login-logo">
<!--    <a href="index.html"><img src="images/logo.png" alt=""/></a>-->
<!--  </div>-->
  <form class="form-signin app-cam" name="registration" action="" method="post">
      <p>Enter your personal details below</p>
      
	  <input type="text" placeholder="First Name" autofocus="" name="txtFirst" id="txtFirst" onKeyUp="this.value = this.value.replace(/[^a-z,A-z]/g,'')"	>
	  
      <input type="text" placeholder="Last Name" autofocus="" name="txtLast" id="txtLast" onKeyUp="this.value = this.value.replace(/[^a-z,A-z]/g,'')">
	  
      <input type="text" placeholder="Email" autofocus="" name="txtEmail" id="txtEmail" 
		onKeyUp="this.value = this.value.replace(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{4,5})+$/g,'')">
		
	  <input type="text" placeholder="Contact" name="txtContact" id="txtContact"
	  	onKeyUp="this.value = this.value.replace(/[^0-9]/g,'')" />
    
	  <input type="text" placeholder="Country" autofocus="" name="txtCountry" id="txtCountry"  
	  	onKeyUp="this.value = this.value.replace(/[^a-z,A-z]/g,'')" >
	
	  <select name="cmbState" class="select1" placeholder="State" autofocus="" onChange="showcity(this.value)">
	  	<option value="0">--Select--</option>
				<?php
				$sql2=mysqli_query($conn,"select * from state");
				while($row=mysqli_fetch_array($sql2))
				{
				?>
				<option value="<?php echo $row['state_id'] ?>"><?php echo $row['state_name']; ?></option>
				<?php
				}
				?>
		</select>
<br>

	<div id="drp_city"></div>
	  <input type="text" placeholder="Pincode" autofocus="" name="txtPincode" id="txtPincode" 
	  	onKeyUp="this.value = this.value.replace(/[^0-9]/g,'')" >
	  
	  <input type="radio" name="rdbGender" value="male"> Male
      <input type="radio" name="rdbGender" value="female"> Female
	  
	  <p> Enter your account details below</p>
      <input type="text"  placeholder="User Name" autofocus="" name="txtUsername" id="txtUsername" 
	  	onKeyUp="this.value = this.value.replace(/[^a-z,A-z,0-9,@,_]/g,'')">
		
      <input type="password" placeholder="Password" autofocus="" name="pwdPass" id="pwdPass" 
	  	onKeyUp="this.value = this.value.replace(/[^a-z,A-z,0-9,@,_]/g,'')">
		
      <input type="password" placeholder="Re-type Password" name="pwdPass" id="pwdPass1" 
	  	onKeyUp="this.value = this.value.replace(/[^a-z,A-z,0-9,@,_]/g,'')">
		
		<select name="cmbQuestion" id="cmbQuestion" class="select1">
			<option value="" selected>Security Question</option>
			<option value="q1">Who is your favourite teacher?</option>
			<option value="q2">Which is your favourite color?</option>
			<option value="q3">Which is your favourite hobby?</option>
		</select><br>
       <input type="text" placeholder="Answer" autofocus="" name="txtAnswer" class="alert-success"
	    id="txtAnswer" onKeyUp="this.value = this.value.replace(/[^a-z,A-z]/g,'')" >

     <input type="checkbox" value="agree this condition" id="checkbox1"> 
	 <label class="checkbox2">I agree to the Terms of Service and Privacy Policy</label>
<br>
<br>
 	
      <input type="submit" name="submit"class="btn btn-lg btn-success1 btn-block" value="Sign Up" onClick="javascript:return validateMyForm();"></button>
      <div class="registration">
          Already Registered.
          <a href="login.php">Login</a>
      </div>
  </form>
  <br>
<br>

  <?php include("../footer.html"); ?>
</body>
</html>
<?php
if(isset($_POST["submit"]))
{

$fn=$_POST['txtFirst'];
$ln=$_POST['txtLast'];
$un=$_POST['txtUsername'];
$pwd=$_POST['pwdPass'];
$pwd1=$_POST['pwdPass1'];
$cty=$_POST['drp_city'];
$sy=$_POST['cmbState'];
$coun=$_POST['txtCountry'];
$pin=$_POST['txtPincode'];
$cnt=$_POST['txtContact'];
$em=$_POST['txtEmail'];
$sc=$_POST['cmbQuestion'];
$ans=$_POST['txtAnswer'];

		

//print_r($_POST);

$id=mysqli_query($conn,"select max(reg_id) as uid from registration");
if($data = mysqli_fetch_array($id))
{	
	if($data['uid'] == 0)
	{
		$no=1;
	}
	else
	{
		$no = $data['uid'] ;
		$no=$no+1;
	}
}
$query=mysqli_query($conn,"insert into registration(`reg_id`,`first_name`,`last_name`,`city_id`,`state_id`,`country`,`pincode`,`contact`,`email`,`security`,`answer`)values('$no','$fn','$ln','$cty','$sy','$coun','$pin','$cnt','$em','$sc','$ans')");


$query2=
mysqli_query($conn,"insert into login(`reg_id`,`username`,`password`,`user_type`)values('$no','$un','$pwd','user')");

			if($query && $query2)
			{
				echo "<script>alert('Registered Successfully');document.location='login.php'</script>";
			}
}

?>	
