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
<p style="background-image:url(img/323a45-2880x1800.png)"><font size="+3" color="#FFFFFF">Contact Us</font></p>
<div class="boxinfo">
<p>email-id:-&nbsp;&nbsp;parshwashah84@gmail.com</p><br><br>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nirmitshah803@gmail.com</p><br><br>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mohitvyas118@gmail.com</p><br><br>
<h1><b>Helpline number</b></h1><br>
<p><u>079-24343455</u></p><br>
<p><u>+91-9876567843</u></p><br>
<p><u>+91-9126567843</u></p><br><br>
</div>
</body>
</html>

