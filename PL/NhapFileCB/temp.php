<?php
    session_start();
	if(isset($_SESSION['temp_id']))
     // unset($_SESSION['admin_id']);
	  unset($_SESSION['hoten']);
	  unset($_SESSION['lylich_id1']);
	  $_SESSION['admin_id']=$_SESSION['temp_id'];
	header("location:Nhapmanhinh.php");
?>