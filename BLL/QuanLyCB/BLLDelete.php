<?php
	require("../../config/config.php");
	$lylich_id = (int)$_POST['lylich_id'];
	//echo $lylich_id;
	$sql = "DELETE FROM `lylich` WHERE `id` = '$lylich_id'";
	$result = mysql_query($sql);
	header("Location: ../../PL/NhapFileCB/PLDanhSachCB.php");
?>