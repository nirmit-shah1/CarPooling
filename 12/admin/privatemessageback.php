<?php
	session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("../connection.php");		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Private Message</title>
</head>

<body>
	<?php
		$reg_id=$_SESSION['reg_id'];
		$receiver=$_SESSION['memberid'];	
		if(isset($_POST['btn_message']))		
		{
			if($_POST['txt_message']==null)
			{
				$_SESSION['messageerror']=1;
				header("location:privatemessage.php");
			}
			else
			{
				if(!($receiver==$reg_id))
				{			
					$message=$_POST['txt_message'];
					$query=mysql_query("select max(messageid) as mid from privatemessage");
					if($data=mysql_fetch_array($query))
					{
						$mid=$data['mid'];
						$mid++;						
					}
					else
					{
						$mid=1;
					}
					$count=1;
					$query1=mysql_query("insert into privatemessage values('$mid','$reg_id','$receiver','$message','$count')");
					if($query1)
					{
						$_SESSION['messagesent']=1;
						header("location:privatemessage.php");
					}
					else
					{
						header("location:privatemessage.php");
						$_SESSION['messageinsenterror'];
					}
				}
				else
				{
					$_SESSION['ownmessageerror']=1;
					header("location:privatemessage.php");
				}	
			}
		}
		else
			header("location:privatemessage.php");
	?>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>