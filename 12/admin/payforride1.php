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
<title>Pay for ride</title>
<body>
<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+2">How to pay for ride?</font></p>
<div class="boxinfo">
<p>Payment is made in cash during the journey.<br><br>
 We recommend that you arrange to have the payment ready for the journey in advance.<BR><BR> Preferably in the exact amount in cash if possible, as this will avoid the need to find a cash machine.<br><br> 
Or to find change if the car owner doesn't have any.
<br><br>
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
