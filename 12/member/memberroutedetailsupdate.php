
<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	$reg_id=$_SESSION['reg_id'];
	include_once("toptemplate2.php");
	if(isset($_SESSION['rid']))
	{
		$rid=$_SESSION['rid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>

input[type="text"]:focus,input[type="text"].focus {
  box-shadow: inset 1px 1px 2px 0 #c9c9c9;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style1.css" type="text/css" rel="stylesheet" />	
<title>Update Member Route Details</title>
</head>
<body style="font-family: sans-serif;
	font-size: 16px;"><br /> 
<?php
		$query=mysql_query("select * from routedetails where mid='".$_SESSION['midedit']."'");
		$route=mysql_fetch_array($query);
		$query1=mysql_query("select * from typeoftrip where mid='".$_SESSION['midedit']."'");
		$trip=mysql_fetch_array($query1);	
?>
			<div>
	<form action="memberroutedetailsback.php" method="get">
		            <div id="map" style="
height:400px;
width:500px;
margin-top:120px;
position:absolute;right:22px;top:19px;"align="right"></div>
<!--<font color=#E66C2C>(Note:- Editing Multiple ride will edit to all deatials)</font>-->
		<table class="trip" cellpadding="5" >
		<tr><td colspan="2">
			<font size="+1"><b>Exact Route</b></font>
		</td></tr>
		<tr><td>
                   Source A:</td><td><input id="searchTextFieldSource" class="text" type="text" name="source" size="50" onkeydown="validateForEnter();" value="<?php echo $route['source']; ?>" placeholder="Enter the source" autocomplete="on" runat="server" />  
                    <input type="hidden" id="city1" name="city1" />
                    <input type="hidden" id="cityLat1" name="cityLat1" />
                    <input type="hidden" id="cityLng1" name="cityLng1" />  
		</td></tr>
		<tr>
			<td></td>
			<td style="padding-left:18px;"><?php if(isset($_SESSION['sourceerror'])){ echo "<font color=red>Enter Source Location</font>";unset($_SESSION['sourceerror']); } ?>
			</td>
		</tr>
		<tr><td>
                   Destination B:</td><td><input id="searchTextFieldDestination" class="text" type="text" name="destination" onkeydown="validateForEnter();" value="<?php echo $route['destination']; ?>" size="50" placeholder="Enter the destination" autocomplete="on" runat="server" />  
                    <input type="hidden" id="city2" name="city2" />
                    <input type="hidden" id="cityLat2" name="cityLat2" />
                    <input type="hidden" id="cityLng2" name="cityLng2" />  
        </td></tr>
		<tr>
			<td></td>
			<td style="padding-left:18px;"><?php if(isset($_SESSION['destinationerror'])){ echo "<font color=red>Enter Destination Location</font>";unset($_SESSION['destinationerror']); } ?>
			</td>
		</tr>
		<tr><td>
                   Intermediate Source C:</td><td><input id="searchTextFieldIntermediateSource"  class="text" type="text" name="intermediatedestination1" onkeydown="validateForEnter();"value="<?php echo $route['intermediatedestination1']; ?>" size="50" placeholder="Enter the destination" autocomplete="on" runat="server" />  
                    <input type="hidden" id="city3" name="city3" />
                    <input type="hidden" id="cityLat3" name="cityLat3" />
                    <input type="hidden" id="cityLng3" name="cityLng3" />  
        </td></tr>
		<tr>
			<td></td>
			<td style="padding-left:18px;"><?php if(isset($_SESSION['intermediated1error'])){ echo "<font color=red>Enter Intermediatedestination1 Location</font>";unset($_SESSION['intermediated1error']); } ?>
			</td>
		</tr>
		<tr><td>
		           Intermediate Destination D:</td><td><input id="searchTextFieldIntermediateDestination" type="text" size="50" placeholder="Enter the destination" autocomplete="on" onkeydown="validateForEnter();" class="text" name="intermediatedestination2" value="<?php echo $route['intermediatedestination2']; ?>" runat="server" />  
                    <input type="hidden" id="city4" name="city4" />
                    <input type="hidden"id="cityLat4" name="cityLat4" />
                    <input type="hidden" id="cityLng4" name="cityLng4" />  
		</td>	</tr>
		<tr>
			<td></td>
			<td style="padding-left:18px;"><?php if(isset($_SESSION['intermediated2error'])){ echo "<font color=red>Enter Intermediatedestination2 Location</font>";unset($_SESSION['intermediated2error']); } ?>
			</td>
		</tr>
		</table><br />

	<table class="trip" cellpadding="5">
	<?php 
		$y=date('Y');
		$a=date('m');
		$d=date('d');
		//echo $a;
		//settype($a,"integer");
		$a++;
		$a++;
		$a++;
		$m="0";
		$m.=$a;
	?>
			<tr>
			<td colspan="3">
				<font size="+1"><b>Date and Time</b></font>
			</td>
		</tr>
			<tr>
				<td width="155">Departure date</td>
				<td>Departure Time</td>
			</tr><tr><td><input type="date" value="<?php echo $trip['departuredate'];?>" name="departuredate" min="<?php echo date('Y-m-d');?>" max="<?php echo $y."-".$m."-".$d?>"/>
			</td>
			<td width="161">
			<?php
				$time=$trip['departuretime'];
				$hour=substr($time,0,2);
				$minute=substr($time,3,2);
			?>
			<select name="timehour">
				<option value="">HH</option>
				<option value="00"<?php if($hour=="00"){echo "selected=selected";} ?>>00</option>
				<option value="01"<?php if($hour=="01"){echo "selected=selected";} ?>>01</option>
				<option value="02"<?php if($hour=="02"){echo "selected=selected";} ?>>02</option>
				<option value="03"<?php if($hour=="03"){echo "selected=selected";} ?>>03</option>
				<option value="04"<?php if($hour=="04"){echo "selected=selected";} ?>>04</option>
				<option value="05"<?php if($hour=="05"){echo "selected=selected";} ?>>05</option>
				<option value="06"<?php if($hour=="06"){echo "selected=selected";} ?>>06</option>
				<option value="07"<?php if($hour=="07"){echo "selected=selected";} ?>>07</option>
				<option value="08"<?php if($hour=="08"){echo "selected=selected";} ?>>08</option>
				<option value="09"<?php if($hour=="09"){echo "selected=selected";} ?>>09</option>
				<option value="10"<?php if($hour=="10"){echo "selected=selected";} ?>>10</option>
				<option value="11"<?php if($hour=="11"){echo "selected=selected";} ?>>11</option>
				<option value="12"<?php if($hour=="12"){echo "selected=selected";} ?>>12</option>
				<option value="13"<?php if($hour=="13"){echo "selected=selected";} ?>>13</option>
				<option value="14"<?php if($hour=="14"){echo "selected=selected";} ?>>14</option>
				<option value="15"<?php if($hour=="15"){echo "selected=selected";} ?>>15</option>
				<option value="16"<?php if($hour=="16"){echo "selected=selected";} ?>>16</option>
				<option value="17"<?php if($hour=="17"){echo "selected=selected";} ?>>17</option>
				<option value="18"<?php if($hour=="18"){echo "selected=selected";} ?>>18</option>
				<option value="19"<?php if($hour=="19"){echo "selected=selected";} ?>>19</option>
				<option value="20"<?php if($hour=="20"){echo "selected=selected";} ?>>20</option>
				<option value="21"<?php if($hour=="21"){echo "selected=selected";} ?>>21</option>
				<option value="22"<?php if($hour=="22"){echo "selected=selected";} ?>>22</option>
				<option value="23"<?php if($hour=="23"){echo "selected=selected";} ?>>23</option>	
			</select>
			
			<select name="timeminute">
				<option value="">MM</option>
				<option value="00"<?php if($minute=="00"){echo "selected=selected";} ?>>00</option>
				<option value="10"<?php if($minute=="10"){echo "selected=selected";} ?>>10</option>
				<option value="20"<?php if($minute=="20"){echo "selected=selected";} ?>>20</option>
				<option value="30"<?php if($minute=="30"){echo "selected=selected";} ?>>30</option>
				<option value="40"<?php if($minute=="40"){echo "selected=selected";} ?>>40</option>
				<option value="50"<?php if($minute=="50"){echo "selected=selected";} ?>>50</option>
			</select></td>
			</td>
			<tr>
			<td><?php if(isset($_SESSION['departuredateerror'])){ echo "<font color=red>Select Date</font>";unset($_SESSION['departuredateerror']); } ?>
			</td>
			<td><?php if(isset($_SESSION['timehourerror'])){ echo "<font color=red>Select Departure Hour</font>";unset($_SESSION['timehourerror']); } ?>
			</td>
			<td><?php if(isset($_SESSION['timeminuteerror'])){ echo "<font color=red>Select Departure Minute</font>";unset($_SESSION['timeminuteerror']); } ?>
			</td>
		</tr>
	</table>
	<input class="button" type="submit" name="btn_updatenext" value="Update" />
</form></div>

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