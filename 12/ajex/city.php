<?php
$conn=mysqli_connect("localhost","root","","project");
	
/*	$c=$_POST['txtcity'];
	$s=$_POST['cmbstate'];
	if($c == NULL)
	{
		echo "enter City";
	}
	else if(empty($s))
	{
		echo "enter State";
	}*/
	 if(isset($_POST['submit']))
	{
		$a=mysqli_query
		($conn,"insert into city (`state_id`,`city_name`) values('".$_POST['cmbstate']."','".$_POST['txtcity']."')");	
		echo "<script>alert('Data Inserted');header.location='city.php'</script>";
	} 	
?>
<html>
<head>
<title>City</title>
<script language="javascript" type="text/javascript">
function showCity(str)
{
if (str=="")
  {
  document.getElementById("drpcity").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("drpcity").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","city_detail.php?q="+str,true);
xmlhttp.send();
}
</script>
<script language="javascript" type="text/javascript">
function validate()
{
	var isvalid=true;;
	if(document.City.txtFirst.value == "")
	{
		alert("enter First name");
		isvalid = false;
	}
	else if(document.City.txtLast.value == "")
	{
		alert("enter last name");
		isvalid = false;
	}
	else if(document.City.txtcity.value == "")
	{
		alert("enter city name");
		isvalid = false;
	}
	else if(document.City.cmbstate.value == "")
	{
		alert("enter state name");
		isvalid = false;
	}
return isvalid;
}
</script>
</head>
<body>
<h2>City Details</h2>
<form action="#" method="post" name="City">
<table border="5">
<tr>
	<td>First Name</td>	<td><input type="text" name="txtFirst" ></td>
<tr>
	<td>Last Name</td>	<td><input type="text" name="txtLast" ></td>
</tr>
<tr>	
	<td>State</td>
	<td><select name="cmbstate" onChange="showCity(this.value)">
		<option value="">--<Select--</option>
		<?php $sql2=mysqli_query($conn,"select * from state");
		while($row=mysqli_fetch_array($sql2))
		{
		?>
		<option value="<?php echo $row['state_id'] ?>"><?php echo $row['state_name']; ?></option>
		<?php
		}
		 ?>
		</select>
	</td>
</tr>
<tr>
	<td>City</td>
	<td><div id="drpcity"></div>
	</td>
</tr>
<tr>	
	<td colspan="2" align="center">
		<input type="submit" name="submit" value="SAVE" onClick="javascript:return validate()" >
	</td>	
</tr>
</table>		
</form>
</body>
</html>
<?php 
$s=mysqli_query($conn,"select * from city");

		while($row=mysqli_fetch_array($s))
		{
			echo $row['state_id']."&nbsp;";
			echo $row['city_name']."<br>";
		}
?>