<?php
/*error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
*/

function nhapTatCa(){
	$list_nhap_ok = array();
	$list_nhap_err = array();
	for ($j = 0; $j < count($_SESSION["file_list_import"]); $j++) {
		$filename = $_SESSION["file_list_import"][$j];
		require_once("_NhapFile.php");
		list($retCode, $data) = xuLyFile2('../../upload/' . $filename);
		
		$ttcb = isset($data['ttcb']) ? $data['ttcb'] : false;
		if (!$ttcb){
			$hoten = "<font color='red'>Lỗi khi đọc</font>";
			$namsinh = "Lỗi khi đọc";
			$capuy_donvi = "Lỗi khi đọc";
		} else {
			$hoten = $ttcb['hoten'];
			$namsinh = $ttcb['namsinh'];
			$capuy_donvi = $ttcb['capuy_donvi'];
		}
		$row = array();
		$row['cmnd'] = 123;
		$row['filename'] = $filename;
		$row['hoten'] = $hoten;
		$row['retcode'] = $retCode;
		$row['data'] = $data;
		
		if ($retCode == 0){
			$list_nhap_ok[] = $row;
		} else {
			$list_nhap_err[] = $row;
		}
	}

	return array($list_nhap_ok, $list_nhap_err);
}