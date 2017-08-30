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
  //$songayconlai = "30 DAY";
  /** Include PHPExcel_IOFactory */
  require_once '../../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';


  if (!file_exists("../../../file_export/huu_tri/danhsach_form.xlsx")) {
    exit("File mau danh sach huu tri khong tim thay!" . EOL);
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../../file_export/huu_tri/danhsach_form.xlsx");

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', '2017');

  // Lay du lieu tu CSDL
  $i = 1;
  $r = 7; // Dong dau tien


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

  // Thong bao truoc 6 thang han 60 tuoi NAM hoac 55 tuoi NU
  $sql = "SELECT *, datediff(ngaynghihuu, date(now())) as songayconlai
          FROM (
            SELECT id, hoten, ngaysinh, sohieucanbo, gioitinh, chucvu, bomonto_id, cosodaotao_id, khoaphongban_id,
              (CASE 
                WHEN gioitinh = 1 THEN DATE_ADD(ngaysinh, INTERVAL 60 YEAR) 
                ELSE DATE_ADD(ngaysinh, INTERVAL 55 YEAR) 
              END) as 'ngaynghihuu'
            FROM lylich  
          ) H
          WHERE year(H.ngaynghihuu) = 2017 
          ORDER BY ngaynghihuu";
  $result = mysql_query($sql);
  while ($row = mysql_fetch_array($result)){
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $row["hoten"]);
	  if ($row["gioitinh"] == 1)
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), date("d-m-Y",strtotime($row["ngaysinh"])));
    else
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), date("d-m-Y",strtotime($row["ngaysinh"])));
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.(string)($r), 
      ( $row["chucvu"] == "" ? "" : ($row["chucvu"] . " - ") ) . 
      ( $row["donvicoso"] == "" ? "" : ($row["donvicoso"] . " - ") ) . 
      ( get_bmt($row["bomonto_id"]) == "" ? "" : (get_bmt($row["bomonto_id"]) . " - ")  ) . 
      ( get_kpb($row["khoaphongban_id"]) == "" ? "" : (get_kpb($row["khoaphongban_id"]) . " - ") ) . 
      ( get_csdt($row["cosodaotao_id"]) == "" ? "" : (get_csdt($row["cosodaotao_id"])))
    );

    $sql = "SELECT * FROM quatrinhluong WHERE lylich_id = " . $row['id'] . " AND thoidiem = (SELECT max(thoidiem) FROM quatrinhluong WHERE lylich_id=" . $row['id'] . ")";
    $result_ngach = mysql_query($sql);
    $row_ngach = mysql_fetch_array($result_ngach);
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), $row_ngach["ngach"]);

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), date("d-m-Y",strtotime($row["ngaynghihuu"])));

    $result_nghihuu = mysql_query("SELECT * FROM luanchuyen WHERE canbo_id = " . $row['id']);
    $row_nghihuu = mysql_fetch_array($result_nghihuu);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.(string)($r), ($row_nghihuu["ngaydieuchuyen"] == '') ? '' :date("d-m-Y",strtotime($row_nghihuu["ngaydieuchuyen"])));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row_nghihuu["lydodieuchuyen"]);
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
	    'A7:' . 
	    'J' . (string)($r-1)
	)->applyFromArray($styleArray);

	  // Tao file da xong du lieu
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save("../../../file_export/huu_tri/Danh sach can bo sap nghi huu.xlsx");
	}
  header("Location: ../../../file_export/huu_tri/Danh sach can bo sap nghi huu.xlsx");
?>
