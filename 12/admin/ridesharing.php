<?php
session_start();
if(isset($_SESSION['adminusername']))
{
header("location:admin.php");
}
if(isset($_SESSION['emailcommanusername']))
{
header("location:comman.php");
}
include_once("toptemplate1.php");
include_once("aboutushorizantalmenu.php");
?>
<html>
<body>
<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+2">Ridesharing</font></p>
<div class="boxinfo">
<p>
Ridesharing is when several people travel together by car and share the cost of the journey.<br><br> 
You probably already rideshare very often with family and friends.<br><br> Every time you take the car together you share the cost of a journey with them.<br><br>
In much the same way, Car Pooling connects car owners and co-travellers to share city-to-city journeys. <br><br>
So that they can share a long distance trip together, and both save money.<br><br>

</p>
</div>
</body>
</html>