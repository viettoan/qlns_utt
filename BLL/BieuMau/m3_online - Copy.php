<?php
  ob_start();
  session_start();
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else { 
  require("../../config/config.php");


  if (isset($_GET['nambaocao'])) 
    $nambaocao = $_GET['nambaocao'];
  else 
    $nambaocao = date('Y');

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

  
  $today = date("d/m/Y"); 
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'Tính đến ngày: '.$today);//tính đến ngày ...
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O7', 'Hợp đồng năm ' . $nambaocao);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P7', 'Nghỉ hưu năm ' . $nambaocao);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q7', 'Thôi việc, chuyển công tác năm ' . $nambaocao);

  // ====================Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO HÀ NỘI==================================  
  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `gioitinh`=1";
  $result = mysql_query($sql);
  $count_nam_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C10', (string)($count_nam_hn));//số lượng nam ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `gioitinh`=0";
  $result = mysql_query($sql);
  $count_nu_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D10', (string)($count_nu_hn));//số lượng nữ ở cơ sở hà nội
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E10', (string)($count_nam_hn+$count_nu_hn));//tổng nam và nữ

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `chucdanhkhoahoc`='Giáo sư'";
  $result = mysql_query($sql);
  $count_GS_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F10', (string)($count_GS_hn));//số lượng Giáo Sư ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `chucdanhkhoahoc`='Phó giáo sư'";
  $result = mysql_query($sql);
  $count_PGS_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G10', (string)($count_PGS_hn));//số lượng phó Giáo Sư ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `hochamcaonhat_ten`='TS'";
  $result = mysql_query($sql);
  $count_TS_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H10', (string)($count_TS_hn));//số lượng Tiến Sĩ ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `hochamcaonhat_ten`='NCS'";
  $result = mysql_query($sql);
  $count_NCS_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I10', (string)($count_NCS_hn));//số lượng NCS ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `hochamcaonhat_ten`='Ths'";
  $result = mysql_query($sql);
  $count_Ths_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J10', (string)($count_Ths_hn+$count_NCS_hn));//số lượng Ths ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `hochamcaonhat_ten`='Đ. Học cao học'";
  $result = mysql_query($sql);
  $count_DHCH_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K10', (string)($count_DHCH_hn));//số lượng Đ. Học cao học ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and (`hochamcaonhat_ten`='Cử nhân' or `hochamcaonhat_ten`='Kỹ sư')";
  $result = mysql_query($sql);
  $count_DH_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L10', (string)($count_DH_hn+$count_DHCH_hn));//số lượng Đại học ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `hochamcaonhat_ten`='Cao đẳng'";
  $result = mysql_query($sql);
  $count_CD_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M10', (string)($count_CD_hn));//số lượng Cao đẳng ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=1 and `chucdanhkhoahoc` NOT IN ('Giáo sư','Phó giáo sư') AND `hochamcaonhat_ten` NOT IN ('TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẳng')";
  $result = mysql_query($sql);
  $count_Khac_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N10', (string)($count_Khac_hn));//số lượng trình độ khác ở cơ sở hà nội


  //Tong hop dong nam 2016
  $sql = "Select distinct lylich_id from hopdong, lylich where lylich.id = hopdong.lylich_id AND lylich.cosodaotao_id=1 AND (year(ngayhdlaodong) = $nambaocao OR year(ngayhdlamviec) = $nambaocao)";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O10', (string)(mysql_num_rows($result)));


  //Nghỉ hưu 2016; Nam=60, Nữ=55
  $sql = "SELECT * FROM lylich, luanchuyen WHERE luanchuyen.cosodaotao_cu = 1 AND lylich.id = luanchuyen.canbo_id AND year(luanchuyen.ngaydieuchuyen) = $nambaocao AND luanchuyen.hinhthuc = 'Nghỉ hưu'";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P10', (string)(mysql_num_rows($result)));


  //Thôi việc, chuyển công tác 2016
  $sql = "SELECT * FROM lylich, luanchuyen WHERE luanchuyen.cosodaotao_cu = 1 AND lylich.id = luanchuyen.canbo_id AND year(luanchuyen.ngaydieuchuyen) = $nambaocao AND luanchuyen.hinhthuc IN ('Thôi việc', 'Đang công tác')";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q10', (string)(mysql_num_rows($result)));


