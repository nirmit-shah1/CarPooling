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
<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+2">How To Search For Ride</font></p>
<div class="boxinfo">
<p>
Use our search engine on the home page: enter the city you wish to depart from and the one you wish to arrive at, you will see a list of rides available, in chronological order by time of departure, with number of seats left and price.<br><br> 
To prevent typos, we recommend that you select cities from the results that are automatically proposed to you.<br><br>
 If the results are too wide, you can refine your search by date, time of departure or price etc.<br><br>
If you would like to see rides available for a return journey, simply click on the button in between the two boxes where you have entered your departure and arrival cities to switch these round and search rides in the opposite direction.<br><br>
If you see a ride you like but need more information, don't hesitate to ask the car owner a question. You can do so by clicking on the orange Contact Car Owner button.<br><br>

</p>
</div>
</body>
</html>