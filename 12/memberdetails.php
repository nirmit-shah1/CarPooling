<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Member Registration</title>
</head>

<body>
<table width="" height="" >
<form action="memberdetailsback.php" enctype="multipart/form-data" method="post">
  <tr>
	<td colspan="2" align="center">
	
  MEMBERS REGISTRATION</td></tr>
  <tr>
  <td height="59">category:</td>
  
  	<td align="center">  <select name="selcategory">
	  <option>--select--</option>
      <option value="bmw">BMW</option>
      <option value="hyundai">hyundai</option>
      </select></td></tr>
		<tr>
		<td>
		</td>
		<td>
	  		<?php
			session_start();
				if(isset($_SESSION['caerror']))
				{
					echo "<font color='red'>please enter category</font>";
					unset($_SESSION['caerror']);
					
				}
			?>
			</td>
	</tr>
   <tr>
    <td height="62">product:</td>
    <td align="center"><p>
      <select name="selproduct">
	  	<option value="--select--">--select--</option>
        <option value="i10">i10</option>
        <option value="verna">verna</option>
      </select>
	    </td>
 	</tr>
	<tr>
		<td>
		</td>
		<td>

	<?php
				if(isset($_SESSION['prerror']))
				{
					echo "<font color='red'>please enter product</font>";
					unset($_SESSION['prerror']);
					
				}
			?>
			</td>
	</tr>
   <td height="63">Number of seat available:</td>
	<td align="center"><select name="selseat" style="border-color:#999900" >
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
					echo "<font color='red'>please enter number of seat</font>";
					unset($_SESSION['seaterror']);
					
				}
			?>
			</td>
	</tr>
    <tr>
   <td height="55">Coviencence:</td>
     <td align="center"><input type="radio" name="rdbac" value="AC"/>
     AC  
       <input  type="radio" name="rdbac" value="NONAC"/>NONAC</td>
	   </tr>
  		<tr>
		<td>
		</td>
		<td>	

      <?php
				if(isset($_SESSION['acerror']))
				{
					echo "<font color='red'>please enter AC OR NON-AC</font>";
					unset($_SESSION['acerror']);
					
				}
			?>
			</td>
	</tr>
    <tr>
    <td height="59">Gender:</td>
      <td align="center"><input type="radio" name="rdogender" value="male"/>male
    <input type="radio" name="rdogender" value="female"/>female</td>
  	</tr>
  <tr>
		<td>
		</td>
		<td>
	
  <?php
				if(isset($_SESSION['generror']))
				{
					echo "<font color='red'>please enter gender </font>";
					unset($_SESSION['generror']);
					
				}
			?>
    </td>
	</tr>
	<tr>
    <td height="48">Laguage:</td>
      <td align="center"><input type="radio" name="rdolag" value="yes"/>yes
    <input type="radio" name="rdolag" value="no"/>no</td>
  </tr>
	<tr>
		<td>
		</td>
		<td>

  <?php
				if(isset($_SESSION['lagerror']))
				{
					echo "<font color='red'>please enter laguage</font>";
					unset($_SESSION['lagerror']);
					
				}
			?>
			</td>
	</tr>
  <p>
      <tr>
    <td height="61">Colour:</td>
    <td align="center"> <select name="selcolor">
	<option value="--select--">--select--</option>
      <option value="red">red</option>
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
					echo "<font color='red'>please enter colour</font>";
					unset($_SESSION['colerror']);
					
				}
			?>
	</td>
	</tr>
	<tr>
 	<td height="48">week days:</td>
    <td align="center"><select name="seldays" multiple="multiple" size="5">
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
				if(isset($_SESSION['dayserror']))
				{
					echo "<font color='red'>please enter days</font>";
					unset($_SESSION['dayserror']);
					
				}
			?>
    </p>
 
	</td>
	</tr> 
		<tr>
	<td>Upload Image of Car</td>
	<td><input type="file" name="image" />
 
	</td>
	<tr>
	<td align="center">
	<TD>
            <input type="submit" name="submit" value="REGISTER" />
       </td>
	   </tr>

</form>
</table>
</body>
</html>
