<?php
include("../../config/config.php");
session_start();

   $id= $_GET['id'];
   $query="Select * from huyen where provinceid='$id'";
   $result=mysql_query($query);
   echo "<option value=''>---Chọn---</option>";
   while($row = mysql_fetch_array($result)){
	   
	   echo"<option value='$row[districtid]'
>$row[name]</option>";	   
   }
?>