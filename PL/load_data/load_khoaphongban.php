<?php
include("../../config/config.php");
session_start();

   $id= $_GET['id'];
   $query="Select * from khoaphongban where tochuctructhuocid='$id'";
   $result=mysql_query($query);
   echo "<option value=''>---Chọn---</option>";
   while($row = mysql_fetch_array($result)){
	   
	   echo"<option value='$row[khoaphongbanid]'
>$row[name]</option>";	   
   }
?>