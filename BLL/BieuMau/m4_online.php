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
	switch ($chucvu){
		case "Bí thư":
			//var_dump("Bí thư $chucvu");
			$line = 11;
			break;
		case "Phó Bí thư":
			//var_dump($chucvu);
			$line = 12;
			break;
		case "Uỷ viên BTV":
			//var_dump($chucvu);
			$line = 13;
			break;
		case "Uỷ viên BCH":
			//var_dump($chucvu);
			$line = 14;
			break;
		default:
			die ("Unknow chucvu");
	}
	$col = false;
	var_dump($ngaysinh);var_dump(get_age($ngaysinh));
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
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
$filename = "../../file_export/bieu_mau/Mau m4.html";
unlink($filename);
$objWriter->save($filename);
header("Location: $filename");
