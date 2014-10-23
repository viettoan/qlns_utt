<?php
$mysql_hostname = "localhost";
$mysql_user = "Admin";
$mysql_password = "qlcbdoan";
$mysql_database = "QLCBDoan";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
mysql_query("SET NAMES 'utf8'", $bd);
?>