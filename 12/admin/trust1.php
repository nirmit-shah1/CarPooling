<?php
session_start();
if(isset($_SESSION['adminusername']))
{
header("location:admin.php");
}
if(isset($_SESSION['emailcommanusername']))
{

include_once("toptemplate2.php");
include_once("hmenu.php");

?>

<html>
<head>
<title>Trust</title>
</head>
<body>
<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+2">Trust</font></p>
<div class="boxinfo">
<p>Trust is at the centre of all communities, and Car Pooling is no exception.<br><br>
 On Car Pooling, every time two members meet in real life they publicly rate each other.<br><br>
  And allowing the members to build up a trusted community reputation.<br><br>
 This means that before you travel with another member you can read their ratings and benefit from the experience of other members.<br><br>
  If a member has been declared trustworthy by several people in the past, you can trust them too</p><br><br>
</div>
</body>
</html>
<?php }
else
{
header("location:../index.html");
}
?>