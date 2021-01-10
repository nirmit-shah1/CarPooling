<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
class connection
{
var $con;
var $db;
var $sql;
var $res;
function connect()
{
$this->con=mysql_connect("localhost","root","");
$this->db=mysql_select_db("car_sales",$this->con);
}
function select_query($str)
{
$this->sql=$str;
$this->res=mysql_query($this->sql);
}
function insert_update_delete($str)
{
$this->sql=$str;
mysql_query($this->sql);

}
}
?>
</body>
</html>
