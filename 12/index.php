<?php
session_start();
if(isset($_SESSION['adminusername']))
{
header("location:admin/admin.php");
}
if(isset($_SESSION['emailcommanusername']))
{
header("location:admin/comman.php");
}
?>

<HTML>
<head>
<title>Car Pooling</title>
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
    <body style="margin:0px;">
		<!---start-header---->
			<div class="header">
				<div class="wrap">
				<div class="logo">
					<!--<a href="index.html"><img src="carshare.png" title="logo" /></a>-->
					<p><font color="#CCCCCC" size="+4">Car Pooling</p></font>
				</div>
				<div class="top-nav">
					<ul>
						<li><a href="index.html"><font size="+1">Home</a></li>
						<li><a href="homepage.php">login</a></li>
						<li><a href="simple signup/signup.php">Sign up</a></li>
						<li><a href="admin/aboutus.php">About us</a></li>
						<li><a href="admin/contactus.php">Contact us</a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
			<!---End-header---->
		<!--start-image-slider---->
					<div class="image-slider">
						<!-- Slideshow 1 -->
					    <ul class="rslides" id="slider1">
					      <li><img src="web/images/slider4.jpg" alt=""></li>
					      <li><img src="web/images/slider2.jpg" alt=""></li>
					      <li><img src="web/images/slider3.jpg" alt=""></li>
					       <li><img src="web/images/slider1.jpg" alt=""></li>
						 <!-- Slideshow 2 -->
					</div>
			<!--End-image-slider---->
		<!---End-wrap---->
		<div class="clear"> </div>
		<!---start-content---->
		<div class="content">
			    <div class="content_top">
			    	<div class="wrap">
						<h1><a href="#">WELCOME.</a></h1>
						<p>The main aim of Car Pooling is vehicle sharing.The people who are travelling everyday from one place to another by their vehicle can share their vehicle with the people who are facing problems in public transport.Thus Car Pooling will help to economize resouces and it is also useful for saving the enviroment from being polluted .   </p>
						<span><a class="learnmore" href="admin/infoaboutus.php">LEARN MORE</a></span>
					</div>
			    </div>
			<div class="content-grids">
				
		 </div>
<!--			<div class="specials">
				<div class="wrap">
					<div class="specials-heading">
						<h3>Traveling Specials</h3>
					</div>
					<div class="specials-grids">
						<div class="special-grid">
							<img src="web/images/grids-img1.jpg" title="image-name" />
							<a href="#">Latest Plans</a>
							<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
						</div>
						<div class="special-grid">
							<img src="web/images/grids-img2.jpg" title="image-name" />
							<a href="#">Pre Plans</a>
							<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
						</div>
						<div class="special-grid spe-grid">
							<img src="web/images/grids-img3.jpg" title="image-name" />
							<a href="#">Free Plans</a>
							<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
						</div>
						<div class="clear"> </div>
					</div>
			    </div>
			</div>	
			<div class="testmonials">
				<div class="wrap">
					<div class="testmonial-grid">
						<h3>TESTIMONIALS :</h3>
						<p>&#34; Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat luctus eros ac placerat. Quisque erat metus, facilisis non felis eu, aliquam hendrrit quam. Donec ut lectus vel dolor adipiscing tincidunt. Ut auctor diam at est iaculis, vitae interdum magna sagittis.&#34;</p>
						<a href="#"> - Lorem ipsum</a>
					</div>
				</div>
			</div>
		</div>-->
		<!---End-content---->
		<div class="clear"> </div>
		<!---start-footer---->
		<div class="footer">
			<div class="wrap">
			<div class="footer-grids">
				<div class="footer-grid">
					<h3>Aim of Car-pooling</h3>
					<p>Our mission is to create an entirely new transport network with a trusted community of drivers and passengers.Collectively, we are building a more efficient and more social form of transport, disrupting the travel industry:we call it people powered travel, and we want to make it the first choice of every traveller.As the car-pooling is synonymous of E-pickup and it also means the same.</p>
				</div>
				<div class="footer-grid">
					<h3>Basic Info.</h3>
					<ul>
						<li><a href="admin/aboutus.php">About Us</a></li>
						<li><a href="admin/trust.php">Trust</a></li>
						<li><a href="admin/choice.php">Choice</a></li>
						<li><a href="admin/insurance.php">Insurance</a></li>
					</ul>
				</div>
				<div class="footer-grid">
					<h3>USEFUL INFO</h3>
					<ul>
						<li><a href="admin/searchforride.php">How to search for ride?</a></li>
						<li><a href="admin/bookride.php">How to book a ride?</a></li>
						<li><a href="admim/payforride.php">How to pay for ride?</a></li>
						<li><a href="admin/tandc.php">Terms And Condition </a></li>
					</ul>
				</div>
				<div class="footer-grid footer-lastgrid">
					<h3>CONTACT US</h3>
					<p>The details by which you can contact us</p>
					<div class="footer-grid-address">
						<p>Tel.800-255-9999</p>
						<p>Fax: 1234 568</p>
						<p>Email:<a class="email-link" href="#">nirmitshah803@gmail.com</a></p>
						<p>Email:<a class="email-link" href="#">parshwa803@gmail.com</a></p>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
			</div>
		</div>
		<!---End-footer---->
		<div class="clear"> </div>
		<div class="copy-right">
			<p>Design by <a href="#">Nirmit shah, Parshwa shah and Mohit vyas</a></p>
		</div>
	</body>
</html>
