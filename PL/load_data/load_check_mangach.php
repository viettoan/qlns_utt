<?php
   include("../../config/config.php");
    $id = $_GET['id'];
	$query = "Select * from ngach where name ='$id'";
	$result = mysql_query($query);
	$number = mysql_num_rows($result);
	if($number>0){
		
		$row = mysql_fetch_row($result);
		echo $row[1];

	}
?>