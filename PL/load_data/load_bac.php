<?php
include("../../config/config.php");
session_start();

   $id= $_GET['id'];
   $query="Select * from bac_heso inner join ngach on ngach.id = bac_heso.ngachid where ngach.mangach='$id'";
   $result=mysql_query($query);
   echo "<option value=''>---Chọn---</option>";
   while($row = mysql_fetch_array($result)){
	   echo"<option value='$row[bac]'
>$row[bac]</option>";	   
   }
?>