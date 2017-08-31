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
  $today = date("d/m/Y"); 
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', "Tính đến ngày: ".$today);//tính đến ngày
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', "1");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B11', "Trường Đại học Công nghệ GTVT");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C11', "Sự nghiệp giáo dục - đào tạo");

  //$sql = "SELECT * FROM `lylich` WHERE `chucvu` = 'Bí thư'";
  $sql = "SELECT * FROM `lylich`";
  $result = mysql_query($sql);
  $tongso = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D11', (string)($tongso));//Tổng số viên chức

  //$sql = "SELECT count(*) as `nu` FROM `lylich` WHERE `gioitinh` = 0 AND `chucvu` = 'Bí thư'";
  $sql = "SELECT count(*) as `nu` FROM `lylich` WHERE `gioitinh` = 0";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $nu = (string)($r["nu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E11', $nu);

  $sql = "SELECT count(*) as `dangvien` FROM `lylich` WHERE `dangcongsan_ngaychinhthuc` is not null";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $dangvien = (string)($r["dangvien"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F11', $dangvien);

  $sql = "SELECT count(*) as `dantoc` FROM `lylich` WHERE `dantoc` != 'kinh' GROUP BY `dantoc`";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  if (mysql_num_rows($result) == 0) $dantrc = "0"; else $dantrc = (string)($r["dantoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G11', $dantrc);

  $sql = "SELECT count(*) as `duoi30` FROM `lylich` WHERE (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) < 30)";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tuoiduoi30 = (string)($r["duoi30"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H11', $tuoiduoi30);  

  $sql = "SELECT count(*) as `tu30den50` FROM `lylich` WHERE (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) >= 30) AND (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) <= 50)";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tu30den50 = (string)($r["tu30den50"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I11', $tu30den50);  

  $sql = "SELECT count(*) as `tu51den60` FROM `lylich` WHERE (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) > 50) AND (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) <= 60)";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tu51den60 = (string)($r["tu51den60"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J11', $tu51den60); 

  $sql = "SELECT count(*) as `tu51den60nu` FROM `lylich` WHERE (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) > 50) AND (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) <= 60) AND `gioitinh` = 0";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tu51den60nu = (string)($r["tu51den60nu"]);
  $sql = "SELECT count(*) as `tu51den60nam` FROM `lylich` WHERE (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) > 50) AND (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) <= 60) AND `gioitinh` = 1";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tu51den60nam = (string)($r["tu51den60nam"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K11', "nữ:".$tu51den60nu.", nam:".$tu51den60nam); 

  $sql = "SELECT count(*) as `tuoinghihuu` FROM `lylich` WHERE (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) >= 55 AND `gioitinh` = 0) OR (TIMESTAMPDIFF(YEAR, `ngaysinh`, NOW()) >= 60 AND `gioitinh` = 1)";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $tuoinghihuu = (string)($r["tuoinghihuu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L11', $tuoinghihuu); 

  $sql = "SELECT count(*) as `CVCC` FROM `lylich` WHERE `ngachcongchuc_maso` = '01.001'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $CVCC = (string)($r["CVCC"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M11', $CVCC); 

  $sql = "SELECT count(*) as `CVC` FROM `lylich` WHERE `ngachcongchuc_maso` = '01.002'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $CVC = (string)($r["CVC"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N11', $CVC);

  $sql = "SELECT count(*) as `CV` FROM `lylich` WHERE `ngachcongchuc_maso` = '01.003'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $CV = (string)($r["CV"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O11', $CV);

  $sql = "SELECT count(*) as `CS` FROM `lylich` WHERE `ngachcongchuc_maso` = '01.004'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $CS = (string)($r["CS"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P11', $CS);

  $sql = "SELECT count(*) as `ngachconlai` FROM `lylich` WHERE `ngachcongchuc_maso` NOT IN ('01.001','01.002','01.003','01.004')";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngachconlai = (string)($r["ngachconlai"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q11', $ngachconlai); 

  $sql = "SELECT count(*) as `TSKH_TS` FROM `lylich` WHERE `hochamcaonhat_ten` = 'TSKH' OR `hochamcaonhat_ten` = 'TS'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $TSKH_TS = (string)($r["TSKH_TS"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T11', $TSKH_TS);

  $sql = "SELECT count(*) as `thacsy` FROM `lylich` WHERE `hochamcaonhat_ten` = 'Ths'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $thacsy = (string)($r["thacsy"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U11', $thacsy);

  $sql = "SELECT count(*) as `daihoc` FROM `lylich` WHERE `hochamcaonhat_ten` = 'cử nhân' OR `hochamcaonhat_ten` = 'kỹ sư'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $daihoc = (string)($r["daihoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V11', $daihoc);

  $sql = "SELECT count(*) as `caodang` FROM `lylich` WHERE `hochamcaonhat_ten` = 'cao đẳng'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $caodang = (string)($r["caodang"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W11', $caodang);

  $sql = "SELECT count(*) as `trungcap` FROM `lylich` WHERE `hochamcaonhat_ten` = 'trung cấp'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $trungcap = (string)($r["trungcap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X11', $trungcap);

  $sql = "SELECT count(*) as `conlai` FROM `lylich` WHERE `hochamcaonhat_ten` = 'sơ cấp' OR `hochamcaonhat_ten` = 'chuyên ngành'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $conlai = (string)($r["conlai"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y11', $conlai);

  $sql = "SELECT count(*) as `caocap` FROM `lylich` WHERE `lyluanchinhtri` = 'Cao cấp'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $caocap = (string)($r["caocap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z11', $caocap);

  $sql = "SELECT count(*) as `trungcap` FROM `lylich` WHERE `lyluanchinhtri` = 'trung cấp'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $trungcap = (string)($r["trungcap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA11', $trungcap);

  $sql = "SELECT count(*) as `socap` FROM `lylich` WHERE `lyluanchinhtri` = 'sơ cấp'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $socap = (string)($r["socap"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB11', $socap);

  $sql = "SELECT count(*) as `ngoainguTC` FROM `lylich` WHERE `ngoaingu_trinhdo` LIKE 'A%'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoainguTC = (string)($r["ngoainguTC"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE11', $ngoainguTC);

  $sql = "SELECT count(*) as `ngoainguCC` FROM `lylich` WHERE `ngoaingu_trinhdo` NOT LIKE 'A%'";
  $result = mysql_query($sql);
  $r = mysql_fetch_array($result);
  $ngoainguCC = (string)($r["ngoainguCC"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF11', $ngoainguCC);
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
    unlink("../../file_export/bieu_mau/Mau m2.html");
	  $objWriter->save("../../file_export/bieu_mau/Mau m2.html");
	}
  header("Location: ../../file_export/bieu_mau/Mau m2.html");
?>
