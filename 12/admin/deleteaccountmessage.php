<?php 
session_start();
include_once("toptemplate1.php");
include_once("hmenulogin.php");
include("connection.php");
?>
<body>
		<div class="boxinfo">
		<img src="img/delete-256-000000.png" />
<?php

		
		session_destroy();
		echo"your account has been deleted ";
?>
</div>
</body>
</html>
