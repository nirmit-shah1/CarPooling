<html>
<head>

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

</head>
<body>

<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("connection.php");
	include_once("toptemplate.php");
	include_once("hmenu.php");
	$id=$_GET['driverid'];
	$sql=mysql_query("select * from rating where did=$id");?>
	
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">Reviews And Comment About Driver
	<div class="boxinfo">
				</font></p>
	<table>
	<?php
	while($row=mysql_fetch_array($sql))
	{
	$pid=$row[1];
	$rating = $row[3];
	$sql1=mysql_query("select * from signup_details where reg_id=$pid");
	$row1=mysql_fetch_array($sql1);
	echo"<tr>";
	echo "<td style='color:#FF9900;font-size:28px'>Name of Passanger:-</td>";
	echo "<td style='font-size:28px'>". $row1[1] ."&nbsp;". $row1[2]."</td></tr>";
	echo "<td style='color:#FF9900;font-size:28px'>Ratings:-</td>";
	echo "<td>";
	?>
							  
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
							else if($rating>1.5 && $rating <= 2.0)
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
							<input class="stars" readonly="true" type="radio" id="star1half" name="rating" value="1.5" checked="checked" />
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
							
							else if($rating >0 &&  $rating <= 0.5)
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
		
	echo "<tr><td style='color:#FF9900;font-size:28px '>comment:-</td>";
	echo "<td style='color:#66CCFF;font-size:28px'>".$row[4]."</td></tr>";
	}
	?>
	</table>
	
	<?php
	echo"<a style='color:#CC0000' href='viewdetails.php?pid=$id'><u><<-Back To The Ride Page</u></a>";?>
	</div>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>