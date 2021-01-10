<?php 
	session_start();
if(isset($_SESSION['emailcommanusername']))
{
	$_SESSION['reg_id'];
	
	//include_once("toptemplate2.php");
	include_once("../connection.php");
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Offer Published</title>
</head>
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
				<div class="logo" style="margin-left:-100px">
					<!--<a href="index.html"><img src="carshare.png" title="logo" /></a>-->
					<p><font color="#CCCCCC" size="+4">Car Pooling</p></font>
				</div>
				<div class="top-nav">
					<ul>
						<li><a href="../admin/home.php"><font size="+1">Home</font></a></li>
						<!--<li><a href="mainprofile.php"><font size="+1">Profile</font></a></li>-->				<li><a href="../admin/message.php">
						<font size="+1">Notification
						<?php
		$receiverid=$_SESSION['reg_id'];;
		$nmsg=0;
		$query=mysql_query("select * from privatemessage where receiverid = $receiverid");
		if(mysql_num_rows($query)>=1)
		{
			while($data=mysql_fetch_array($query))
			{
				if($data['counter']==1)
					$nmsg++;
			}
		}
			if($nmsg==0)
			{
			}
			elseif($nmsg>0)
			{
			echo "<p align='center' style='background-color:#FF0000;width:20px; height:20px; padding-bottom:0px; margin-left:110px; margin-top:-40px;'><font color='#FFFFFF'>".$nmsg."</p>";}
?>
						</font></a></li>		
							<!--<li><a href="mainprofile.php"><font size="+1">Profile</font></a></li>-->			
						<li ><a href="../admin/infoaboutus.php"><font size="+1">About Us</font></a></li>		
				
					<li>
								<DIV class="dropdown">
								<!--<div class="dropdown-content">-->
						  <button class="dropbtn" style="margin-top:21px;"><?php include_once("../connection.php"); $a= $_SESSION['reg_id'];
						  $sql=mysql_query("select firstname from signup_details where reg_id=$a");
						    
							$row=mysql_fetch_array($sql);
							echo $row['firstname'];?>   </button>
						  <div class="dropdown-content">
							<a href="../admin/mainprofile.php"><font color="#333333">Basic Info.</font></a>
							<a href="../member/offerdetails.php"><font color="#333333">Rides Offered</font></a>
							<a href="../admin/uploadfile.php"><font color="#333333">Upload Profile Pic.</font></a>							</div>
						 </DIV>
										 
						
						
					  <li><a href="../logout.php"><font size="+1">logout</font></a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
		</div>

</body>

<body>
	<br />
<br />
<?php
	if(isset($_SESSION['updatesuccess']))
	{
		?>
			<img src="success.jpg" height="30px" width="30px" /><b>Congratulations! Your ride has been updated</b>    <a href="offerdetails.php" >View your ride offer</a>
		<?php
	}
	else
	{
?>
	<img src="success.jpg" height="30px" width="30px" /><b>Congratulations! Your ride has been published</b>    <a href="offerdetails.php" >View your ride offer</a>
	<?php
		}
	?>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>