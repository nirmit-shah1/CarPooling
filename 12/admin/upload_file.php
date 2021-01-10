<?php
	session_start();
//if(isset($_SESSION['emailcommanusername']))
//{
	set_time_limit(0); 
	ini_set('memory_limit', '512M'); 
	/*if(!$_SESSION['username'])
	{
		header("location:../web/index.php");	
	}*/
	
	$conn=mysqli_connect("localhost","root","","project");
	
?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Upload File</title>
	
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/isotope.css" media="screen" />
	<link rel="stylesheet" href="../js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../css/animate.css" media="screen">
	<!-- Owl Carousel Assets -->
	<link href="../js/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/styles.css" />
	<!-- Font Awesome -->
	<link href="../font/css/font-awesome.min.css" rel="stylesheet">
	
	
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
	
	<header class="header">
	  <div class="container">
		<nav class="navbar navbar-inverse" role="navigation">
			<h5 align="right" style="margin-top:5px; margin-bottom:0px;"><b>
			<a href="../logout.php">
			<img src="../Homepage/logout.png" alt="Go to logout!" height="20" width="20">
			</a>
<?php  echo $_SESSION['username'];  ?>
		</b></h5>
	
		  <div class="navbar-header">
			<button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<a class="navbar-brand scroll-top logo  animated bounceInLeft"><b><i></i>KnowMore</b></a> </div>
		  <!--/.navbar-header-->
		  <div id="main-nav" class="collapse navbar-collapse">
			<ul class="nav navbar-nav" id="mainNav">
	
			  <li><a href="index.php" class="scroll-link">Home</a></li>
			  <li class="active" id="firstLink"><a href="upload_file.php" class="scroll-link">Materials</a></li>
			  <li><a href="#aboutUs" class="scroll-link">Test</a></li>
			  <li><a href="#work" class="scroll-link">Result</a></li>
			  <li><a href="#team" class="scroll-link">Forum</a></li>
	
			</ul>
		  </div>
		  <!--/.navbar-collapse--> 
		</nav>
		<!--/.navbar--> 
	
	<table border="">
	<form action="" method="post" name="file" enctype="multipart/form-data" autocomplete="off">
	<br />
	<tr>
		<td>Select file</td>
		<td><input type="file" name="image"  /></td>
	<br />
	</tr>
	<tr>
		<td>Description</td>
		<td><input type="text" name="txtDesc" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type="submit" name="submit" value="Upload File" onClick="javascript:return validate()" /></td>
	</tr>
	</form>
	</table>
<?php
	if(isset($_POST['submit']))
	{
		$de=$_POST['txtDesc'];
		$path="images/".$_FILES['image']['name'];
		$size=$_FILES['image']['size']/1024;
		if(move_uploaded_file($_FILES['image']['tmp_name'],$path))
		{
			$sql=mysqli_query($conn,"insert into file_upload(f_name,f_path,f_description,f_size)
							VALUES('".$_FILES['image']['name']."','".$path."','".$de."','".$size."')");
		}
	}
?>
	
	<table border="">
	<tr>
		<td>Name</td>
		<td>Description</td>
		<td>Size</td>
	</tr>
<?php
	$s=mysqli_query($conn,"select * from file_upload");
	
	while($row=mysqli_fetch_array($s))
	{
?>
	<!--<td><img src="images/<?php echo $row['f_name']; ?>" width="50" height="50"></td>-->
<?php
	
		echo "<tr><td>".$row['f_name']."</td>";
		echo "<td>Description: ".$row['f_description']."</td>";
		echo "<td>Size: ".$row['f_size']."KB</td>";
	
	echo "<td>
	<a href=download.php?id=".$row['f_id']."&nm=".$row['f_name'].">Download</a><br></td>";
	}
	
?>
	</table>
	  </div>
	  <!--/.container--> 
	</header>
	
		
	</body>
	</html>
<?php
/*}
else
	header("location:../index.html");
*/?>