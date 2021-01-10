<?php
session_start();
if(isset($_SESSION['adminusername']))
{
?>
<html>
<title>Report Page</title>
<body>
<?php 
include_once("connection.php");
include_once("toptemplate3.php");
function noofuser()
{
$sql="select * from signup_details";
$result=mysql_query($sql);
echo "<font size='+2'>". mysql_num_rows($result)."</font>";
}
function noofuserdaily()
{
$date1=date('d-m-y');
$sql="select * from signup_details where date='".$date1."' ";
$result=mysql_query($sql);
echo"<font size='+2'>". mysql_num_rows($result)."</font>";
}
function ridesoffernow()
{
$sql="select * from routedetails";
$result=mysql_query($sql);
echo"<font size='+2'>". mysql_num_rows($result)."</font>";
}
function imageuploadtillnow()
{
$sql="select * from images";
$result=mysql_query($sql);
 echo"<font size='+2'>". mysql_num_rows($result)."</font>";
}
function statesaddedtillnow()
{
$sql="select * from state";
$result=mysql_query($sql);
echo"<font size='+2'>". mysql_num_rows($result)."</font>";
}
function cityaddedtillnow()
{
$sql="select * from city";
$result=mysql_query($sql);
echo"<font size='+2'>". mysql_num_rows($result)."</font>";
}
function areraaddedtillnow()
{
$sql="select * from area";
$result=mysql_query($sql);
echo"<font size='+2'>".mysql_num_rows($result)."</font>";
}
function companyaddedtillnow()
{
$sql="select * from company";
$result=mysql_query($sql);
echo"<font size='+2'>". mysql_num_rows($result)."</font>";
}
function modeladdedtillnow()
{
$sql="select * from model";
$result=mysql_query($sql);
echo"<font size='+2'>". mysql_num_rows($result)."</font>";
}
function nooflogin()
{
$b=0;
$sql=mysql_query("select * from logincount");
while($row=mysql_fetch_array($sql))
{
 $a=$row['logincounter'];
	$b+=$a;
}
echo "<font size='+2'>".$b."</font>";

}
function noofratingtodriver()
{
$sql="select * from rating";
$result=mysql_query($sql);
echo"<font size='+2'>". mysql_num_rows($result)."</font>";

}
function noofratingtopassanger()
{
$sql="select * from prating";
$result=mysql_query($sql);
echo"<font size='+2'>". mysql_num_rows($result)."</font>";

}

?>
<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Report</font></p></div>
				<!--<div class="boxinfo" style="padding-bottom:100px;">-->
<div class="report" style="background-color:#f9410a">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;Users Register till now <br />on &nbsp;The Site</font><br /><?php echo"&nbsp;"; noofuser();?><br /><a href="usertillnow.php"><u><font color="#00000">Details of Users->></font></u></a></p>
</div>
<div class="report" style="margin-left:241px; margin-top:-184px; background-color:#5bc0d1">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;Users Register Daily <br />on &nbsp;The Site</font><br /><?php echo"&nbsp;"; noofuserdaily();?></p>
</div>
<div class="report" style="margin-left:489px; margin-top:-184px; background-color:#66ef66">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of Rides  <br />Offer Till Now By Individuals</font><br /><br /><a href="ridesoffer.php"><u><font color="#000000">Check Here->></font></u></a></p>
</div>
<div class="report" style="margin-left:740px; margin-top:-184px;background-color:#0090a8">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of 	Rides  <br />Offer Till Now</font><br /><?php  ridesoffernow();?></p>
</div>
<div class="report" style="margin-left:980px; margin-top:-184px;background-color:#3ea055">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of Images <br />upload Till Now</font><br /><?php  imageuploadtillnow();?></p>
</div>

<div class="report" style="margin-left:0px; margin-top:14px;background-color:#fdd017">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of States<br />Added Till Now</font><br /><?php  statesaddedtillnow();?><br /><br /><a href="statestillnow.php"><u><font color="#000000">Details of States->></font></u></a></p>
</div>
<div class="report" style="margin-left:241px; margin-top:-184px;background-color:#7e3517">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of Cities<br />Added Till Now</font><br /><?php echo"&nbsp;"; cityaddedtillnow();?><br /><br /><a href="citytillnow.php"><u><font color="#000000">Details of City->></font></u></a></p>
</div>
<div class="report" style="margin-left:491px; margin-top:-184px; background-color:#728c00">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of Areas<br />Added Till Now</font><br /><?php echo"&nbsp;"; areraaddedtillnow();?><br /><br /><a href="areatillnow.php"><u><font color="#00000">Details of Areas->></font></u></a></p>
</div>
<div class="report" style="margin-left:741px; margin-top:-184px; background-color:#4c4646">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of Companies<br />Added Till Now</font><br /><?php echo"&nbsp;"; companyaddedtillnow();?><br /><a href="companytillnow.php"><u><font color="#00000">Details of Companies->></font></u></a></p>
</div>
<div class="report" style="margin-left:981px; margin-top:-184px; background-color:#00CC00">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of Model<br />Added Till Now</font><br /><?php echo"&nbsp;"; modeladdedtillnow();?><br /><br /><a href="modeltillnow.php"><u><font color="#00000">Details of Models->></font></u></a></p>
</div>

<div class="report" style="margin-left:0px; margin-top:14px;">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of User<br />Login Till Now</font><br /><?php  nooflogin();?><br /><br /><a href="logindetails.php"><u><font color="#000000">Details of Login->></font></u></a></p>
</div>
<div class="report" style="margin-left:235px; margin-top:-181px; background:#004A00">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of Ratings<br /> And Comment To Driver  Till Now</font><br /><?php  noofratingtodriver();?>
</p></div>
<div class="report" style="margin-left:485px; margin-top:-181px; background:#C66300">
				<p style="padding-top:10px;" align="center" align="justify"><font size="+2">&nbsp;&nbsp;No. Of Ratings<br /> And Comment To Passanger  Till Now</font><br /><?php  noofratingtopassanger();?>
</p></div>

<a href="admin.php"><font color="#990000" size="+2"><-Back to Admin Page</font></a>

</body>
</html>
<?php 
}
else
{
header("location:../index.html");
}
?>

