<?php
session_start();
//this session is for backspace
if(isset($_SESSION['adminusername']))
{
//this session is use to check when link of this page is copied and paste
	if(isset($_SESSION['$regid']))
	{
		unset($_SESSION['$regid']);
	}
//include_once("toptemplate3.php");
include("../connection.php"); 
 
/*
}
else
	header("location:../index.html");
	*/
?>


<html >
<head>
<title>Admin Page</title>
<link href="web/css/style.css" rel="stylesheet" type="text/css"  media="all" />	
<link rel="stylesheet" href="web/css/responsiveslides.css">
</head>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/navi.css" media="screen" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".box .h_title").not(this).next("ul").hide("normal");
	$(".box .h_title").not(this).next("#home").show("normal");
	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
});
</script>
</head>
<body>

    <body>
		<!---start-header---->
			<div class="header">
				<div class="wrap">
				<div class="logo">
					<!--<a href="index.html"><img src="carshare.png" title="logo" /></a>-->
					<p><font color="#CCCCCC" size="+4">Car Pooling</p></font>
				</div>
				<div class="top-nav">
					<ul>
						<li><a href="admin.php"><font size="+1">Home</font></a></li>
						<!--<li><a href="../homepage.php"><font size="+1">login</font></a></li>-->
						<li><a href="../admin signup/signup.php"><font size="+1">Signup</font></a></li>
						<li><a href="adminaboutus.php"><font size="+1">About Us</font></a></li>
						<li><a href="admincontactus.php"><font size="+1">Contact Us</font></a></li>
						<li><a href="../logout.php"><font size="+1">Logout</font></a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
</body>
	</div>
	<div class="wrap">
	
	<div id="header">
	
		<div id="top">
		
	<div id="content">			
			<div class="clear"></div>
			<?php
			if(isset($_SESSION['notify']))
			{
			?>
			<h3 style="background-color:#00FF66; font:'Times New Roman', Times, serif;"><font color="#FFFFFF" size="+1">Account Successfully Created</font></h3> 
			<?php
			unset($_SESSION['notify']);
			}
			?>
				<div class="full_w">
					<div class="h_title"><p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Registration</font></p></div>
					<div class="boxinfo">
		<!--<div align="right">	<a href="../main login/logout.php">Log out</a></div>-->
		<!--<h3 ><font color="#00CC00" size="+5">Welcome To Admin Registration Page</font></h3>-->
		<ul><br />
		
		<li><font color="#0099FF" size="+2"><a href="state.php">Add State</a></li><br />
		<li><a href="city.php">Add City</a></li><br />
		<li><a href="area.php">Add Area</a></li><br />
		<li><a href="company.php">Add Vehicle company</a></li><br />
		<li><a href="model.php">Add Vehilce Model</a></li></font><br />
		<li><a href="report1.php"><font  size="+2">View Report</font></a></li></ul><br />
	</font>
	</div>
	</div>
			
				<br />
				<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">All User Information</font></p>
				<?php
				include_once("connection.php");
				$sql="select * from signup_details order by reg_id desc";
				$result=mysql_query($sql); 
				?>
				<table style="padding-right:1px;" width="779">
					<thead>
						<tr>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">Srno.</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">First name</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">Last name</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">Contact no.</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">Gender</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png" style="width: 65px;">Email-id</th>
<th scope="col" background="../simple signup/img/323a45-2880x1800.png" style="width: 65px;">Password</th>
<th scope="col" background="../simple signup/img/323a45-2880x1800.png" style="width: 65px;">Update</th>
<th scope="col" background="../simple signup/img/323a45-2880x1800.png" style="width: 65px;">Delete</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
								$Srno=1;
								while($row=mysql_fetch_array($result))
								{
								
				$sql1="select * from login where reg_id=$row[0]";
				$result1=mysql_query($sql1);
								$row1=mysql_fetch_array($result1);
								echo "<tr>";
								echo "<td>".$Srno."</td>";
								//echo "<td>".$row[0]."</td>";
								echo "<td>".$row[1]."</td>";
								echo "<td>".$row[2]."</td>";
								echo "<td>".$row[3]."</td>";
								echo "<td>".$row[4]."</td>";
								//echo "<td>".$row[5]."</td>";
								echo "<td>".$row1[1]."</td>";
								echo "<td>".$row1[2]."</td>";
		echo "<td><a class='table-icon edit' title='Edit' href='basicupdate.php?id=".$row[0]."'></a></td>";
		echo "<td ><a class='table-icon delete' title='Delete' href='basicdelete.php?did=".$row[0]."'></a></td>";
								echo "</tr>";
								$Srno++;
								}


						?>
			
	</div>
</div>

</body>
</html>
<?php
}
else
	header("location:../index.html");
?>