<?php
  ob_start();
  session_start();
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else { 
	require("../../config/config.php");
  $lylich_id = $_GET["lylich_id"];
  // Lay mau form va tao file ly lich cho CB
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  date_default_timezone_set('Europe/London');

  /** Include PHPExcel_IOFactory */
  require_once '../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';


  if (!file_exists("../../file_export/canbo_daotao_form.xlsx")) {
    exit("File mau danh sach dao tao khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../file_export/canbo_daotao_form.xlsx");

  // Lay du lieu tu CSDL
  $i = 1;
  $r = 8; // Dong dau tien

  $sql = "SELECT * FROM lylich WHERE id = '$lylich_id'";
  $result = mysql_query($sql);
  while ($row = mysql_fetch_array($result)){
    //$lylich_id = $row["id"];
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E5', $row["hoten"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G5', date("d-m-Y",strtotime($row["ngaysinh"])));
    if ($row["gioitinh"] == 1)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I5', "Nam");
    else
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I5', "Nữ");     
    $sql_daotao = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' ORDER BY lylich_id ASC, thoigianhoc DESC";
    $result_daotao = mysql_query($sql_daotao);
    while ($row_daotao = mysql_fetch_array($result_daotao)){      
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);	    		  
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), $row_daotao["tentruong"]);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), $row_daotao["nganhhoc"]);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.(string)($r), $row_daotao["thoigianhoc"]);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row_daotao["hinhthuchoc"]);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.(string)($r), $row_daotao["vanbang"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($r), $row_daotao["noidaotao"]);
	    $r++;
		  $i++;
    }	  
	}
  $styleArray = array(
          'borders' => array(
              'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
              )
          )
      );
	$objPHPExcel->getActiveSheet()->getStyle(
	    'A8:' . 
	    'L' . (string)($r-1)
	)->applyFromArray($styleArray);

	  // Tao file da xong du lieu
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save("../../file_export/Thong tin dao tao can bo.xlsx");
	}
  header("Location: ../../file_export/Thong tin dao tao can bo.xlsx");
?>
