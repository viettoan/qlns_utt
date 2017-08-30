<?php
include("../../config/config.php");
session_start();

   $id= $_GET['id'];
   $query="Select * from tochuctructhuoc where cosodaotaoid='$id'";
   $result=mysql_query($query);
   echo "<option value=''>---Chọn---</option>";
   while($row = mysql_fetch_array($result)){
	   
	   echo"<option value='$row[tochuctructhuocid]'
>$row[name]</option>";	   
   }
?>