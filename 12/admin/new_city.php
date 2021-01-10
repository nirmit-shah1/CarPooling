<?php
	include_once("connection.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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

</head>

<body>
<h3 align="center" >City Details</h3>
<form name="city" action="insert_city.php" method="post">
<table align="center" border="1">
   <tr>
    <td>state</td>
    <td><select name="drpstate" onchange="showCity(this.value)">
	<option value="0">--select--</option>
	<?php
	$sql=mysql_query("select * from state");
		while($row=mysql_fetch_array($sql))
	{
		echo "<option value=".$row[0].">".$row[1]."</option>";
	}
	?>
	
	</select>
	</td>
  </tr>
	<tr>
		<td>City Name</td>
		<td><div id="drpcity"></div></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="submit" /></td>
	</tr>
</table>
</form>
<br />

</body>
</html>
