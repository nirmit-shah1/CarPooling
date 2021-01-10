<html>
<title>Forget Password</title>
<?php
ob_start();
session_start();
include_once("toptemplate1.php");
include_once("hmenulogin.php");
include_once("connection.php");
?>
<body>
<p style="background-image:url(img/323a45-2880x1800.png); margin-top:-56px;"><font color="#FFFFFF" size="+2">Forget Password</font></p>
<div class="boxinfo" style=" padding-bottom: 227px; ">	
	<?php
	if(isset($_GET['btn_search']) || isset($_SESSION['check']))
	{
		if(isset($_SESSION['check']))
		{
			$txt_email=$_SESSION['check'];
		}
		else
		{
			if($_GET['txt_email']==NULL)
			{
				$_SESSION['txt_emailerror']=1;
				header("location:forgetpassword.php");
			}
			else
			{
				$txt_email=$_GET['txt_email'];
			}
		}
				$data1=mysql_query("select * from login where email='".$txt_email."'");
				
	//			echo "select * from login where email=$txt_email";
				if($query1=mysql_fetch_array($data1))	
				{
					$_SESSION['reg_id']=$query1["reg_id"];
					$_SESSION['email']=$txt_email;
					$data2=mysql_query("select * from signup_details where reg_id=$query1[reg_id]");
					if($query2=mysql_fetch_array($data2))
					{
				?>
					
						<form action="forgetsecuritycheck.php" method="post">
				<table  > 
					<tr>
					<td>
						<?php
							 $data3=mysql_query("select * from images where reg_id=$query1[reg_id]");
							 $query3=mysql_fetch_array($data3);
						?>
						<img src="images/<?php echo $query3["name"];?>" height="100" width="100"/>
					</td>
					<td >
						<?php echo $query2["firstname"]." ".$query2["lastname"]?>
						
					</td>
					</tr>
					<tr>	
						<td>Select security question</td>
						<td>
							<select name="securityquestion" class="text">
					<?php
						$query=mysql_query("select * from securityquestion");
						while($data=mysql_fetch_array($query))
						{
							if(isset($_SESSION['securityquestionvalue']))
							{
								if($_SESSION['securityquestionvalue']==$data["qid"])
								{
									echo "<option value=$data[qid] selected=selected>$data[question]</option>";					
									unset($_SESSION['securityquestionvalue']);
								}
								else
								{
									echo "<option value=$data[qid]>$data[question]</option>";					
								}
							}
							else
							{
								echo "<option value=$data[0]>$data[1]</option>";					
							}
						}
					?>
						</select>
						</td>
						</tr>
						<tr>
						<td>
							Answer
						</td>
						<td>
							<input type="text" name="answer" class="text" onKeyUp="this.value = this.value.replace(/[^a-z,A-Z]/g,'')" />
						</td>
						</tr>
						<?php
							echo "<tr><td></td><td>";
							if(isset($_SESSION['answererror']))
							{
								unset($_SESSION['answererror']);
								echo "<font color=red>enter answer</font></td></tr>";
								if(isset($_SESSION['invalidanswer']))
								{
										unset($_SESSION['invalidanswer']);
								}
							}
							else
							{	
								if(isset($_SESSION['invalidanswer']))
								{
									echo "<tr><td></td><td>";
									unset($_SESSION['invalidanswer']);
									echo "<font color=red>Invalid answer</font></td></tr>";
								}
							}	
						?>
						<tr>
						<td></td>
						<td>
							<input type="submit" name="btn_submit" value="submit"  class="button-3"/>
							</form>
	
							<form action="forgetpassword.php">
								<input style="margin-left:-565px; background-color: #FF9900;" type="submit" name="btn_submit" value="Not me" class="button-3">
							</form>
						</td>
					</tr>
				</table>
							
					<?php
	//			echo "<br>".$query2[1];
					}
				}
				else
				{
					echo "No profile found related to this Email-Id";
					?><br />
	<br />
	<img src="img/symbol-error.png" height="256" width="256">
						<form action="forgetpassword.php" >
							<input type="submit" class="button-3" name="forget" value="Forget password" />
						</form>
						<form action="../homepage.php">
							<input type="submit" style="background:#FF6600" name="login" class="button-3" value="Login" />
						</form><?php
				}
	}
	else
	{
		header("location:forgetpassword.php");
	}
	?>
</div>

</body>
</html>