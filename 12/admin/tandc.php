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
<hmtl>
<body>

<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+2">GENERAL CONDITION OF USE</font></p>
<div class="boxinfo">
* <b><u>Scope and Definitions:-</b></u>These General Conditions of Use apply to all services provided by Car Pooling. Car Pooling owns and operates the Site  in India.<br /><br />
*<b><u> Defined Terms</b></u><br /><br />
<b><u>Car Sharing</b></u>:- means the sharing of a Vehicle for a Trip by a Car Owner carrying a Co-Traveller for that Trip in exchange for a Cost Contribution;<br /><br />
<b><u>Conditions</b></u>:- mean these General Conditions of Use, including the Good Conduct Charter and Privacy Policy of Car Pooling as notified on the Site.<br /><br />
<b><u>Cost Contribution</b></u>:- means the amount agreed between the Car Owner and the Co-Traveler in relation to the Trip which is payable by the Co-Traveler as their contribution towards the costs of the Trip.<br /><br />
<b><u>Co-Traveller or Passenger</b></u> means a Member who has accepted an offer to be transported by a Car Owner and includes all other persons who accompany such Member in the Vehicle for the Trip.<br /><br />
 <b><u>Car Owner or Driver</u>:- means a Member who through the Site offers to share a car journey with a Co-Traveller in exchange for the Cost Contribution.<br /><br />
 <b><u>Member<b></u>:- refers to a registered user of the Site.<br /><br />
 <b><u>Service</b></u>:- refers to any service provided by Car Pooling through the Site to any   Member.<br /><br />
<B><u>Trip</u></b>:- means a given journey in relation to which a Car Owner and a Co-Traveler have agreed upon a transaction through the Site.<br /><br />
<B><u>User Account</B></u>:- means an account with the Site opened by a Member and used in order to access the Service provided by Car Pooling through the Site.<br /><br />
<B><u>Vehicle</B></u>:- means the vehicle offered by a Car Owner for Car Sharing.<br /><br />
</div>
<br>
<br>

<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF">Acceptance of Conditions</font></p>
<div class="boxinfo">
<p>The Conditions apply to any and all use of the Site by a Member. By using the Site, the Members signify their acceptance to these Conditions in full and agree to be bound by them .<br><br>
&nbsp;&nbsp;&nbsp;No access to the Services will be permitted unless the Conditions are accepted in full. No Member is entitled to accept part only of the Conditions. If a Member does not agree to the Conditions, such Member may not use the Services.<br><br>
&nbsp;&nbsp;&nbsp; All Members agree to comply with the Conditions and accept that their personal data may be processed in accordance with the Privacy Policy.<br><br>
&nbsp;&nbsp;&nbsp;In the event that any Member fails to comply with any of the Conditions, BlaBlaCar reserves the right, but not the obligation at its own discretion, to withdraw the User Account in question and suspend or withdraw all Services to that Member without notice.<br><br>
</body>
</html>