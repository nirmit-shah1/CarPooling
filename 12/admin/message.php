<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{
	include_once("../connection.php");
	$reg_id=$_SESSION['reg_id'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Your Private messages</title>
<link type="text/css" rel="stylesheet" href="style1.css" />
</head>
<body>
<?php
include_once("toptemplate2.php");
include_once("hmenu.php");
?>
<p style="background-image:url(img/323a45-2880x1800.png)"><font color="#FFFFFF" size="+2">Your Messages</font></p>

<div class="boxinfo">
<form action="" method="post">
	
	<?php 
		$receiverid=$reg_id;
		$nmsg=0;
		$query=mysql_query("select * from privatemessage where receiverid = $receiverid");
		if(mysql_num_rows($query)>=1)
		{
			
			?> 
			<table>
			<?php
			$query=mysql_query("select senderid from privatemessage where receiverid = $receiverid group by senderid asc");
			while($data1=(mysql_fetch_array($query)))
			{
				$nmsg=0;
				$senderid=$data1['senderid'];//IT WILL GIVE REG_ID OF SENDEER USER
				$query2=mysql_query("select * from signup_details where reg_id=$senderid");
				while($data2=mysql_fetch_array($query2))
				{
				$query3=mysql_query("select * from privatemessage where senderid=$senderid and receiverid = $receiverid");
				while($data3=mysql_fetch_array($query3))
				{	
					if($data3['counter']==1)
						$nmsg++;
				}		
				?>
					<tr>
						<td>
						<?php 
						 	echo $data2['firstname']." ".$data2['lastname']."($nmsg)</a>";
							echo "&nbsp";
							echo "<a href=personalmessage.php?senderid=".$data1['senderid']."><br> 			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMessages-></a>";
							echo "&nbsp";
		echo "<a style='color:#3366FF' href=passangerprofileinfo.php?senderid=".$data1['senderid']."><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspView Details-></a>";
						?>
						</td>
					</tr>	
					<?php
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
	</div>
</body>
</html>
<?php
}
else
	header("location:../index.html");
?>