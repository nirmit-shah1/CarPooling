<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Model Select</title>
</head>

<body>
 
<?php
	session_start();
	include_once("connection.php");
	$reg_id=$_SESSION['reg_id'];
	$fetch=mysql_query("select * from member_signup where reg_id = $reg_id");
		if($model_detail=mysql_fetch_array($fetch))
		{
			echo "<select name='drpcity' class='text'>";
			echo "<option value='0'>Select</option>";
			$a=$_GET["q"];
			$qry=mysql_query("select * from model where coid=".$a."");
			
			while($row=mysql_fetch_array($qry))
			{
				if($model_detail['product']==$row['moid'])
					echo "<option value=".$row[1]." selected='selected'>".$row[2]."</option>";
				else
					echo "<option value=".$row[1].">".$row[2]."</option>";
			}
			echo "</select>";
		}
		else
		{
			echo "<select name='drpcity' class='text'>";
			echo "<option value='0'>Select</option>";
			$a=$_GET["q"];
			$qry=mysql_query("select * from model where coid=".$a."");
			
			while($row=mysql_fetch_array($qry))
			{
			echo "<option value=".$row[1].">".$row[2]."</option>";
			}
			echo "</select>";
		}
?>
</body>
</html>
