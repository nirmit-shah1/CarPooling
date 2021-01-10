<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("../connection.php");
	include_once("toptemplate2.php");
	$reg_id=$_SESSION['reg_id'];
	if(isset($_SESSION['rid']))
	{
		$rid=$_SESSION['rid'];
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
	<?php
			if(isset($_SESSION['midedit']))
			{
				$query2=mysql_query("select * from membertravellingdetails where mid='".$_SESSION['midedit']."'");
				$detail=mysql_fetch_array($query2);
				?>
					<form action="memberroutedetailsback.php" method="get">
			<table class="trip" cellpadding="5">
				<tr><td colspan="2">
				<font size="+1"><b>Ride Details</b></font>
			</td></tr>
				<tr>
					<td>Price per traveler</td>
					<td  align="right" style="padding-right:30px">
						<input type='text' value="<?php echo $detail['pricepertraveler']; ?>" class="icon1" readonly="true" name='qty' id='qty' style="width:100px; height:40px;"/>
						<input type='button' name='add' style="background-color:#00FF00;height:40px; width:40px;" onclick='javascript: document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;document.getElementById("qty").value++;' value='+'/>
						<input type='button' name='subtract' style="background-color:#FF0000; height:40px; width:40px; font-size:20px;" onclick='javascript: subtractQty();' value='-'/>
					</td>
				</tr>
				<tr>
					<tD>Number of seats offered:
					</tD>
					<td>
						<select name="seatavailable">
							<option value="1"<?php if($detail['seatsavail']==1){ echo "selected=selected";} ?>>1</option>
							<option value="2"<?php if($detail['seatsavail']==2){ echo "selected=selected";} ?>>2</option>
							<option value="3"<?php if($detail['seatsavail']==3){ echo "selected=selected";} ?>>3</option>
							<option value="4"<?php if($detail['seatsavail']==4){ echo "selected=selected";} ?>>4</option>
							<option value="5"<?php if($detail['seatsavail']==5){ echo "selected=selected";} ?>>5</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Maximum luggage size:
					</td>
					<td>
						<select name="luggage">
							<option <?php if($detail['luggage']=="small"){ echo "selected=selected";} ?>>small</option>
							<option <?php if($detail['luggage']=="Medium"){ echo "selected=selected";} ?>>Medium</option>
							<option <?php if($detail['luggage']=="Big"){ echo "selected=selected";} ?>>Big</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>I will leave:
					</td>
					<td>
						<select name="leave">
							<option value="On time" <?php if($detail['leave']=="On time"){ echo "selected=selected";} ?>>Right on time</option>
							<option value="Fifteen minutes" <?php if($detail['leave']=="Fifteen minutes"){ echo "selected=selected";} ?>>In a 15 minute window</option>
							<option value="THIRTY_MINUTES" <?php if($detail['leave']=="THIRTY_MINUTES"){ echo "selected=selected";} ?>>In a 30 minute window</option>
							<option value="TWO_HOURS" <?php if($detail['leave']=="TWO_HOURS"){ echo "selected=selected";} ?>>In a 2 hour window</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>I can make a detour
					</td>
					<td>
						<select name="detour">
							<option value="NO detours" <?php if($detail['detour']=="NO detours"){ echo "selected=selected";} ?>>I'm not willing to make a detour</option>
							<option value="Fifteen minutes detour max." <?php if($detail['detour']=="Fifteen minutes detour max."){ echo "selected=selected";} ?>>15 minute detour max.</option>
							<option value="Thirty minutes detour max." <?php if($detail['detour']=="Thirty minutes detour max."){ echo "selected=selected";} ?>>30 minute detour max.</option>
							<option value="Whatever it takes" <?php if($detail['detour']=="Whatever it takes"){ echo "selected=selected";} ?>>Anything is fine</option>
						</select>
					</td>
				</tr>
			</table>
			<input class="button" type="submit" name="btn_updateoffer" value="Update publised Offer" />
		</form>
				<?php		
			}
			?>
	</body>
	</html>
<?php
	}
	else
		header("location:offerdetails.php");
}
else
	header("location:../index.html");
?>