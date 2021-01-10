<?php
	session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("connection.php");
	include_once("toptemplate2.php");
	include_once("hmenu.php");
	$a=$_SESSION['reg_id'];
?><p style="background-image:url(img/323a45-2880x1800.png)" ><font color="#FFFFFF" size="+3">Update Your Profile Picture</font></p>	
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
	<input type="submit" class="button-3" name="submit" value="Upload File" onClick="javascript:return validate()" />
	
</td>
</tr>

</form>
</table>
<a href="uploadfile.php"><< Go Back</a>
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
					$qry="update  images  set name='".$_FILES['pimage']['name']."' WHERE reg_id=".$a." ";
                $result=mysql_query($qry);
					if($result)
					{
						echo "<br/>Image uploaded.";
					}
					else
					{
						echo "<br/>Image not uploaded.";
					}
				}
				}
				}
}
else
	header("location:../index.html");