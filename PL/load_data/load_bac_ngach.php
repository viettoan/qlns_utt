<?php
include("../../config/config.php");
session_start();

   $id= $_GET['id'];
   $query1="Select mangach from ngach where tenngach='$id'";
   $result1= mysql_query($query1);
   $row1 = mysql_fetch_row($result1);
   
   $query="Select * from bac_heso inner join ngach on bac_heso.ngachid = ngach.id where ngach.tenngach='$id'";
   $result=mysql_query($query);
  
   echo "<option value='$row1[0]'>---Chọn---</option>";
   while($row = mysql_fetch_array($result)){
	   
	   echo"<option value='$row[bac]'
>$row[bac]</option>";	   
   }
?>