<?php
	include_once("connection.php");
	if(isset($_POST["submit"]))
	{
		$result=mysql_query("insert into regi (`fname`,`city_id`,`state_id`) values ('".$_POST['txtfname']."',".$_POST['drpcity'].",".$_POST['drpstate'].") ");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js"></script>


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
<?php
include_once("connection.php");
?>
<h1 align="center"></h1>
<form name="frm" action="" method="post">
<table width="200" border="1" align="center">
  <tr>
    <td>first_name</td>
    <td><input type="text" name="txtfname" /></td>
  </tr>
  
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
    <td>city</td>
    <td><div id="drpcity"></div></td>
  </tr>
  
  <tr> 
    <td colspan="2" align="center"><input type="submit" name="submit" value="submit"  /></td>
  </tr>
</table>






</form>
</body>
</html>
