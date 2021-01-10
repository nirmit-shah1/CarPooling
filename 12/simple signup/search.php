<html>
<body>
<form action="backsearch.php" method="post">
From<input type="text" name="txtFrom" />
<?php
if(isset($_SESSION['frmerror']))
{
echo"enter your source";
unset($_SESSION['frmerror'];
}
?>
To<input type="text" name="txtTo" />
<?php
if(isset($_SESSION['frmerror']))
{
echo"enter your source";
unset($_SESSION['frmerror'];
}
?>
<input type="submit" value="search" />
</form>
</body>
</html>