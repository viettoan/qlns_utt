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

  if(isset($_GET['batdau']) && isset($_GET['ketthuc'])) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', 'TỪ ' . date("d-m-Y",strtotime($_GET['batdau'])) . ' đến ' . date("d-m-Y",strtotime($_GET['ketthuc'])));
  } else
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', $objPHPExcel->getActiveSheet()->getCell('A6')->getValue()." ".date("Y"));
  $styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman',
        'size'  => '11'
  ));
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
  $i = 1;
  $r = 11; // Dong dau tien

  // Thong bao han 3 nam ke tu lan nang luong cuoi
  $sql = "SELECT * FROM lylich WHERE trangthailamviec='Đang công tác'";
  $result = mysql_query($sql);
  $j=1;
  while ($row = mysql_fetch_array($result)){
    $lylich_id = $row["id"];
    //$sql_qtluong = "SELECT * FROM quatrinhluong WHERE lylich_id = '$lylich_id' ORDER BY thoidiem DESC LIMIT 1";
    $sql_qtluong = "SELECT *, date_add(thoidiem, INTERVAL  3 YEAR) as thoidiemtinh, date_add(thoidiem, INTERVAL  1 YEAR) as thoidiemtinhvk1nam FROM quatrinhluong WHERE lylich_id = $lylich_id ORDER BY thoidiem DESC LIMIT 1";
    if(isset($_GET['batdau']) && isset($_GET['ketthuc'])) {
      $batdau = $_GET['batdau'];
      $ketthuc = $_GET['ketthuc'];
      // $sql_qtluong = "SELECT *, date_add(thoidiem, INTERVAL  3 YEAR) as thoidiemtinh,
      //                 date_add(thoidiem, INTERVAL  1 YEAR) as thoidiemtinhvk1nam 
      //                 FROM quatrinhluong 
      //                 WHERE lylich_id = $lylich_id  
      //                 AND (date_add(thoidiem, INTERVAL  1 YEAR) > '$batdau' 
      //                       AND date_add(thoidiem, INTERVAL  1 YEAR) < '$ketthuc')
      //                 OR (date_add(thoidiem, INTERVAL  3 YEAR) > '$batdau'
      //                       AND date_add(thoidiem, INTERVAL  3 YEAR) < '$ketthuc') 
      //                 ORDER BY thoidiem DESC 
      //                 LIMIT 1";
    } else {
      $batdau = '1960-1-1';
      $ketthuc = '2050-1-1';
    }

    $result_qtluong = mysql_query($sql_qtluong);
    $row_qtluong = mysql_fetch_array($result_qtluong);

    $date1=date_create(date("Y-m-d"));
    $date2=date_create($row_qtluong["thoidiem"]);
    $diff=date_diff($date2,$date1);
    //var_dump("expression1: ".$diff);
    //var_dump("expression2: ".$diff->format("%R%a"));
    //die();
    if ((int)($diff->format("%R%a"))>3*365){
  	  /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
  	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $row["hoten"]);
  	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $row["chucvu"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), $row["ngachcongchuc_ten"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), $row["ngachcongchuc_bacluong"]);//Từ bậc
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row["ngachcongchuc_heso"]);//Từ hệ số
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($r), $row["ngachcongchuc_ten"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($r), (string)((int)($row["ngachcongchuc_bacluong"])+1));//Bậc mới
  	  */

      if(CheckVuotKhung($row_qtluong["bac"]) AND ($row_qtluong["vuotkhung"]==NULL OR $row_qtluong["vuotkhung"]=="")){
        if (!( (date($row_qtluong["thoidiemtinh"]) > date($batdau)) && (date($row_qtluong["thoidiemtinh"]) < date($ketthuc)) )) continue;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.(string)($r), "5%");//Phụ cấp thâm niên vượt khung mới
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.(string)($r), ($row_qtluong["thoidiem"] == "0000-00-00") ? "" : date("d-m-Y",strtotime($row_qtluong["thoidiemtinh"])));//Thời điểm mới
      } else if(CheckVuotKhung($row_qtluong["bac"]) AND ($row_qtluong["vuotkhung"]!=NULL OR $row_qtluong["vuotkhung"]!="") AND (int)($diff->format("%R%a"))>1*365){  
      if (!( (date($row_qtluong["thoidiemtinhvk1nam"]) > date($batdau)) && (date($row_qtluong["thoidiemtinhvk1nam"]) < date($ketthuc)) )) continue;      
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.(string)($r), TangVuotKhung($row_qtluong["vuotkhung"])."%");//Phụ cấp thâm niên vượt khung mới
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.(string)($r), ($row_qtluong["thoidiem"] == "0000-00-00") ? "" : date("d-m-Y",strtotime($row_qtluong["thoidiemtinhvk1nam"])));//Thời điểm mới
      } else {
        if (!( (date($row_qtluong["thoidiemtinh"]) > date($batdau)) && (date($row_qtluong["thoidiemtinh"]) < date($ketthuc)) )) continue;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.(string)($r), ($row_qtluong["thoidiem"] == "0000-00-00") ? "" : date("d-m-Y",strtotime($row_qtluong["thoidiemtinh"])));//Thời điểm mới
      }

      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $row["hoten"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $row["chucvu"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), $row_qtluong["ngach"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), $row_qtluong["bac"]);//Từ bậc
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row_qtluong["heso"]." ");//Từ hệ số
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($r), $row_qtluong["ngach"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($r), $row_qtluong["vuotkhung"]);//Phụ cấp thâm niên vượt khung cũ
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.(string)($r), ($row_qtluong["thoidiem"] == "0000-00-00") ? "" : date("d-m-Y",strtotime($row_qtluong["thoidiem"])));//Thời điểm cũ
      $bacmoi=TangBac($row_qtluong["bac"]);
      $ngachid= getNgachIdByMaNgach($row_qtluong["mangach"]);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($r), $bacmoi);//Bậc mới    
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.(string)($r), getHeSoByBac($bacmoi,$ngachid)." ");//Hệ số mới  

      
      
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
