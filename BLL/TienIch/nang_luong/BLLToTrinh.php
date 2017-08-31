<?php
  ob_start();
  session_start();
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else { 
	require("../../../config/config.php");
  $count_can_bo = $_GET["count_can_bo"];
  // Lay mau form va tao file ly lich cho CB
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  date_default_timezone_set('Europe/London');

  /** Include PHPExcel_IOFactory */
  require_once '../../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';


  if (!file_exists("../../../file_export/nang_luong/totrinh_form.xlsx")) {
    exit("File mau to trinh luong khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../../file_export/nang_luong/totrinh_form.xlsx");
	$styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman',
        'size'  => '13'
  ));
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:Z100')->applyFromArray($styleArray);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', $objPHPExcel->getActiveSheet()->getCell('F3')->getValue()."ngày ".date("d")." tháng ".date("m")." năm ".date("Y"));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', $objPHPExcel->getActiveSheet()->getCell('A8')->getValue().date("Y"));

  // Lay du lieu tu CSDL
  $sql = "SELECT * FROM lylich WHERE id = '$lylich_id'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', $objPHPExcel->getActiveSheet()->getCell('A12')->getValue().(string)($count_can_bo)." đồng chí");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A14', $objPHPExcel->getActiveSheet()->getCell('A14')->getValue().(string)($count_can_bo)." đồng chí");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A15', $objPHPExcel->getActiveSheet()->getCell('A15')->getValue().date("Y"));

  // Tao file da xong du lieu
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save("../../../file_export/nang_luong/To trinh can bo nang luong.xlsx");
	}
  header("Location: ../../../file_export/nang_luong/To trinh can bo nang luong.xlsx");
?>
