<?php 
require_once "../../../config/config.php";
if(isset($_POST['luu_email_va_gui'])) {
    $sql = "UPDATE taikhoan SET email = '" . $_POST['mail_to'] . "' WHERE id=" . $_POST['taikhoan_id'];
    if(!mysql_query($sql)) {
    	echo $sql;
    	echo "Không lưu được địa chỉ email vào hệ thống, có thể cán bộ chưa được cấp tài khoản.<br>";
    }
}

require_once('mail.php')
?>