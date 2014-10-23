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


  if (!file_exists("../../../file_export/huu_tri/danhsach_form.xlsx")) {
    exit("File mau danh sach huu tri khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../../file_export/huu_tri/danhsach_form.xlsx");

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', date("Y"));

  // Lay du lieu tu CSDL
  $i = 1;
  $r = 7; // Dong dau tien

  // Thong bao truoc 6 thang han 60 tuoi NAM hoac 55 tuoi NU
  $sql = "SELECT * FROM lylich WHERE (gioitinh = 1 AND DATEDIFF(curdate(),ngaysinh)>(60*365-6*30)) OR (gioitinh = 0 AND DATEDIFF(curdate(),ngaysinh)>(55*365-6*30))";
  $result = mysql_query($sql);
  while ($row = mysql_fetch_array($result)){
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $row["hoten"]);
	  if ($row["gioitinh"] == 1)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), date("d-m-Y",strtotime($row["ngaysinh"])));
    else
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), date("d-m-Y",strtotime($row["ngaysinh"])));
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.(string)($r), $row["chucvu"]." - ".$row["donvicoso"]);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), $row["ngachcongchuc_ten"]." - ".$row["luong"]);
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
	    'A7:' . 
	    'J' . (string)($r-1)
	)->applyFromArray($styleArray);

	  // Tao file da xong du lieu
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save("../../../file_export/huu_tri/Danh sach can bo sap nghi huu.xlsx");
	}
  header("Location: ../../../file_export/huu_tri/Danh sach can bo sap nghi huu.xlsx");
?>
