<?php
	session_start();
	include_once("../connection.php");
	$a=$_SESSION['reg_id'];
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
<form action="#" method="post">
	
	<?php 
		$receiverid=$a;
		$nmsg=0;
		$query=mysql_query("select * from privatemessage where receiverid = $receiverid");
		if(mysql_num_rows($query)>=1)
		{
			while($data=mysql_fetch_array($query))
			{
				if($data['counter']==1)
					$nmsg++;
			}
			echo "Unread Messages(".$nmsg.")";
			$query1=mysql_query("update privatemessage set counter = 0 where receiverid=$receiverid");
		?> <br /><br /><table class="trip"><?php
			
		$srmsg=1;
		$query=mysql_query("select * from privatemessage where receiverid = $receiverid order by messageid desc");
		while($data1=(mysql_fetch_array($query)))
		{
			
			$senderid=$data1['senderid'];
			$query2=mysql_query("select * from signup_details where reg_id=$senderid");
		while($data2=mysql_fetch_array($query2)){
			?>
				<tr>
					<td><?php echo $srmsg.") Message from ".$data2['firstname']." ".$data2['lastname']; ?>					</td>
				</tr>			
				<tr>
					<td colspan="2" align="center" class="message">
						<textarea name="txt_message" cols="50" rows="5"readonly="readonly"><?php echo $data1['message']; ?></textarea></td>
				</tr>
			<?php	
				$srmsg++;
			}
		}	
		}
		else
		{
			echo "You have no Messages !!!";
		}
		?>
	</table>
	</form>
</body>
</html>
	