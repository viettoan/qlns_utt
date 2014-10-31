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


if (!file_exists("../../file_export/bieu_mau/m4.xlsx")) {
	exit("File mau m3 khong tim thay!" . EOL);
}

// Lay file mau
$objPHPExcel = PHPExcel_IOFactory::load("../../file_export/bieu_mau/m4.xlsx");

// ====================Lay du lieu tu CSDL cho Uy vien Thuong vu Doan==================================
$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sum = 0;
$sql = "SELECT count(*) as `count` FROM `lylich` WHERE `chucvu` = 'Bí thư'";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_array($result);
$count = (int)($r["count"]);
$sheet->setCellValue("C11", $count);
$sum += $count;

$sql = "SELECT count(*) as `count` FROM `lylich` WHERE `chucvu` = 'Phó Bí thư'";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_array($result);
$count = (int)($r["count"]);
$sheet->setCellValue("C12", $count);
$sum += $count;

$sql = "SELECT count(*) as `count` FROM `lylich` WHERE `chucvu` = 'Uỷ viên BTV'";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_array($result);
$count = (int)($r["count"]);
$sheet->setCellValue("C13", $count);
$sum += $count;

$sql = "SELECT count(*) as `count` FROM `lylich` WHERE `chucvu` = 'Uỷ viên BCH'";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_array($result);
$count = (int)($r["count"]);
$sheet->setCellValue("C14", $count);
$sum += $count;

$sheet->setCellValue("C15", $sum);

//=======================================================================================
$sql = "SELECT ngaysinh, chucvu FROM `lylich`";
$result = mysql_query($sql) or die(mysql_error());
while ($r = mysql_fetch_array($result)){
	$ngaysinh = $r["ngaysinh"];
	$chucvu = $r['chucvu'];
	$line = false;
	$chucvu = trim(mb_strtolower(vn_str_filter($chucvu)));
	var_dump($chucvu);
	switch ($chucvu){
		case "bi thu":
			//var_dump("Bí thư $chucvu");
			$line = 11;
			break;
		case "pho bi thu":
			//var_dump($chucvu);
			$line = 12;
			break;
		case "uy vien ban thuong vu":
		case "uy vien btv":
			//var_dump($chucvu);
			$line = 13;
			break;
		case "uy vien ban chap hanh":
		case "uy vien bch":
			//var_dump($chucvu);
			$line = 14;
			break;
		default:
			break;
			//die ("Unknow chucvu");
	}
	var_dump($line);
	if ($line){
		$col = false;
		//var_dump($ngaysinh);var_dump(get_age($ngaysinh));
		$age = get_age($ngaysinh);
		if ($age < 25) $col = "D";
		else if ($age > 42) $col = "W";
		else {
			$tmp = $age - 25;
			$col = "E";
			//var_dump($tmp);
			for ($i = 0; $i < $tmp; $i++)
				$col++;
			//var_dump($col);
		}
		$v = $sheet->getCell("$col$line")->getValue();
		if ($v) $v++;
		else $v = 1;
		$sheet->setCellValue("$col$line", $v);
	}
}
//var_dump(date('Y-m-d'));die('kk');

//=======================================================================================

$styleArray = array(
	'borders' => array(
	  'allborders' => array(
		  'style' => PHPExcel_Style_Border::BORDER_THIN
	  )
	)
);
// Tao file da xong du lieu
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("../../file_export/bieu_mau/Mau m4.xlsx");
header("Location: ../../file_export/bieu_mau/Mau m4.xlsx");

