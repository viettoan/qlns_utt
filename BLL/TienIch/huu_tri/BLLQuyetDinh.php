<?php
  ob_start();
  session_start();
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else { 
  require("../../../config/config.php");
  $lylich_id = $_GET["lylich_id"];

  // Lay mau form va tao file ly lich cho CB
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  date_default_timezone_set('Europe/London');

  /** Include PHPExcel_IOFactory */
  require_once '../../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';


  if (!file_exists("../../../file_export/huu_tri/quyetdinh_form.xlsx")) {
    exit("File mau quyet huu tri khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../../file_export/huu_tri/quyetdinh_form.xlsx");
  $styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman',
        'size'  => '13'
  ));
  $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:Z100')->applyFromArray($styleArray);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', "ngày ".date("d")." tháng ".date("m")." năm ".date("Y"));

  function get_csdt($id) { // Cơ sở đào tạo
    $sql = "SELECT * FROM cosodaotao WHERE cosodaotaoid=$id";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row['name'];
  }

  function get_kpb($id) { // KHoa phòng ban
    $sql = "SELECT * FROM khoaphongban WHERE khoaphongbanid=$id";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row['name'];
  }

  function get_bmt($id) { // Bộ môn tổ
    $sql = "SELECT * FROM bomonto WHERE bomontoid=$id";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row['name'];
  }
  // Lay du lieu tu CSDL
  $sql = "SELECT * FROM lylich WHERE id = '$lylich_id'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C18', $objPHPExcel->getActiveSheet()->getCell('C18')->getValue()." ".$row["hoten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G18', $objPHPExcel->getActiveSheet()->getCell('G18')->getValue()." ".$row["sosobaohiem"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B19', $objPHPExcel->getActiveSheet()->getCell('B19')->getValue()." ".date("d-m-Y", strtotime($row["ngaysinh"])));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B20', $objPHPExcel->getActiveSheet()->getCell('B20')->getValue()." ".$row["noisinh"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B21', $objPHPExcel->getActiveSheet()->getCell('B21')->getValue()." ".$row["chucvu"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B22', $objPHPExcel->getActiveSheet()->getCell('B22')->getValue()." ".
    ( get_bmt($row["bomonto_id"]) == "" ? "" : (get_bmt($row["bomonto_id"]) . " - ")  ) . 
      ( get_kpb($row["khoaphongban_id"]) == "" ? "" : (get_kpb($row["khoaphongban_id"]) . " - ") ) . 
      ( get_csdt($row["cosodaotao_id"]) == "" ? "" : (get_csdt($row["cosodaotao_id"]))));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B23', $objPHPExcel->getActiveSheet()->getCell('B23')->getValue()." "."ngày ".date("d")." tháng ".date("m")." năm ".date("Y"));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B24', $objPHPExcel->getActiveSheet()->getCell('B24')->getValue()." ".$row["noiohiennay"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C26', $objPHPExcel->getActiveSheet()->getCell('C26')->getValue()." ".$row["hoten"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A30', $objPHPExcel->getActiveSheet()->getCell('A30')->getValue()." ".$row["hoten"]);

  // Tao file da xong du lieu
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save("../../../file_export/huu_tri/Quyet dinh nghi huu voi can bo ".$row["cmnd"].".xlsx");
  }
  header("Location: ../../../file_export/huu_tri/Quyet dinh nghi huu voi can bo ".$row["cmnd"].".xlsx");
?>
