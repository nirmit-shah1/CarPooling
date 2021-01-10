<?php
include("../connection.php");
session_start();
	if(isset($_GET['submit']))
	{
		$ca=$_GET['selcategory'];
		$pr=$_GET['selproduct'];
		$seat=$_GET['selseat'];
		$ac=$_GET['rdbac'];
		$gen=$_GET['rdogender'];
		$lag=$_GET['rdolag'];
		$col=$_GET['selcolor'];
		$days=$_GET['seldays'];
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
		
		if($gen==NULL)
		{
			$_SESSION['generror']=1;
			header("location:memberdetails.php");
		}
		if($lag==NULL)
		{
			$_SESSION['lagerror']=1;
			header("location:memberdetails.php");
		}
		if($col== "--select--")
		{
			$_SESSION['colerror']=1;
			header("location:memberdetails.php");
		}
		if($days == "--select--")
		{
			$_SESSION['dayserror']=1;
			header("location:memberdetails.php");
		}
		if(!($ca==NULL || $pr==NULL ||$seat==NULL || $ac==NULL || $gen==NULL ||$lag==NULL || $col==NULL || $days==NULL))
		{
      $j=mysql_query("insert into member_signup values('','$ca','$pr','$seat','$ac','$gen','$lag','$col','$days')");}	
	  
   	}
	else
		header("location:memberdetails");
	  
	            if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
                {
                    echo "Please select an image.";
                }
                else
                {
                    $image= addslashes($_FILES['image']['tmp_name']);
                    $name= addslashes($_FILES['image']['name']);
                    $image= file_get_contents($image);
                    $image= base64_encode($image);
                    saveimage($name,$image);
                }
            
            displayimage();
            function saveimage($name,$image)
            {
                $con=mysql_connect("localhost","root","");
                mysql_select_db("project",$con);
                $qry="insert into images (name,image) values ('$name','$image')";
                $result=mysql_query($qry,$con);
                if($result)
                {
                    //echo "<br/>Image uploaded.";
                }
                else
                {
                    //echo "<br/>Image not uploaded.";
                }
            }
            function displayimage()
            {
                $con=mysql_connect("localhost","root","");
                mysql_select_db("project",$con);
                $qry="select * from images";
                $result=mysql_query($qry,$con);
                while($row = mysql_fetch_array($result))
                {
                    echo '<img height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
                }
                mysql_close($con);   
            }
			if($j)
			{
				header("location:message.php");
			}
?>