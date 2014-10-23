<?php
	/*error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', TRUE);
    */
	session_start();
	include("../../config/config.php");
	// Lay ten file
	$filename = $_POST["filename"];

	// Che do ghi de file
	$overWritten = false;
	if (isset($_POST["overwrite"]) && $_POST["overwrite"] == "true"){
		$lylich_id = (int)$_POST['lylich_id'];
		$sql = "DELETE FROM `lylich` WHERE `id` = '$lylich_id'";
		$result = mysql_query($sql);
		if (!$result) die(mysql_error());
		$overWritten = true;
	}

    require_once("_NhapFile.php");
    list($retCode, $data) = xuLyFile2('../../upload/' . $filename);
    $ttcb = isset($data['ttcb']) ? $data['ttcb'] : false;
	if (!$ttcb){
		$hoten = "Lỗi khi đọc";
		$namsinh = "Lỗi khi đọc";
		$capuy_donvi = "Lỗi khi đọc";
	} else {
		$hoten = $ttcb['hoten'];
		$namsinh = $ttcb['namsinh'];
		$capuy_donvi = $ttcb['capuy_donvi'];
	}

    // Thong bao ket qua
	if ($retCode == 0){
        $_SESSION["success"] = "<b>".$filename.":</b> Đã thêm thành công cán bộ ".$hoten.".";
	    if ($overWritten){
            $_SESSION["success"] = "<b>".$filename.":</b> Đã ghi đè thành công cán bộ ".$hoten.".";
        }
	    unlink("../../upload/".$filename);
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
				break;
		}
	}
	header("Location: ../../PL/NhapFileCB/PLNhapFileCB.php");
?>