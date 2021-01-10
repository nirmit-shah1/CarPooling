<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
if(isset($_SESSION['routesuccess']))
{
	unset($_SESSION['routesuccess']);
	
	include_once("../connection.php");
	include_once("toptemplate2.php");
	$reg_id=$_SESSION['reg_id'];
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<link href="style1.css" type="text/css" rel="stylesheet" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Member Travelling Details</title>
	<script type="text/javascript">
	function subtractQty(){
	if(document.getElementById("qty").value - 10 < 10)
	return;
	else
	{
	document.getElementById("qty").value--;
	document.getElementById("qty").value--;
	document.getElementById("qty").value--;
	document.getElementById("qty").value--;
	document.getElementById("qty").value--;
	document.getElementById("qty").value--;
	document.getElementById("qty").value--;
	document.getElementById("qty").value--;
	document.getElementById("qty").value--;
	document.getElementById("qty").value--;
	}
	}
	
	</script>
		
	</head>
	
	<body>
		
		<form action="memberroutedetailsback.php" method="get">
			<table class="trip" cellpadding="5">
				<tr><td colspan="2">
				<font size="+1"><b>Ride Details</b></font>
			</td></tr>
				<tr>
					<td>Price per traveler</td>
					<td  align="right" style="padding-right:30px">
						<input type='text' value="10" class="icon1" readonly="true" name='qty' id='qty' style="width:100px; height:40px;"/>
						<input type='button' name='add' style="background-color:#00FF00;height:40px; width:40px;" onclick='javascript: document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;' value='+'/>
						<input type='button' name='subtract' style="background-color:#FF0000; height:40px; width:40px; font-size:20px;" onclick='javascript: subtractQty();' value='-'/>
					</td>
				</tr>
				<tr>
					<tD>Number of seats offered:
					</tD>
					<td>
						<select name="seatavailable">
							<option value="1">1</option>
							<option value="2" selected="selected">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Maximum luggage size:
					</td>
					<td>
						<select name="luggage">
							<option>small</option>
							<option selected="selected">Medium</option>
							<option>Big</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>I will leave:
					</td>
					<td>
						<select name="leave">
							<option value="On time" selected="selected">Right on time</option>
							<option value="Fifteen minutes">In a 15 minute window</option>
							<option value="THIRTY_MINUTES">In a 30 minute window</option>
							<option value="TWO_HOURS">In a 2 hour window</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>I can make a detour
					</td>
					<td>
						<select name="detour">
							<option value="NO detours">I'm not willing to make a detour</option>
							<option value="Fifteen minutes detour max." selected="selected">15 minute detour max.</option>
							<option value="Thirty minutes detour max.">30 minute detour max.</option>
							<option value="Whatever it takes">Anything is fine</option>
						</select>
					</td>
				</tr>
			</table>
			<input class="button" type="submit" name="btn_publisoffer" value="Publish Offer" />
		</form>
		<?php
			
		?>
	</body>
	</html>
<?php
}
else
	header("location:memberroutedetails.php");
}
else
	header("location:../index.html");
?>