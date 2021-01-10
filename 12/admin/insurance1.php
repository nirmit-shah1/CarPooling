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
<body>
<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+2">Insurance</font></p>
<div class="boxinfo">
<p>
Co-travellers contributions to car owners do not generate profit, they only offset costs.<br /><br />
 Therefore ridesharing is not ever hire and reward.<br /><br />
  Rides must only be given in a vehicle seating four passengers or less.<br /><br />
   Car Pooling scrupulously fulfills these conditions.<br /><br />
    As we limit number of seats and cap price per co-travellers.<br /><br />
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