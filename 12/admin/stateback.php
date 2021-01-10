<?php
session_start();
if(isset($_SESSION['adminusername']))
{	 
	 include_once("..\connection.php");	 
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Alter state</title>
</head>
<body><br />
<br />
<?php
		if(isset($_POST["btn_submit"]))
		{
				
		 $statename=$_POST['txt_state'];
		 if($statename==NULL)
		 {
			$_SESSION['state']=0;
			header("location:state.php");
		 }
			$result1=mysql_query("select max(sid) as sid1 from state");
			//checks last raecords student id
			if($row=mysql_fetch_array($result1))
			{
				$no = $row['sid1'];
				$no=$no+1;
			}
			else
			{
				$no=1;
			}
			$insertquery=mysql_query("insert into state values('$no','$statename')");
			if($insertquery)
				header("location:state.php");
		}
		else
		{
			header("location:state.php");
		}
	?>
</table><br />
<br />
<a href="state.php">Go To State registration page</a>
</body>
</html>
<?php
}
else
	header("location:index.html");
?>