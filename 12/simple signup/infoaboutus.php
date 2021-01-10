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
<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">Information About Car Pooling</font></p>
<div class="boxinfo">
<ol>
<li> Car Pooling is a trusted community marketplace that connects drivers with empty seats to co-travellers looking for a ride.</li><br>
<li> Many people will like to use Car Pooling every quarter creating an entirely new, people powered, transport network.</li><br>
<li> With a dedicated customer service.</li><br>
<li>A state of the art web  platform.</li><br>
<li> Car Pooling will making travel social.</li><br>
<li>Car Pooling wil also help for money-saving and more efficient for many members.</li><br>
<li>With help of Car Pooling the enviroment can also be protected from the harmful gases that are emitted from the vehicle.</li><br>
<li>By travelling in one vehicle instead of individual vehicles.</li><br> </p>
</div>
</body>
</html>

<?php }
else
{
header("location:../index.html");
}
?>