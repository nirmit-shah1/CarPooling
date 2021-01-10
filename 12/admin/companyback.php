<?php
	session_start();
	if(isset($_SESSION['adminusername']))
	{ 
		include_once("..\connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>alter company table</title>
</head>
<body><br />
<br />
<table title="Alter company table" border="1">
	<tr>
		<th>COID</th>
		<th>Company Name</th>
	</tr>
<?php
	 
	 if($_POST['txt_company']=="")
	 {
	 	$_SESSION['company']=0;
	 	header("location:company.php");
	 }
	 else
	 {
	 	$companyname=$_POST['txt_company'];
		$result1=mysql_query("select max(coid) as coid1 from company");
		//checks last raecords student id
		if($row=mysql_fetch_array($result1))
		{
			$no = $row['coid1'];
			$no=$no+1;
		}
		else
		{
			$no=1;
		}
		if(isset($_POST["btn_submit"]))
		{
			$insertquery=mysql_query("insert into company values('$no','$companyname')");
			if($insertquery)
				header("location:company.php");
			else
				echo "Error in inserting...";
		}
	 }
	?>

</table><br />
<br />
<a href="company.php">Go To company registration page</a>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>