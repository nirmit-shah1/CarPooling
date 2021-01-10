<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" language="javascript">


function showsecurity_question(str)
{
if (str=="")
  {
  document.getElementById("security").innerHTML="";
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
    document.getElementById("security").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","sec_question_details.php?q="+str,true);
xmlhttp.send();
}


</script>

</head>

<body>
<?php
include_once("connection.php");
$c=new connection();
$c->connect();
if(isset($_REQUEST["submit"]))
{
$c->sql="select password from login where user_name='".$_REQUEST["txtname"]."' and sec_id=".$_REQUEST["drpquestion"]." and answer='".$_REQUEST["txtans"]."'";
//echo $c->sql;
$c->select_query($c->sql);
$row=mysql_fetch_array($c->res);
/*echo "<script>alert('Your Password Is:".$row[0]."');document.location='index.php?page=login.php'</script>";*/

$str="=http://mobi1.blogdns.com/httpmsgid/SMSSenders.aspx?UserID=uicahm&UserPass=uic999&Message='TestSMSWON'&MobileNo=9687610106&GSMID='INFORM'";
echo "$str";

//$str1=http://mobi1.blogdns.com/httpmsgid/SMSSenders.aspx?UserID=uicahm&UserPass=uic999&Message=TestSMSWON&MobileNo=9687610106&GSMID=INFORM
			header("Location:$str");
			}
?>
<form name="frm" action="" method="post">
<table width="200" border="1">
  <tr>
    <td>User Name</td>
    <td><input type="text" name="txtname" onchange="showsecurity_question(this.value)" /></td>
  </tr>
  <tr>
    <td>Security Question</td>
	<td><div id="security"></div></td>

  </tr>
  <tr>
    <td>Security Answer</td>
    <td><input type="text" name="txtans" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
</body> 
</html>
