<?php
ob_start();
session_start();
	include_once("toptemplate.php");
	include_once("hmenu.php");
	include_once("connection.php");
	if(isset($_SESSION['emailcommanusername']))
	{
		
	?>
	<html>
	<head>
		<title>Search page</title>	
				 <style type="text/css">
	
				#dv1, #dv0{
					width: 408px;
					border: 1px #ccc solid;
					padding: 15px;
					margin: auto;
	
				}
			   
				/*downloaded from http://devzone.co.in*/
			</style>
		   <style>
	
				/****** Rating Starts *****/
			   @import url(http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
	
				fieldset, label { margin: 0; padding: 0; }
				body{ margin: 20px; }
				h1 { font-size: 1.5em; margin: 10px; }
	
				.rating { 
					border: none;
					float: left;
				}
	
				.rating > input { display: none; } 
				.rating > label:before { 
					margin: 5px;
					font-size: 1.25em;
					font-family: FontAwesome;
					display: inline-block;
					content: "\f005";
				}
	
				.rating > .half:before { 
					content: "\f089";
					position: absolute;
				}
	
				.rating > label { 
					color: #ddd; 
					float: right; 
				}
	
				.rating > input:checked ~ label, 
				.rating:not(:checked) > label:hover,  
				.rating:not(:checked) > label:hover ~ label { color: #FFD700;  }
	
				.rating > input:checked + label:hover, 
				.rating > input:checked ~ label:hover,
				.rating > label:hover ~ input:checked ~ label, 
				.rating > input:checked ~ label:hover ~ label { color: #FFED85;  }     
			</style>
			
		
						<!-- Demo 2 start -->
		   
		<script>
							$(document).ready(function () {
								$("#demo2 .stars").click(function () {
									alert($(this).val());
									$(this).attr("checked");
								});
							});
						</script>
	</head>
	
	<?php
		$date2=date('yy-mm-dd');
		if(isset($_GET['submit']) || isset($_SESSION['searchvalue']))
		{
			if(isset($_SESSION['searchvalue']))
			{
				$t=$_SESSION['tovalue'];
				$f=$_SESSION['fromvalue'];
			}
			else
			{
				$a=$_SESSION['reg_id'];
				if($_GET['txtfrom']== NULL)
				{
					$_SESSION['fromerror']=1;
					header("location:searchfront.php");
				}
				else
				{
					$f=$_GET['txtfrom'];
					$_SESSION['fromvalue']=$f;
				}
				if($_GET['txtto']== NULL)
				{
					$_SESSION['toerror']=1;
					header("location:searchfront.php");
				}
				else
				{
					$t=$_GET['txtto'];
					$_SESSION['tovalue']=$t;
				}
			}
			if(!($f==NULL || $t==NULL))
			{
				unset($_SESSION['searchvalue']);
				$sql1="select * from routedetails  where source like '%".$f."%' AND destination LIKE '%".$t."%' ";
	?>
				<html>
				<body>
				<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">People Travelling on Your Route
				</font></p><div class="boxinfo">
				<table border="2">
	<?php 
	
				/*if(strtotime('departuredate') > date('yy-mm-dd') )
		{*/
				$result1=mysql_query($sql1);
				if(mysql_num_rows($result1)>=1)
				{
				while($row1=mysql_fetch_array($result1))
				{
					$sq=mysql_query("select * from typeoftrip  where reg_id=".$row1['reg_id']);
					$ro=mysql_fetch_array($sq);
					$date1=$ro['departuredate'];
					if($date1 > $date2 )
					{		
						if(!($row1['reg_id']==$a))
						{		
						echo "<tr>";
						$sql2=mysql_query("select * from images  where reg_id=".$row1['reg_id']);
						$row2=mysql_fetch_array($sql2);
						$sql3=mysql_query("select * from signup_details  where reg_id=".$row1['reg_id']);
						$row3=mysql_fetch_array($sql3);
						$sql4=mysql_query("select * from typeoftrip  where mid=".$row1['mid']);
						$row4=mysql_fetch_array($sql4);
						$sql5=mysql_query("select * from rating where did=".$row1['reg_id']);
						$rating=0;
						$count=1;
						while($row5=mysql_fetch_array($sql5))
						{
												
								$value=$row5['rate'];
								$rating=($value+$rating)/$count;
								$count++;
	
						}
						echo "<td><img align='middle'  src='images/".$row2[1]."' height='250px' width='350px' ></td></tr>";	
						echo "<tr><td style='padding-top:-1px;'>Name of Driver:-</td>";
						echo "<td >".$row3['firstname'];
						echo "&nbsp;".$row3['lastname']."</td></tr>";	
						echo "<tr><td>Depature location:-</td><td>".$row1[2]."</td></tr>";
						echo "<tr><td>Arrival location:-</td><td>".$row1[3]."</td></tr>";	
						echo "<tr><td>Depature Date:-</td><td>".$row4[3]."</td></tr>";
						echo "<tr><td>Depature Time:-</td><td>".$row4[4]."</td></tr>";?>
						
						<?php echo "<tr><td>Ratings:-</td><td>";?>
							
							  
							<?php if($rating <= 5 && $rating >4.5)
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input class="stars" type="radio" id="star5" name="rating" value="5" checked="checked" readonly="true" />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" type="radio" id="star4half" readonly="true" name="rating" value="4.5" />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input class="stars" type="radio" id="star4" name="rating" readonly="true" value="4" />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" type="radio" id="star3half" name="rating" value="3.5" readonly="true" />
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input class="stars" type="radio" id="star3" readonly="true" name="rating" value="3" />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" type="radio" id="star2half" name="rating" readonly="true" value="2.5"  />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input class="stars" type="radio" id="star2" name="rating" readonly="true" value="2" />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" type="radio" id="star1half" name="rating" value="1.5" readonly="true" />
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star1" name="rating" value="1" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" readonly="true" type="radio" id="starhalf" name="rating" value="0.5" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							<?php
							}
							 else if($rating>4.0 && $rating <= 4.5   )
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input class="stars" type="radio" readonly="true" id="star5" name="rating" value="5" \ />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" type="radio" id="star4half" readonly="true" name="rating" value="4.5" checked="checked" />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star4" name="rating" readonly="true" value="4" />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star3half" name="rating" value="3.5" readonly="true" />
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star3" name="rating" value="3" />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" type="radio" id="star2half" readonly="true" name="rating" value="2.5"  />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input class="stars" type="radio" id="star2" name="rating" readonly="true" value="2" />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" type="radio" id="star1half" name="rating" readonly="true" value="1.5" />
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input class="stars" type="radio" id="star1" name="rating" value="1" readonly="true" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" type="radio" id="starhalf" name="rating" value="0.5" readonly="true" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							<?php
							}
							else if($rating>3.5 && $rating <=4.0)
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input readonly="true" class="stars" type="radio" id="star5" name="rating" value="5"  />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star4half" name="rating" value="4.5" />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star4" name="rating" value="4" checked="checked"  />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" type="radio" id="star3half" readonly="true" name="rating" value="3.5" />
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input class="stars" type="radio" id="star3" name="rating" readonly="true" value="3" />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" type="radio" id="star2half" name="rating" value="2.5" readonly="true"  />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star2" name="rating" value="2" />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star1half" name="rating" value="1.5" />
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star1" name="rating" value="1" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" readonly="true" type="radio" id="starhalf" name="rating" value="0.5" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							<?php
							}
							else if($rating>3.0 && $rating <= 3.5)
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input readonly="true" class="stars" type="radio" id="star5" name="rating" value="5"  />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star4half" name="rating" value="4.5"  />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star4" name="rating" value="4"  />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" type="radio" id="star3half" readonly="true" name="rating" value="3.5" checked="checked"/>
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input class="stars" type="radio" id="star3" name="rating" readonly="true" value="3" />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" type="radio" id="star2half" name="rating" value="2.5" readonly="true"  />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star2" name="rating" value="2" />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star1half" name="rating" value="1.5" />
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star1" name="rating" value="1" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" readonly="true" type="radio" id="starhalf" name="rating" value="0.5" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							<?php
							}
							else if($rating>2.5 && $rating <= 3.0)
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input class="stars" type="radio" readonly="true" id="star5" name="rating" value="5"  />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" type="radio" id="star4half" readonly="true" name="rating" value="4.5" />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input class="stars" type="radio" id="star4" name="rating" readonly="true" value="4" />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" type="radio" id="star3half" name="rating" value="3.5" readonly="true"  />
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star3" name="rating" value="3" checked="checked"/>
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star2half" name="rating" value="2.5"  />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star2" name="rating" value="2" />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" type="radio" id="star1half" readonly="true" name="rating" value="1.5" />
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input class="stars" type="radio" id="star1" name="rating" readonly="true" value="1" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" type="radio" id="starhalf" name="rating" value="0.5" readonly="true" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							<?php
							}
							else if($rating>2.0 && $rating <= 2.5)
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input class="stars" readonly="true" type="radio" id="star5" name="rating" value="5"  />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star4half" name="rating" value="4.5" />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input class="stars" type="radio" id="star4" readonly="true" name="rating" value="4" />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" type="radio" id="star3half" readonly="true" name="rating" value="3.5" />
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input class="stars" type="radio" id="star3" name="rating" readonly="true" value="3"  />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" type="radio" id="star2half" name="rating" readonly="true" value="2.5" checked="checked" />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input class="stars" type="radio" id="star2" name="rating" value="2" readonly="true" />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" type="radio" id="star1half" name="rating" value="1.5" readonly="true"/>
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star1" name="rating" value="1" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" readonly="true" type="radio" id="starhalf" name="rating" value="0.5" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							<?php
							}
							else if($rating > 1.5 && $rating <= 2.0)
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input class="stars" type="radio" readonly="true" id="star5" name="rating" value="5"  />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" type="radio" id="star4half" readonly="true" name="rating" value="4.5" />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input class="stars" type="radio" id="star4" name="rating" value="4" readonly="true" />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" type="radio" id="star3half" name="rating" value="3.5" readonly="true"/>
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star3" name="rating" value="3" />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star2half" name="rating" value="2.5"  />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star2" name="rating" value="2"  checked="checked"/>
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" type="radio" id="star1half" readonly="true" name="rating" value="1.5" />
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input class="stars" type="radio" id="star1" name="rating" readonly="true" value="1" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" type="radio" id="starhalf" name="rating" value="0.5" readonly="true" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							<?php
							}
							else if($rating >1 && $rating <= 1.5)
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input class="stars" readonly="true" type="radio" id="star5" name="rating" value="5"  />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star4half" name="rating" value="4.5" />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input class="stars" type="radio" id="star4" readonly="true" name="rating" value="4" />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" type="radio" id="star3half" name="rating" readonly="true" value="3.5" />
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input class="stars" type="radio" id="star3" name="rating" value="3" readonly="true" />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" type="radio" id="star2half" name="rating" value="2.5" readonly="true"  />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star2" name="rating" value="2"  />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star1half" name="rating" value="1.5" checked="checked"  />
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star1" name="rating" value="1" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" type="radio" id="starhalf" readonly="true" name="rating" value="0.5" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							<?php
							}
							else if($rating >0.5 && $rating <= 1.0)
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input class="stars" readonly="true" type="radio" id="star5" name="rating" value="5"  />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star4half" name="rating" value="4.5" />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input class="stars" type="radio" id="star4" readonly="true" name="rating" value="4" />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" type="radio" id="star3half" readonly="true" name="rating" value="3.5" />
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input class="stars" type="radio" id="star3" name="rating" readonly="true" value="3" />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" type="radio" id="star2half" name="rating" value="2.5" readonly="true"  />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star2" name="rating" value="2" />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star1half" name="rating" value="1.5" />
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star1" name="rating" value="1"  checked="checked" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" type="radio" id="starhalf" readonly="true" name="rating" value="0.5" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							<?php
							}
							
							else if($rating >0 && $rating == 0.5)
							{?>
							<form action="rating.php" method="post">					
							<fieldset id='demo2' class="rating">
							<input class="stars" type="radio" id="star5" name="rating" readonly="true" value="5"  />							
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input class="stars" type="radio" id="star4half" name="rating" readonly="true" value="4.5" />
							<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input class="stars" type="radio" id="star4" name="rating" readonly="true" value="4" />
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input class="stars" type="radio" id="star3half" name="rating" value="3.5" readonly="true"  />
							<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input readonly="true" class="stars" type="radio" id="star3" name="rating" value="3" />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input class="stars" readonly="true" type="radio" id="star2half" name="rating" value="2.5"  />
							<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input class="stars" type="radio" readonly="true" id="star2" name="rating" value="2" />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input class="stars" type="radio" id="star1half" readonly="true" name="rating" value="1.5" />
							<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input class="stars" type="radio" id="star1" name="rating" readonly="true" value="1" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input class="stars" type="radio" id="starhalf" name="rating" value="0.5" readonly="true"  checked="checked" />
							<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
						</fieldset></form>
							
						
							
						
							<?php
							}
							else if($rating == 0)
							{
							
								echo"the Driver has not been rated till now</td></tr>";
							}
							else 
							{
								echo "error in fetching ratings";
							}
						//	echo "<td>".$rating."</td>";
							
						echo "<tr><td><a href='viewdetails.php?pid=".$row1[0]."'>view details>></a></td>";	
						echo "</tr>";
						echo"<tr>";
						echo"<td><hr></td>";
						echo"<td><hr></td>";
						echo"<td><hr></td>";
						echo"<td><hr></td>";		
						echo"</tr>";
					}
				}		
			}
			}		
			else
			{	
				echo "No rides offered till now for this route";
			}
		}
	}
		else
		{
		?>
	<!--	<img src="img/Exclamation.png">No Ride Has Been Found On This Route-->
		
	<?php
		}
		?>	
	
		</table>
		</body>
		</div>
		</html> 
<?php
}
else
	header("location:../index.html");
?>