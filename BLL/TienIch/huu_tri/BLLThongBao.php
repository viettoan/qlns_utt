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


  if (!file_exists("../../../file_export/huu_tri/thongbao_form.xlsx")) {
    exit("File mau thong bao huu tri khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../../file_export/huu_tri/thongbao_form.xlsx");
	$styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman'
  ));
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:Z100')->applyFromArray($styleArray);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', "ngày ".date("d")." tháng ".date("m")." năm ".date("Y"));

  // Lay du lieu tu CSDL
  $sql = "SELECT * FROM lylich WHERE id = '$lylich_id'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D10', $objPHPExcel->getActiveSheet()->getCell('D10')->getValue()." ".$row["hoten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D18', $objPHPExcel->getActiveSheet()->getCell('D18')->getValue()." ".$row["hoten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D19', $objPHPExcel->getActiveSheet()->getCell('D19')->getValue()." ".date("d-m-Y", strtotime($row["ngaysinh"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D20', $objPHPExcel->getActiveSheet()->getCell('D20')->getValue()." ".$row["chucvu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D21', $objPHPExcel->getActiveSheet()->getCell('D21')->getValue()." ".$row["donvicoso"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B23', $objPHPExcel->getActiveSheet()->getCell('B23')->getValue()." "."ngày ".date("d")." tháng ".date("m")." năm ".date("Y"));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B26', $objPHPExcel->getActiveSheet()->getCell('B26')->getValue()." ".$row["hoten"]);

  // Tao file da xong du lieu
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save("../../../file_export/huu_tri/Thong bao nghi huu voi can bo ".$row["cmnd"].".xlsx");
	}
  header("Location: ../../../file_export/huu_tri/Thong bao nghi huu voi can bo ".$row["cmnd"].".xlsx");
?>
