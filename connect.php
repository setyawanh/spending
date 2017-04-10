<?php
$conn='localhost';
$user='root';
$pass='';
$db='spending_db';

mysql_connect($conn,$user,$pass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());
?>