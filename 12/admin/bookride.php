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
<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+2">How to book a ride?</font></p>
<div class="boxinfo">
<p>Once you have chosen your ride, click on Contact Car Owner. If you are not logged-in, you will need to do so. There are then two possibilities:<br><br>
1. Get in touch by private message - this is the recommended form of communication, because the car owner will immediately be able to consult your profile and find out more about you. Car owners prefer to receive private messages for this reason.<br><br>
2. Call the car owner or send an SMS. This is more appropriate after having first made contact by private message.<br><br>
</p>
</div>
</body>
</html>