//===========================End Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO HÀ NỘI===========================================

  // ====================Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO VĨNH PHÚC==================================  
  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `gioitinh`=1";
  $result = mysql_query($sql);
  $count_nam_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C11', (string)($count_nam_vp));//số lượng nam ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `gioitinh`=0";
  $result = mysql_query($sql);
  $count_nu_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D11', (string)($count_nu_vp));//số lượng nữ ở cơ sở hà nội
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E11', (string)($count_nam_vp+$count_nu_vp));//tổng nam và nữ

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `chucdanhkhoahoc`='Giáo sư'";
  $result = mysql_query($sql);
  $count_GS_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F11', (string)($count_GS_vp));//số lượng Giáo Sư ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `chucdanhkhoahoc`='Phó giáo sư'";
  $result = mysql_query($sql);
  $count_PGS_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G11', (string)($count_PGS_vp));//số lượng phó Giáo Sư ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `hochamcaonhat_ten`='TS'";
  $result = mysql_query($sql);
  $count_TS_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H11', (string)($count_TS_vp));//số lượng Tiến Sĩ ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `hochamcaonhat_ten`='NCS'";
  $result = mysql_query($sql);
  $count_NCS_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I11', (string)($count_NCS_vp));//số lượng NCS ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `hochamcaonhat_ten`='Ths'";
  $result = mysql_query($sql);
  $count_Ths_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J11', (string)($count_Ths_vp+$count_NCS_vp));//số lượng Ths ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `hochamcaonhat_ten`='Đ. Học cao học'";
  $result = mysql_query($sql);
  $count_DHCH_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K11', (string)($count_DHCH_vp));//số lượng Đ. Học cao học ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and (`hochamcaonhat_ten`='Cử nhân' or `hochamcaonhat_ten`='Kỹ sư')";
  $result = mysql_query($sql);
  $count_DH_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L11', (string)($count_DH_vp+$count_DHCH_vp));//số lượng Đại học ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `hochamcaonhat_ten`='Cao đẳng'";
  $result = mysql_query($sql);
  $count_CD_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M11', (string)($count_CD_vp));//số lượng Cao đẳng ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=2 and `chucdanhkhoahoc` NOT IN ('Giáo sư','Phó giáo sư') AND `hochamcaonhat_ten` NOT IN ('TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẳng')";
  $result = mysql_query($sql);
  $count_Khac_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N11', (string)($count_Khac_vp));//số lượng trình độ khác ở cơ sở hà nội

  //Tong hop dong nam 2016
  $sql = "Select distinct lylich_id from hopdong, lylich where lylich.id = hopdong.lylich_id AND lylich.cosodaotao_id=2 AND (year(ngayhdlaodong) = $nambaocao OR year(ngayhdlamviec) = $nambaocao)";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O11', (string)(mysql_num_rows($result)));

  //Nghỉ hưu 2016; Nam=60, Nữ=55
  $sql = "SELECT * FROM lylich, luanchuyen WHERE luanchuyen.cosodaotao_cu = 2 AND lylich.id = luanchuyen.canbo_id AND year(luanchuyen.ngaydieuchuyen) = $nambaocao AND luanchuyen.hinhthuc = 'Nghỉ hưu'";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P11', (string)(mysql_num_rows($result)));


  //Thôi việc, chuyển công tác 2016
  $sql = "SELECT * FROM lylich, luanchuyen WHERE luanchuyen.cosodaotao_cu = 2 AND lylich.id = luanchuyen.canbo_id AND year(luanchuyen.ngaydieuchuyen) = $nambaocao AND luanchuyen.hinhthuc IN ('Thôi việc', 'Đang công tác')";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q11', (string)(mysql_num_rows($result)));
