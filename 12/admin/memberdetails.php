<?php
session_start();
$a=$_SESSION['reg_id']; 
require("connection.php");
include_once("toptemplate2.php");
include_once("hmenu.php");
if(isset($_SESSION['emailcommanusername']))
{
	$reg_id=$_SESSION['reg_id'];
	?>
	<!DOCTYPE html >
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Car Details</title>
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
	<?php
		$fetch=mysql_query("select * from member_signup where reg_id = $reg_id");
		if($model_detail=mysql_fetch_array($fetch))
		{
	?>
	<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+3">Car-Information</font></p><br>
	<div class="boxinfo">	
		
		<form name="reg" id="reg" action="ins_registration.php" method="post">
		<table align="center">
	
					<?php
			if(isset($_SESSION['infousuccess']))
			{
				unset($_SESSION['infousuccess']);
				echo "<tr bgcolor='#e3f4d7'><td colspan='2'><font color=black>Information Updated successfully</font></td></tr>"; 
			}
			if(isset($_SESSION['infosuccess']))
				{
					unset($_SESSION['infosuccess']);
					echo "<tr bgcolor='#e3f4d7'><td colspan='2'><font color=black>Information Inserted successfully</font></td></tr>"; 
				}
			if(isset($_SESSION['infoufail']))
			{
				unset($_SESSION['infoufail']);
				echo "<tr bgcolor='#FFbaba'><td colspan='2'><font color=black>Please correct the error listed below</font></td></tr>"; 
			}
		?>
				<tr>
				<td>Company</td>
				<td>
				<select name="selcategory" onChange="showCity(this.value)" class="text">
				<option value="0" >--SELECT--</option>
				<?php
				$sql=mysql_query("select * from company"); 
				 while($row=mysql_fetch_array($sql))
				 {?>
					<option value="<?php echo $row['coid']; ?>" 
					<?php if($row['coid'] == $model_detail['category']){ echo "selected='selected'";}?> >
					<?php echo $row['company_name'];?></option>
				<?php }
				 ?>
				 </select>
				 </td>			 
			</tr><script> showCity(<?php echo $model_detail['category'];?>); </script>
				<?php
						if(isset($_SESSION['caerror']))
						{
							
							echo "<tr><td></td><td><font color='red'>Select Company name</font></td></tr>";
							unset($_SESSION['caerror']);
						}
				?>	
			<tr>
				<td>Model
				</td>
				<td><div id="city"></div></td>
			</tr>
		<tr>
		<tr><td>Number of seat:</td>
			<td align="left" ><select name="selseat" class="text" >
			<option value="--select--">--select--</option>
		<option value="1" <?php if($model_detail['seats']==1){echo "selected='selected'";}?> >1</option>
			  <option value="2" <?php if($model_detail['seats']==2){echo "selected='selected'";}?>>2</option>
			  <option value="3"<?php if($model_detail['seats']==3){echo "selected='selected'";}?>>3</option>
			  <option value="4"<?php if($model_detail['seats']==4){echo "selected='selected'";}?>>4</option>
			  <option value="5"<?php if($model_detail['seats']==5){echo "selected='selected'";}?>>5</option>
			  <option value="6"<?php if($model_detail['seats']==6){echo "selected='selected'";}?>>6</option>
			  <option value="7"<?php if($model_detail['seats']==7){echo "selected='selected'";}?>>7</option>
			  <option value="8"<?php if($model_detail['seats']==8){echo "selected='selected'";}?>>8</option>
			</select></td>	
			</tr>
		
				<?php
						if(isset($_SESSION['seaterror']))
						{
							echo "<tr><td></td><td><font color='red'>please select number of seat</font></td></tr>";
							unset($_SESSION['seaterror']);
							
						}
				?>
					
			<tr>
		   <td>Coviencence:</td>
			 <td align="left">&nbsp; &nbsp;&nbsp;<input type="radio" <?php if($model_detail['ac']=="AC"){echo "checked='checked'";}?> name="rdbac" value="AC"/>
			 AC  &nbsp; &nbsp;
			   <input  type="radio" <?php if($model_detail['ac']=="Non-AC"){echo "checked='checked'";}?>name="rdbac" value="Non-AC"/>NON-AC</td>
			   </tr>		
			  <?php
						if(isset($_SESSION['acerror']))
						{
							echo "<tr><td></td><td><font color='red'>please select AC OR NON-AC</font></td></tr>";
							unset($_SESSION['acerror']);	
						}
					?>
		  <p>
			  <tr>
			<td>Colour:</td>
			<td align="left"> <select name="selcolor" class="text">
			<option value="--select--">--select--</option>
			  <option value="red" <?php if($model_detail['colour']=="red"){echo "selected='selected'";}?>>red</option>
			  <option value="green" <?php if($model_detail['colour']=="green"){echo "selected='selected'";}?>>green</option>
			  <option value="blue" <?php if($model_detail['colour']=="blue"){echo "selected='selected'";}?>>blue</option>
			  <option value="black" <?php if($model_detail['colour']=="black"){echo "selected='selected'";}?>>black</option>
			  <option value="white" <?php if($model_detail['colour']=="white"){echo "selected='selected'";}?>>white</option>
			  <option value="grey" <?php if($model_detail['colour']=="grey"){echo "selected='selected'";}?>>grey</option>
			  <option value="yellow" <?php if($model_detail['colour']=="yellow"){echo "selected='selected'";}?>>yellow</option>
			  <option value="silver" <?php if($model_detail['colour']=="silver"){echo "selected='selected'";}?>>silver</option>
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
			<tr>
			<td align="left">
			<TD>
					<input class="button-3" style="margin-top:-21px; margin-left:-142px;" type="submit" name="update" value="UPDATE" />
			   </td>
			   </tr>
		
		</table>
		</form>
	</div>
	<?php
	}
	else
	{?>
			<div class="boxinfo">	
			<h3 align="center">Registration</h3>
			<form name="reg" id="reg" action="ins_registration.php" method="post">
			<table align="center">
		
						<?php
				if(isset($_SESSION['infosuccess']))
				{
					unset($_SESSION['infosuccess']);
					echo "<tr bgcolor='#e3f4d7'><td colspan='2'><font color=black>Information Inserted successfully</font></td></tr>"; 
				}
				if(isset($_SESSION['infofail']))
				{
					unset($_SESSION['infofail']);
					echo "<tr bgcolor='#FFbaba'><td colspan='2'><font color=black>Please correct the error(s) listed below</font></td></tr>"; 
				}
			?>
					<tr>
					<td>Company</td>
					<td>
					<select name="selcategory" onChange="showCity(this.value)" class="text">
					<option value="0">--SELECT--</option>
					<?php
					$sql=mysql_query("select * from company"); 
					 while($row=mysql_fetch_array($sql))
					 {?>
						<option value="<?php echo $row['coid']; ?>" ><?php echo $row['company_name'];?></option>
					<?php }
					 ?>
					 </select>
					 </td>			 
				</tr>
					<?php
							if(isset($_SESSION['caerror']))
							{
								
								echo "<tr><td></td><td><font color='red'>Select Company name</font></td></tr>";
								unset($_SESSION['caerror']);
							}
					?>	
				<tr>
					<td>Model
					</td>
					<td><div id="city"></div></td>
				</tr>
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
			
					<?php
							if(isset($_SESSION['seaterror']))
							{
								echo "<tr><td></td><td><font color='red'>please select number of seat</font></td></tr>";
								unset($_SESSION['seaterror']);
								
							}
					?>
						
				<tr>
			   <td>Coviencence:</td>
				 <td align="left">&nbsp; &nbsp;&nbsp;<input type="radio" name="rdbac" value="AC"/>
				 AC  &nbsp; &nbsp;
				   <input  type="radio" checked="checked" name="rdbac" value="Non-AC"/>NONAC</td>
				   </tr>
						
			
				  <?php
							if(isset($_SESSION['acerror']))
							{
								echo "<tr><td></td><td><font color='red'>please select AC OR NON-AC</font></td></tr>";
								unset($_SESSION['acerror']);
								
							}
						?>
						
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
				<tr>
				<td align="left">
				<TD>
						<input class="button-3" style="margin-top:-21px; margin-left:-142px;" type="submit" name="submit" value="REGISTER" />
				   </td>
				   </tr>
			
			</table>
			</form>
		</div>
	<?php
	}
	?>
	</body>
<?php
}
else
	header("location:../index.html");
?>
</html>	