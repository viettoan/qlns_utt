<?php
include("../../config/config.php");
session_start();

   $id= $_GET['id'];
   $mangach= $_GET['mangach'];
   $query="Select * from bac_heso inner join ngach on ngach.id=bac_heso.ngachid where mangach='$mangach' and bac='$id'";
   $result=mysql_query($query);

   while($row = mysql_fetch_array($result)){
	   
	   echo"<option value='$row[heso]'
>$row[heso]</option>";	   
   }
?>