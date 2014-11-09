<?php
require("../../config/config.php");
if ($_REQUEST['a'] == 'loadListCB' && $_REQUEST['phongban']){
	$a = $_REQUEST['a'];
	$phongban = $_REQUEST['phongban'];
	$sql = "SELECT LL.id, LL.hoten, LC.canbo_id, LC.vitri FROM lylich as LL 
			join luanchuyen as LC 
			on LL.id = LC.canbo_id 
			where LC.vitri = '$phongban' and (LC.flag = 2 || (LC.vitri = 'Cơ quan Đoàn thể' and LC.flag = 0))";
	$result = mysql_query($sql) or die(mysql_error());
	echo "<option value='-1'>Chọn cán bộ</option>";
	while ($row = mysql_fetch_assoc($result)){
		echo "<option value='{$row['id']}'>{$row['hoten']}</option>";
	}
}
else if ($_REQUEST['a'] == 'getCB' && $_REQUEST['id']){
	$sql = "select * from lylich where id='{$_REQUEST['id']}'";
	$result = mysql_query($sql) or die(mysql_error());
	if (mysql_num_rows($result) <= 0){
		echo "<strong><i>Chưa chọn</i></strong>";
	} else {
		$row = mysql_fetch_assoc($result);
		echo "Họ tên: <strong>{$row['hoten']}</strong>, chức vụ: <strong>{$row['chucvu']}</strong>, đơn vị: <strong>{$row['donvicoso']}</strong>";
	}
}
