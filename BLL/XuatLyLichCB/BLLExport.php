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
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', $row["botinh"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', $row["donvitructhuoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', $row["donvicoso"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X6', $row["hoten"]);
  if ($row["gioitinh"] == 1) $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AZ6', "Nam");
  else  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AZ6', "Nữ");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W7', $row["tengoikhac"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V8', $row["capuyhientai"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS8', $row["capuykiem"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R10', $row["chucvu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S12', date("d-m-Y", strtotime($row["ngaysinh"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL12', $row["noisinh"]);

    // Lay quequan_huyen tu CSDL
  $huyen = $row["quequan_huyen"];
  $tinh = $row["quequan_tinh"];

  $sql_huyen = "SELECT `name` FROM `huyen` WHERE districtid = '$huyen'";
  $result_huyen = mysql_query($sql_huyen);
  $row_huyen = mysql_fetch_array($result_huyen);

    // Lay quequan_tinh tu CSDL
  $sql_tinh = "SELECT `name` FROM `tinh` WHERE provinceid = '$tinh'";
  $result_tinh = mysql_query($sql_tinh);
  $row_tinh = mysql_fetch_array($result_tinh);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I13', $row["quequan_xa"]." - ".$row_huyen["name"]." - ".$row_tinh["name"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L14', $row["noiohiennay"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AV14', $row["dienthoai"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H15', $row["dantoc"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC15', $row["tongiao"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U16', $row["xuatthan"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB18', $row["nghetruoctuyendung"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q20', date("d-m-Y", strtotime($row["ngaytuyendung"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA21', date("d-m-Y", strtotime($row["coquanhientai_ngayvao"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AY21', date("d-m-Y", strtotime($row["cachmang_ngayvao"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X22', date("d-m-Y", strtotime($row["dangcongsan_ngayvao"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT22', date("d-m-Y", strtotime($row["dangcongsan_ngaychinhthuc"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC23', "Đoàn TNCS: ".date("d-m-Y", strtotime($row["doantncs_ngayvao"]))." Công đoàn: ".date("d-m-Y", strtotime($row["congdoan_ngayvao"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M25', date("d-m-Y", strtotime($row["ngaynhapngu"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD25', date("d-m-Y", strtotime($row["ngayxuatngu"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AY25', $row["quanhamcaonhat_ten"]." - ".$row["quanhamcaonhat_nam"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z26', $row["giaoducphothong"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT26', $row["hochamcaonhat_ten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M28', $row["lyluanchinhtri"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG28', $row["ngoaingu_ten"]." - ".$row["ngoaingu_trinhdo"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R30', $row["congtacdanglam"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M31', $row["ngachcongchuc_ten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X31', $row["ngachcongchuc_maso"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ31', $row["ngachcongchuc_bacluong"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ31', $row["ngachcongchuc_heso"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BA31', $row["ngachcongchuc_thang"]."/".$row["ngachcongchuc_nam"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V32', $row["danhhieu_ten"]." - ".$row["danhhieu_nam"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O34', $row["sotruongcongtac"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT34', $row["congvieclaunhat"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P38', $row["tinhtrangsuckhoe"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF38', $row["chieucao"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AP38', $row["cannang"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BD38', $row["nhommau"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R40', $row["cmnd"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM40', $row["thuongbinhloai"]);
  if ($row["giadinhlietsy"] == 1) $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BC40', "Có");
  else $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BC40', "Không");

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L35', $row["khenthuong"]." - Năm: ".$row["namkhenthuong"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL126', $row["luong"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P127', $row["thunhapkhac"]);

  // Dien bang daotao muc DAOTAO
  $sql_daotao = "SELECT * FROM `daotao` WHERE lylich_id = '$lylich_id' and daotao_boiduong = 0";
  $result_daotao = mysql_query($sql_daotao);
  // Dong dau tien
  $i = 49;
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
  $i = 56;
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
  $i = 66;
  while ($row_congtac = mysql_fetch_array($result_congtac)){
    if ($i - 66 == $count_congtac - 1) $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), date("m-Y", strtotime($row_congtac["thoidiem_batdau"]))." đến nay");
    else $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), date("m-Y", strtotime($row_congtac["thoidiem_batdau"]))." đến ".date("m-Y", strtotime($row_congtac["thoidiem_ketthuc"])));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($i), $row_congtac["chucvu"]);
    $i++;
  }

  // Dien bang phamphap
  $sql_phamphap = "SELECT * FROM `phamphap` WHERE lylich_id = '$lylich_id'";
  $result_phamphap = mysql_query($sql_phamphap);
  // Dong dau tien
  $i = 81;
  while ($row_phamphap = mysql_fetch_array($result_phamphap)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), $row_phamphap["lydo"]." - Từ ".date("d-m-Y", strtotime($row_phamphap["thoidiem_batdau"]))." đến ".date("d-m-Y", strtotime($row_congtac["thoidiem_ketthuc"]))
    ." Ở: ".$row_phamphap["odau"]." Báo cho: ".$row_phamphap["khaibaocho"]." Về vđ: ".$row_phamphap["vande"]);
    $i++;
  }

  // Dien bang chedocu
  $sql_chedocu = "SELECT * FROM `chedocu` WHERE lylich_id = '$lylich_id'";
  $result_chedocu = mysql_query($sql_chedocu);
  // Dong dau tien
  $i = 84;
  while ($row_chedocu = mysql_fetch_array($result_chedocu)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), "Cơ quan: ".$row_chedocu["coquan"]." Đơn vị: ".$row_chedocu["donvi"]." Địa điểm: ".$row_chedocu["diadiem"]
    ." Chức vụ: ".$row_chedocu["chucvu"]." Thời gian: ".$row_chedocu["thoigian"]);
    $i++;
  }

  // Dien bang tochucnuocngoai
  $sql_tochucnuocngoai = "SELECT * FROM `tochucnuocngoai` WHERE lylich_id = '$lylich_id'";
  $result_tochucnuocngoai = mysql_query($sql_tochucnuocngoai);
  // Dong dau tien
  $i = 90;
  while ($row_tochucnuocngoai = mysql_fetch_array($result_tochucnuocngoai)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), "Làm: ".$row_tochucnuocngoai["lamgi"]." Tổ chức: ".$row_tochucnuocngoai["tochuc"]." Trụ sở: ".$row_tochucnuocngoai["truso"]);
    $i++;
  }

  // Dien bang thannhannuocngoai
  $sql_thannhannuocngoai = "SELECT * FROM `thannhannuocngoai` WHERE lylich_id = '$lylich_id'";
  $result_thannhannuocngoai = mysql_query($sql_thannhannuocngoai);
  // Dong dau tien
  $i = 93;
  while ($row_thannhannuocngoai = mysql_fetch_array($result_thannhannuocngoai)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), "Quan hệ: ".$row_thannhannuocngoai["quanhe"]." Họ tên: ".$row_thannhannuocngoai["hoten"]." Làm: ".$row_thannhannuocngoai["lamgi"]
    ." Địa chỉ: ".$row_thannhannuocngoai["diachi"]);
    $i++;
  }

  // Dien bang quanhegiadinh muc BANTHAN
  $sql_qhgd = "SELECT * FROM `quanhegiadinh` WHERE lylich_id = '$lylich_id' and banthan_vochong = 0";
  $result_qhdg = mysql_query($sql_qhgd);
  // Dong dau tien
  $i = 100;
  while ($row_qhgd = mysql_fetch_array($result_qhdg)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), $row_qhgd["quanhe"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($i), $row_qhgd["hoten"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($i), $row_qhgd["namsinh"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($i), $row_qhgd["mote"]);
    $i++;
  }

  // Dien bang quanhegiadinh muc BANTHAN
  $sql_qhgd = "SELECT * FROM `quanhegiadinh` WHERE lylich_id = '$lylich_id' and banthan_vochong = 1";
  $result_qhdg = mysql_query($sql_qhgd);
  // Dong dau tien
  $i = 112;
  while ($row_qhgd = mysql_fetch_array($result_qhdg)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($i), $row_qhgd["quanhe"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($i), $row_qhgd["hoten"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($i), $row_qhgd["namsinh"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($i), $row_qhgd["mote"]);
    $i++;
  }

  // Dien bang quatrinhluong
  $sql_qtl = "SELECT * FROM `quatrinhluong` WHERE lylich_id = '$lylich_id'";
  $result_qtl = mysql_query($sql_qtl);
  $mang_column = array("K","S","AA","AI","AQ","AY");
  // Dong dau tien
  $i = 0;
  while ($row_qtl = mysql_fetch_array($result_qtl)){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i]."121", $row_qtl["thoidiem"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i]."122", $row_qtl["ngach"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i]."123", $row_qtl["bac"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i]."124", $row_qtl["heso"]);
    $i++;
  }

  // Dien bang thidua
  $sql_thidua = "SELECT * FROM `thidua` WHERE lylich_id = '$lylich_id'";
  $result_thidua = mysql_query($sql_thidua);
  $mang_column = array("L","AB","AR");
  // Dong dau tien
  $i = 0; $j = 137;
  while ($row_thidua = mysql_fetch_array($result_thidua)){
    if ($i == 3) $j = 139;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i].(string)($j), $row_thidua["nam"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($mang_column[$i].(string)($j+1), $row_thidua["danhhieu"]);
    $i++;
  }

  // Tao file da xong du lieu
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save("../../file_export/lylich/".$row["cmnd"].".xlsx");

	}

  header("Location: ../../file_export/lylich/".$row["cmnd"].".xlsx");
?>
