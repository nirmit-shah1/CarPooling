<?php
session_start();
$a=$_SESSION['reg_id']; 
require("connection.php");
include_once("toptemplate3.php");
include_once("hmenu.php");
 ?>

<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Online shopping</title>
<script type="text/javascript" language="javascript">
function showCity(str)
{
if (str=="")
  {
  document.getElementById("city").innerHTML="";
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
    document.getElementById("city").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","city_details.php?q="+str,true);
xmlhttp.send();
}
	

</script>
</head>

<body>
<h3 align="center">Registration</h3>
<form name="reg" id="reg" action="ins_registration.php" method="post">
<table align="center">
<!--/*
	<tr>
		<td>Name</td>
		<td><input type="text" id="pname" name="pname" autocomplete="off"  /></td>
	</tr>
	<tr>
		<td>Address</td>
		<td><textarea name="address" rows="4" cols="10"></textarea></td>
		
	</tr>
	<tr>
		<td>Email Id</td>
		<td><input type="text" name="email" autocomplete="off"   /></td>
	</tr>
	<tr>
		<td>Phone No</td>
		<td><input type="text" name="phone" autocomplete="off"   /></td>
	</tr>
*/-->	<tr>
		<td>Company</td>
		<td>
		<select name="selcategory" onChange="showCity(this.value)">
		<option value="0">--SELECT--</option>
		<?php
		$sql=mysql_query("select * from company"); 
		 while($row=mysql_fetch_array($sql))
		 {?>
		 	<option value="<?php echo $row['coid']; ?>"><?php echo $row['company_name'];?></option>
		<?php }
		 ?>
		 </select>
		 </td>
		 
	</tr>
	<tr>
		<td>Model
		</td>
		<td><div id="city"></div></td>
	</tr>
	<!--/*/*<tr>
		<td align="center" colspan="2"><input type="submit" name="submit" value="Save" /></td>
	</tr>*/*/-->
<tr>
<tr><td>Number of seat:</td>
	<td align="left" ><select name="selseat" class="text" >
	<option value="--select--">--select--</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
    </select></td>	
	</tr>
	<tr>
		<td>
		</td>
		<td>

		<?php
				if(isset($_SESSION['seaterror']))
				{
					echo "<font color='red'>please select number of seat</font>";
					unset($_SESSION['seaterror']);
					
				}
			?>
			</td>
	</tr>
    <tr>
   <td>Coviencence:</td>
     <td align="left">&nbsp; &nbsp;&nbsp;<input type="radio" name="rdbac" value="AC"/>
     AC  &nbsp; &nbsp;
       <input  type="radio" checked="checked" name="rdbac" value="Non-AC"/>NONAC</td>
	   </tr>
  		<tr>
		<td>
		</td>
		<td>	

      <?php
				if(isset($_SESSION['acerror']))
				{
					echo "<font color='red'>please select AC OR NON-AC</font>";
					unset($_SESSION['acerror']);
					
				}
			?>
			</td>
	</tr>
    <!--<tr>
    <td height="59">Gender:</td>
      <td align="left"><input type="radio" name="rdogender" value="male"/>male
    <input type="radio" name="rdogender" value="female"/>female</td>
  	</tr>
  <tr>
		<td>
		</td>
		<td>
	
  <?php
				/*if(isset($_SESSION['generror']))
				{
					echo "<font color='red'>please select gender </font>";
					unset($_SESSION['generror']);
					
				}
			*/?>
    </td>
	</tr>-->
<!--	<tr>
    <td height="48">Laguage:</td>
      <td align="left"><input type="radio" name="rdolag" value="yes"/>yes
    <input type="radio" name="rdolag" value="no"/>no</td>
  </tr>
	<tr>
		<td>
		</td>
		<td>

  <?php
			/*	if(isset($_SESSION['lagerror']))
				{
					echo "<font color='red'>please select laguage</font>";
					unset($_SESSION['lagerror']);
					
				}
			*/?>
			</td>
	</tr>-->
  <p>
      <tr>
    <td>Colour:</td>
    <td align="left"> <select name="selcolor" class="text">
	<option value="--select--">--select--</option>
      <option value="red">red</option>
	  <option value="green">green</option>
	  <option value="blue">blue</option>
	  <option value="black">black</option>
	  <option value="white">white</option>
	  <option value="grey">grey</option>
	  <option value="yellow">yellow</option>
	  <option value="silver">silver</option>
    </select>
	</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
        
  <?php
				if(isset($_SESSION['colerror']))
				{
					echo "<font color='red'>please select colour</font>";
					unset($_SESSION['colerror']);
					
				}
			?>
	</td>
	</tr>
	<!--<tr>
 	<td height="48">week days:</td>
    <td align="left"><select name="seldays" multiple="multiple" size="5">
	<option value="--select--">--select--</option>
      <option name="monday">Monday</option>
      <option name="tuesday">tuesday</option>
      <option name="wednesday">wednesday</option>
      <option name="thursday">thursday</option>
      <option name="friday">friday</option>
      <option name="saturday">saturday</option>
      <option name="sunday">sunday</option>
      </select></td>
  </tr>
  	<tr>
		<td>
		</td>
		<td>

  <?php
			/*	if(isset($_SESSION['dayserror']))
				{
					echo "<font color='red'>please select days</font>";
					unset($_SESSION['dayserror']);
					
				}
			*/?>
    </p>
 
	</td>
	</tr> 
	--><!--	<tr>
	<td>Upload Image of Car</td>
	<td><input type="file" name="image" />
 
	</td>-->
	<tr>
	<td align="left">
	<TD>
            <input class="button-3" style="margin-top:-21px; margin-left:-142px;" type="submit" name="submit" value="REGISTER" />
       </td>
	   </tr>

</table>
</form>
</body>
</html>

