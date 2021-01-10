<?php session_start()?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css"  media="all" />	
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="web/css/responsiveslides.css">
<script src="web/js/jquery.min.js"></script>
<script src="web/js/responsiveslides.min.js"></script>
		  <script>
		    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 2500,
			        speed: 600
			      });
			});
		  </script>


<!--<meta name="keywords" content="" />
        <meta name="description" content="" />
		<meta content="vtf-8">
		<meta name="viewport" content="width=device-width;intial scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Serious Face by FCT</title>
        <link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />-->
</head>
<body>
<!---start-header---->
			<div class="header">
				<div class="wrap">
				<div class="logo">
					<!--<a href="index.html"><img src="carshare.png" title="logo" /></a>-->
					<p><font color="#CCCCCC" size="+4">E-PICKUP</p></font>
				</div>
				<div class="top-nav">
					<ul>
						<li class="active"><a href="index.html">Home</a></li>
						<li><a href="homepage.php">login</a></li>
						<li><a href="services.html">Services</a></li>
						<li><a href="plans.html">plans</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		<?PHP include_once("hmenu.php");
		if(isset($_SESSION['reg_id']))
		{
			$a=$_SESSION['reg_id'];
			echo $a;
		}
		else
		{
			echo "no";
		}
		?>
		
	</body>
</html>
