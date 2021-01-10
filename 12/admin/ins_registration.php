<?php
	//	require("connection.php");
	//insert into registration
	echo $_POST['drpcity'];
	include("../connection.php");
	session_start();
if(isset($_SESSION['emailcommanusername']))
{
			$a=$_SESSION['reg_id'];
			$ca=$_POST['selcategory'];
			$pr1=$_POST['drpcity'];
			 $seat=$_POST['selseat'];
			$ac=$_POST['rdbac'];
			$col=$_POST['selcolor'];
			if($ca == "0")
			{
				$_SESSION['caerror']=1;
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
			if($col== "--select--")
			{
				$_SESSION['colerror']=1;
				header("location:memberdetails.php");
			}
			if(!($ca=="--select--" || $pr1=="--select--" ||$seat=="--select--" || $ac==NULL  || $col=="--select--" ))
			{
				if(isset($_POST['submit']))
				{
					$j=mysql_query("insert into member_signup values('$a','$ca','$pr1','$seat','$ac','$col')");
						if($j)
							$_SESSION['infosuccess']=1;
						else
							$_SESSION['infofail']=1;
						
						header("location:memberdetails.php");
				}
				if(isset($_POST['update']))
				{
					$i=mysql_query("update member_signup set category='$ca',product='$pr1',seats='$seat',ac='$ac',colour='$col' where reg_id = '$a'");
					
					//echo "update member_signup set category='$ca',product='$pr1',seats='$seat',ac='$ac',color='$col' where reg_id = '$a'";
						if($i)
							$_SESSION['infousuccess']=1;
						else
							$_SESSION['infoufail']=1;
						
						header("location:memberdetails.php");
				}
			}
			else
			{
				header("location:memberdetails.php");
			}  
}
else
	header("location:../index.html");
?>