<?php
  ob_start();
  session_start();
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else { 
  require("../../../config/config.php");
  $lylich_id = $_GET["lylich_id"];

  // Lay mau form va tao file ly lich cho CB
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  date_default_timezone_set('Europe/London');

  /** Include PHPExcel_IOFactory */
  require_once '../../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';


  if (!file_exists("../../../file_export/nang_luong/quyetdinh_form.xlsx")) {
    exit("File mau quyet nang luong khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../../file_export/nang_luong/quyetdinh_form.xlsx");
  $styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman',
        'size'  => '13'
  ));
  $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:Z100')->applyFromArray($styleArray);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3',  $objPHPExcel->getActiveSheet()->getCell('F3')->getValue()."ngày ".date("d")." tháng ".date("m")." năm ".date("Y"));

  // Lay du lieu tu CSDL
  $sql = "SELECT * FROM lylich WHERE id = '$lylich_id'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C13', $objPHPExcel->getActiveSheet()->getCell('C13')->getValue().$row["hoten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B14', $objPHPExcel->getActiveSheet()->getCell('B14')->getValue().$row["ngachcongchuc_bacluong"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D14', $objPHPExcel->getActiveSheet()->getCell('D14')->getValue().$row["ngachcongchuc_heso"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F14', $objPHPExcel->getActiveSheet()->getCell('F14')->getValue().$row["ngachcongchuc_ten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B15', $objPHPExcel->getActiveSheet()->getCell('B15')->getValue().(string)((int)($row["ngachcongchuc_bacluong"])+1));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D15', $objPHPExcel->getActiveSheet()->getCell('D15')->getValue());
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F15', $objPHPExcel->getActiveSheet()->getCell('F15')->getValue().$row["ngachcongchuc_ten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B16', $objPHPExcel->getActiveSheet()->getCell('B16')->getValue().date("d-m-Y"));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C17', $objPHPExcel->getActiveSheet()->getCell('C17')->getValue().$row["donvicoso"].", ");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B18', $objPHPExcel->getActiveSheet()->getCell('B18')->getValue().$row["hoten"]);

  // Tao file da xong du lieu
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save("../../../file_export/nang_luong/Quyet dinh nang luong voi can bo ".$row["cmnd"].".xlsx");
  }
  header("Location: ../../../file_export/nang_luong/Quyet dinh nang luong voi can bo ".$row["cmnd"].".xlsx");
?>
