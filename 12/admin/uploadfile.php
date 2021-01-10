<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("toptemplate.php");
	include_once("hmenu.php");
	include_once("connection.php");
	set_time_limit(4); 
	ini_set('memory_limit', '512M'); 
	
	 $a=$_SESSION['reg_id'];
	?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Upload File</title>
	
	<!--<link rel="stylesheet" href="file:///G|/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="file:///G|/css/isotope.css" media="screen" />
	<link rel="stylesheet" href="file:///G|/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="file:///G|/css/animate.css" media="screen">
	<!-- Owl Carousel Assets --
	<link href="file:///G|/js/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link rel="stylesheet" href="file:///G|/css/styles.css" />
	<!-- Font Awesome --
	<link href="file:///G|/font/css/font-awesome.min.css" rel="stylesheet">
	-->
	
	<script language="javascript" type="text/javascript">
	var isvalid=true;
	function validate()
	{	
	   if(isvalid==false)
	   {
		  isvalid=true;
		  validate();
		  
	   }
		if(document.file.image.value == "")
		{
			alert("enter the image");
			isvalid=false;
		}
		else if(document.file.txtDesc.value == "")
		{
			alert("enter the description");
			isvalid=false;
		}
	return isvalid;
	}
	</script>
	</head>
	
	<body>
	
	<!--<header class="header">
	  <div class="container">
		<nav class="navbar navbar-inverse" role="navigation">
			<h5 align="right" style="margin-top:5px; margin-bottom:0px;"><b>
			<a href="file:///G|/logout.php">
			<img src="file:///G|/Homepage/logout.png" alt="Go to logout!" height="20" width="20">
			</a>
			<?php  //echo $_SESSION['username'];  ?>
		</b></h5>
	
		  <div class="navbar-header">
			<button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<a class="navbar-brand scroll-top logo  animated bounceInLeft"><b><i></i>KnowMore</b></a> </div>
		  <!--/.navbar-header
		  <div id="main-nav" class="collapse navbar-collapse">
			<ul class="nav navbar-nav" id="mainNav">
	
			  <li><a href="file:///G|/index.php" class="scroll-link">Home</a></li>
			  <li class="active" id="firstLink"><a href="file:///G|/upload_file.php" class="scroll-link">Materials</a></li>
			  <li><a href="#aboutUs" class="scroll-link">Test</a></li>
			  <li><a href="#work" class="scroll-link">Result</a></li>
			  <li><a href="#team" class="scroll-link">Forum</a></li>
	
			</ul>
		  </div>
		  <!--/.navbar-collapse 
		</nav>
		<!--/.navbar-->
	 <?php
	 $sql=mysql_query("select * from images where reg_id=$a");
	// $result=mysql_fetch_array($sql);
	 $no=mysql_num_rows($sql);
	 //echo $no;
	 if($no>0)
	 {
	 
	 
	 ?>
	<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+3">Update Your Profile Picture</font></p>
	<div class="boxinfo">
	<?php
	//$sql=mysql_query("select * from images where reg_id=$a");
	while($row=mysql_fetch_array($sql))
	{
	
	?>
	<!--<img src="images/<?php/* echo $row['name'];*/ ?>" width="300" >-->
	<?php
	 echo '<img  style=margin-bottom:150px; height="300" width="300" src="images/'.$row[1].' "> ';
	}
	?>
	<form action="updateprofile.php" method="post">
	<input type="submit" style="margin-top:-110px" value="Update" name="update" class="button-3">
	</form>
	</div>
	<?php			
	 
	}
	else
	{
	?>  
	<p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+3">Upload Your Profile Picture</font></p>	
	<div class="boxinfo">
	<table width="461" height="249" border="">
	<form action="" method="post" name="file" enctype="multipart/form-data" autocomplete="off">
	<br />
	<tr>
		<td>Select profile pic</td>
		<td><input type="file" name="pimage" /> </td>
	<br />
	</tr>
	<!--<tr>
		<td>Description</td>
		<td><input type="text" name="txtDesc" /></td>
	</tr>-->
	<tr>
		<td colspan="2" align="center">
		<input type="submit" class="button-3" name="submit" value="Upload File" onClick="javascript:return validate()" /></td>
	</tr>
	</form>
	</table>
	</div>
	<?php
	//}
	if(isset($_POST['submit']))
	{
		if(getimagesize($_FILES['pimage']['tmp_name']) == FALSE)
					{
						echo "Please select an image.";
					}
					else
					{
					
						$path="images/".$_FILES['pimage']['name'];
						if(move_uploaded_file($_FILES['pimage']['tmp_name'],$path))
						{
					
						 /*$image= addslashes($_FILES['image']['tmp_name']);
						$name= addslashes($_FILES['image']['name']);
						$image= file_get_contents($image);
						$image= base64_encode($image);*/
						$qry="insert into images (reg_id,name) values ('$a','".$_FILES['pimage']['name']."')";
					$result=mysql_query($qry,$con);
						if($result)
						{
							echo "<br/>Image uploaded.";
						}
						else
						{
							echo "<br/>Image not uploaded.";
						}
								//saveimage($name,$image);
						}
					}
				}
				}
				//displayimage();
		 /*       function saveimage($name,$image)
				{
				
					/*$con=mysql_connect("localhost","root","");
					mysql_select_db("project",$con);
					$qry="insert into images (reg_id,name,image) values ('$a','".$_FILES['pimage']['name']."','$image')";
					$result=mysql_query($qry,$con);
					if($result)
					{
						echo "<br/>Image uploaded.";
					}
					else
					{
						echo "<br/>Image not uploaded.";
					}
					//echo "hello";
				}
				function displayimage()
				{
					/*$con=mysql_connect("localhost","root","");
					mysql_select_db("project",$con);
					$qry="select * from images";
					$result=mysql_query($qry);
					while($row = mysql_fetch_array($result))
					{
						echo '<img height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
					}
					//mysql_close($con);   
				}
	
	}
		/*$de=$_POST['txtDesc'];
		$path="images/".$_FILES['pimage']['name'];
		$size=$_FILES['pimage']['size']/1024;
		if(move_uploaded_file($_FILES['pimage']['tmp_name'],$path))
		{
		$sql=mysql_query("insert into file(reg_id ,f_name,f_path,f_description,f_size)
							VALUES($a,'".$_FILES['pimage']['name']."','".$path."','".$de."','".$size."')");
		echo $_SESSION['reg_id'];
		/*echo "insert into file(reg_id ,f_name,f_path,f_description,f_size)
							VALUES($a,'".$_FILES['pimage']['name']."','".$path."','".$de."','".$size."')";die();
		echo "<script>alert('your image has been succesfully inserted into database');document.location='uploadfile.php'</script>";*/
		
		
		//}
		
		
	//}
	
	?>
	<!--<table border="">
	<tr>
		<td>Name</td>
		<td>Description</td>
		<td>Size</td>
	</tr>->
	<?php
	/*
	$result="select * from file";
	$result=mysql_query($result);
	while($row=mysql_fetch_array($result))
	{
	?>
	<!--<td><img src="images/<?php echo $row['f_name']; ?>" width="50" height="50"></td>-->
	<?php
	
		echo "<tr><td>".$row['f_name']."</td>";
		echo "<td>Description: ".$row['f_description']."</td>";
		echo "<td>Size: ".$row['f_size']."KB</td>";
	
	echo "<td>
	<a href=download.php?id=".$row['reg_id']."&nm=".$row['f_name'].">Download</a><br></td>";
	}
	*/
	?>
	<!--</table>-->
	
	  <!--/.container--> 
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>