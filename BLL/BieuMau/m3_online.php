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


  if (!file_exists("../../file_export/bieu_mau/m3.xlsx")) {
    exit("File mau m3 khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../file_export/bieu_mau/m3.xlsx");

  // ====================Lay du lieu tu CSDL cho Uy vien Thuong vu Doan==================================
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', "1");

  $sql = "SELECT * FROM `lylich` WHERE `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $tongso = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', (string)($tongso));

  $sql = "SELECT round(TIMESTAMPDIFF(YEAR, max(ngaysinh), NOW())) as `min` FROM `lylich` WHERE `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tretuoinhat = (string)($r["min"]);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B11', $tretuoinhat);

    $sql = "SELECT round(TIMESTAMPDIFF(YEAR, min(ngaysinh), NOW())) as `max` FROM `lylich` WHERE `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $nhieutuoinhat = (string)($r["max"]);
  // echo $r["max"];
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C11', $nhieutuoinhat);

  $sql = "SELECT round(avg(TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()))) as `average` FROM `lylich` WHERE `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tuoitrungbinh = (string)($r["average"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D11', $tuoitrungbinh);
/*
  $sql = "SELECT count(*) as `tren35` FROM `lylich` WHERE (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) > 35) AND `chucvu` = 'Bí thư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tuoitren35 = (string)($r["tren35"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G10', $tuoitren35);
*/
  $sql = "SELECT count(*) as `dantoc` FROM `lylich` WHERE `dantoc` != 'kinh' AND `chucvu` = 'Ủy viên Thường vụ' GROUP BY `dantoc`";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  if (mysql_num_rows($result) == 0) $dantrc = "0"; else $dantrc = (string)($r["dantoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E11', $dantrc);

  $sql = "SELECT count(*) as `tongiao` FROM `lylich` WHERE `chucvu` = 'Ủy viên Thường vụ' GROUP BY `tongiao`";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tongiao = (string)($r["tongiao"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F11', $tongiao);

  $sql = "SELECT count(*) as `nu` FROM `lylich` WHERE `gioitinh` = 0 AND `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $nu = (string)($r["nu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G11', $nu);

  $sql = "SELECT count(*) as `caocap` FROM `lylich` WHERE `lyluanchinhtri` = 'Cao cấp' AND `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $caocap = (string)($r["caocap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J11', $caocap);

  $sql = "SELECT count(*) as `trungcap` FROM `lylich` WHERE `lyluanchinhtri` = 'Trung cấp' AND `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $trungcap = (string)($r["trungcap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K11', $trungcap);

  $sql = "SELECT count(*) as `ngoaingu_a` FROM `lylich` WHERE `ngoaingu_trinhdo` = '%A%' AND `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_a = (string)($r["ngoaingu_a"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L11', $ngoaingu_a);

  $sql = "SELECT count(*) as `ngoaingu_b` FROM `lylich` WHERE `ngoaingu_trinhdo` = '%B%' AND `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_b = (string)($r["ngoaingu_b"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M11', $ngoaingu_b);

  $sql = "SELECT count(*) as `ngoaingu_dh` FROM `lylich` WHERE `ngoaingu_trinhdo` != '%A%' AND `ngoaingu_trinhdo` != '%B%' AND `chucvu` = 'Ủy viên Thường vụ'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_dh = (string)($r["ngoaingu_dh"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N11', $ngoaingu_dh);
//=======================================================================================

  // ====================Lay du lieu tu CSDL cho Uy vien ban Chap hanh Doan==================================
  $sql = "SELECT * FROM `lylich` WHERE `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $tongso = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O11', (string)($tongso));

  $sql = "SELECT round(TIMESTAMPDIFF(YEAR, max(ngaysinh), NOW())) as `min` FROM `lylich` WHERE `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tretuoinhat = (string)($r["min"]);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P11', $tretuoinhat);

  $sql = "SELECT round(TIMESTAMPDIFF(YEAR, min(ngaysinh), NOW())) as `max` FROM `lylich` WHERE `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $nhieutuoinhat = (string)($r["max"]);
  // echo $r["max"];
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q11', $nhieutuoinhat);

  $sql = "SELECT round(avg(TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()))) as `average` FROM `lylich` WHERE `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tuoitrungbinh = (string)($r["average"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R11', $tuoitrungbinh);

  $sql = "SELECT count(*) as `dantoc` FROM `lylich` WHERE `dantoc` != 'kinh' AND `chucvu` = 'Ủy viên Ban Chấp Hành' GROUP BY `dantoc`";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  if (mysql_num_rows($result) == 0) $dantrc = "0"; else $dantrc = (string)($r["dantoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S11', $dantrc);

  $sql = "SELECT count(*) as `tongiao` FROM `lylich` WHERE `chucvu` = 'Ủy viên Ban Chấp Hành' GROUP BY `tongiao`";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tongiao = (string)($r["tongiao"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T11', $tongiao);

  $sql = "SELECT count(*) as `nu` FROM `lylich` WHERE `gioitinh` = 0 AND `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $nu = (string)($r["nu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U11', $nu);

  $sql = "SELECT count(*) as `caocap` FROM `lylich` WHERE `lyluanchinhtri` = 'Cao cấp' AND `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $caocap = (string)($r["caocap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X11', $caocap);

  $sql = "SELECT count(*) as `trungcap` FROM `lylich` WHERE `lyluanchinhtri` = 'Trung cấp' AND `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $trungcap = (string)($r["trungcap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y11', $trungcap);

  $sql = "SELECT count(*) as `ngoaingu_a` FROM `lylich` WHERE `ngoaingu_trinhdo` = '%A%' AND `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_a = (string)($r["ngoaingu_a"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z11', $ngoaingu_a);

  $sql = "SELECT count(*) as `ngoaingu_b` FROM `lylich` WHERE `ngoaingu_trinhdo` = '%B%' AND `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_b = (string)($r["ngoaingu_b"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA11', $ngoaingu_b);

  $sql = "SELECT count(*) as `ngoaingu_dh` FROM `lylich` WHERE `ngoaingu_trinhdo` != '%A%' AND `ngoaingu_trinhdo` != '%B%' AND `chucvu` = 'Ủy viên Ban Chấp Hành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoaingu_dh = (string)($r["ngoaingu_dh"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB11', $ngoaingu_dh);
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
    unlink("../../file_export/bieu_mau/Mau m3.html");
	  $objWriter->save("../../file_export/bieu_mau/Mau m3.html");
	}
  header("Location: ../../file_export/bieu_mau/Mau m3.html");
?>
