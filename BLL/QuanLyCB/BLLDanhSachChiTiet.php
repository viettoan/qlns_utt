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


  if (!file_exists("../../file_export/danhsach_chitiet_form.xlsx")) {
    exit("File mau danh sach chi tiet khong tim thay!" . EOL);
  }

  function GetNgayHDLD($id) {
    $sql_hd = "SELECT id, lylich_id, MAX(ngayhdlaodong) AS 'max' from hopdong  where lylich_id = $id";
    $result_hd = mysql_query($sql_hd);
    if ($result_hd && mysql_num_rows($result_hd) == 1){
      $array = mysql_fetch_assoc($result_hd);
      return $array['max'] != '0000-00-00' ? date("d-m-Y",strtotime($array['max'])) : '';
    }
    return "";
  }

  function GetNgayHDLV($id) {
    $sql_hd = "SELECT id, lylich_id, MAX(ngayhdlamviec) AS 'max' from hopdong  where lylich_id = $id";
    $result_hd = mysql_query($sql_hd);
    if ($result_hd && mysql_num_rows($result_hd) == 1){
      $array = mysql_fetch_assoc($result_hd);
      return $array['max'] != '0000-00-00' ? date("d-m-Y",strtotime($array['max'])) : '';
    }
    return "";
  }

  function GetMaNgach($id) {
    $sql = "SELECT * from quatrinhluong where thoidiem = (select max(thoidiem) from quatrinhluong where lylich_id = $id) and lylich_id = $id";
    $result = mysql_query($sql);
    if ($result && mysql_num_rows($result) == 1){
      $array = mysql_fetch_assoc($result);
      return $array['mangach'];
    }
    return "";
  }

  function GetTenKhoa($id){
    $sql_khoa = "select name from khoaphongban where khoaphongbanid = '$id'";
    $result_khoa = mysql_query($sql_khoa);
    if ($result_khoa && mysql_num_rows($result_khoa) == 1){
      $array = mysql_fetch_assoc($result_khoa);
      return $array['name'];
    }
    return "";
  }
  function GetTenBoMon($id){
    $sql_bomon = "select name from bomonto where bomontoid = '$id'";
    $result_bomon = mysql_query($sql_bomon);
    if($result_bomon && mysql_num_rows($result_bomon) == 1){
      $array = mysql_fetch_assoc($result_bomon);
      return $array['name'];
    }
    return "";
  }

  // Lay file mau
  $objPHPExcel = PHPExcel_IOFactory::load("../../file_export/danhsach_chitiet_form.xlsx");

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5','Tính đến ngày: '.date("d-m-Y"));

  // Lay du lieu tu CSDL
  $i = 1;  
  $r = 10; // Dong dau tien

  $sql_coso = "SELECT * FROM cosodaotao WHERE 1";
  $result_coso = mysql_query($sql_coso);
  while ($row_coso = mysql_fetch_array($result_coso)){
    $cosodaotao_id = $row_coso["cosodaotaoid"];
    $cosodaotao_name = $row_coso["name"];
	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $cosodaotao_name);//cơ sở đào tạo
    $objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.(string)($r), $cosodaotao_name)->getFont()->setBold(true);
    //$objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.(string)($r), $cosodaotao_name)->getFont()->setBold(true)->getColor()->setRGB('6F6F6F');
    $r++;

    $sql_tochuc = "SELECT * FROM tochuctructhuoc WHERE cosodaotaoid='$cosodaotao_id'";
    $result_tochuc = mysql_query($sql_tochuc);
    while ($row_tochuc = mysql_fetch_array($result_tochuc)){
      $tochuc_id = $row_tochuc["tochuctructhuocid"];
      //$tochuc_name = $row_tochuc["name"];
      $tochuc_name = mb_strtoupper($row_tochuc["name"],'UTF-8');
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $tochuc_name);    
      $objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.(string)($r))->getFont()->setItalic(true)->setBold(true);  
      $r++;
      //start các con trực tiếp của tổ chức trực thuộc
      $sql_lylich = "SELECT * FROM lylich WHERE cosodaotao_id = '$cosodaotao_id' and tochuctructhuoc_id = '$tochuc_id' and khoaphongban_id = 0 and bomonto_id = 0";
      $result_lylich = mysql_query($sql_lylich);
      $j = 1;
      while ($row_lylich = mysql_fetch_array($result_lylich)){
        $lylich_id = $row_lylich["id"];
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $j);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $row_lylich["hoten"]);
        if ($row_lylich["gioitinh"] == 1)
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), "Nam");
        else
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), "Nữ");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.(string)($r), date("d-m-Y",strtotime($row_lylich["ngaysinh"])));        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), GetNgayHDLV($row_lylich["id"]));
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), date("d-m-Y",strtotime($row_lylich["ngaytuyendung"])));
        // if ($row_lylich["ngaytuyendung"] == '0000-00-00') {
        //   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), '');
        // }
        if (GetNgayHDLV($row_lylich["id"]) == "") {
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "CBC");
        } else {
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "Cơ Hữu");
        }
        // if ($row_lylich["ngaytuyendung"] == null || $row_lylich["ngaytuyendung"] == '0000-00-00')
        //   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "CBC");
        // else
        //   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "Cơ Hữu");


        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.(string)($r), GetNgayHDLD($row_lylich["id"])); 
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.(string)($r), GetMaNgach($row_lylich["id"]));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row_lylich["ngoaingu_ten"].'-'.$row_lylich["ngoaingu_trinhdo"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.(string)($r), $row_lylich["tinhoc_trinhdo"]);

        //Xử lý Chuyên ngành đào tạo (ĐH; Ths; Ts)
        $chuyennganh = "";       
        $hocvi = "Đang học";
        $namTN = "";
        $hocviNuocNgoai = "";
        $sql_daotao_DH = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND (vanbang = 'Cử nhân' OR vanbang = 'Kỹ sư') AND thoigianhoc IS NOT NULL";
        $result_daotao_DH = mysql_query($sql_daotao_DH);      
        while ($row_daotao_DH = mysql_fetch_array($result_daotao_DH)){          
          $chuyennganh = $chuyennganh."ĐH: ".$row_daotao_DH["nganhhoc"];
          $hocvi = "ĐH"; 
          $hocviNuocNgoai = $row_daotao_DH["noidaotao"];
          if ($hocviNuocNgoai == 'Ngoài nước')
            $hocviNuocNgoai = "Đại học";
          $namTN = $row_daotao_DH["thoigianhoc"];
          $namTN = explode('-',$namTN);
          $namTN = explode('/',$namTN[1]);
          $namTN = $namTN[1];
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.(string)($r), $namTN);
        }
        $sql_daotao_Ths = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'Ths' AND thoigianhoc IS NOT NULL";
        $result_daotao_Ths = mysql_query($sql_daotao_Ths);      
        while ($row_daotao_Ths = mysql_fetch_array($result_daotao_Ths)){          
          $chuyennganh = $chuyennganh.";Ths: ".$row_daotao_Ths["nganhhoc"];
          $hocvi = "Ths";
          $hocviNuocNgoai = $row_daotao_Ths["noidaotao"];
          if ($hocviNuocNgoai == 'Ngoài nước')
            $hocviNuocNgoai = "Thạc sỹ";
          $namTN = $row_daotao_Ths["thoigianhoc"];
          $namTN = explode('-',$namTN);
          $namTN = explode('/',$namTN[1]);
          $namTN = $namTN[1];
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.(string)($r), $namTN);
        }
        $sql_daotao_Ts = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'TS' AND thoigianhoc IS NOT NULL";
        $result_daotao_Ts = mysql_query($sql_daotao_Ts);      
        while ($row_daotao_Ts = mysql_fetch_array($result_daotao_Ts)){          
          $chuyennganh = $chuyennganh.";Ts: ".$row_daotao_Ts["nganhhoc"];
          $hocvi = "Ts";
          $hocviNuocNgoai = $row_daotao_Ts["noidaotao"];
          if ($hocviNuocNgoai == 'Ngoài nước')
            $hocviNuocNgoai = "Tiến sỹ";
          $namTN = $row_daotao_Ts["thoigianhoc"];
          $namTN = explode('-',$namTN);
          //$namTN = $namTN[1];
          echo "namTN 1: ".$namTN[1];
          $namTN = explode('/',$namTN[1]);
          $namTN = $namTN[1];
          echo "namTN 2: ".$namTN;
          //die();
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.(string)($r), $namTN);
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($r), $chuyennganh);
        //End Xử lý Chuyên ngành đào tạo (ĐH; Ths; Ts)
        
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.(string)($r), $hocvi);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.(string)($r), $row_lylich["chucvu"]);        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($r), (($row_lylich["chucvudate"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["chucvudate"])): ''));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($r), $row_lylich["phucapchucvu"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.(string)($r), $row_lylich["phucaptrachnhiem"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($r), $row_lylich["phucapquansu"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($r), $row_lylich["chucdanhkhoahoc"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.(string)($r), $row_lylich["phucapquansu"]);
        //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($r), $row_lylich["dieuchuyen"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.(string)($r), (($row_lylich["ngaynhapngu"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["ngaynhapngu"])): ''));           
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.(string)($r), $row_lylich["chungchiNVSP"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.(string)($r), $row_lylich["phucapgiaovien"]);  
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.(string)($r), GetTenBoMon($row_lylich["bomonto_id"]));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.(string)($r), GetTenKhoa($row_lylich["khoaphongban_id"]));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.(string)($r), $hocviNuocNgoai);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI'.(string)($r), $row_lylich["quanlynhanuoc"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ'.(string)($r), $row_lylich["lyluanchinhtri"]);
        //Xử lý Năm cử đi học, Ngành cử đi học (ĐH; Ths; Ts)
        $chuyennganh="";       
        $hocvi = "Đang học";
        $namTN = "";
        $hocviNuocNgoai = "";
        //$sql_daotao_DH = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND (vanbang = 'Cử nhân' OR vanbang = 'Kỹ sư') AND ngaycudi IS NOT NULL";
        $sql_daotao_DH = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND ngaycudi IS NOT NULL AND ngaycudi != ''";
        $result_daotao_DH = mysql_query($sql_daotao_DH);      
        while ($row_daotao_DH = mysql_fetch_array($result_daotao_DH)){          
          //$chuyennganh = $chuyennganh."ĐH: ".$row_daotao_DH["nganhhoc"]." ".$row_daotao_DH["ngaycudi"];
          $chuyennganh = $chuyennganh.$row_daotao_DH["vanbang"].": ".$row_daotao_DH["nganhhoc"]." ".$row_daotao_DH["ngaycudi"]."; ";
          $namcudi = $row_daotao_DH["ngaycudi"];                     
        }
        /*$sql_daotao_Ths = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'Ths' AND ngaycudi IS NOT NULL";
        $result_daotao_Ths = mysql_query($sql_daotao_Ths);      
        while ($row_daotao_Ths = mysql_fetch_array($result_daotao_Ths)){          
          $chuyennganh = $chuyennganh."; Ths: " + $row_daotao_Ths["nganhhoc"]." ".$row_daotao_Ths["ngaycudi"];
          $namcudi = $row_daotao_Ths["ngaycudi"];   
        }
        $sql_daotao_Ts = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'TS' AND ngaycudi IS NOT NULL";
        $result_daotao_Ts = mysql_query($sql_daotao_Ts);      
        while ($row_daotao_Ts = mysql_fetch_array($result_daotao_Ts)){          
          $chuyennganh = $chuyennganh."; Ts: " + $row_daotao_Ts["nganhhoc"]." ".$row_daotao_Ts["ngaycudi"];
          $namcudi = $row_daotao_Ts["ngaycudi"];          
        }*/        
        //End Xử lý Năm cử đi học, Ngành cử đi học (ĐH; Ths; Ts)
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL'.(string)($r), $namcudi);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM'.(string)($r), $chuyennganh);
        //Xử lý ngày hợp đồng
        $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlamviec = 'Hợp đồng 3 năm' ORDER BY ngayhdlamviec";
        $result_hopdong = mysql_query($sql_hopdong);
        $r_hopdong = mysql_fetch_array($result_hopdong);
        $ngayhopdong = (string)($r_hopdong["ngayhdlamviec"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN'.(string)($r), $ngayhopdong);
        
        $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlamviec = 'HĐ không xác định thời hạn' ORDER BY ngayhdlamviec";
        $result_hopdong = mysql_query($sql_hopdong);
        $r_hopdong = mysql_fetch_array($result_hopdong);
        $ngayhopdong = (string)($r_hopdong["ngayhdlamviec"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO'.(string)($r), $ngayhopdong);

        $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlaodong = 'Hợp đồng 3 năm' ORDER BY ngayhdlaodong";
        $result_hopdong = mysql_query($sql_hopdong);
        $r_hopdong = mysql_fetch_array($result_hopdong);
        $ngayhopdong = (string)($r_hopdong["ngayhdlaodong"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AP'.(string)($r), $ngayhopdong);
        
        $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlaodong = 'HĐ không xác định thời hạn' ORDER BY ngayhdlaodong";
        $result_hopdong = mysql_query($sql_hopdong);
        $r_hopdong = mysql_fetch_array($result_hopdong);
        $ngayhopdong = (string)($r_hopdong["ngayhdlaodong"]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ'.(string)($r), $ngayhopdong);
        //End Xử lý ngày hợp đồng
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AR'.(string)($r), (($row_lylich["dangcongsan_ngayvao"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["dangcongsan_ngayvao"])): ''));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS'.(string)($r), (($row_lylich["dangcongsan_ngaychinhthuc"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["dangcongsan_ngaychinhthuc"])): ''));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT'.(string)($r), $row_lylich["dantoc"]);

        $r++;
        $j++;
        $i++;
      }//end while ($row_lylich = mysql_fetch_array($result_lylich))
      //end các con trực tiếp của tổ chức trực thuộc

      //start khối con của tổ chức trực thuộc
      $sql_khoaphongban = "SELECT * FROM khoaphongban WHERE tochuctructhuocid = '$tochuc_id'";
      //var_dump("sql_khoaphongban: ".$sql_khoaphongban);
      //die();
      $result_khoaphongban = mysql_query($sql_khoaphongban);
      while ($row_khoaphongban = mysql_fetch_array($result_khoaphongban)){
        $khoaphongban_id = $row_khoaphongban["khoaphongbanid"];        
        $khoaphongban_name = mb_strtoupper($row_khoaphongban["name"],'UTF-8');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $khoaphongban_name);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.(string)($r))->getFont()->setBold(true);
        //$objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.(string)($r), $cosodaotao_name)->getFont()->setBold(true);
        $r++;

        //start các con trực tiếp của khoa phòng ban
        $sql_lylich = "SELECT * FROM lylich WHERE cosodaotao_id = '$cosodaotao_id' and tochuctructhuoc_id = '$tochuc_id' and khoaphongban_id = '$khoaphongban_id' and bomonto_id = 0";
        $result_lylich = mysql_query($sql_lylich);
        $j = 1;
        while ($row_lylich = mysql_fetch_array($result_lylich)){
          $lylich_id = $row_lylich["id"];
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $j);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $row_lylich["hoten"]);
          if ($row_lylich["gioitinh"] == 1)
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), "Nam");
          else
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), "Nữ");
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.(string)($r), date("d-m-Y",strtotime($row_lylich["ngaysinh"])));        
          // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), date("d-m-Y",strtotime($row_lylich["ngaytuyendung"])));
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), GetNgayHDLV($row_lylich["id"]));

          // if ($row_lylich["ngaytuyendung"] == null || $row_lylich["ngaytuyendung"] == '0000-00-00')
          //   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "CBC");
          // else
          //   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "Cơ Hữu");


          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.(string)($r), GetNgayHDLD($row_lylich["id"]));
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.(string)($r), GetMaNgach($row_lylich["id"]));
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row_lylich["ngoaingu_ten"].'-'.$row_lylich["ngoaingu_trinhdo"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.(string)($r), $row_lylich["tinhoc_trinhdo"]);
          //Xử lý Chuyên ngành đào tạo (ĐH; Ths; Ts)
          $chuyennganh = "";       
          $hocvi = "Đang học";
          $namTN = "";
          $hocviNuocNgoai = "";
          $sql_daotao_DH = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND (vanbang = 'Cử nhân' OR vanbang = 'Kỹ sư') AND thoigianhoc IS NOT NULL";
          $result_daotao_DH = mysql_query($sql_daotao_DH);      
          while ($row_daotao_DH = mysql_fetch_array($result_daotao_DH)){          
            $chuyennganh = $chuyennganh."ĐH: ".$row_daotao_DH["nganhhoc"];
            $hocvi = "ĐH"; 
            $hocviNuocNgoai = $row_daotao_DH["noidaotao"];
            if ($hocviNuocNgoai == 'Ngoài nước')
              $hocviNuocNgoai = "Đại học";
            $namTN = $row_daotao_DH["thoigianhoc"];
            $namTN = explode('-',$namTN);
            $namTN = explode('/',$namTN[1]);
            $namTN = $namTN[1];
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.(string)($r), $namTN);
          }
          $sql_daotao_Ths = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'Ths' AND thoigianhoc IS NOT NULL";
          $result_daotao_Ths = mysql_query($sql_daotao_Ths);      
          while ($row_daotao_Ths = mysql_fetch_array($result_daotao_Ths)){          
            $chuyennganh = $chuyennganh.";Ths: ".$row_daotao_Ths["nganhhoc"];
            $hocvi = "Ths";
            $hocviNuocNgoai = $row_daotao_Ths["noidaotao"];
            if ($hocviNuocNgoai == 'Ngoài nước')
              $hocviNuocNgoai = "Thạc sỹ";
            $namTN = $row_daotao_Ths["thoigianhoc"];
            $namTN = explode('-',$namTN);
            $namTN = explode('/',$namTN[1]);
            $namTN = $namTN[1];
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.(string)($r), $namTN);
          }
          $sql_daotao_Ts = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'TS' AND thoigianhoc IS NOT NULL";
          $result_daotao_Ts = mysql_query($sql_daotao_Ts);      
          while ($row_daotao_Ts = mysql_fetch_array($result_daotao_Ts)){          
            $chuyennganh = $chuyennganh.";Ts: ".$row_daotao_Ts["nganhhoc"];
              $hocvi = "Ts";
              $hocviNuocNgoai = $row_daotao_Ts["noidaotao"];
              if ($hocviNuocNgoai == 'Ngoài nước')
                $hocviNuocNgoai = "Tiến sỹ";
              $namTN = $row_daotao_Ts["thoigianhoc"];
              $namTN = explode('-',$namTN);
              //$namTN = $namTN[1];
              echo "namTN 1: ".$namTN[1];
              $namTN = explode('/',$namTN[1]);
              $namTN = $namTN[1];
              echo "namTN 2: ".$namTN;
              //die();
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.(string)($r), $namTN);
          }
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($r), $chuyennganh);
          //End Xử lý Chuyên ngành đào tạo (ĐH; Ths; Ts)
          
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.(string)($r), $hocvi);
          
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.(string)($r), $row_lylich["chucvu"]);        
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($r), (($row_lylich["chucvudate"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["chucvudate"])): ''));
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($r), $row_lylich["phucapchucvu"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.(string)($r), $row_lylich["phucaptrachnhiem"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($r), $row_lylich["phucapquansu"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($r), $row_lylich["chucdanhkhoahoc"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.(string)($r), $row_lylich["phucapquansu"]);
          //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($r), $row_lylich["dieuchuyen"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.(string)($r), (($row_lylich["ngaynhapngu"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["ngaynhapngu"])): ''));           
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.(string)($r), $row_lylich["chungchiNVSP"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.(string)($r), $row_lylich["phucapgiaovien"]);  
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.(string)($r), GetTenBoMon($row_lylich["bomonto_id"]));
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.(string)($r), GetTenKhoa($row_lylich["khoaphongban_id"]));
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.(string)($r), $hocviNuocNgoai);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI'.(string)($r), $row_lylich["quanlynhanuoc"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ'.(string)($r), $row_lylich["lyluanchinhtri"]);
          //Xử lý Năm cử đi học, Ngành cử đi học (ĐH; Ths; Ts)
          $chuyennganh="";       
          $hocvi = "Đang học";
          $namTN = "";
          $hocviNuocNgoai = "";
          //$sql_daotao_DH = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND (vanbang = 'Cử nhân' OR vanbang = 'Kỹ sư') AND ngaycudi IS NOT NULL";
          $sql_daotao_DH = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND ngaycudi IS NOT NULL AND ngaycudi != ''";
          $result_daotao_DH = mysql_query($sql_daotao_DH);      
          while ($row_daotao_DH = mysql_fetch_array($result_daotao_DH)){          
            //$chuyennganh = $chuyennganh."ĐH: ".$row_daotao_DH["nganhhoc"]." ".$row_daotao_DH["ngaycudi"];
            $chuyennganh = $chuyennganh.$row_daotao_DH["vanbang"].": ".$row_daotao_DH["nganhhoc"]." ".$row_daotao_DH["ngaycudi"]."; ";
            $namcudi = $row_daotao_DH["ngaycudi"];                     
          }
          /*$sql_daotao_Ths = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'Ths' AND ngaycudi IS NOT NULL";
          $result_daotao_Ths = mysql_query($sql_daotao_Ths);      
          while ($row_daotao_Ths = mysql_fetch_array($result_daotao_Ths)){          
            $chuyennganh = $chuyennganh."; Ths: " + $row_daotao_Ths["nganhhoc"]." ".$row_daotao_Ths["ngaycudi"];
            $namcudi = $row_daotao_Ths["ngaycudi"];   
          }
          $sql_daotao_Ts = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'TS' AND ngaycudi IS NOT NULL";
          $result_daotao_Ts = mysql_query($sql_daotao_Ts);      
          while ($row_daotao_Ts = mysql_fetch_array($result_daotao_Ts)){          
            $chuyennganh = $chuyennganh."; Ts: " + $row_daotao_Ts["nganhhoc"]." ".$row_daotao_Ts["ngaycudi"];
            $namcudi = $row_daotao_Ts["ngaycudi"];          
          }*/        
          //End Xử lý Năm cử đi học, Ngành cử đi học (ĐH; Ths; Ts)
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL'.(string)($r), $namcudi);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM'.(string)($r), $chuyennganh);
          //Xử lý ngày hợp đồng
          $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlamviec = 'Hợp đồng 3 năm' ORDER BY ngayhdlamviec";
          $result_hopdong = mysql_query($sql_hopdong);
          $r_hopdong = mysql_fetch_array($result_hopdong);
          $ngayhopdong = (string)($r_hopdong["ngayhdlamviec"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN'.(string)($r), $ngayhopdong);
          
          $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlamviec = 'HĐ không xác định thời hạn' ORDER BY ngayhdlamviec";
          $result_hopdong = mysql_query($sql_hopdong);
          $r_hopdong = mysql_fetch_array($result_hopdong);
          $ngayhopdong = (string)($r_hopdong["ngayhdlamviec"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO'.(string)($r), $ngayhopdong);

          $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlaodong = 'Hợp đồng 3 năm' ORDER BY ngayhdlaodong";
          $result_hopdong = mysql_query($sql_hopdong);
          $r_hopdong = mysql_fetch_array($result_hopdong);
          $ngayhopdong = (string)($r_hopdong["ngayhdlaodong"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AP'.(string)($r), $ngayhopdong);
          
          $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlaodong = 'HĐ không xác định thời hạn' ORDER BY ngayhdlaodong";
          $result_hopdong = mysql_query($sql_hopdong);
          $r_hopdong = mysql_fetch_array($result_hopdong);
          $ngayhopdong = (string)($r_hopdong["ngayhdlaodong"]);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ'.(string)($r), $ngayhopdong);
          //End Xử lý ngày hợp đồng
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AR'.(string)($r), (($row_lylich["dangcongsan_ngayvao"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["dangcongsan_ngayvao"])): ''));
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS'.(string)($r), (($row_lylich["dangcongsan_ngaychinhthuc"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["dangcongsan_ngaychinhthuc"])): ''));
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT'.(string)($r), $row_lylich["dantoc"]);

          $r++;
          $j++;
          $i++;
        }//end while ($row_lylich = mysql_fetch_array($result_lylich))
      //end các con trực tiếp của khoa phòng ban
        
        //start khối con của khoa phòng ban
        $sql_bomonto = "SELECT * FROM bomonto WHERE khoaphongbanid= $khoaphongban_id";
        $result_bomonto = mysql_query($sql_bomonto);
        while ($row_bomonto = mysql_fetch_array($result_bomonto)){
          $bomonto_id = $row_bomonto["bomontoid"];
          $bomonto_name = $row_bomonto["name"];
          //$bomonto_name = mb_strtoupper($row_bomonto["name"],'UTF-8');
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $bomonto_name);
          $objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.(string)($r))->getFont()->setBold(true);
          $r++;    

          //start các con trực tiếp của bộ môn tổ
          $sql_lylich = "SELECT * FROM lylich WHERE cosodaotao_id = '$cosodaotao_id' and tochuctructhuoc_id = '$tochuc_id' and khoaphongban_id = '$khoaphongban_id' and bomonto_id = '$bomonto_id'";
          $result_lylich = mysql_query($sql_lylich);
          $j = 1;
          while ($row_lylich = mysql_fetch_array($result_lylich)){
            $lylich_id = $row_lylich["id"];
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.(string)($r), $i);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.(string)($r), $j);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.(string)($r), $row_lylich["hoten"]);
            if ($row_lylich["gioitinh"] == 1)
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), "Nam");
            else
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.(string)($r), "Nữ");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.(string)($r), date("d-m-Y",strtotime($row_lylich["ngaysinh"])));        
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), date("d-m-Y",strtotime($row_lylich["ngaytuyendung"])));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.(string)($r), GetNgayHDLV($row_lylich["id"]));
            if (GetNgayHDLV($row_lylich["id"]) == "") {
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "CBC");
        } else {
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "Cơ Hữu");
        }
            // if ($row_lylich["ngaytuyendung"] == null || $row_lylich["ngaytuyendung"] == '0000-00-00')
            //   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "CBC");
            // else
            //   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.(string)($r), "Cơ Hữu");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.(string)($r), GetNgayHDLD($row_lylich["id"]));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.(string)($r), GetMaNgach($row_lylich["id"]));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.(string)($r), $row_lylich["ngoaingu_ten"].'-'.$row_lylich["ngoaingu_trinhdo"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.(string)($r), $row_lylich["tinhoc_trinhdo"]);
            //Xử lý Chuyên ngành đào tạo (ĐH; Ths; Ts)
            $chuyennganh = "";       
            $hocvi = "Đang học";
            $namTN = "";
            $hocviNuocNgoai = "";
            $sql_daotao_DH = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND (vanbang = 'Cử nhân' OR vanbang = 'Kỹ sư') AND thoigianhoc IS NOT NULL";
            $result_daotao_DH = mysql_query($sql_daotao_DH);      
            while ($row_daotao_DH = mysql_fetch_array($result_daotao_DH)){          
              $chuyennganh = $chuyennganh."ĐH: ".$row_daotao_DH["nganhhoc"];
              $hocvi = "ĐH"; 
              $hocviNuocNgoai = $row_daotao_DH["noidaotao"];
              if ($hocviNuocNgoai == 'Ngoài nước')
                $hocviNuocNgoai = "Đại học";
              $namTN = $row_daotao_DH["thoigianhoc"];
              $namTN = explode('-',$namTN);
              $namTN = explode('/',$namTN[1]);
              $namTN = $namTN[1];
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.(string)($r), $namTN);
            }
            $sql_daotao_Ths = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'Ths' AND thoigianhoc IS NOT NULL";
            $result_daotao_Ths = mysql_query($sql_daotao_Ths);      
            while ($row_daotao_Ths = mysql_fetch_array($result_daotao_Ths)){          
              $chuyennganh = $chuyennganh.";Ths: ".$row_daotao_Ths["nganhhoc"];
              $hocvi = "Ths";
              $hocviNuocNgoai = $row_daotao_Ths["noidaotao"];
              if ($hocviNuocNgoai == 'Ngoài nước')
                $hocviNuocNgoai = "Thạc sỹ";
              $namTN = $row_daotao_Ths["thoigianhoc"];
              $namTN = explode('-',$namTN);
              $namTN = explode('/',$namTN[1]);
              $namTN = $namTN[1];
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.(string)($r), $namTN);
            }
            $sql_daotao_Ts = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'TS' AND thoigianhoc IS NOT NULL";
            $result_daotao_Ts = mysql_query($sql_daotao_Ts);      
            while ($row_daotao_Ts = mysql_fetch_array($result_daotao_Ts)){          
              $chuyennganh = $chuyennganh.";Ts: ".$row_daotao_Ts["nganhhoc"];
              $hocvi = "Ts";
              $hocviNuocNgoai = $row_daotao_Ts["noidaotao"];
              if ($hocviNuocNgoai == 'Ngoài nước')
                $hocviNuocNgoai = "Tiến sỹ";
              $namTN = $row_daotao_Ts["thoigianhoc"];
              $namTN = explode('-',$namTN);
              //$namTN = $namTN[1];
              echo "namTN 1: ".$namTN[1];
              $namTN = explode('/',$namTN[1]);
              $namTN = $namTN[1];
              echo "namTN 2: ".$namTN;
              //die();
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.(string)($r), $namTN);
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.(string)($r), $chuyennganh);
            //End Xử lý Chuyên ngành đào tạo (ĐH; Ths; Ts)
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.(string)($r), $hocvi);
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.(string)($r), $row_lylich["chucvu"]);        
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.(string)($r), (($row_lylich["chucvudate"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["chucvudate"])): ''));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($r), $row_lylich["phucapchucvu"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.(string)($r), $row_lylich["phucaptrachnhiem"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($r), $row_lylich["phucapquansu"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.(string)($r), $row_lylich["chucdanhkhoahoc"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.(string)($r), $row_lylich["phucapquansu"]);
            //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.(string)($r), $row_lylich["dieuchuyen"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.(string)($r), (($row_lylich["ngaynhapngu"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["ngaynhapngu"])): ''));           
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.(string)($r), $row_lylich["chungchiNVSP"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.(string)($r), $row_lylich["phucapgiaovien"]);  
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.(string)($r), GetTenBoMon($row_lylich["bomonto_id"]));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.(string)($r), GetTenKhoa($row_lylich["khoaphongban_id"]));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.(string)($r), $hocviNuocNgoai);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI'.(string)($r), $row_lylich["quanlynhanuoc"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ'.(string)($r), $row_lylich["lyluanchinhtri"]);
            //Xử lý Năm cử đi học, Ngành cử đi học (ĐH; Ths; Ts)
            $chuyennganh="";       
            $hocvi = "Đang học";
            $namTN = "";
            $hocviNuocNgoai = "";
            //$sql_daotao_DH = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND (vanbang = 'Cử nhân' OR vanbang = 'Kỹ sư') AND ngaycudi IS NOT NULL";
            $sql_daotao_DH = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND ngaycudi IS NOT NULL AND ngaycudi != ''";
            $result_daotao_DH = mysql_query($sql_daotao_DH);      
            while ($row_daotao_DH = mysql_fetch_array($result_daotao_DH)){          
              //$chuyennganh = $chuyennganh."ĐH: ".$row_daotao_DH["nganhhoc"]." ".$row_daotao_DH["ngaycudi"];
              $chuyennganh = $chuyennganh.$row_daotao_DH["vanbang"].": ".$row_daotao_DH["nganhhoc"]." ".$row_daotao_DH["ngaycudi"]."; ";
              $namcudi = $row_daotao_DH["ngaycudi"];                     
            }
            /*$sql_daotao_Ths = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'Ths' AND ngaycudi IS NOT NULL";
            $result_daotao_Ths = mysql_query($sql_daotao_Ths);      
            while ($row_daotao_Ths = mysql_fetch_array($result_daotao_Ths)){          
              $chuyennganh = $chuyennganh."; Ths: " + $row_daotao_Ths["nganhhoc"]." ".$row_daotao_Ths["ngaycudi"];
              $namcudi = $row_daotao_Ths["ngaycudi"];   
            }
            $sql_daotao_Ts = "SELECT * FROM daotao WHERE lylich_id = '$lylich_id' AND vanbang = 'TS' AND ngaycudi IS NOT NULL";
            $result_daotao_Ts = mysql_query($sql_daotao_Ts);      
            while ($row_daotao_Ts = mysql_fetch_array($result_daotao_Ts)){          
              $chuyennganh = $chuyennganh."; Ts: " + $row_daotao_Ts["nganhhoc"]." ".$row_daotao_Ts["ngaycudi"];
              $namcudi = $row_daotao_Ts["ngaycudi"];          
            }*/        
            //End Xử lý Năm cử đi học, Ngành cử đi học (ĐH; Ths; Ts)
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL'.(string)($r), $namcudi);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM'.(string)($r), $chuyennganh);
            //Xử lý ngày hợp đồng
            $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlamviec = 'Hợp đồng 3 năm' ORDER BY ngayhdlamviec";
            $result_hopdong = mysql_query($sql_hopdong);
            $r_hopdong = mysql_fetch_array($result_hopdong);
            $ngayhopdong = (string)($r_hopdong["ngayhdlamviec"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN'.(string)($r), $ngayhopdong);
            
            $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlamviec = 'HĐ không xác định thời hạn' ORDER BY ngayhdlamviec";
            $result_hopdong = mysql_query($sql_hopdong);
            $r_hopdong = mysql_fetch_array($result_hopdong);
            $ngayhopdong = (string)($r_hopdong["ngayhdlamviec"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO'.(string)($r), $ngayhopdong);

            $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlaodong = 'Hợp đồng 3 năm' ORDER BY ngayhdlaodong";
            $result_hopdong = mysql_query($sql_hopdong);
            $r_hopdong = mysql_fetch_array($result_hopdong);
            $ngayhopdong = (string)($r_hopdong["ngayhdlaodong"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AP'.(string)($r), $ngayhopdong);
            
            $sql_hopdong = "SELECT * FROM hopdong WHERE lylich_id = '$lylich_id' AND loaihdlaodong = 'HĐ không xác định thời hạn' ORDER BY ngayhdlaodong";
            $result_hopdong = mysql_query($sql_hopdong);
            $r_hopdong = mysql_fetch_array($result_hopdong);
            $ngayhopdong = (string)($r_hopdong["ngayhdlaodong"]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ'.(string)($r), $ngayhopdong);
            //End Xử lý ngày hợp đồng
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AR'.(string)($r), (($row_lylich["dangcongsan_ngayvao"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["dangcongsan_ngayvao"])): ''));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS'.(string)($r), (($row_lylich["dangcongsan_ngaychinhthuc"] != '0000-00-00') ? date("d-m-Y",strtotime($row_lylich["dangcongsan_ngaychinhthuc"])): ''));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT'.(string)($r), $row_lylich["dantoc"]);

            $r++;
            $j++;
            $i++;
          }//end while ($row_lylich = mysql_fetch_array($result_lylich))
        //end các con trực tiếp của bộ môn tổ
        }            
      }
      //end khối con của khoa phòng ban
    }//end while ($row_tochuc = mysql_fetch_array($result_tochuc))        	      	  
	}//end while ($row_coso = mysql_fetch_array($result_coso))


  $styleArray = array(
          'borders' => array(
              'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
              )
          )
      );
	$objPHPExcel->getActiveSheet()->getStyle(
	    'A10:' . 
	    'AU' . (string)($r-1)
	)->applyFromArray($styleArray);

	  // Tao file da xong du lieu
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save("../../file_export/Danh sach chi tiet can bo.xlsx");
	}
  header("Location: ../../file_export/Danh sach chi tiet can bo.xlsx");
?>