//===========================End Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO VĨNH PHÚC===========================================

  // ====================Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO THÁI NGUYÊN==================================  
  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `gioitinh`=1";
  $result = mysql_query($sql);
  $count_nam_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C12', (string)($count_nam_tn));//số lượng nam ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `gioitinh`=0";
  $result = mysql_query($sql);
  $count_nu_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D12', (string)($count_nu_tn));//số lượng nữ ở cơ sở hà nội
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E12', (string)($count_nam_tn+$count_nu_tn));//tổng nam và nữ

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `chucdanhkhoahoc`='Giáo sư'";
  $result = mysql_query($sql);
  $count_GS_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F12', (string)($count_GS_tn));//số lượng Giáo Sư ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `chucdanhkhoahoc`='Phó giáo sư'";
  $result = mysql_query($sql);
  $count_PGS_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G12', (string)($count_PGS_tn));//số lượng phó Giáo Sư ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `hochamcaonhat_ten`='TS'";
  $result = mysql_query($sql);
  $count_TS_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H12', (string)($count_TS_tn));//số lượng Tiến Sĩ ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `hochamcaonhat_ten`='NCS'";
  $result = mysql_query($sql);
  $count_NCS_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I12', (string)($count_NCS_tn));//số lượng NCS ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `hochamcaonhat_ten`='Ths'";
  $result = mysql_query($sql);
  $count_Ths_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J12', (string)($count_Ths_tn+$count_NCS_tn));//số lượng Ths ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `hochamcaonhat_ten`='Đ. Học cao học'";
  $result = mysql_query($sql);
  $count_DHCH_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K12', (string)($count_DHCH_tn));//số lượng Đ. Học cao học ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and (`hochamcaonhat_ten`='Cử nhân' or `hochamcaonhat_ten`='Kỹ sư')";
  $result = mysql_query($sql);
  $count_DH_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L12', (string)($count_DH_tn+$count_DHCH_tn));//số lượng Đại học ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `hochamcaonhat_ten`='Cao đẳng'";
  $result = mysql_query($sql);
  $count_CD_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M12', (string)($count_CD_tn));//số lượng Cao đẳng ở cơ sở hà nội

  $sql = "SELECT * FROM `lylich` where `cosodaotao_id`=3 and `chucdanhkhoahoc` NOT IN ('Giáo sư','Phó giáo sư') AND `hochamcaonhat_ten` NOT IN ('TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẳng')";
  $result = mysql_query($sql);
  $count_Khac_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N12', (string)($count_Khac_tn));//số lượng trình độ khác ở cơ sở hà nội

  //Tong hop dong nam 2016
  $sql = "Select distinct lylich_id from hopdong, lylich where lylich.id = hopdong.lylich_id AND lylich.cosodaotao_id=2 AND (year(ngayhdlaodong) = $nambaocao OR year(ngayhdlamviec) = $nambaocao)";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O12', (string)(mysql_num_rows($result)));

  //Nghỉ hưu 2016; Nam=60, Nữ=55
  $sql = "SELECT * FROM lylich, luanchuyen WHERE luanchuyen.cosodaotao_cu = 3 AND lylich.id = luanchuyen.canbo_id AND year(luanchuyen.ngaydieuchuyen) = $nambaocao AND luanchuyen.hinhthuc = 'Nghỉ hưu'";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P12', (string)(mysql_num_rows($result)));


  //Thôi việc, chuyển công tác 2016
  $sql = "SELECT * FROM lylich, luanchuyen WHERE luanchuyen.cosodaotao_cu = 3 AND lylich.id = luanchuyen.canbo_id AND year(luanchuyen.ngaydieuchuyen) = $nambaocao AND luanchuyen.hinhthuc IN ('Thôi việc', 'Đang công tác')";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q12', (string)(mysql_num_rows($result)));
