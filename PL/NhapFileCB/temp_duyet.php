<?php
        include("../../config/config.php");
	  $query = "Update lylich set trangthai='1' where id='$_GET[duyet]'";
	  $result = mysql_query($query);
	  if($result)
	    echo"<script>alert('Duyet thanh cong !');window.location.href='PLDanhSachCB.php'</script>";
?>