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


  if (!file_exists("../../file_export/bieu_mau/m1.xlsx")) {
    exit("File mau M1 khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../file_export/bieu_mau/m1.xlsx");

  $today = date("d/m/Y"); 
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', "Tính đến ngày: ".$today);

  // Lay du lieu tu CSDL
  $i = 1;
  $r = 11; // Dong dau tien
  // Thong bao 3 thang truoc han 5 nam duoc bo nhiem lai
  $sql = "SELECT * FROM lylich WHERE 1";
  var_dump($sql);
  $result = mysql_query($sql);
  while ($row = mysql_fetch_array($result)){
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $row["hoten"]);
    if ($row["gioitinh"] == 1)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), date("d-m-Y",strtotime($row["ngaysinh"])));
    else
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), date("d-m-Y",strtotime($row["ngaysinh"])));

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.(string)($r), $row["chucvu"]);
	  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.(string)($r), $row["quequan_xa"]." - ".$row["quequan_huyen"]." - ".$row["quequan_tinh"]);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), $row["congtacdanglam"]);
    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), $row["dantoc"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.(string)($r), $row["coquanhientai_ngayvao"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.(string)($r), $row["ngachcongchuc_maso"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row["hochamcaonhat_ten"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.(string)($r), $row["hochamcaonhat_chuyennganh"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($r), 'Chính quy');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.(string)($r), $row["ngoaingu_trinhdo"]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.(string)($r), $row["tinhoc_trinhdo"]);
	  /*if ($row["hochamcaonhat_ten"] == "CĐ")
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.(string)($r), "+");
    else {
      $os = array("ĐH", "Cử nhân", "Kỹ sư");
      if (in_array($row["hochamcaonhat_ten"], $os))
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.(string)($r), "+");
      else $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "+");
    }
    
    if ($row["lyluanchinhtri"] == "Cao cấp")
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), "+");
    else if ($row["lyluanchinhtri"] == "Trung cấp")
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.(string)($r), "+");
    else $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($r), "+");

    if ($row["ngoaingu_trinhdo"] == "A")
  	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.(string)($r), "+");
    else if ($row["ngoaingu_trinhdo"] == "B")
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.(string)($r), "+");
    else $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.(string)($r), "+");

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.(string)($r), date("d-m-Y",strtotime($row["doantncs_ngayvao"])));
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.(string)($r), date("d-m-Y",strtotime($row["dangcongsan_ngayvao"])));
	  */
	  $r++;
	  $i++;
	}
  $styleArray = array(
          'borders' => array(
              'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
              )
          )
      );
	$objPHPExcel->getActiveSheet()->getStyle(
	    'A10:' . 
	    'O' . (string)($r-1)
	)->applyFromArray($styleArray);

	  // Tao file da xong du lieu
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save("../../file_export/bieu_mau/Mau M1.xlsx");
	}
  header("Location: ../../file_export/bieu_mau/Mau M1.xlsx");
?>
