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


  if (!file_exists("../../file_export/bieu_mau/m6.xlsx")) {
    exit("File mau m6 khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../file_export/bieu_mau/m6.xlsx");

  

  ////////// THEO CƠ SỞ

  function theo_coso($cell, $sql) {
    global $objPHPExcel;
    $result = mysql_query($sql);
    $count = mysql_num_rows($result);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell, (string)($count));
  }
  ///// HN
  // Nam
  theo_coso('D10', "SELECT * FROM lylich WHERE cosodaotao_id=1 AND gioitinh=1");
  // Nữ
  theo_coso('E10', "SELECT * FROM lylich WHERE cosodaotao_id=1 AND gioitinh=0");
  // Tổng số
  theo_coso('F10', "SELECT * FROM lylich WHERE cosodaotao_id=1");
  // Giáo sư
  theo_coso('G10', "SELECT * FROM lylich WHERE cosodaotao_id=1 AND chucdanhkhoahoc='Giáo sư'");
  // Phó Giáo sư
  theo_coso('H10', "SELECT * FROM lylich WHERE cosodaotao_id=1 AND chucdanhkhoahoc='Phó giáo sư'");
  // Tiến sĩ
  theo_coso('I10', "SELECT * FROM lylich WHERE cosodaotao_id=1 AND hochamcaonhat_ten='TS'");
  // NCS
  theo_coso('J10', "SELECT * FROM lylich WHERE cosodaotao_id=1 AND hochamcaonhat_ten='NCS'");
  // Thạc sĩ
  theo_coso('K10', "SELECT * FROM lylich WHERE cosodaotao_id=1 AND hochamcaonhat_ten='Ths'");
  // Đ. Học Cao học
  theo_coso('L10', "SELECT * FROM lylich where cosodaotao_id=1 and hochamcaonhat_ten='Đ. Học cao học'");
  // ĐH
  theo_coso('M10', "SELECT * FROM lylich WHERE cosodaotao_id=1 AND (hochamcaonhat_ten='Cử nhân' OR hochamcaonhat_ten='Kỹ sư')");
  // CĐ
  theo_coso('N10', "SELECT * FROM lylich WHERE cosodaotao_id=1 AND hochamcaonhat_ten='Cao đẳng'");
  // Trình độ khác
  theo_coso('O10', "SELECT * FROM lylich where cosodaotao_id=1 and hochamcaonhat_ten NOT IN ('Giáo sư','Phó giáo sư','TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẵng')");


  ///// VY
  // Nam
  theo_coso('D11', "SELECT * FROM lylich WHERE cosodaotao_id=2 AND gioitinh=1");
  // Nữ
  theo_coso('E11', "SELECT * FROM lylich WHERE cosodaotao_id=2 AND gioitinh=0");
  // Tổng số
  theo_coso('F11', "SELECT * FROM lylich WHERE cosodaotao_id=2");
  // Giáo sư
  theo_coso('G11', "SELECT * FROM lylich WHERE cosodaotao_id=2 AND chucdanhkhoahoc='Giáo sư'");
  // Phó Giáo sư
  theo_coso('H11', "SELECT * FROM lylich WHERE cosodaotao_id=2 AND chucdanhkhoahoc='Phó giáo sư'");
  // Tiến sĩ
  theo_coso('I11', "SELECT * FROM lylich WHERE cosodaotao_id=2 AND hochamcaonhat_ten='TS'");
  // NCS
  theo_coso('J11', "SELECT * FROM lylich WHERE cosodaotao_id=2 AND hochamcaonhat_ten='NCS'");
  // Thạc sĩ
  theo_coso('K11', "SELECT * FROM lylich WHERE cosodaotao_id=2 AND hochamcaonhat_ten='Ths'");
  // Đ. Học Cao học
  theo_coso('L11', "SELECT * FROM lylich where cosodaotao_id=2 and hochamcaonhat_ten='Đ. Học cao học'");
  // ĐH
  theo_coso('M11', "SELECT * FROM lylich WHERE cosodaotao_id=2 AND (hochamcaonhat_ten='Cử nhân' OR hochamcaonhat_ten='Kỹ sư')");
  // CĐ
  theo_coso('N11', "SELECT * FROM lylich WHERE cosodaotao_id=2 AND hochamcaonhat_ten='Cao đẳng'");
  // Trình độ khác
  theo_coso('O11', "SELECT * FROM lylich where cosodaotao_id=2 and hochamcaonhat_ten NOT IN ('Giáo sư','Phó giáo sư','TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẵng')");

  ///// TN
  // Nam
  theo_coso('D86', "SELECT * FROM lylich WHERE cosodaotao_id=3 AND gioitinh=1");
  // Nữ
  theo_coso('E86', "SELECT * FROM lylich WHERE cosodaotao_id=3 AND gioitinh=0");
  // Tổng số
  theo_coso('F86', "SELECT * FROM lylich WHERE cosodaotao_id=3");
  // Giáo sư
  theo_coso('G86', "SELECT * FROM lylich WHERE cosodaotao_id=3 AND chucdanhkhoahoc='Giáo sư'");
  // Phó Giáo sư
  theo_coso('H86', "SELECT * FROM lylich WHERE cosodaotao_id=3 AND chucdanhkhoahoc='Phó giáo sư'");
  // Tiến sĩ
  theo_coso('I86', "SELECT * FROM lylich WHERE cosodaotao_id=3 AND hochamcaonhat_ten='TS'");
  // NCS
  theo_coso('J86', "SELECT * FROM lylich WHERE cosodaotao_id=3 AND hochamcaonhat_ten='NCS'");
  // Thạc sĩ
  theo_coso('K86', "SELECT * FROM lylich WHERE cosodaotao_id=3 AND hochamcaonhat_ten='Ths'");
  // Đ. Học Cao học
  theo_coso('L86', "SELECT * FROM lylich where cosodaotao_id=3 and hochamcaonhat_ten='Đ. Học cao học'");
  // ĐH
  theo_coso('M86', "SELECT * FROM lylich WHERE cosodaotao_id=3 AND (hochamcaonhat_ten='Cử nhân' OR hochamcaonhat_ten='Kỹ sư')");
  // CĐ
  theo_coso('N86', "SELECT * FROM lylich WHERE cosodaotao_id=3 AND hochamcaonhat_ten='Cao đẳng'");
  // Trình độ khác
  theo_coso('O86', "SELECT * FROM lylich where cosodaotao_id=3 and hochamcaonhat_ten NOT IN ('Giáo sư','Phó giáo sư','TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẵng')");

  ///// BGH - HĐ - CĐ - ĐTN
  ///// HN
  // Nam
  theo_coso('D12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4 AND gioitinh=1");
  // Nữ
  theo_coso('E12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4 AND gioitinh=0");
  // Tổng số
  theo_coso('F12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4");
  // Giáo sư
  theo_coso('G12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4 AND chucdanhkhoahoc='Giáo sư'");
  // Phó Giáo sư
  theo_coso('H12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4 AND chucdanhkhoahoc='Phó giáo sư'");
  // Tiến sĩ
  theo_coso('I12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4 AND hochamcaonhat_ten='TS'");
  // NCS
  theo_coso('J12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4 AND hochamcaonhat_ten='NCS'");
  // Thạc sĩ
  theo_coso('K12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4 AND hochamcaonhat_ten='Ths'");
  // Đ. Học Cao học
  theo_coso('L12', "SELECT * FROM lylich where tochuctructhuoc_id=4 and hochamcaonhat_ten='Đ. Học cao học'");
  // ĐH
  theo_coso('M12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4 AND (hochamcaonhat_ten='Cử nhân' OR hochamcaonhat_ten='Kỹ sư')");
  // CĐ
  theo_coso('N12', "SELECT * FROM lylich WHERE tochuctructhuoc_id=4 AND hochamcaonhat_ten='Cao đẳng'");
  // Trình độ khác
  theo_coso('O12', "SELECT * FROM lylich where tochuctructhuoc_id=4 and hochamcaonhat_ten NOT IN ('Giáo sư','Phó giáo sư','TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẵng')");


  /////Lãnh đạo Cơ sở đào tạo TN 87
  // Nam
  theo_coso('D87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11 AND gioitinh=1");
  // Nữ
  theo_coso('E87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11 AND gioitinh=0");
  // Tổng số
  theo_coso('F87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11");
  // Giáo sư
  theo_coso('G87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11 AND chucdanhkhoahoc='Giáo sư'");
  // Phó Giáo sư
  theo_coso('H87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11 AND chucdanhkhoahoc='Phó giáo sư'");
  // Tiến sĩ
  theo_coso('I87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11 AND hochamcaonhat_ten='TS'");
  // NCS
  theo_coso('J87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11 AND hochamcaonhat_ten='NCS'");
  // Thạc sĩ
  theo_coso('K87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11 AND hochamcaonhat_ten='Ths'");
  // Đ. Học Cao học
  theo_coso('L87', "SELECT * FROM lylich where tochuctructhuoc_id=11 and hochamcaonhat_ten='Đ. Học cao học'");
  // ĐH
  theo_coso('M87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11 AND (hochamcaonhat_ten='Cử nhân' OR hochamcaonhat_ten='Kỹ sư')");
  // CĐ
  theo_coso('N87', "SELECT * FROM lylich WHERE tochuctructhuoc_id=11 AND hochamcaonhat_ten='Cao đẳng'");
  // Trình độ khác
  theo_coso('O87', "SELECT * FROM lylich where tochuctructhuoc_id=11 and hochamcaonhat_ten NOT IN ('Giáo sư','Phó giáo sư','TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẵng')");




  ////////// Theo phòng ban


 function column($col, $row, $sql) {
    echo $row;
    global $objPHPExcel;
    $result = mysql_query($sql);
    $count = mysql_num_rows($result);
    echo $col . $row;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($col . $row, (string)($count));
  }

  function theo_phongban($row, $coso, $phongban) {
    // Nam D
    column('D', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND gioitinh=1 AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // Nữ E
    column('E', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND gioitinh=0 AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // Tổng số F
    column('F', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // Giáo sư G
    column('G', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND chucdanhkhoahoc='Giáo sư' AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // Phó Giáo sư H
    column('H', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND chucdanhkhoahoc='Phó giáo sư' AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // Tiến sĩ I
    column('I', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND hochamcaonhat_ten='TS' AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // NCS J
    column('J', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND hochamcaonhat_ten='NCS' AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // Thạc sĩ K
    column('K', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND hochamcaonhat_ten='Ths' AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // Đ. Học Cao học]
    column('L', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND hochamcaonhat_ten='Đ. Học cao học' AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // ĐH
    column('M', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND (hochamcaonhat_ten='Cử nhân' OR hochamcaonhat_ten='Kỹ sư') AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // CĐ
    column('N', $row, "SELECT * FROM lylich, khoaphongban WHERE cosodaotao_id=$coso AND hochamcaonhat_ten='Cao đẳng' AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
    // Trình độ khác
    column('O', $row, "SELECT * FROM lylich, khoaphongban where cosodaotao_id=$coso and hochamcaonhat_ten NOT IN ('Giáo sư','Phó giáo sư','TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẵng') AND khoaphongban.name='$phongban' AND lylich.khoaphongban_id=khoaphongban.khoaphongbanid");
  }

  ///// Phòng Tài chính Kế toán
  // HN
  theo_phongban('13', 1, 'Phòng Tài chính Kế toán');
  // VY
  theo_phongban('14', 2, 'Phòng Tài chính Kế toán.');
  //TN
  theo_phongban('88', 3, 'Phòng Tài chính Kế toán');

  ///// Phòng Đào tạo
  // HN
  theo_phongban('16', 1, 'Phòng Đào tạo');
  // VY
  theo_phongban('17', 2, 'Phòng Đào tạo.');
  //TN
  theo_phongban('89', 3, 'Phòng Đào tạo');

  ///// Phòng Tổ chức cán bộ
  // HN
  theo_phongban('19', 1, 'Phòng Tổ chức cán bộ');
  // VY
  theo_phongban('20', 2, 'Phòng Tổ chức cán bộ.');
  //TN
  theo_phongban('90', 3, 'Phòng Tổ chức cán bộ');

///// Phòng Công tác HS-SV
  // HN
  theo_phongban('22', 1, 'Phòng Công tác HS-SV');
  // VY
  theo_phongban('23', 2, 'Phòng Công tác HS-SV.');

///// Phòng Thanh tra giáo dục
  // HN
  theo_phongban('26', 1, 'Phòng Thanh tra giáo dục');
  // VY
  theo_phongban('27', 2, 'Phòng Thanh tra giáo dục.');

///// Phòng Đảm bảo chất lượng đào tạo
  // HN
  theo_phongban('29', 1, 'Phòng Đảm bảo chất lượng đào tạo');
  // VY
  theo_phongban('30', 2, 'Phòng Đảm bảo chất lượng đào tạo.'); //Phòng không có trong cơ sở dữ liệu

///// Phòng Hành chính - Quản trị
  // HN
  theo_phongban('32', 1, 'Phòng Hành chính - Quản trị');
  // VY
  theo_phongban('33', 2, 'Phòng Hành chính - Quản trị.');


///// Phòng Đào tạo Sau đại học
  // HN
  theo_phongban('35', 1, 'Phòng Đào tạo Sau đại học');


///// Khoa Công trình
  // HN
  theo_phongban('36', 1, 'Khoa Công trình');
  // VY
  theo_phongban('37', 2, 'Khoa Công trình.');


///// Khoa Cơ khí
  // HN
  theo_phongban('39', 1, 'Khoa Cơ khí');
  // VY
  theo_phongban('40', 2, 'Khoa Cơ khí.');

///// Khoa Kinh tế Vận tải
  // HN
  theo_phongban('42', 1, 'Khoa Kinh tế Vận tải');
  // VY
  theo_phongban('43', 2, 'Khoa Kinh tế Vận tải.');

///// Khoa Khoa học cơ bản
  // HN
  theo_phongban('45', 1, 'Khoa Khoa học cơ bản');
  // VY
  theo_phongban('46', 2, 'Khoa Khoa học cơ bản.');

///// Khoa Công nghệ thông tin
  // HN
  theo_phongban('48', 1, 'Khoa Công nghệ thông tin');
  // VY
  theo_phongban('49', 2, 'Khoa Công nghệ thông tin.');

///// Khoa Lý luận chính trị
  // HN
  theo_phongban('51', 1, 'Khoa Lý luận chính trị');
  // VY
  theo_phongban('52', 2, 'Khoa Lý luận chính trị.');


///// Khoa đào tạo tại chức
  // HN
  theo_phongban('54', 1, 'Khoa đào tạo tại chức');
  // VY
  theo_phongban('55', 2, 'Khoa đào tạo tại chức.');


///// Khoa Cơ sở kỹ thuật
  // HN
  theo_phongban('57', 1, 'Khoa Cơ sở kỹ thuật');
  // VY
  theo_phongban('58', 2, 'Khoa Cơ sở kỹ thuật.');


///// Bộ môn DG quốc phòng - An ninh
  // HN
  theo_phongban('60', 1, 'Bộ môn DG quốc phòng - An ninh');
  // VY
  theo_phongban('61', 2, 'Bộ môn DG quốc phòng - An ninh.');


///// Bộ môn Giáo dục thể chất
  // HN
  theo_phongban('63', 1, 'Bộ môn Giáo dục thể chất');
  // VY
  theo_phongban('64', 2, 'Bộ môn Giáo dục thể chất.');

///// Trung tâm Công nghệ Cơ khí
  // HN
  theo_phongban('66', 1, 'Trung tâm Công nghệ Cơ khí');
  // VY
  theo_phongban('67', 2, 'Trung tâm Công nghệ Cơ khí.');

///// Trung tâm Dịch vụ Đời sống
  // HN
  theo_phongban('69', 1, 'Trung tâm Dịch vụ Đời sống');
  // VY
  theo_phongban('70', 2, 'Trung tâm Dịch vụ Đời sống.');


///// Trung tâm CNTT
  // HN
  theo_phongban('72', 1, 'Trung tâm CNTT');
  // VY
  theo_phongban('73', 2, 'Trung tâm CNTT.');

///// Ban Xây dựng cơ bản
  // HN
  theo_phongban('77', 1, 'Ban Xây dựng cơ bản');
  // VY
  theo_phongban('78', 2, 'Ban Xây dựng cơ bản.');

///// Trạm y tế
  // HN
  theo_phongban('80', 1, 'Trạm y tế');
  // VY
  theo_phongban('81', 2, 'Trạm y tế.');
  
///// Thư viện
  // HN
  theo_phongban('83', 1, 'Thư viện');
  // VY
  theo_phongban('84', 2, 'Thư viện.');





///// Phòng KHCN và HTQT
  // HN
  theo_phongban('25', 1, 'Phòng KHCN và HTQT');

///// Trung tâm tư vấn TK - KĐ chất lượng công trình
  // HN
  theo_phongban('75', 1, 'Trung tâm tư vấn TK - KĐ chất lượng công trình');

///// Trung tâm Đào tạo lái xe
  // HN
  theo_phongban('76', 1, 'Trung tâm Đào tạo lái xe');

///// Phòng Công tác HS-SV
  //TN
  theo_phongban('91', 3, 'Tổ ĐB CLĐT, TTGD và CT HS,SV');

///// Phòng Hành chính - Quản trị
  //TN
  theo_phongban('92', 3, 'Phòng Hành chính Quản trị');

///// Tổ dạy lái xe
  // HN
  theo_phongban('93', 1, 'Tổ dạy lái xe');

///// Bộ môn Kinh tế
  //TN
  theo_phongban('94', 3, 'Bộ môn Kinh tế');

///// Bộ môn Công trình
  //TN
  theo_phongban('95', 3, 'Bộ môn Công trình');

///// Bộ môn Cơ sở
  //TN
  theo_phongban('96', 3, 'Bộ môn Cơ sở');

///// Bộ môn Khoa học cơ bản
  //TN
  theo_phongban('97', 3, 'Bộ môn Khoa học cơ bản');


///// Bộ Môn Lý Luận Chính Trị
  //TN
  theo_phongban('98', 3, 'Bộ Môn Lý Luận Chính Trị');

  $styleArray = array(
          'borders' => array(
              'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
              )
          )
      );

    // Tao file da xong du lieu
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save("../../file_export/bieu_mau/Mau m6.xlsx");
  }
  header("Location: ../../file_export/bieu_mau/Mau m6.xlsx");
?>
