<?php
$mysql_hostname = "localhost";
//$mysql_hostname = "203.113.132.106";
//$mysql_user = "Admin";
//$mysql_password = "qlcbdoan";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "qlnscongnghegtvt";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
mysql_query("SET NAMES 'utf8'", $bd);
//$host = "http://qlns.utt.edu.vn";
$host = "http://localhost/quanlynhansu";
$menu_active = "root";
?>