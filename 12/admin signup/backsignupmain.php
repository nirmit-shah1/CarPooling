<?php
	session_start();
	include_once("../connection.php");
	//$uname=$_POST['txtun'];
	//$stat=$_POST['drpstate'];
	//$chk=$_POST['rdbtype'];
	//$city=$_POST['drpcity'];
	
	if(isset($_POST['submit']))
	{
		if($_POST['txtfname']==NULL)
		{
			$_SESSION['namerror']=1;
			header("location:signup.php");
		}
		else
		{
			$nam=$_POST['txtfname'];
			$_SESSION['namevalue']=$nam;
		}
		if($_POST['txtlname']==NULL)
		{
			$_SESSION['lnamerror']=1;
			header("location:signup.php");
		}		
		else
		{
			$lnam=$_POST['txtlname'];
			$_SESSION['lnamevalue']=$lnam;
		}
		if($_POST['txt_phno']==NULL)
		{
			$_SESSION['phnoerror']=1;
			header("location:signup.php");
		}
		else
		{
			$phno=$_POST['txt_phno'];
			$_SESSION['phnovalue']=$phno;
		}
		if($_POST['rdb_gender']==NULL)
		{
			$_SESSION['gendererror']=1;
			header("location:signup.php");
		}
		else
		{
			$gender=$_POST['rdb_gender'];
			if($gender=="male")
			{
				$_SESSION['gendervalue']=$gender;
			}
			if($gender=="female")
			{
				$_SESSION['gendervalue']=$gender;
			}
		}	
		if($_POST['emailid']==NULL)
		{
			$_SESSION['emailerror']=1;
			header("location:signup.php");
		}
		else
		{
			$email=$_POST['emailid'];
			$_SESSION['emailvalue']=$email;
		}	
		if($_POST['password']==NULL)
		{
			$_SESSION['passerror']=1;
			header("location:signup.php");
		}
		else
		{
			$pass=$_POST['password'];
		}
		if($_POST['question']==NULL)
		{
			$_SESSION['questionerror']=1;
			header("location:signup.php");
		}
		else
		{
			$question=$_POST['question'];
			$_SESSION['questionvalue']=$question;
		}
		if($_POST['conpassword']==NULL)
		{
			$_SESSION['cpasserror']=1;
			header("location:signup.php");
		}
		else
			$cpass=$_POST['conpassword'];		
		if(!($pass==$cpass))
		{
			$_SESSION['comparepasserror']=1;
			header("location:signup.php");
		}
		if(isset($_POST['securityquestion']))
		{
			$_SESSION['securityquestionvalue']=$_POST['securityquestion'];
			$qid=$_POST['securityquestion'];
		}
		//echo $nam.$lnam.$email.$pass.$gender.$phno,$question,$_POST['securityquestion'];
		if(!($nam==NULL || $lnam==NULL || $email==NULL || $pass==NULL || $gender==NULL || $phno==NULL || $question==NULL))
		{
			if($pass==$cpass)
			{	
				unset($_SESSION['namevalue']);
				unset($_SESSION['lnamevalue']);
				unset($_SESSION['phnovalue']);
				unset($_SESSION['gendervalue']);
				unset($_SESSION['emailvalue']);
				$result=mysql_query("select max(reg_id) as cid1 from signup_details");
				if($data=mysql_fetch_array($result))
				{
					$no = $data['cid1'];
					$no=$no+1;
				}
				else
				{
					$no=1;
				}
				$date1=date('y-m-d');
				//echo $no.$nam.$lnam.$email.$phno.$gender.$chk.$no.$uname.$pass;
				$j=mysql_query("insert into signup_details values ('$no','$nam','$lnam','$phno','$gender','','$date1')");
				$i=mysql_query("insert into login values ('$no','$email','$pass')");
				$k=mysql_query("insert into usersecurityquestion values ('$no','$qid','$question')");
				if($j && $i && $k)
				{
					$_SESSION['reg_id']=$no;
					$_SESSION['email']=$email;
					$_SESSION['emailcommanusername']=$email;
					$_SESSION['notify']=1;
					header("location:../admin/admin.php");
				}
				else
				{
					$_SESSION['inserterror']=1;
					header("location:signup.php");
				}
			}
		}
	}
?>