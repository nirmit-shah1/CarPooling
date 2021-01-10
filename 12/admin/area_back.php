<?php
	session_start();
	include_once("../connection.php");
	if(isset($_SESSION['adminusername']))
	{
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert area</title>
</head>
<body>
<?php	
	if(isset($_POST['btn_insert']))
	{
		$check="0";
		if($_POST['drpstate']==$check)
		{
			$_SESSION['error_sid']=0;			
		}	
		else
		{
			$sid=$_POST['drpstate'];
			$_SESSION['value_sid']=$sid;
		}
		if($_POST['drpcity']==$check || $_POST['drpcity']==NULL)
		{
			$_SESSION['error_cid']=0;	
		}
		else 
			$cid=$_POST['drpcity'];
			
		if($_POST['txt_area']==NULL)
		{
			$_SESSION['error_area_name']=0;			
		}
		else 
		{
			$area_name=$_POST['txt_area'];
			$_SESSION['value_area_name']=$area_name;
		}
		if(isset($sid) && isset($cid) && isset($area_name))
		{	
				unset($_SESSION['value_sid']);
				unset($_SESSION['value_area_name']);
				$query=mysql_query("select max(aid) as aid1 from area");
					if($data=mysql_fetch_array($query))
					{
						$no = $data['aid1'];
						$no=$no+1;
					}
					else
					{
						$no=1;
					}
					echo $no.$sid.$cid.$area_name;
				$query1=mysql_query("insert into area values ('$no','$sid','$cid','$area_name')");
				if($query1)
					header("location:area.php");
				else
					echo "error in inserting";
		}
		else
		header("location:area.php");
	}
	else
		header("location:area.php");	
?>
<a href="area.php">Insert Area</a>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>