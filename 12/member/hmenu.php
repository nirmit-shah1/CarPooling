<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Pawel 'kilab' Balicki - kilab.pl" />
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
	<div class="wrap">
	<div id="header">
	<form action="memberroutedetails.php" method="post">
			<input type="submit" style="background-color:#FF9224;" name="btnoffer" class="button-3" value="Offer a ride">
			</form>
		
				
		<div id="top">
			<form action="../admin/searchfront.php" method="post">
			<input type="submit" name="btnoffer" style="background-color:#FFCC00; margin-left:450px; margin-top:0px;"  class="button-3" value="Get a ride">
			</form>
	<div id="content">
		<div id="sidebar">
			<div class="box">
				<div class="h_title">&#8250; User</div>
				<ul id="home">
					<li class="b1"><a class="icon view_page" href="../admin/mainprofile.php">Profile</a></li>
					<li class="b2"><a class="icon report" href="../admin/postaladdress.php">Postal address</a></li>
					<li class="b1"><a class="icon add_page" href="../admin/updatemain.php">Update info.</a></li>
					<li class="b2"><a class="icon config" href="../admin/memberdetails.php">Car info.</a></li>
				</ul>
			</div>
			
			<div class="box">
				<div class="h_title">&#8250; Account</div>
				<ul id="home">
					<li class="b1"><a class="icon page" href="../admin/message.php">Notification</a></li>
					<li class="b2"><a class="icon add_page" href="../admin/delete.php">Delete Account</a></li>
					<li class="b1"><a class="icon page" href="../admin/uploadfile.php">Upload Profile Pic. </a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; About Ridesharing</div>
				<ul id="home">
					<li class="b1"><a class="icon users" href="../admin/ridesharing1.php">Ridesharing</a></li>
					<li class="b2"><a class="icon add_user" href="../admin/searchforride1.php">How to search for ride?</a></li>
	<!--				<li class="b1"><a class="icon block_users" href="bookride.php">How to book a ride?</a></li>-->
					<li class="b2"><a class="icon category" href="../admin/payforride1.php">How to pay for a ride?</a></li>

				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Car Pooling</div>
				<ul id="home">
					<li class="b1"><a class="icon users" href="../admin/aimofepickup1.php">Aim of Car Pooling</a></li>
					<li class="b2"><a class="icon add_user" href="../admin/howitworks1.php">How it works?</a></li>
				</ul>
			</div>
		</div>
		</div>
		</body>
		</html>