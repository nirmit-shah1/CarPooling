<!DOCTYPE HTML>
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
 </head>
    <body>
		<!---start-header---->
			<div class="header">
				<div class="wrap">
				<div class="logo1">
					<!--<a href="index.html"><img src="carshare.png" title="logo" /></a>-->
					<p><font color="#CCCCCC" size="+4">E-PICKUP</p></font>
				</div>
				<div class="top-nav">
					<ul>
						<li><a href="../index1.html"><font size="+1">Home</font></a></li>
						<!--<li><a href="mainprofile.php"><font size="+1">Profile</font></a></li>-->				<li><a href="message.php"><font size="+1">Notification</font></a></li>		
							<!--<li><a href="mainprofile.php"><font size="+1">Profile</font></a></li>-->			
						<li ><a href="infoaboutus.php"><font size="+1">About Us</font></a></li>		
				
					<li>
								<DIV class="dropdown">
								<!--<div class="dropdown-content">-->
						  <button class="dropbtn"> Profile  </button>
						  <div class="dropdown-content">
							<a href="mainprofile.php"><font color="#333333">Basic Info.</font></a>
							<a href="../member/offerdetails.php"><font color="#333333">Rides Offered</font></a>
							<a href="uploadfile.php"><font color="#333333">Upload Profile Pic.</font></a>
							</div>
						 </DIV>
										 
						<li ><a href="infoaboutus.php"><font size="+1">About Us</font></a></li>
						
						<li><a href="logout.php"><font size="+1">logout</font></a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
</body>
</html>