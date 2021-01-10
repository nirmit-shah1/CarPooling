<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Pawel 'kilab' Balicki - kilab.pl" />
<title>SimpleAdmin</title>
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
		<div id="top">
	<div id="content">
		<div id="sidebar">
			<div class="box">
				<div class="h_title">&#8250; About Us</div>
				<ul id="home">
					<li class="b1"><a class="icon view_page" href="adminaboutus.php">Info of Car Pooling</a></li>
					<li class="b2"><a class="icon report" href="admintandc.php">Terms And Condition</a></li>
					<li class="b1"><a class="icon add_page" href="admintrust.php">Trust</a></li>
					<li class="b2"><a class="icon config" href="adminchoice.php">Choice</a></li>
					<li class="b2"><a class="icon config" href="admininsurance.php">Insurance</a></li>
						
				</ul>
			</div>
			
			<div class="box" >
				<div class="h_title">&#8250; About Ridesharing</div>
				<ul id="home">
					<li class="b1"><a class="icon page" href="adminridesharing.php">Ridesharing</a></li>
					<li class="b2"><a class="icon add_page" href="adminsearchforride.php">How to search for ride?</a></li>
					<li class="b1"><a class="icon photo" href="adminbookride.php">How to book a ride?</a></li>
					<li class="b2"><a class="icon category" href="adminpayforride.php">How to pay for a ride?</a></li>
				</ul>
			</div>
			<div class="box">
				<div class="h_title">&#8250; Car Pooling</div>
				<ul id="home">
					<li class="b1"><a class="icon users" href="adminaimofepickup.php">Aim of Car Pooling</a></li>
					<li class="b2"><a class="icon add_user" href="adminhowitworks.php">How it works?</a></li>
				</ul>
			</div>
		</div>
		</div>
		</body>
		</html>