//===========================End Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO THÁI NGUYÊN===========================================
  //===========================Dòng Tổng Số===========================================
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C13', (string)($count_nam_hn+$count_nam_vp+$count_nam_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D13', (string)($count_nu_hn+$count_nu_vp+$count_nu_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E13', (string)($count_nam_hn+$count_nam_vp+$count_nam_tn+$count_nu_hn+$count_nu_vp+$count_nu_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F13', (string)($count_GS_hn+$count_GS_vp+$count_GS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G13', (string)($count_PGS_hn+$count_PGS_vp+$count_PGS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H13', (string)($count_TS_hn+$count_TS_vp+$count_TS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I13', (string)($count_NCS_hn+$count_NCS_vp+$count_NCS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J13', (string)($count_Ths_hn+$count_Ths_vp+$count_Ths_tn+$count_NCS_hn+$count_NCS_vp+$count_NCS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K13', (string)($count_DHCH_hn+$count_DHCH_vp+$count_DHCH_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L13', (string)($count_DH_hn+$count_DH_vp+$count_DH_tn+$count_DHCH_hn+$count_DHCH_vp+$count_DHCH_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M13', (string)($count_CD_hn+$count_CD_vp+$count_CD_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N13', (string)($count_Khac_hn+$count_Khac_vp+$count_Khac_tn));

  //Hợp đồng năm 2016
  $sql = "Select distinct lylich_id from hopdong, lylich where lylich.id = hopdong.lylich_id AND lylich.cosodaotao_id=2 AND (year(ngayhdlaodong) = $nambaocao OR year(ngayhdlamviec) = $nambaocao)";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O13', (string)(mysql_num_rows($result)));


  //Nghỉ hưu 2016; Nam=60, Nữ=55
  $sql = "SELECT * FROM lylich, luanchuyen WHERE luanchuyen.cosodaotao_cu in (1, 2, 3) AND lylich.id = luanchuyen.canbo_id AND year(luanchuyen.ngaydieuchuyen) = $nambaocao AND luanchuyen.hinhthuc = 'Nghỉ hưu'";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P13', (string)(mysql_num_rows($result)));


  //Thôi việc, chuyển công tác 2016
  $sql = "SELECT * FROM lylich, luanchuyen WHERE luanchuyen.cosodaotao_cu in (1, 2, 3) AND lylich.id = luanchuyen.canbo_id AND year(luanchuyen.ngaydieuchuyen) = $nambaocao AND luanchuyen.hinhthuc IN ('Thôi việc', 'Đang công tác')";
  $result = mysql_query($sql);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q13', (string)(mysql_num_rows($result)));
  
  //===========================End Dòng Tổng Số===========================================

  // ====================Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO HÀ NỘI (Giảng Viên, Giáo Viên)=======================
  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.gioitinh = 1 AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_nam_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C19', (string)($count_nam_hn));//số lượng nam ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.gioitinh = 0 AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_nu_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D19', (string)($count_nu_hn));//số lượng nữ ở cơ sở hà nội
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E19', (string)($count_nam_hn+$count_nu_hn));//tổng nam và nữ

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.chucdanhkhoahoc = 'Giáo sư' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_GS_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F19', (string)($count_GS_hn));//số lượng Giáo Sư ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.chucdanhkhoahoc = 'Phó giáo sư' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_PGS_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G19', (string)($count_PGS_hn));//số lượng phó Giáo Sư ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.hochamcaonhat_ten = 'TS' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_TS_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H19', (string)($count_TS_hn));//số lượng Tiến Sĩ ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.hochamcaonhat_ten = 'NCS' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_NCS_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I19', (string)($count_NCS_hn));//số lượng NCS ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.hochamcaonhat_ten = 'Ths' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_Ths_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J19', (string)($count_Ths_hn+$count_NCS_hn));//số lượng Ths ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.hochamcaonhat_ten = 'Đ. Học cao học' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_DHCH_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K19', (string)($count_DHCH_hn));//số lượng  ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.hochamcaonhat_ten in ('Cử nhân', 'Kỹ sư') AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_DH_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L19', (string)($count_DH_hn+$count_DHCH_hn));//số lượng Đại học ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND lylich.hochamcaonhat_ten = 'Cao đẳng' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_CD_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M19', (string)($count_CD_hn));//số lượng Cao đẳng ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 1 AND `chucdanhkhoahoc` NOT IN ('Giáo sư','Phó giáo sư') AND `hochamcaonhat_ten` NOT IN ('TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẳng') AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_Khac_hn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N19', (string)($count_Khac_hn));//số lượng trình độ khác ở cơ sở hà nội
//===========================End Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO HÀ NỘI===========================================

  // ====================Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO VĨNH PHÚC==================================  
  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.gioitinh = 1 AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_nam_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C20', (string)($count_nam_vp));//số lượng nam ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.gioitinh = 0 AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_nu_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D20', (string)($count_nu_vp));//số lượng nữ ở cơ sở hà nội
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E20', (string)($count_nam_vp+$count_nu_vp));//tổng nam và nữ

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.chucdanhkhoahoc = 'Giáo sư' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_GS_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F20', (string)($count_GS_vp));//số lượng Giáo Sư ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.chucdanhkhoahoc = 'Phó giáo sư' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_PGS_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G20', (string)($count_PGS_vp));//số lượng phó Giáo Sư ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.hochamcaonhat_ten = 'TS' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_TS_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H20', (string)($count_TS_vp));//số lượng Tiến Sĩ ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.hochamcaonhat_ten = 'NCS' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_NCS_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I20', (string)($count_NCS_vp));//số lượng NCS ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.hochamcaonhat_ten = 'Ths' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_Ths_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J20', (string)($count_Ths_vp+$count_NCS_vp));//số lượng Ths ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.hochamcaonhat_ten = 'Đ. Học cao học' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_DHCH_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K20', (string)($count_DHCH_vp));//số lượng Đ. Học cao học ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.hochamcaonhat_ten in ('Kỹ sư', 'Cử nhân') AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_DH_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L20', (string)($count_DH_vp+$count_DHCH_vp));//số lượng Đại học ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND lylich.hochamcaonhat_ten = 'Cao đẳng' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_CD_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M20', (string)($count_CD_vp));//số lượng Cao đẳng ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND `chucdanhkhoahoc` NOT IN ('Giáo sư','Phó giáo sư') AND `hochamcaonhat_ten` NOT IN ('TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẳng') AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_Khac_vp = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N20', (string)($count_Khac_vp));//số lượng trình độ khác ở cơ sở hà nội
//===========================End Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO VĨNH PHÚC===========================================

  // ====================Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO THÁI NGUYÊN==================================  
  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.gioitinh = 1 AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_nam_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C21', (string)($count_nam_tn));//số lượng nam ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.gioitinh = 0 AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_nu_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D21', (string)($count_nu_tn));//số lượng nữ ở cơ sở hà nội
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E21', (string)($count_nam_tn+$count_nu_tn));//tổng nam và nữ

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.chucdanhkhoahoc = 'Giáo sư' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_GS_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F21', (string)($count_GS_tn));//số lượng Giáo Sư ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.chucdanhkhoahoc = 'Phó giáo sư' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_PGS_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G21', (string)($count_PGS_tn));//số lượng phó Giáo Sư ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.hochamcaonhat_ten = 'TS' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_TS_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H21', (string)($count_TS_tn));//số lượng Tiến Sĩ ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.hochamcaonhat_ten = 'NCS' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_NCS_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I21', (string)($count_NCS_tn));//số lượng NCS ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.hochamcaonhat_ten = 'Ths' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_Ths_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J21', (string)($count_Ths_tn+$count_NCS_tn));//số lượng Ths ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.hochamcaonhat_ten = 'Đ. Học cao học' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_DHCH_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K21', (string)($count_DHCH_tn));//số lượng Đ. Học cao học ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.hochamcaonhat_ten in ('Kỹ sư','Cử nhân') AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_DH_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L21', (string)($count_DH_tn+$count_DHCH_tn));//số lượng Đại học ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 3 AND lylich.hochamcaonhat_ten = 'Cao đẳng' AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_CD_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M21', (string)($count_CD_tn));//số lượng Cao đẳng ở cơ sở hà nội

  $sql = "SELECT lylich.* from lylich where lylich.cosodaotao_id = 2 AND `chucdanhkhoahoc` NOT IN ('Giáo sư','Phó giáo sư') AND `hochamcaonhat_ten` NOT IN ('TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẳng') AND lylich.id in (SELECT q1.lylich_id FROM quatrinhluong q1 LEFT JOIN quatrinhluong q2 ON (q1.lylich_id = q2.lylich_id AND q1.thoidiem < q2.thoidiem) WHERE q2.id IS NULL AND q1.mangach in ('15.113','V.07.01.03','15.112','V.07.01.02','13.090'))";
  $result = mysql_query($sql);
  $count_Khac_tn = mysql_num_rows($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N21', (string)($count_Khac_tn));//số lượng trình độ khác ở cơ sở hà nội
//===========================End Lay du lieu tu CSDL cho CƠ SỞ ĐÀO TẠO THÁI NGUYÊN===========================================
  //===========================Dòng Tổng Số===========================================
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C22', (string)($count_nam_hn+$count_nam_vp+$count_nam_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D22', (string)($count_nu_hn+$count_nu_vp+$count_nu_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E22', (string)($count_nam_hn+$count_nam_vp+$count_nam_tn+$count_nu_hn+$count_nu_vp+$count_nu_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F22', (string)($count_GS_hn+$count_GS_vp+$count_GS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G22', (string)($count_PGS_hn+$count_PGS_vp+$count_PGS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H22', (string)($count_TS_hn+$count_TS_vp+$count_TS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I22', (string)($count_NCS_hn+$count_NCS_vp+$count_NCS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J22', (string)($count_Ths_hn+$count_Ths_vp+$count_Ths_tn+$count_NCS_hn+$count_NCS_vp+$count_NCS_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K22', (string)($count_DHCH_hn+$count_DHCH_vp+$count_DHCH_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L22', (string)($count_DH_hn+$count_DH_vp+$count_DH_tn+$count_DHCH_hn+$count_DHCH_vp+$count_DHCH_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M22', (string)($count_CD_hn+$count_CD_vp+$count_CD_tn));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N22', (string)($count_Khac_hn+$count_Khac_vp+$count_Khac_tn));
  
  //===========================End Dòng Tổng Số===========================================

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
