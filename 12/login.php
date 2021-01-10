<html >
<head>
</head>
<body>
<?php
		session_start();
		include_once("toptemplate.php");
		include_once("../connection.php");
		if($_POST['txt_loginid']==NULL)
		{
			$_SESSION['usernamenullerror']=1;
			header("location:homepage.php");
		}
		else
		{
			$uid=$_POST['txt_loginid'];
			
		}
		if($_POST['txt_password']==NULL)
		{
			$_SESSION['passwordnullerror']=1;
			header("location:homepage.php");
		}
		else
		{
			$password=$_POST['txt_password'];
		}
		if(isset($_POST['btn_login']))
		{
			if(($uid=="admin" || $uid=="ADMIN") && $password=="123")
			{
				$_SESSION['adminusername']="admin";
				header("location:admin/admin.php");
			}
			else
			{
				$query=mysql_query("select * from login where email='$uid'");
				if($data=mysql_fetch_array($query))
				{
					if($password==$data['password'])
					{
						$_SESSION['email']=$data['email'];
						$_SESSION['emailcommanusername']=$data['email'];
						$_SESSION['reg_id']=$data['reg_id'];
						$reg_id=$_SESSION['reg_id'];
						$c=0;
						$sql3=mysql_query("select * from logincount where reg_id=$reg_id order by dt_id asc");
						while($row3=mysql_fetch_array($sql3))
						{
							if($row3[3]==date('Y-m-d'))
							{
							$c=1;
							echo $row3[3];
							echo date('y-m-d');
									$query2=mysql_query("select max(logincounter) as lc from logincount where dt_id='".$row3['dt_id']."'");
									if($row2=mysql_fetch_array($query2))
									{
										$lc=$row2['lc'];
										$lc+=1;
									}
									echo $lc;
									$query3=mysql_query("update logincount set logincounter=$lc where dt_id='".$row3['dt_id']."'");
									header("location:admin/comman.php");
								
							}
						}
						if($c==0)
						{
							$query1=mysql_query("select max(dt_id) as dt_id1 from logincount");
								if($data=mysql_fetch_array($query1))
								{
									$dt_id=$data['dt_id1'];
									$dt_id+=1;
								}
								$date1=date('Y-m-d');
								$k=mysql_query("insert into logincount values ('$dt_id','$reg_id','1','$date1')");
									header("location:admin/comman.php");
						}
					}
					else
					{
						$_SESSION['loginerror']=1;
						header("location:homepage.php");
					}
				}
				else
				{
					$_SESSION['loginerror']=1;
					header("location:homepage.php");
				}
			}
		}
	?>
</body>
</html>