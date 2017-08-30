<?php
include("../../config/config.php");
session_start();

   $id= $_GET['id'];
   $query="Select * from ngach where name='$id'";
   $result=mysql_query($query);

   while($row = mysql_fetch_array($result)){
	    echo'<option value="">chọn</option>';
	   echo"<option value='$row[ngachid]'
>$row[ngachid]</option>";	   
   }
?>