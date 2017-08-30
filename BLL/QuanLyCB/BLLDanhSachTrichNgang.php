<?php
  ob_start();
  session_start();
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else { 
	require("../../config/config.php");

  // Lay mau form va tao file ly lich cho CB
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  date_default_timezone_set('Europe/London');

  /** Include PHPExcel_IOFactory */
  require_once '../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';


  if (!file_exists("../../file_export/danhsach_trichngang_form.xlsx")) {
    exit("File mau danh sach trich ngang khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../file_export/danhsach_trichngang_form.xlsx");

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', date("Y"));

  // Lay du lieu tu CSDL
  $i = 1;
  $r = 10; // Dong dau tien

  $sql = "SELECT * FROM lylich WHERE 1";
  $result = mysql_query($sql);
  while ($row = mysql_fetch_array($result)){
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $row["hoten"]);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $row["quequan_xa"]." - ".$row["quequan_huyen"]." - ".$row["quequan_tinh"]);
	  if ($row["gioitinh"] == 1)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), date("d-m-Y",strtotime($row["ngaysinh"])));
    else
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.(string)($r), date("d-m-Y",strtotime($row["ngaysinh"])));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.(string)($r), $row["dantoc"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row["lyluanchinhtri"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.(string)($r), date("d-m-Y",strtotime($row["doantncs_ngayvao"])));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($r), date("d-m-Y",strtotime($row["dangcongsan_ngayvao"])));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.(string)($r), $row["chucvu"]." - ".$row["donvicoso"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.(string)($r), $row["ngachcongchuc_ten"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.(string)($r), $row["ngachcongchuc_bacluong"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($r), $row["ngachcongchuc_heso"]);

    $lylich_id = $row["id"];
    $sql_thidua = "SELECT * FROM thidua WHERE lylich_id = '$lylich_id' ORDER BY nam ASC";
    $col = array("U","V","W","X","Y","Z");
    $count_col = 0;
    $result_thidua = mysql_query($sql_thidua);
    while ($row_thidua = mysql_fetch_array($result_thidua)){
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue((string)($col[$count_col]).(string)($r), date("Y",strtotime($row_thidua["nam"]))." - ".$row_thidua["danhhieu"]);
      $count_col++;
    }
	  
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
	    'A10:' . 
	    'Z' . (string)($r-1)
	)->applyFromArray($styleArray);

	  // Tao file da xong du lieu
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save("../../file_export/Danh sach trich ngang can bo.xlsx");
	}
  header("Location: ../../file_export/Danh sach trich ngang can bo.xlsx");
?>
