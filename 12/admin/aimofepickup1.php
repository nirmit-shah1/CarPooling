<?php
session_start();
if(isset($_SESSION['adminusername']))
{
header("location:admin/admin.php");
}
if(isset($_SESSION['emailcommanusername']))
{

include_once("toptemplate2.php");
include_once("hmenu.php");
?>
<html>
<body>
<p style="background-image:url(img/323a45-2880x1800.png)" ><font size="+2" color="#FFFFFF">Aim of Car Pooling</font></p>
<div class="boxinfo">
<p>
Our mission is to create an entirely new transport network with a trusted community of drivers and passengers.<br><br> Collectively, we are building a more efficient and more social form of transport, disrupting the travel industry: <br><br>we call it people powered travel, and we want to make it the first choice of every traveller.<br><br>		
</p>
</div>

</body>
</html>
<?php }
else
{
header("location:../index.html");
}
?>