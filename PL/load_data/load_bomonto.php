<?php
include("../../config/config.php");
session_start();

   $id= $_GET['id'];
   $query="Select * from bomonto where khoaphongbanid='$id'";
   $result=mysql_query($query);
   echo "<option value=''>---Chọn---</option>";
   while($row = mysql_fetch_array($result)){
	   
	   echo"<option value='$row[bomontoid]'
>$row[name]</option>";	   
   }
?>