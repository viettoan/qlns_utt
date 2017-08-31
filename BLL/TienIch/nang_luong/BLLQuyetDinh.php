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


  if (!file_exists("../../../file_export/nang_luong/quyetdinh_form.xlsx")) {
    exit("File mau quyet nang luong khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../../file_export/nang_luong/quyetdinh_form.xlsx");
  $styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman',
        'size'  => '13'
  ));
  $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:Z100')->applyFromArray($styleArray);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3',  $objPHPExcel->getActiveSheet()->getCell('F3')->getValue()."ngày ".date("d")." tháng ".date("m")." năm ".date("Y"));

  //Start Hàm tiện ích
  function TangBac($baccu){
    $tmp=explode('/',$baccu);
    if(count($tmp)==2){
      $tu=$tmp[0];
      $mau=$tmp[1];
      $tu=$tu+1;
      if($tu>$mau) return $baccu;
      else return $tu."/".$mau;
    }
    else return "";
  }
  function CheckVuotKhung($baccu){
    $tmp=explode('/',$baccu);
    if(count($tmp)==2){
      $tu=$tmp[0];
      $mau=$tmp[1];      
      if($tu==$mau) return true;
      else return false;
    }
    else return false;
  }
  function TangVuotKhung($vuotkhung){
    if(strpos($vuotkhung,'%')>0){
      $tmp=substr($vuotkhung,0,strlen($vuotkhung)-1);
      if(intval($tmp)==0){
        return 0;      
      }
      else return intval($tmp)+1;      
    }else{
      return intval($vuotkhung)+1;
    }
    
  }
  function getHeSoByBac($bac,$ngachid){
    $sql = "SELECT heso FROM `bac_heso` WHERE bac = '$bac' AND ngachid='$ngachid'";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)){
      return $row["heso"];
    }  
    return "";
  }
  function getNgachIdByMaNgach($mangach){
    $sql = "SELECT id FROM `ngach` WHERE mangach = '$mangach'";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)){
      return $row["id"];
    }  
    return "";
  }
  //End Hàm tiện ích
  // Lay du lieu tu CSDL
  $sql = "SELECT * FROM lylich WHERE id = '$lylich_id'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);

  //$sql_qtluong = "SELECT * FROM quatrinhluong WHERE lylich_id = '$lylich_id' ORDER BY thoidiem DESC LIMIT 1";  
  $sql_qtluong = "SELECT *, date_add(thoidiem, INTERVAL  3 YEAR) as thoidiemtinh, date_add(thoidiem, INTERVAL  1 YEAR) as thoidiemtinhvk1nam FROM quatrinhluong WHERE lylich_id = $lylich_id ORDER BY thoidiem DESC LIMIT 1";
  $result_qtluong = mysql_query($sql_qtluong);
  $row_qtluong = mysql_fetch_array($result_qtluong);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C13', $objPHPExcel->getActiveSheet()->getCell('C13')->getValue().$row["hoten"]);

  $bacmoi=TangBac($row_qtluong["bac"]);
  $ngachid= getNgachIdByMaNgach($row_qtluong["mangach"]);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B14', $objPHPExcel->getActiveSheet()->getCell('B14')->getValue().$row_qtluong["bac"]);//từ bậc
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D14', $objPHPExcel->getActiveSheet()->getCell('D14')->getValue().$row_qtluong["heso"]);//từ hệ số
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F14', $objPHPExcel->getActiveSheet()->getCell('F14')->getValue().$row_qtluong["ngach"]);//từ ngạch
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B15', $objPHPExcel->getActiveSheet()->getCell('B15')->getValue().$bacmoi);//lên bậc
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D15', $objPHPExcel->getActiveSheet()->getCell('D15')->getValue().getHeSoByBac($bacmoi,$ngachid)." ");//lên hệ số
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F15', $objPHPExcel->getActiveSheet()->getCell('F15')->getValue().$row_qtluong["ngach"]);//lên ngạch
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B16', $objPHPExcel->getActiveSheet()->getCell('B16')->getValue().(($row_qtluong["thoidiem"] == "0000-00-00") ? "" : date("d-m-Y",strtotime($row_qtluong["thoidiemtinh"]))));
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C17', $objPHPExcel->getActiveSheet()->getCell('C17')->getValue().$row_qtluong["donvicoso"].", ");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C17', $objPHPExcel->getActiveSheet()->getCell('C17')->getValue()."Đơn vị trực thuộc".", ");
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B18', $objPHPExcel->getActiveSheet()->getCell('B18')->getValue().$row["hoten"]);

  // Tao file da xong du lieu
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save("../../../file_export/nang_luong/Quyet dinh nang luong voi can bo ".$row["cmnd"].".xlsx");
  }
  header("Location: ../../../file_export/nang_luong/Quyet dinh nang luong voi can bo ".$row["cmnd"].".xlsx");
?>
