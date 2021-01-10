<?php
include("../connection.php");
session_start();
	if(isset($_POST['submit']))
	{
		$a=$_SESSION['reg_id'];
		$ca=$_POST['selcategory'];
	$pr=2;	
$pr1=$_POST['drpproduct'];
		$seat=$_POST['selseat'];
		$ac=$_POST['rdbac'];
		$col=$_POST['selcolor'];
		if($ca == "--select--" )
		{
			$_SESSION['caerror']=1;
			header("location:memberdetails.php");
		}	
		
		if($pr == "--select--")
		{
			$_SESSION['prerror']=1;
			header("location:memberdetails.php");
		}	
		if($seat == "--select--")
		{
			$_SESSION['seaterror']=1;
			header("location:memberdetails.php");
		}
		if($ac == NULL)
		{
			$_SESSION['acerror']=1;
			header("location:memberdetails.php");
		}
		
		/*if($gen==NULL)
		{
			$_SESSION['generror']=1;
			header("location:memberdetails.php");
		}
		if($lag==NULL)
		{
			$_SESSION['lagerror']=1;
			header("location:memberdetails.php");
		}*/
		if($col== "--select--")
		{
			$_SESSION['colerror']=1;
			header("location:memberdetails.php");
		}
		/*if($days == "--select--")
		{
			$_SESSION['dayserror']=1;
			header("location:memberdetails.php");
		}*/
		if(!($ca=="--select--" || $pr=="--select--" ||$seat=="--select--" || $ac==NULL  || $col=="--select--" ))
		{
      		$j=mysql_query("insert into member_signup values('$a','$ca','$pr','$seat','$ac','$col')");}
   		}
	else
	{
		//header("location:memberdetails.php");
	}  
	//header("location:memberdetails.php");
?>