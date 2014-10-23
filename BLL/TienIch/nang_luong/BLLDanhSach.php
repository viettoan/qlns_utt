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


  if (!file_exists("../../../file_export/nang_luong/danhsach_form.xlsx")) {
    exit("File mau danh sach nang luong khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../../file_export/nang_luong/danhsach_form.xlsx");

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', $objPHPExcel->getActiveSheet()->getCell('A6')->getValue()." ".date("Y"));
  $styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman',
        'size'  => '11'
  ));

  // Lay du lieu tu CSDL
  $i = 1;
  $r = 11; // Dong dau tien

  // Thong bao han 3 nam ke tu lan nang luong cuoi
  $sql = "SELECT * FROM lylich WHERE 1";
  $result = mysql_query($sql);
  while ($row = mysql_fetch_array($result)){
    $lylich_id = $row["id"];
    $sql_qtluong = "SELECT * FROM quatrinhluong WHERE lylich_id = '$lylich_id' ORDER BY thoidiem DESC LIMIT 1";
    $result_qtluong = mysql_query($sql_qtluong);
    $row_qtluong = mysql_fetch_array($result_qtluong);

    $date1=date_create(date("Y-m-d"));
    $date2=date_create($row_qtluong["thoidiem"]);
    $diff=date_diff($date2,$date1);
    if ((int)($diff->format("%R%a"))>3*365){
  	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
  	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $row["hoten"]);
  	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $row["chucvu"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), $row["ngachcongchuc_ten"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), $row["ngachcongchuc_bacluong"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row["ngachcongchuc_heso"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($r), $row["ngachcongchuc_ten"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($r), (string)((int)($row["ngachcongchuc_bacluong"])+1));
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
	    'A11:' . 
	    'W' . (string)($r-1)
	)->applyFromArray($styleArray);

	  // Tao file da xong du lieu
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save("../../../file_export/nang_luong/Danh sach can bo nang luong.xlsx");
	}
  header("Location: ../../../file_export/nang_luong/Danh sach can bo nang luong.xlsx");
?>
