<?php
  include("../../config/config.php");
  $cmnd = isset($_GET['cmnd'])?$_GET['cmnd']:'';
  if($cmnd!=''){
		  $query = "Select cmnd,hoten from lylich where cmnd ='$cmnd'";
		  $result = mysql_query($query);
	      $row = mysql_fetch_row($result);
		  $number = mysql_num_rows($result);
		  if($number>0){
			  echo "Số chứng minh thư $cmnd này đã nhập cho cán bộ $row[1]" ;
		  }

  }

?>