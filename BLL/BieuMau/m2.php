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


  if (!file_exists("../../file_export/bieu_mau/m2.xlsx")) {
    exit("File mau m2 khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../file_export/bieu_mau/m2.xlsx");

  // ====================Lay du lieu tu CSDL cho BI THU==================================
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A10', "1");

  $sql = "SELECT * FROM `lylich` WHERE `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $tongso = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B10', (string)($tongso));

  $sql = "SELECT round(TIMESTAMPDIFF(YEAR, max(ngaysinh), NOW())) as `min` FROM `lylich` WHERE `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tretuoinhat = (string)($r["min"]);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D10', $tretuoinhat);

  $sql = "SELECT round(TIMESTAMPDIFF(YEAR, min(ngaysinh), NOW())) as `max` FROM `lylich` WHERE `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $nhieutuoinhat = (string)($r["max"]);
  // echo $r["max"];
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E10', $nhieutuoinhat);

  $sql = "SELECT round(avg(TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()))) as `average` FROM `lylich` WHERE `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tuoitrungbinh = (string)($r["average"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F10', $tuoitrungbinh);

  $sql = "SELECT count(*) as `tren35` FROM `lylich` WHERE (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) > 35) AND `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tuoitren35 = (string)($r["tren35"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G10', $tuoitren35);

  $sql = "SELECT count(*) as `dantoc` FROM `lylich` WHERE `dantoc` != 'kinh' AND `chucvu` = 'Bí thư' GROUP BY `dantoc`";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $dantrc = (string)($r["dantoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H10', $dantrc);

  $sql = "SELECT count(*) as `tongiao` FROM `lylich` WHERE `chucvu` = 'Bí thư' GROUP BY `tongiao`";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tongiao = (string)($r["tongiao"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I10', $tongiao);

  $sql = "SELECT count(*) as `nu` FROM `lylich` WHERE `gioitinh` = 0 AND `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $nu = (string)($r["nu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J10', $nu);

  $sql = "SELECT count(*) as `caocap` FROM `lylich` WHERE `lyluanchinhtri` = 'Cao cấp' AND `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $caocap = (string)($r["caocap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M10', $caocap);

  $sql = "SELECT count(*) as `trungcap` FROM `lylich` WHERE `lyluanchinhtri` = 'Trung cấp' AND `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $trungcap = (string)($r["trungcap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N10', $trungcap);

  $sql = "SELECT count(*) as `ngoaingu_a` FROM `lylich` WHERE `ngoaingu_trinhdo` = '%A%' AND `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_a = (string)($r["ngoaingu_a"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O10', $ngoaingu_a);

  $sql = "SELECT count(*) as `ngoaingu_b` FROM `lylich` WHERE `ngoaingu_trinhdo` = '%B%' AND `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_b = (string)($r["ngoaingu_b"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P10', $ngoaingu_b);

  $sql = "SELECT count(*) as `ngoaingu_dh` FROM `lylich` WHERE `ngoaingu_trinhdo` != '%A%' AND `ngoaingu_trinhdo` != '%B%' AND `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_dh = (string)($r["ngoaingu_dh"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q10', $ngoaingu_dh);
//=======================================================================================

  // ====================Lay du lieu tu CSDL cho PHO BI THU==================================
  $sql = "SELECT * FROM `lylich` WHERE `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $tongso = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R10', (string)($tongso));

  $sql = "SELECT round(TIMESTAMPDIFF(YEAR, max(ngaysinh), NOW())) as `min` FROM `lylich` WHERE `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tretuoinhat = (string)($r["min"]);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T10', $tretuoinhat);

  $sql = "SELECT round(TIMESTAMPDIFF(YEAR, min(ngaysinh), NOW())) as `max` FROM `lylich` WHERE `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $nhieutuoinhat = (string)($r["max"]);
  // echo $r["max"];
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U10', $nhieutuoinhat);

  $sql = "SELECT round(avg(TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()))) as `average` FROM `lylich` WHERE `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tuoitrungbinh = (string)($r["average"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V10', $tuoitrungbinh);

  $sql = "SELECT count(*) as `dantoc` FROM `lylich` WHERE `dantoc` != 'kinh' AND `chucvu` = 'Phó bí thư' GROUP BY `dantoc`";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $dantrc = (string)($r["dantoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W10', $dantrc);

  $sql = "SELECT count(*) as `tongiao` FROM `lylich` WHERE `chucvu` = 'Phó bí thư' GROUP BY `tongiao`";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tongiao = (string)($r["tongiao"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X10', $tongiao);

  $sql = "SELECT count(*) as `nu` FROM `lylich` WHERE `gioitinh` = 0 AND `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $nu = (string)($r["nu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y10', $nu);

  $sql = "SELECT count(*) as `caocap` FROM `lylich` WHERE `lyluanchinhtri` = 'Cao cấp' AND `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $caocap = (string)($r["caocap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB10', $caocap);

  $sql = "SELECT count(*) as `trungcap` FROM `lylich` WHERE `lyluanchinhtri` = 'Trung cấp' AND `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $trungcap = (string)($r["trungcap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC10', $trungcap);

  $sql = "SELECT count(*) as `ngoaingu_a` FROM `lylich` WHERE `ngoaingu_trinhdo` = '%A%' AND `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_a = (string)($r["ngoaingu_a"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD10', $ngoaingu_a);

  $sql = "SELECT count(*) as `ngoaingu_b` FROM `lylich` WHERE `ngoaingu_trinhdo` = '%B%' AND `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_b = (string)($r["ngoaingu_b"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE10', $ngoaingu_b);

  $sql = "SELECT count(*) as `ngoaingu_dh` FROM `lylich` WHERE `ngoaingu_trinhdo` != '%A%' AND `ngoaingu_trinhdo` != '%B%' AND `chucvu` = 'Phó bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_dh = (string)($r["ngoaingu_dh"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF10', $ngoaingu_dh);
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
	  $objWriter->save("../../file_export/bieu_mau/Mau m2.xlsx");
	}
  header("Location: ../../file_export/bieu_mau/Mau m2.xlsx");
?>
