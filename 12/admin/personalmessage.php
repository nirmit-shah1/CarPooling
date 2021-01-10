<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("../connection.php");
	$reg_id=$_SESSION['reg_id'];
	if(isset($_SESSION['senderid']))
		$senderid=$_SESSION['senderid'];
	if(isset($_GET['senderid']))
	{
		$senderid=$_GET['senderid'];
		$_SESSION['senderid']=$senderid;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Your Private messages</title>
<link type="text/css" rel="stylesheet" href="style1.css" />
</head>
<body>

<?php
include_once("toptemplate2.php");
include_once("hmenu.php");
?>
<form action="messageback.php" method="post">
	
	<?php 
		$receiverid=$reg_id;
		$nmsg=0;
		$query=mysql_query("select * from privatemessage where receiverid = $receiverid and senderid=$senderid");
		if(mysql_num_rows($query)>=1)
		{
			while($data=mysql_fetch_array($query))
			{
				if($data['counter']==1)
					$nmsg++;
			}
			echo "Unread Messages(".$nmsg.")";
			$query1=mysql_query("update privatemessage set counter = 0 where receiverid=$receiverid and senderid=$senderid");
		?> <br /><br />
		<table class="trip">
		<?php
			$query=mysql_query("select * from privatemessage where ((receiverid = $receiverid and senderid =$senderid) ||(receiverid = $senderid and senderid = $receiverid) ) order by messageid asc");
//			$query=mysql_query("select * from privatemessage where  order by messageid desc");
			$counter=0;
			while($data1=(mysql_fetch_array($query)))
			{
				$senderid=$data1['senderid'];
				$query2=mysql_query("select * from signup_details where reg_id=$senderid");
				while($data2=mysql_fetch_array($query2))
				{
					if($data2['reg_id']==$receiverid)
					{		
?>
						<tr>
							<td style="padding-right:70px;" align="right" class="message">
								<textarea name="txt_message" cols="30" rows="3"readonly="readonly"><?php echo $data1['message']; ?></textarea></td>
						</tr>
						
<?php
					}
					else
					{		
						$counter++;
						if($counter<2)
						{
?>
							<?php echo "<tr><td>"; echo $data2['firstname']." ".$data2['lastname']; echo "</td></tr>";}?>
								
							<tr>
								<td style="padding-left:70px;" class="message">
									<textarea name="txt_message" cols="30" rows="3"readonly="readonly"><?php echo $data1['message']; ?></textarea></td>
							</tr>
							
<?php			
					}	
				}
			}	
?>
			<tr>
					<td align="right">
						<textarea name="txt_message" cols="30" rows="3" style="margin-right:20px;"></textarea>
						<input type="image"  style="background:#0033CC; padding:10px;" src="icon.png" name="btn_send"/>
					</td>
				</tr>
<?php
		}
		else
		{
			echo "You have no Messages !!!";
		}
		?>
	</table>
	</form>
<a href="message.php" style="color:#990000; font-size:26px;"><<-Back T0 Message Page</a>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>