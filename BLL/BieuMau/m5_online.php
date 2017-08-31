<?php
ob_start();
session_start();
if( !isset($_SESSION["login_user"]) ) {
	header('Location: index.php');
	exit();
}
function get_age($ngaysinh){
	$birthDate = $ngaysinh;
	//explode the date to get month, day and year
	$birthDate = explode("-", $birthDate);
	//get age from date or birthdate
	$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
		? ((date("Y") - $birthDate[0]) - 1)
		: (date("Y") - $birthDate[0]));
	return $age;
}
function vn_str_filter ($str){
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
		'd'=>'đ',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'i'=>'í|ì|ỉ|ĩ|ị',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'D'=>'Đ',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	);
	
	foreach($unicode as $nonUnicode=>$uni){
		$str = preg_replace("/($uni)/i", $nonUnicode, $str);
	}
	return $str;
}

require("../../config/config.php");

// Lay mau form va tao file ly lich cho CB
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');

/** Include PHPExcel_IOFactory */
require_once '../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';


if (!file_exists("../../file_export/bieu_mau/m5.xlsx")) {
	exit("File mau m5 khong tim thay!" . EOL);
}

// Lay file mau
$objPHPExcel = PHPExcel_IOFactory::load("../../file_export/bieu_mau/m5.xlsx");

// ====================Lay du lieu tu CSDL cho Uy vien Thuong vu Doan==================================
$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sum = 0;
$sql = "select count(*) as count from lylich LL
		join luanchuyen LC
		on LL.id = LC.canbo_id
		where LC.vitri = 'Cơ quan Đảng' and (LC.flag > 0)";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_array($result);
$count = (int)($r["count"]);
$sheet->setCellValue("B8", $count);
$sum += $count;
//var_dump($count);

$sql = "select count(*) as count from lylich LL
		join luanchuyen LC
		on LL.id = LC.canbo_id
		where LC.vitri = 'Cơ quan Chính quyền' and (LC.flag > 0)";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_array($result);
$count = (int)($r["count"]);
$sheet->setCellValue("C8", $count);
$sum += $count;
//var_dump($count);

$sql = "select count(*) as count from lylich LL
		join luanchuyen LC
		on LL.id = LC.canbo_id
		where LC.vitri = 'Cơ quan Đoàn thể' and (LC.flag > 0)";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_array($result);
$count = (int)($r["count"]);
$sheet->setCellValue("D8", $count);
$sum += $count;
//var_dump($count);

$sql = "select count(*) as count from lylich LL
		join luanchuyen LC
		on LL.id = LC.canbo_id
		where LC.vitri = 'Đại biểu HĐND' and (LC.flag > 0)";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_array($result);
$count = (int)($r["count"]);
$sheet->setCellValue("E8", $count);
$sum += $count;
//var_dump($count);

$sql = "select count(*) as count from lylich LL
		join luanchuyen LC
		on LL.id = LC.canbo_id
		where LC.vitri = 'Cơ quan khác' and (LC.flag > 0)";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_array($result);
$count = (int)($r["count"]);
$sheet->setCellValue("F8", $count);
$sum += $count;
//var_dump($count);

$sheet->setCellValue("A8", $sum);

//die('kk');
//=======================================================================================

$styleArray = array(
	'borders' => array(
	  'allborders' => array(
		  'style' => PHPExcel_Style_Border::BORDER_THIN
	  )
	)
);
// Tao file da xong du lieu
if (!isset($excel_download)){
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
	$filename = "../../file_export/bieu_mau/Mau m5.html";
	unlink($filename);
	$objWriter->save($filename);
	header("Location: $filename");
} else {
	// Tao file da xong du lieu
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$filename = "../../file_export/bieu_mau/Mau m5.xlsx";
	$objWriter->save($filename);
	header("Location: $filename");

}
