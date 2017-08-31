<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', TRUE);
*/
session_start();
include("../../config/config.php");
// Lay ten file
$filename = $_POST["filename"];

require_once("_NhapFile.php");
list($retCode, $data) = xuLyFile2('../../upload_capnhat/' . $filename);
$ttcb = isset($data['ttcb']) ? $data['ttcb'] : false;
if (!$ttcb){
	$hoten = "Lỗi khi đọc";
	$namsinh = "Lỗi khi đọc";
} else {
	$hoten = $ttcb['hoten'];
	$namsinh = $ttcb['namsinh'];
}

// Thong bao ket qua
if ($retCode == 0){
	$_SESSION["success"] = "<b>".$filename.":</b> Đã cập nhật thành công cán bộ ".$hoten.".";
	unlink("../../upload_capnhat/".$filename);
} else {
	// Thong bao khi xay ra it nhat 1 loi
	$_SESSION["notice"] = "<b>".$filename.":</b> Có lỗi trong hồ sơ, xin hãy kiểm tra.<br>";
	
	$_SESSION["error"] = array();
	switch ($retCode){
		case 3:
			$_SESSION["error"][] = "Tập tin excel bị lỗi hoặc không được hỗ trợ.<br>Hãy chắc chắn rằng tập tin excel này được tải từ trang chủ rồi mới chỉnh sửa, mọi thao thác chỉnh sửa trên tập tin excel khác đều không được hỗ trợ.";
			break;
		default:
			$_SESSION["error"]=$data['errors'];
			$_SESSION["notice"] .= "<p>Tải hồ sơ về để chính sửa: <a href='../../upload_capnhat/{$filename}'>Tải về</a></p>";
			break;
	}
}
header("Location: ../../PL/CapNhatFileCB/PLCapNhatCB.php");
?>