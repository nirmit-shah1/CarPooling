<?php
session_start();
if(isset($_SESSION['adminusername']))
{
include_once("toptemplate6.php");
include_once("adminhmenu.php");

?>
<html>
<body>
<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+2">Choice</font></p>
<div class="boxinfo">
<p>On Car Pooling, you get to choose your travelling companions.<br><br>
 Co-travellers contact car owners of their choice, and in turn, car owners can quickly accept or decline requests.<br><br> To help members decide, in addition to ratings, BlaBlaCar provides valuable information about each members recent activity and experience level.<br><br>
 This means you will always be confident and comfortable planning a rideshare.<br><br>
</div>
</body>
</html>
<?php
}
else
{
header("location:../index.php");

}
?>