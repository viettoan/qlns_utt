<?php
  ob_start();
  session_start();
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else { 
	require("../../../config/config.php");

  // Lay mau form va tao file ly lich cho CB
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  date_default_timezone_set('Europe/London');

  /** Include PHPExcel_IOFactory */
  require_once '../../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';


  if (!file_exists("../../../file_export/bo_nhiem/danhsach_form.xlsx")) {
    exit("File mau danh sach bo nhiem khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../../file_export/bo_nhiem/danhsach_form.xlsx");

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', date("Y"));

  // Lay du lieu tu CSDL
  $i = 1;
  $r = 8; // Dong dau tien
  // Thong bao 3 thang truoc han 5 nam duoc bo nhiem lai
  $sql = "SELECT * FROM lylich WHERE DATEDIFF(curdate(),chucvudate)>(5*365-3*30)";
  $result = mysql_query($sql);
  while ($row = mysql_fetch_array($result)){
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $i);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), $row["hoten"]);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.(string)($r), date("d-m-Y",strtotime($row["ngaysinh"])));
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), "");
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), $row["lyluanchinhtri"]);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.(string)($r), $row["chucvu"]);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.(string)($r), date("d-m-Y",strtotime($row["chucvudate"])));
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), "5 năm");
	  $r++;
	  $i++;
	}
  $styleArray = array(
          'borders' => array(
              'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
              )
          )
      );
	$objPHPExcel->getActiveSheet()->getStyle(
	    'C5:' . 
	    'J' . (string)($r-1)
	)->applyFromArray($styleArray);

	  // Tao file da xong du lieu
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save("../../../file_export/bo_nhiem/Danh sach bo nhiem can bo.xlsx");
	}
  header("Location: ../../../file_export/bo_nhiem/Danh sach bo nhiem can bo.xlsx");
?>
