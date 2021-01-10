<?php
session_start();
include_once("toptemplate2.php");
if(isset($_SESSION['emailcommanusername']))
{
	/*
	else
		header("location:../index.php");
	*/
?>
<html>
<body style="margin:0px;">
<a href="mainprofile.php" style="font-family:'Times New Roman', Times, serif; font-size:30px">See Your Profile-->></a>
<a href="../member/memberroutedetails.php" class="button-0">Offer a ride</a>
<a href="searchfront.php" class="button-1">Get a ride</a>
<?php 
//echo $_SESSION['reg_id'];
?>
<style type="text/css">
.button-0 {
    position: relative;
    padding: 10px 49px;
    margin: 173px 14px 10px 126px;
	 height: 114px;
    width: 357px;
    float: left;
    border-radius: 10px;
    font-family: 'Helvetica', cursive;
    font-size: 25px;
    color: #FFF;
	padding-top:50px;
    text-decoration: none;
	text-align:center;  
    background-color: #FF9933;
    border-bottom: 5px solid #999999;
    text-shadow: 0px -2px #FF9933;
    /* Animation */
    transition: all 0.1s;
    -webkit-transition: all 0.1s;
}

.button-0:hover, 
.button-0:focus {
    text-decoration: none;
    color: #fff;
}

.button-0:active {
    transform: translate(0px,5px);
    -webkit-transform: translate(0px,5px);
    border-bottom: 1px solid;
}
.button-1 {
    position: relative;
    padding: 10px 49px;
    margin: 173px 14px 10px 126px;
	 height: 114px;
    width: 357px;
    float: left;
    border-radius: 10px;
    font-family: 'Helvetica', cursive;
    font-size: 25px;
    color: #FFF;
	padding-top:50px;
    text-decoration: none;
	text-align:center;  
    background-color:#00CC00;
    border-bottom: 5px solid #999999;
    text-shadow: 0px -2px #FFFFF;
    /* Animation */
    transition: all 0.1s;
    -webkit-transition: all 0.1s;
}

.button-1:hover, 
.button-1:focus {	
    text-decoration: none;
    color: #fff;
}

.button-1:active {
    transform: translate(0px,5px);
    -webkit-transform: translate(0px,5px);
    border-bottom: 1px solid;
}

</style>
</body>
</html>
<?php
include_once("footer.php");
}
else
{
	header("location:../index.html");
}
?>