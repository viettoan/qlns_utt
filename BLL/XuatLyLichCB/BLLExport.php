<?php
  ob_start();
  session_start();
  include_once("header.php");
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else { 
  require("../../config/config.php");
  $lylich_id = $_GET["lylich_id"];

  // Lay du lieu tu CSDL
  $sql = "SELECT * FROM `lylich` WHERE id = '$lylich_id'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);

  /// Lấy thông tin quá trình lương
  $qtl_sql = "SELECT id, lylich_id, year(thoidiem) as 'nam', month(thoidiem) as 'thang', ngach, mangach, bac,heso, vuotkhung from quatrinhluong where thoidiem = (select max(thoidiem)  from quatrinhluong where lylich_id=$lylich_id)";
  $qtl_result = mysql_query($qtl_sql);
  $qtl_row = mysql_fetch_array($qtl_result);

  /// Lấy ngày tuyển dụng (ngayhdlamviec)
  $ngaytd_sql = "SELECT max(ngayhdlamviec) as ngayhdlamviec FROM hopdong WHERE lylich_id=$lylich_id";
  $ngaytd_result = mysql_query($ngaytd_sql);
  $ngaytd_row = mysql_fetch_array($ngaytd_result);


  // Lay mau form va tao file ly lich cho CB
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  date_default_timezone_set('Europe/London');

  /** Include PHPExcel_IOFactory */
  require_once '../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';


  if (!file_exists("../../file_export/form2c.xlsx")) {
    exit("File mau 2C khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../file_export/form2c.xlsx");

    // Lay quequan_tinh tu CSDL
  $cosodaotao_id=$row["cosodaotao_id"];
  $sql_cosodaotao = "SELECT `name` FROM `cosodaotao` WHERE cosodaotaoid = '$cosodaotao_id'";
  $result_cosodaotao = mysql_query($sql_cosodaotao);
  $row_cosodaotao = mysql_fetch_array($result_cosodaotao);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT1', $row["sohieucanbo"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q2', $row_cosodaotao["name"]);
  $hoten = $row["hoten"];
  //$hoten = strtoupper($hoten);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD6', $hoten);
  if ($row["gioitinh"] == 1) $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AX8', "Nam");
  else  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AX8', "Nữ");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T7', $row["tengoikhac"]);
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V8', $row["capuyhientai"]);
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS8', $row["capuykiem"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R19', $row["chucvu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T8', date("d-m-Y", strtotime($row["ngaysinh"])));
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL12', $row["noisinh"]);

    // Lay quequan_huyen tu CSDL
  $huyen = $row["quequan_huyen"];
  $tinh = $row["quequan_tinh"];

  $sql_huyen = "SELECT `name`, `type` FROM `huyen` WHERE districtid = '$huyen'";
  $result_huyen = mysql_query($sql_huyen);
  $row_huyen = mysql_fetch_array($result_huyen);

    // Lay quequan_tinh tu CSDL
  $sql_tinh = "SELECT `name`, `type` FROM `tinh` WHERE provinceid = '$tinh'";
  $result_tinh = mysql_query($sql_tinh);
  $row_tinh = mysql_fetch_array($result_tinh);

  $noisinh = $row["noisinh"];
  $noisinhs = explode("-", $noisinh);

    // Lay type cua noisinh_huyen tu CSDL
  $xa_type = trim($noisinhs[0]);
  $huyen_type = trim($noisinhs[1]);
  $tinh_type = trim($noisinhs[2]);
  $sql_huyen_type = "SELECT `type` FROM `huyen` WHERE name = '$huyen_type'";
  //$sql_huyen_type = "SELECT `type` FROM `huyen` WHERE name = 'Thanh Hóa'";
  $result_huyen_type = mysql_query($sql_huyen_type);
  $row_huyen_type = mysql_fetch_array($result_huyen_type);

    // Lay type cua noisinh_tinh tu CSDL
  $sql_tinh_type = "SELECT `type` FROM `tinh` WHERE name = '$tinh_type'";
  $result_tinh_type = mysql_query($sql_tinh_type);
  $row_tinh_type = mysql_fetch_array($result_tinh_type);

  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I13', $row["quequan_xa"]." - ".$row_huyen["name"]." - ".$row_tinh["name"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T9', $xa_type);//Nơi sinh xã
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC9', ', '.$row_huyen_type["type"]);//type của huyện
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI9', $huyen_type);//Nơi sinh huyện
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ9', ', '.$row_tinh_type["type"]);//type của tỉnh
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AW9', $tinh_type);//Nơi sinh tỉnh
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T10', $row["quequan_xa"]);//Quê quán xã
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC10', ', '.$row_huyen["type"]);//type của huyện
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI10', $row_huyen["name"]);//Quê quán huyện
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ10', ', '.$row_tinh["type"]);//type của tỉnh
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AW10', $row_tinh["name"]);//Quê quán tỉnh

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L15', $row["noiohiennay"]);
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AV14', $row["dienthoai"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H12', $row["dantoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG12', $row["tongiao"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R13', $row["hokhauthuongtru"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U16', $row["xuatthan"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U17', $row["nghetruoctuyendung"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M18', $row["coquantuyendung"]);
  if($ngaytd_row["ngayhdlamviec"] == '0000-00-00') {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT17', "");
  } else {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT17', date("d-m-Y", strtotime($ngaytd_row["ngayhdlamviec"])));
  };
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA21', date("d-m-Y", strtotime($row["coquanhientai_ngayvao"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AY21', (($row["cachmang_ngayvao"] != '0000-00-00') ? date('d-m-Y', strtotime($row["cachmang_ngayvao"])) : ''));
  
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q21', $row["congtacdanglam"]);
  /// Quá trình lương
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X22', $qtl_row['ngach']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS22', $qtl_row['mangach']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G23', $qtl_row['bac']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q23', $qtl_row['heso']);  
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF23', $qtl_row['thang'] . '/' . $qtl_row['nam']);
  /// end Quá trinh lương

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J24', $row["phucapchucvu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z24', $row["phucapkhac"]);
  //
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK25', $row["giaoducphothong"]."/12");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T26', $row["hochamcaonhat_ten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M28', $row["lyluanchinhtri"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK28', $row["quanlynhanuoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J30', $row["ngoaingu_ten"]." - ".$row["ngoaingu_trinhdo"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC30', $row["tinhoc_trinhdo"]);
  
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U32', (($row["dangcongsan_ngayvao"] != '0000-00-00') ? date('d-m-Y', strtotime($row["dangcongsan_ngayvao"])) : ''));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO32', (($row["dangcongsan_ngaychinhthuc"] != '0000-00-00') ? date('d-m-Y', strtotime($row["dangcongsan_ngaychinhthuc"])) : ''));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W33', (($row["ngaythamgiatc"] != '0000-00-00') ? date('d-m-Y', strtotime($row["ngaythamgiatc"])) : ''));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI33', $row["noithamgiatc"]);
  
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K35', (($row["ngaynhapngu"] != '0000-00-00') ? date('d-m-Y', strtotime($row["ngaynhapngu"])) : ''));
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K35', date("d-m-Y", strtotime($row["ngaynhapngu"])));

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z35', (($row["ngayxuatngu"] != '0000-00-00') ? date('d-m-Y', strtotime($row["ngayxuatngu"])) : ''));
  if($row["quanhamcaonhat_nam"]!=0)
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AR35', $row["quanhamcaonhat_ten"]." - Năm: ".$row["quanhamcaonhat_nam"]);
  if($row["danhhieu_nam"]!=0)
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V36', $row["danhhieu_ten"]." - ".$row["danhhieu_nam"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M38', $row["sotruongcongtac"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J45', $row["sosobaohiem"]);
  if($row["namkhenthuong"]!=0)
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J39', $row["khenthuong"]." - Năm: ".$row["namkhenthuong"]);
  if($row["namkyluatcaonhat"]!=0)
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK39', $row["kyluatcaonhat"]." - Năm: ".$row["namkyluatcaonhat"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N41', $row["tinhtrangsuckhoe"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE41', $row["chieucao"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO41', $row["cannang"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BC41', $row["nhommau"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P44', $row["cmnd"]);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC44', (($row["ngaycapcmt"] != '0000-00-00') ? date('d-m-Y', strtotime($row["ngaycapcmt"])) : ''));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN44', $row["noicapcmt"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N42', $row["thuongbinhloai"]);
  //if ($row["giadinhlietsy"] == 1) $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG42', "Có");
  //else $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG42', "Không");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG42', $row["giadinhlietsy"]);

  
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL126', $row["luong"]);
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P127', $row["thunhapkhac"]);

  // Dien bang daotao muc DAOTAO
  $sql_daotao = "SELECT * FROM `daotao` WHERE lylich_id = '$lylich_id' and daotao_boiduong = 0";
  $result_daotao = mysql_query($sql_daotao);
  // Dong dau tien
  $i = 52;
  while ($row_daotao = mysql_fetch_array($result_daotao)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), $row_daotao["tentruong"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($i), $row_daotao["nganhhoc"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.(string)($i), $row_daotao["thoigianhoc"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL'.(string)($i), $row_daotao["hinhthuchoc"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AU'.(string)($i), $row_daotao["vanbang"]);
    $i++;
  }

  // Dien bang daotao muc BOIDUONG
  $sql_daotao = "SELECT * FROM `daotao` WHERE lylich_id = '$lylich_id' and daotao_boiduong = 1";
  $result_daotao = mysql_query($sql_daotao);
  // Dong dau tien
  $i = 59;
  while ($row_daotao = mysql_fetch_array($result_daotao)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), $row_daotao["tentruong"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($i), $row_daotao["nganhhoc"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.(string)($i), $row_daotao["thoigianhoc"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL'.(string)($i), $row_daotao["hinhthuchoc"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AU'.(string)($i), $row_daotao["vanbang"]);
    $i++;
  }

  // Dien bang congtac
  $sql_congtac = "SELECT * FROM `congtac` WHERE lylich_id = '$lylich_id' order by id asc";
  $result_congtac = mysql_query($sql_congtac);
  $count_congtac = mysql_num_rows($result_congtac);
  // Dong dau tien
  $i = 68;
  while ($row_congtac = mysql_fetch_array($result_congtac)){
    if ($i - 68 == $count_congtac - 1) $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), date("m-Y", strtotime($row_congtac["thoidiem_batdau"]))." đến nay");
    else $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), date("m-Y", strtotime($row_congtac["thoidiem_batdau"]))." đến ".date("m-Y", strtotime($row_congtac["thoidiem_ketthuc"])));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($i), $row_congtac["chucvu"]);
    $i++;
  }

  // Dien bang phamphap
  $sql_phamphap = "SELECT * FROM `phamphap` WHERE lylich_id = '$lylich_id'";
  $result_phamphap = mysql_query($sql_phamphap);
  // Dong dau tien
  $i = 84;
  while ($row_phamphap = mysql_fetch_array($result_phamphap)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), $row_phamphap["lydo"]." - Từ ".date("d-m-Y", strtotime($row_phamphap["thoidiem_batdau"]))." đến ".date("d-m-Y", strtotime($row_congtac["thoidiem_ketthuc"]))
    ." Ở: ".$row_phamphap["odau"]." Báo cho: ".$row_phamphap["khaibaocho"]." Về vđ: ".$row_phamphap["vande"]);
    $i++;
  }

  // Dien bang chedocu
  $sql_chedocu = "SELECT * FROM `chedocu` WHERE lylich_id = '$lylich_id'";
  $result_chedocu = mysql_query($sql_chedocu);
  // Dong dau tien
  $i = 87;
  while ($row_chedocu = mysql_fetch_array($result_chedocu)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), "Cơ quan: ".$row_chedocu["coquan"]." Đơn vị: ".$row_chedocu["donvi"]." Địa điểm: ".$row_chedocu["diadiem"]
    ." Chức vụ: ".$row_chedocu["chucvu"]." Thời gian: ".$row_chedocu["thoigian"]);
    $i++;
  }

  // Dien bang tochucnuocngoai
  $sql_tochucnuocngoai = "SELECT * FROM `tochucnuocngoai` WHERE lylich_id = '$lylich_id'";
  $result_tochucnuocngoai = mysql_query($sql_tochucnuocngoai);
  // Dong dau tien
  $i = 93;
  while ($row_tochucnuocngoai = mysql_fetch_array($result_tochucnuocngoai)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), "Làm: ".$row_tochucnuocngoai["lamgi"]." Tổ chức: ".$row_tochucnuocngoai["tochuc"]." Trụ sở: ".$row_tochucnuocngoai["truso"]);
    $i++;
  }

  // Dien bang thannhannuocngoai
  $sql_thannhannuocngoai = "SELECT * FROM `thannhannuocngoai` WHERE lylich_id = '$lylich_id'";
  $result_thannhannuocngoai = mysql_query($sql_thannhannuocngoai);
  // Dong dau tien
  $i = 96;
  while ($row_thannhannuocngoai = mysql_fetch_array($result_thannhannuocngoai)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), "Quan hệ: ".$row_thannhannuocngoai["quanhe"]." Họ tên: ".$row_thannhannuocngoai["hoten"]." Làm: ".$row_thannhannuocngoai["lamgi"]
    ." Địa chỉ: ".$row_thannhannuocngoai["diachi"]);
    $i++;
  }

  // Dien bang quanhegiadinh muc BANTHAN
  $sql_qhgd = "SELECT * FROM `quanhegiadinh` WHERE lylich_id = '$lylich_id' and banthan_vochong = 0";
  $result_qhdg = mysql_query($sql_qhgd);
  // Dong dau tien
  $i = 103;
  while ($row_qhgd = mysql_fetch_array($result_qhdg)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), $row_qhgd["quanhe"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($i), $row_qhgd["hoten"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($i), $row_qhgd["namsinh"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($i), $row_qhgd["mota"]);
    $i++;
  }

  // Dien bang quanhegiadinh muc BANTHAN
  $sql_qhgd = "SELECT * FROM `quanhegiadinh` WHERE lylich_id = '$lylich_id' and banthan_vochong = 1";
  $result_qhdg = mysql_query($sql_qhgd);
  // Dong dau tien
  $i = 115;
  while ($row_qhgd = mysql_fetch_array($result_qhdg)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), $row_qhgd["quanhe"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($i), $row_qhgd["hoten"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($i), $row_qhgd["namsinh"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($i), $row_qhgd["mota"]);
    $i++;
  }

  // Dien bang quatrinhluong
  /*$sql_qtl = "SELECT * FROM `quatrinhluong` WHERE lylich_id = '$lylich_id'";
  $result_qtl = mysql_query($sql_qtl);
  $mang_column = array("K","S","AA","AI","AQ","AY");
  // Dong dau tien
  $i = 0;
  while ($row_qtl = mysql_fetch_array($result_qtl)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i]."123", $row_qtl["thoidiem"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i]."124", $row_qtl["ngach"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i]."125", $row_qtl["bac"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i]."126", $row_qtl["heso"]);
    $i++;
  }*/

  // Dien bang quatrinhluong
  $sql_qtl = "SELECT * FROM `quatrinhluong` WHERE lylich_id = '$lylich_id'";
  $result_qtl = mysql_query($sql_qtl);  
  // Dong dau tien
  $i = 124;
  while ($row_qtl = mysql_fetch_array($result_qtl)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), $row_qtl["thoidiem"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.(string)($i), $row_qtl["ngach"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($i), $row_qtl["bac"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.(string)($i), $row_qtl["heso"]);
    $i++;
  }

  // Dien bang thidua
  /*$sql_thidua = "SELECT * FROM `thidua` WHERE lylich_id = '$lylich_id'";
  $result_thidua = mysql_query($sql_thidua);
  $mang_column = array("L","AB","AR");
  // Dong dau tien
  $i = 0; $j = 137;
  while ($row_thidua = mysql_fetch_array($result_thidua)){
    if ($i == 3) $j = 139;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i].(string)($j), $row_thidua["nam"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i].(string)($j+1), $row_thidua["danhhieu"]);
    $i++;
  }*/

  // Tao file da xong du lieu
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save("../../file_export/lylich/".$row["cmnd"].".xlsx");

  }

  header("Location: ../../file_export/lylich/".$row["cmnd"].".xlsx");
?>
