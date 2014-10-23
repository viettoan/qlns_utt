<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', TRUE);*/


$g_excel = null;

class MyGetter {
	public function __construct($excel) {
		$this->resetReturnCode();
		$this->_excel = $excel;
   }
   
   private function getCellByName($cellName){
   	$cell = $this->getCellRaw($cellName);
   	if (!$cell)
   		return "";
		$val = $cell->getValue();
		$val = trim($val);
		//echo "$cellName = _$val<br>";
		return $val;
	}

	//
	// flag
	//
	public static $FLAG_OPTION 		= 0x01;// 0x01 - optional
	public static $FLAG_DATE 			= 0x02; // 0x02 - date (1/1/2010)
	public static $FLAG_2DATE 			= 0x04; // 0x04 - 2date (8/2008-9/2009)
	public static $FLAG_MONTHDATE 	= 0x08; // 0x08 - monthdate (8/2008)
	public static $FLAG_INTEGER_ONLY = 0x10; // 0x10 - integer only (0-9)
	public static $FLAG_NUMBER			= 0x20; // 0x20 - number (integer, float)
	
	public function getCell($cellName, $description = "", $flag = 0){
		try {
			$val = $this->getCellByName($cellName);
		}
		catch (PHPExcel_Exception $ex){
			$val = "";		
		}
		
		// empty value with option flag dont need be checked for error
		if (($val == "") && ($flag & self::$FLAG_OPTION))
			return $val;

		// check if cell has value
		if ( (($val == "") && 0 == ($flag & self::$FLAG_OPTION))
		|| (($flag & self::$FLAG_DATE) && !$this->validateDate($val))
		|| (($flag & self::$FLAG_2DATE) && !$this->validate2Date($val))
		|| (($flag & self::$FLAG_MONTHDATE) && !$this->validateMonthDate($val))
		|| (($flag & self::$FLAG_INTEGER_ONLY) && !$this->validateIntegerOnly($val))
		|| (($flag & self::$FLAG_NUMBER) && !$this->validateNumber($val)) ){
			$this->_success = false;
			if ($description == "")
				$description = $cellName;
			$this->_errors[] = ($description);
		}
		return $val;
	}
	
	// get 2 or more cell (with option flag)
	//
	// vd: get huanchuong, namhuanchuong
	//
	public function getCell2($arrays){
		// check if is optional
		//var_dump($arrays);
		$is_optional = true;		
		for ($i = 0; $i < count($arrays); $i++){
			$cell = $this->getCellRaw($arrays[$i]['cellName']);
			if (!$cell) {
				$is_optional = false;
				break;
			}
			$val = trim($cell->getValue());
			if ($val != ""){
				$is_optional = false;
				break;
			}
		}
		
		$result = array();
		foreach ($arrays as $a){
			$cellName = $a['cellName'];
			$description = $a['description'];
			$flag = $a['flag'];
			if ($is_optional)
				$flag |= self::$FLAG_OPTION;
			$val = $this->getCell($cellName, $description, $flag);
			$result["$cellName"] = $val;
		}
		return $result;
	}
	
	// read table
	// success: return array -> rows
	// error: return false
	//
	public function getCellTable($cellStart, $arrays, $is_option = false){
		$ret = $this->_success; // backup
		
		$result = array();
		
		//xy start
		list($x, $y) = $this->getAddressCell($cellStart);
		if ($x < 0 || $y < 0) {
			$this->_success = $ret;
			return false;
		}
		
		if (!$is_option){
			// prepare array for getCell2
			$copy = $arrays;
			for ($i = 0; $i < count($copy); $i++){
				$copy[$i]['cellName'] = $copy[$i]['cellName'].$y;
			}
			//var_dump($arrays);
			//var_dump($copy);
			$this->resetReturnCode();
			$rowResult = $this->getCell2($copy);
			//var_dump($rowResult);
			if (!$this->getReturnCode()) {
				$this->_success = $ret;
				return false;
			}
			$result[] = $rowResult;
			$y++;
		}
		//var_dump($result);
		// read next rows (by option)
		while (true){
			// prepare array for getCell2
			$copy = $arrays;
			for ($i = 0; $i < count($copy); $i++){
				$copy[$i]['cellName'] = $copy[$i]['cellName'].$y;
			}
			$this->resetReturnCode();
			$rowResult = $this->getCell2($copy);
			//var_dump($rowResults);
			if (!$this->getReturnCode()) {
				break;
			}
			
			// check if all cell in row = ""
			// this cause by option effect
			$isvalid = false;
			if (count($copy) != count($rowResult)){
				die("Unexpected error when getCell2");
			}
			//var_dump($copy);var_dump($rowResult);
			for ($i = 0; $i < count($copy); $i++){
				//$cellName = $copy[$i]['cellName'];
				if ($rowResult[$copy[$i]['cellName']] != ""){
					$isvalid = true;
					break;
				}
			}
			if ($isvalid){
				$result[] = $rowResult;
				$y++;
			} else {
				break;
			}
		}
		
		$this->_success = $ret;
		return $result;
	}
	public function getReturnCode(){
		return $this->_success;
	}
	public function resetReturnCode(){
		$this->_success = true;
	}
	public function getErrorTexts(){
		return $this->_errors;
	}
	function validateDate($date){
		$a = explode('/', $date);
		//var_dump($a);
		if (count($a) == 3)
			return $this->isInteger($a[0]) 
				&& $this->isInteger($a[1]) 
				&& $this->isInteger($a[2])
				&& checkdate($a[1], $a[0], $a[2]);
		if (count($a) == 2)
			return $this->isInteger($a[0]) 
				&& $this->isInteger($a[1]) 
				&& checkdate($a[0], 1, $a[1]);
		return false;
	}
	
	function validate2Date($date2){
		$a = explode('-', $date2);
		if (count($a) != 2){
			return false;
		}
		//var_dump($a);
		return $this->validateDate($a[0]) && ($this->validateDate($a[1]) || trim(strtolower($a[1])) == "nay");
	}
	function validateMonthDate($date){
		return $this->validateDate($date);
	}
	function validateIntegerOnly($v){
		return(ctype_digit(strval($v)));
	}
	function validateNumber($v){
		return is_numeric($v);
	}
	public function getAddressCell($cellName){
		$cell = $this->getCellRaw($cellName);
		if (!$cell)
			return array(-1,-1); // getCellTable will reject getCell(-1,*)
		$result = array($cell->getColumn(), $cell->getRow());
		return $result;
	}
	function getCellRaw($cellName){
		try {			
			$cell = $this->_excel->getActiveSheet()->getCell($cellName);
		}
		catch (Exception $ex){
			$cell = false;
			$this->_isValidExcelFile = false;
		}
		return $cell;
	}
	function isInteger($input){
		//echo "input = $input<br>". ctype_digit(strval($input)) ;
   	return ctype_digit(strval($input));
	}
	public function isValidExcelFile(){
		return $this->_isValidExcelFile;
	}
	private $_success = true;
	private $_errors = array();
	private $_excel = null;
	private $_isValidExcelFile = true;
}


function convertDate(&$date){
	$dateFormated = explode('/', $date);
	$cnt = count ($dateFormated);
	if ($cnt == 2){
		//echo 'lolz';
		$date = $dateFormated[1] . '-' . $dateFormated[0] . '-1';
	}
	else if ($cnt == 3){
		$date = $dateFormated[2] . '-' . $dateFormated[1] . '-' . $dateFormated[0];
	}
	return $date;
}

function getHuyenID($huyen){
	$sql = "SELECT districtid FROM `huyen` WHERE name = '$huyen'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) == 1){
		$array = mysql_fetch_assoc($result);
		return $array['districtid'];
	}
	//die("get districtid");
	// error occur
	return "";
}

function getTinhID($tinh){
	$sql = "SELECT provinceid FROM `tinh` WHERE name = '$tinh'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) == 1){
		$array = mysql_fetch_assoc($result);
		return $array['provinceid'];
	}
	//die("get provinceid");
	return "";
}

function isExistCMND($cmnd){
	$sql = "SELECT * FROM `lylich` WHERE cmnd='$cmnd'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) >= 1){
		return true;
	}
	return false;
}

function xuLyFile2($fileName){
	$success = true;
	$errors = array();
	
	require_once(__DIR__."/../../config/config.php");
	date_default_timezone_set('Europe/London');
	require_once(__DIR__.'/../lib/PHPExcel/Classes/PHPExcel/IOFactory.php');
	require_once(__DIR__.'/../lib/PHPExcel/Classes/PHPExcel.php');
	
	// check excel type for reading
	$excel = false;
	$types = array('Excel2007', 'Excel5');
	foreach ($types as $type) {
		$reader = PHPExcel_IOFactory::createReader($type);
	   if ($reader->canRead($fileName)) {
	   	try {
				$excel = PHPExcel_IOFactory::createReader($type);
				$excel = $excel->load($fileName);
			}
			catch (Exception $e){
			}
	      break;
	    }
	}

	//var_dump($excel);
	if (!$excel){
		return array(1, array()); // khong phai excel file
	}
	
	$excel->setActiveSheetIndex(0);
	$myget = new MyGetter($excel);
	
	// read from excel
	$dvTrucThuoc = $myget->getCell('dvTrucThuoc2');
	$dvCoSo = $myget->getCell('dvCoSo2');
	$sohieucb = $myget->getCell("sohieucb");
	
	//1
	$hoTen = $myget->getCell("hoten", "Mục 1: Họ và tên khai sinh");
	$gioiTinh = $myget->getCell("gioitinh", "Mục 1: Giới tính");
	//2
	$tenKhac = $myget->getCell("tenkhac", "Mục 2: Tên khác");
	//3
	$capUyHienTai = $myget->getCell("capuyht", "Mục 3: Cấp ủy hiện tại");
	$capUyKiem = $myget->getCell("capuykiem", "Mục 3: Cấp ủy kiểm");
	$chucVu = $myget->getCell("chucvu", "Mục 3: Chức vụ");
	$chucVuNgay = $myget->getCell("chucvungay", "Mục 3: Ngày bổ nhiệm chức vụ", MyGetter::$FLAG_INTEGER_ONLY);
	$chucVuThang = $myget->getCell("chucvuthang", "Mục 3: Tháng bổ nhiệm chức vụ", MyGetter::$FLAG_INTEGER_ONLY);
	$chucVuNam = $myget->getCell("chucvunam", "Mục 3: Năm bổ nhiệm chức vụ", MyGetter::$FLAG_INTEGER_ONLY);
	if ($chucVuNgay == "" || $chucVuThang == "" || $chucVuNam == ""
		|| !checkdate($chucVuThang, $chucVuNgay, $chucVuNam)){
		$success = false;
		$errors[] = "Mục 3: Ngày/Tháng/Năm bổ nhiệm chức vụ";
	}
	$phuCapCV = $myget->getCell("phucapcv", "Mục 3: Phụ cấp chức vụ");
	//4
	$sinhNgay = $myget->getCell("sngay", "Mục 4: ngày sinh", MyGetter::$FLAG_INTEGER_ONLY);
	$sinhThang = $myget->getCell("sthang", "Mục 4: tháng sinh", MyGetter::$FLAG_INTEGER_ONLY);
	$sinhNam = $myget->getCell("snam", "Mục 4: năm sinh", MyGetter::$FLAG_INTEGER_ONLY);
	if ($sinhNgay == "" || $sinhThang == "" || $sinhNam == ""
		|| !checkdate($sinhThang, $sinhNgay, $sinhNam)){
		$success = false;
		$errors[] = "Mục 4: Ngày/Tháng/Năm sinh";
	}
	$nsXa = $myget->getCell("nsxa", "Mục 4: Nơi sinh (xã)");
	$nsHuyen = $myget->getCell("nsDistrict2", "Mục 4: Nơi sinh (huyện)");
	$nsTinh = $myget->getCell("nsProvince2", "Mục 4: Nơi sinh (tỉnh)");
	$nsHuyen = getHuyenID($nsHuyen);
	$nsTinh = getTinhID($nsTinh);
	//5
	$queXa = $myget->getCell("quexa", "Mục 4: quê quán (xã)");
	$queHuyen = $myget->getCell("queDistrict2", "Mục 4: quê quán (huyện)");
	$queTinh = $myget->getCell("queProvince2", "Mục 4: quê quán (tỉnh)");
	$queHuyen = getHuyenID($queHuyen);
	$queTinh = getTinhID($queTinh);
	//6
	$noiO = $myget->getCell("noio", "Mục 6: Nơi ở hiện nay");
	//7
	$dienThoai = $myget->getCell("dthoai", "Mục 7: Số điện thoại", MyGetter::$FLAG_INTEGER_ONLY);
	//8
	$danToc = $myget->getCell("dantoc2", "Mục 8: Dân tộc");
	//9
	$tonGiao = $myget->getCell("tongiao2", "Mục 9: Tôn giáo");
	//10
	$tpgdXuatThan = $myget->getCell("xuatthan2", "Mục 10: Thành phần xuất thân");
	//11
	$ngheTruocTuyenDung = $myget->getCell("nghetruoctd");
	//12
	$ngayTuyenDung = $myget->getCell("ngaytd", "Mục 12: Ngày tuyển dụng", MyGetter::$FLAG_DATE);
	convertDate($ngayTuyenDung);
	
	$coQuanTuyenDung = $myget->getCell("coquantd", "Mục 12: Cơ quan tuyển dụng");
	//13
	$ngayVaoCoQuan = $myget->getCell("ngayvaocq", "Mục 12: Ngày vào cơ quan", MyGetter::$FLAG_DATE);
	convertDate($ngayVaoCoQuan);
	
	$ngayThamGiaCM = $myget->getCell("ngaythamgiacm", "Mục 13: Ngày tham gia cách mạng", MyGetter::$FLAG_DATE);
	convertDate($ngayThamGiaCM);
	
	//14
	$ngayVaoDang = $myget->getCell("ngayvaodang", "Mục 14: Ngày vào Đảng Cộng Sản", MyGetter::$FLAG_DATE);
	convertDate($ngayVaoDang);
	
	$ngayChinhThucDang = $myget->getCell("ngaychinhthuc", "Mục 14: Ngày vào Đảng Cộng Sản chính thức", MyGetter::$FLAG_DATE);
	convertDate($ngayChinhThucDang);
	//15
	$ngayThamGiaToChucTC = $myget->getCell("ngaythamgiatc", "Mục 14: Ngày tham gia tổ chức chính trị", MyGetter::$FLAG_DATE);
	convertDate($ngayThamGiaToChucTC);
	//16
	$ngayNhapNgu = $myget->getCell("ngaynn", "Mục 16: Ngày nhập ngũ", MyGetter::$FLAG_OPTION);
	convertDate($ngayNhapNgu);
	$ngayXuatNgu = $myget->getCell("ngayxn", "Mục 16: Ngày xuất ngũ", MyGetter::$FLAG_OPTION);
	convertDate($ngayXuatNgu);
	
	$tmp = $myget->getCell2(array(
		array("cellName" => "quanham", "description" => "Mục 16: Quân hàm", "flag"=> 0), 
		array("cellName" => "namquanham", "description" => "Mục 16: Năm quân hàm", "flag"=> MyGetter::$FLAG_INTEGER_ONLY)));
	$quanHam = $tmp['quanham'];
	$namQuanHam = $tmp["namquanham"];
	//17
	$lopHocVan = $myget->getCell("lophocvan", "Mục 17: Lớp học vấn");
	$tenHocVi = $myget->getCell("hocham2", "Mục 17: Học hàm");
	$namHocVi = $myget->getCell("namhocvi", "Mục 17: Năm học vị", MyGetter::$FLAG_INTEGER_ONLY);
	$chuyenNganh = $myget->getCell("chuyennganh", "Mục 17: Chuyên ngành");
	$capLyLuan = $myget->getCell("caplyluan", "Mục 17: Cấp lý luận");
	$ngoaiNgu = $myget->getCell("ngoaingu", "Mục 17: Ngoại ngữ");
	$tmp = explode('(', $ngoaiNgu);
	if (count($tmp) == 2){
		$ngoaiNguTen = trim($tmp[0]);
		preg_match('/.*([a-dA-D][0-9]*).*/', $tmp[1], $match);
		if (count($match) == 2){
			$ngoaiNguTrinhDo = trim($match[1]);
		} else {
			$ngoaiNguTrinhDo = "";
		}
	}
	else {
		$ngoaiNguTen = "";
		$ngoaiNguTrinhDo = "";
	}
	//18
	$congTacChinh = $myget->getCell("congtacchinh", "Mục 18: Công tác đang làm");
	//19
	$ngachCongChuc = $myget->getCell("ngachcongchuc", "Mục 19: Tên ngạch công chức");
	$maNgach = $myget->getCell("mangach", "Mục 19: Mã ngạch");
	$bacLuong = $myget->getCell("bacluong", "Mục 19: Bậc lương");
	$heSoLuong = $myget->getCell("hesoluong", "Mục 19: Hệ số lương");
	$ngayLuong = $myget->getCell("ngayluong", "Mục 19: Ngày lương", MyGetter::$FLAG_MONTHDATE);
	$tmp = explode('/', $ngayLuong);
	if (count($tmp) == 2){
		$ngayLuongNam = $ngayLuong[1];
		$ngayLuongThang = $ngayLuong[0];
	} else {
		$ngayLuongNam = "";
		$ngayLuongThang = "";
	}
	//20
	//
	$tmp = $myget->getCell2(array(array("cellName" => "danhhieu2", "description" => "Mục 20: Danh hiệu", "flag"=> 0), 
		array("cellName" => "namdanhhieu", "description" => "Mục 20: Năm danh hiệu", "flag"=> MyGetter::$FLAG_INTEGER_ONLY)));
	$tenDanhHieu = $tmp["danhhieu2"];
	$namDanhHieu = $tmp["namdanhhieu"];
	//21
	$soTruongCongTac = $myget->getCell("sotruongct", "Mục 21: Sở trường công tác");
	$congViecLauNhat = $myget->getCell("congvieclaunhat", "Mục 21: Công việc lâu nhất");
	//22
	$tmp = $myget->getCell2(array(
		array("cellName" => "huanchuong", "description" => "Mục 22: Huân chương", "flag"=> 0), 
		array("cellName" => "namhuanchuong", "description" => "Mục 22: Năm huân chương", "flag"=> MyGetter::$FLAG_INTEGER_ONLY)));
	$khenThuong = $tmp["huanchuong"];
	$namKhenThuong = $tmp["namhuanchuong"];
	//23
	//24
	$sucKhoe = $myget->getCell("suckhoe", "Mục 24: Sức khỏe");
	$cao = $myget->getCell("cao", "Mục 24: Chiều cao");
	$nang = $myget->getCell("nang", "Mục 24: Cân nặng");
	$nhomMau = $myget->getCell("nhommau", "Mục 24: Nhóm máu");
	//25
	$cmnd = $myget->getCell("cmnd", "Mục 25: Chứng minh nhân dân", MyGetter::$FLAG_INTEGER_ONLY);
	
	// thong tin can bo -> thong bao ket qua
	$ttcb = array();
	$ttcb['hoten'] = ($hoTen != "") ? $hoTen : "Lỗi khi đọc";
	$ttcb['namsinh'] = ($sinhNam != "" && $sinhThang != "" && $sinhNgay != "") ? ($sinhNgay.'/'.$sinhThang.'/'.$sinhNam) : "Lỗi khi đọc";
	$ttcb['capuy_donvi'] = ($capUyHienTai != "" && $dvCoSo != "") ? ($capUyHienTai.' - '.$dvCoSo) : "Lỗi khi đọc";
	
	if (isExistCMND($cmnd)){
		return array(2, array('ttcb'=>$ttcb));
	}
	$loaiThuongBinh = $myget->getCell("loaithuongbinh", "Mục 25: Loại thương  binh", MyGetter::$FLAG_OPTION);
	$gdLietSi = $myget->getCell("lalietsi2", "Mục 25: Là liệt sĩ", MyGetter::$FLAG_OPTION);
	//26
	//27
	//28
	//29
	//30
	//31
	$luong = $myget->getCell("luong", "Mục 31: Lương");
	$nguonKhac = $myget->getCell("nguonkhac", "Mục 31: Nguồn khác");
	
	//
	// insert to lylich
	//
	$sql = "INSERT INTO `QLCBDoan`.`lylich` (`id`, 
	`botinh`, `donvitructhuoc`, `donvicoso`, `sohieucanbo`, 
	`hoten`, `gioitinh`, `tengoikhac`, `capuyhientai`, `capuykiem`, 
	`ngaysinh`, `noisinh`, `quequan_xa`, `quequan_huyen`, `quequan_tinh`, 
	`noiohiennay`, `dienthoai`, 
	`dantoc`, `tongiao`, 
	`xuatthan`, `nghetruoctuyendung`, `ngaytuyendung`, `coquanhientai_ngayvao`,
	`cachmang_ngayvao`, `dangcongsan_ngayvao`, `dangcongsan_ngaychinhthuc`, 
	`doantncs_ngayvao`, `congdoan_ngayvao`, `ngaynhapngu`, `ngayxuatngu`, 
	`quanhamcaonhat_ten`, `quanhamcaonhat_nam`, `giaoducphothong`, 
	`hochamcaonhat_ten`, `hochamcaonhat_nam`, `hochamcaonhat_chuyennganh`, 
	`lyluanchinhtri`, `ngoaingu_ten`, `ngoaingu_trinhdo`, `congtacdanglam`, 
	`ngachcongchuc_ten`, `ngachcongchuc_maso`, `ngachcongchuc_bacluong`, `ngachcongchuc_heso`, 
	`ngachcongchuc_thang`, `ngachcongchuc_nam`, 
	`danhhieu_ten`, `danhhieu_nam`, `sotruongcongtac`, `congvieclaunhat`, 
	`tinhtrangsuckhoe`, `chieucao`, `cannang`, `nhommau`, `cmnd`, 
	`thuongbinhloai`, `giadinhlietsy`,`chucvu`,
	`chucvudate`,
	`luong`, `thunhapkhac`,
	`khenthuong`, `namkhenthuong`)
	VALUES (NULL, 
	NULL, '$dvTrucThuoc', '$dvCoSo', '$sohieucb', 
	'$hoTen', '$gioiTinh', '$tenKhac', '$capUyHienTai', '$capUyKiem', 
	'$sinhNam-$sinhThang-$sinhNgay', '$nsXa - $nsHuyen - $nsTinh', '$queXa', '$queHuyen', '$queTinh', 
	'$noiO', '$dienThoai', 
	'$danToc', '$tonGiao',
	'$tpgdXuatThan', '$ngheTruocTuyenDung', '$ngayTuyenDung', '$ngayVaoCoQuan', 
	'$ngayThamGiaCM', '$ngayVaoDang', '$ngayChinhThucDang', 
	'$ngayThamGiaToChucTC', 'congdoan_ngayvao=boqua', '$ngayNhapNgu', '$ngayXuatNgu', 
	'$quanHam', '$namQuanHam', '$lopHocVan', 
	'$tenHocVi', '$namHocVi', '$chuyenNganh', 
	'$capLyLuan', '$ngoaiNguTen', '$ngoaiNguTrinhDo', '$congTacChinh', 
	'$ngachCongChuc', '$maNgach', '$bacLuong', '$heSoLuong', 
	'$ngayLuongThang', '$ngayLuongNam', 
	'$tenDanhHieu', '$namDanhHieu', '$soTruongCongTac', '$congViecLauNhat', 
	'$sucKhoe', '$cao', '$nang', '$nhomMau', '$cmnd',
	'$loaiThuongBinh', '$gdLietSi','$chucVu',
	'$chucVuNam-$chucVuThang-$chucVuNgay',
	'$luong', '$nguonKhac',
	'$khenThuong', '$namKhenThuong')";
	
	// execute sql if no error found
	$success = $success && $myget->getReturnCode();
	if ($success){
		$result = mysql_query($sql);
		if (!$result){
			$error .= "Invalid Query";
			die(mysql_error());
		} else {
			//echo "<p>Ok Ly lich</p>";
		}
		$lylich_id = mysql_insert_id();
	}
	
	//
	// tbl_daotao
	//
	list($x, $y) = $myget->getAddressCell("tbl_daotao");
	$y++;
	$array = $myget->getCellTable("B".$y, array(
		array("cellName" => "B", "description" => "Mục 26: Tên trường", "flag"=> 0),
		array("cellName" => "D", "description" => "Mục 26: Ngành học hoặc tên lớp", "flag"=> 0), 
		array("cellName" => "H", "description" => "Mục 26: Thời gian học", "flag"=> MyGetter::$FLAG_2DATE),
		array("cellName" => "K", "description" => "Mục 26: Hình thức học", "flag"=> 0),
		array("cellName" => "M", "description" => "Mục 26: Văn bằng, chứng chỉ", "flag"=> 0),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$tenTruong 		= $row['B'.$y];
			$nganhHoc 		= $row['D'.$y];
			$thoiGianHoc 	= $row['H'.$y];
			$hinhThucHoc 	= $row['K'.$y];
			$vanBang 		= $row['M'.$y];
			
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`daotao` (`id`, `lylich_id`, `tentruong`, `nganhhoc`, 
			`thoigianhoc`, `hinhthuchoc`, `vanbang`, `daotao_boiduong`) 
			VALUES (NULL, '$lylich_id', '$tenTruong', '$nganhHoc', 
			'$thoiGianHoc', '$hinhThucHoc', '$vanBang', '0')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok daotao</p>";
			$y++;
		}
	}
	
	//
	// tbl_kyluat
	//
	list($x, $y) = $myget->getAddressCell("tbl_kyluat");
	$y++;
	$array = $myget->getCellTable("B".$y, array(
		array("cellName" => "B", "description" => "Mục 23: Cấp quyết định", "flag"=> 0),
		array("cellName" => "D", "description" => "Mục 23: Năm quyết định", "flag"=> MyGetter::$FLAG_INTEGER_ONLY), 
		array("cellName" => "E", "description" => "Mục 23: Lý do", "flag"=> 0),
		array("cellName" => "F", "description" => "Mục 23: Hình thức", "flag"=> 0),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$capQuyetDinh 	= $row['B'.$y];
			$namKL 			= $row['D'.$y];
			$lyDoKL 			= $row['E'.$y];
			$hinhThucKL 	= $row['F'.$y];
			
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`kyluat` (`id`, `lylich_id`, `capquyetdinh`, `nam`, `lydo`, `hinhthuc`) 
			VALUES (NULL, '$lylich_id', '$capQuyetDinh', '$namKL', '$lyDoKL', '$hinhThucKL')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			///echo "<p>ok kyluat</p>";
			$y++;
		}
	}
	
	//
	// tbl_qtcongtac
	//
	list($x, $y) = $myget->getAddressCell("tbl_congtac");
	$y += 2;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Mục 27: Thời gian công tác", "flag"=> MyGetter::$FLAG_2DATE),
		array("cellName" => "E", "description" => "Mục 27: Chức danh, chức vụ, đơn vị công tác", "flag"=> 0),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$thoiGian 		= $row['B'.$y];
			$chucVuCT 		= $row['E'.$y];
			
			$thoiGian = explode('-', $thoiGian);
			convertDate($thoiGian[0]);
			convertDate($thoiGian[1]);
			
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`congtac` (`id`, `lylich_id`, `thoidiem_batdau`, `thoidiem_ketthuc`, `chucvu`) 
			VALUES (NULL, '$lylich_id', '$thoiGian[0]', '$thoiGian[1]', '$chucVuCT')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok congtac</p>";
			$y++;
		}
	}
	
	//
	// tbl_bibat
	//
	list($x, $y) = $myget->getAddressCell("tbl_bibat");
	$y++;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Mục 28: Thời gian bị bát", "flag"=> MyGetter::$FLAG_2DATE),
		array("cellName" => "D", "description" => "Mục 28: Khai báo cho ai", "flag"=> 0),
		array("cellName" => "F", "description" => "Mục 28: Vấn đề khai báo", "flag"=> 0),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$thoiGian 		= $row['B'.$y];
			$khaiBaoChoAi 	= $row['D'.$y];
			$vandeKhaiBao 	= $row['F'.$y];
			// *** do chua co lydo, nen mac dinh de bibat
			$lyDo = "bi bat";
			$oDau = "bi bat o dau";
			
			// process data here
			$thoiGian = explode('-', $thoiGian);
			convertDate($thoiGian[0]);
			convertDate($thoiGian[1]);
			
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`phamphap` (`id`, `lylich_id`, `lydo`, `thoidiem_batdau`, `thoidiem_ketthuc`, `odau`, `khaibaocho`, `vande`) 
			VALUES (NULL, '$lylich_id', 'lyDo', '$thoiGian[0]', '$thoiGian[1]', '$oDau', '$khaiBaoChoAi', '$vandeKhaiBao')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok phamphap</p>";
			$y++;
		}
	}
	
	//
	// tbl_chedocu
	//
	list($x, $y) = $myget->getAddressCell("tbl_chedocu");
	$y++;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Mục 28: Thời gian", "flag"=> MyGetter::$FLAG_2DATE),
		array("cellName" => "D", "description" => "Mục 28: Cơ quan", "flag"=> 0),
		array("cellName" => "F", "description" => "Mục 28: Đơn vị", "flag"=> 0),
		array("cellName" => "H", "description" => "Mục 28: Chức vụ", "flag"=> 0),
		array("cellName" => "J", "description" => "Mục 28: Địa điểm	", "flag"=> 0),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$soNamThang = $row['B'.$y];
			$coQuan = $row['D'.$y];
			$donVi = $row['F'.$y];
			$chucVu = $row['H'.$y];
			$diaDiem = $row['J'.$y];
	
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`chedocu` (`id`, `lylich_id`, `coquan`, `donvi`, `diadiem`, `chucvu`, `thoigian`) 
			VALUES (NULL, '$lylich_id', '$coQuan', '$donVi', '$diaDiem', '$chucVu', '$soNamThang')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok chedocu</p>";
			$y++;
		}
	}
	
	//
	// tbl_tentochuc
	//
	list($x, $y) = $myget->getAddressCell("tbl_tochucnn");
	$y++;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Mục 29: Tên tổ chức", "flag"=> 0),
		array("cellName" => "D", "description" => "Mục 29: Trụ sở", "flag"=> 0),
		array("cellName" => "F", "description" => "Mục 29: Nhiệm vụ", "flag"=> 0),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$tenToChuc 	= $row['B'.$y];
			$truSo 		= $row['D'.$y];
			$nhiemVu 	= $row['F'.$y];
	
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`tochucnuocngoai` (`id`, `lylich_id`, `lamgi`, `tochuc`, `truso`) 
			VALUES (NULL, '$lylich_id', '$nhiemVu', '$tenToChuc', '$truSo')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok tochucnuocngoai</p>";
			$y++;
		}
	}
	
	//
	// tbl_thannhannn
	//
	list($x, $y) = $myget->getAddressCell("tbl_thannhannn"); $y++;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Mục 29: Mối quan hệ", "flag"=> 0),
		array("cellName" => "C", "description" => "Mục 29: Họ và tên", "flag"=> 0),
		array("cellName" => "F", "description" => "Mục 29: Công việc", "flag"=> 0),
		array("cellName" => "I", "description" => "Mục 29: Địa chỉ", "flag"=> 0),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$mqh 			= $row['B'.$y];
			$hoTen 		= $row['C'.$y];
			$congViec 	= $row['F'.$y];
			$diaChi 		= $row['I'.$y];
	
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`thannhannuocngoai` (`id`, `lylich_id`, `quanhe`, `hoten`, `lamgi`, `diachi`) 
			VALUES (NULL, '$lylich_id', '$mqh', '$hoTen', '$congViec', '$diaChi')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			///echo "<p>ok thannhannuocngoai</p>";
			$y++;
		}
	}
	
	//
	// tbl_quanhegiadinh benruot
	//
	list($x, $y) = $myget->getAddressCell("tbl_giadinhruot");
	$y++; $y++; // jump to value row
	$allowBreak = false;
	while ($x > 0)
	{
		$quanhe = $myget->getCell("$x$y", "Mục 30a: Quan hệ", MyGetter::$FLAG_OPTION);
		
		if ($quanhe == "Anh chị em") {
			$allowBreak = true;
		}
		// bo qua tieu de
		$title = array("Bố, mẹ", "Vợ chồng", "Các con", "Anh chị em");
		if (in_array($quanhe, $title)){
			$y++;
			continue;		
		}
		
		if ($quanhe == ""){
			//echo "<p>=NULL BREAK HERE</p>";
			if ($allowBreak) break;
			$y++; continue;
		}
		// process data here
		$hoten = $myget->getCell("C".$y, "Mục 30a: Họ và tên");
		$namSinh = $myget->getCell("F".$y, "Mục 30a: Năm sinh", MyGetter::$FLAG_INTEGER_ONLY);
		$mota = $myget->getCell("H".$y, "Mục 30a: Quê quán, nghề nghiệp, chức danh, chức vụ,  đơn vị, công tác, học tập, nơi ở");
		$banthan_vochong = 0; // anh, chi, em ruot

		if (!$success){
			$y++;
			continue;
		}
		
		// insert to database
		$sql = "INSERT INTO `QLCBDoan`.`quanhegiadinh` (`id`, `lylich_id`, `quanhe`, `hoten`, `namsinh`, `mota`, `banthan_vochong`) 
		VALUES (NULL, '$lylich_id', '$quanhe', '$hoten', '$namSinh', '$mota', '$banthan_vochong')";

		$result = mysql_query($sql);
		if (!$result){
			die(mysql_error());
		}
		//echo "<p>ok quanhegiadinh benruot</p>";
		$y++;
	}
	
	//
	// tbl_quanhegiadinh benvo(chong)
	//
	list($x, $y) = $myget->getAddressCell("tbl_giadinhvochong");
	$y++; $y++; // jump to value row
	$allowBreak = false;
	while ($x > 0)
	{
		$quanhe = $myget->getCell("$x$y", "Mục 30b: Quan hệ", MyGetter::$FLAG_OPTION);
		
		if ($quanhe == "Anh chị em") {
			$allowBreak = true;
		}
		// bo qua tieu de
		$title = array("Bố, mẹ", "Anh chị em");
		if (in_array($quanhe, $title)){
			$y++;
			continue;		
		}
		
		if ($quanhe == ""){
			//echo "<p>=NULL BREAK HERE</p>";
			if ($allowBreak) break;
			$y++; continue;
		}
		
		// process data here
		$hoten = $myget->getCell("C".$y, "Mục 30b: Họ và tên");
		$namSinh = $myget->getCell("E".$y, "Mục 30b: Năm sinh", MyGetter::$FLAG_INTEGER_ONLY);
		$mota = $myget->getCell("G".$y, "Mục 30b: Quê quán, nghề nghiệp, chức danh, chức vụ,  đơn vị, công tác, học tập, nơi ở");
		$banthan_vochong = 1; // anh, chi, em benvo(chong)
		
		if (!$success){
			$y++;
			continue;
		}

		// insert to database
		$sql = "INSERT INTO `QLCBDoan`.`quanhegiadinh` (`id`, `lylich_id`, `quanhe`, `hoten`, `namsinh`, `mota`, `banthan_vochong`) 
		VALUES (NULL, '$lylich_id', '$quanhe', '$hoten', '$namSinh', '$mota', '$banthan_vochong')";

		$result = mysql_query($sql);
		if (!$result){
			die(mysql_error());
		}
		//echo "<p>ok quanhegiadinh benvo(chong)</p>";
		$y++;
	}
	
	//
	// tbl_quatrinhluong
	//
	list($x, $y) = $myget->getAddressCell("tbl_hoancanhgiadinh"); $y++;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Mục 31: Tháng/Năm", "flag"=> MyGetter::$FLAG_MONTHDATE),
		array("cellName" => "C", "description" => "Mục 31: Ngạch", "flag"=> 0),
		array("cellName" => "D", "description" => "Mục 31: Bậc", "flag"=> 0),
		array("cellName" => "E", "description" => "Mục 31: Hế số lương", "flag"=> 0),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$thoidiem 	= $row['B'.$y];
			$ngach 		= $row['C'.$y];
			$bac 			= $row['D'.$y];
			$heso 		= $row['E'.$y];
			
			convertDate($thoidiem);
	
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`quatrinhluong` (`id`, `lylich_id`, `thoidiem`, `ngach`, `bac`, `heso`) 
			VALUES (NULL, '$lylich_id', '$thoidiem', '$ngach', '$bac', '$heso')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok quatrinhluong</p>";
			$y++;
		}
	}
	
	
	//
	// tbl_nhao
	//
	//*** cap_thue_mua_xay khong can
	list($x, $y) = $myget->getAddressCell("tbl_loainha"); $y++;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Nhà ở: loại nhà", "flag" => 0),
		array("cellName" => "C", "description" => "Nhà ở: diện tích sử dụng", "flag" => MyGetter::$FLAG_INTEGER_ONLY),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$loainha 	= $row['B'.$y];
			$dientich 	= $row['C'.$y];
	
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`sohuunha` (`id`, `lylich_id`, `loainha`, `dientich`) 
			VALUES (NULL, '$lylich_id', '$loainha', '$dientich')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok sohuunha</p>";
			$y++;
		}
	}
	
	
	//
	// tbl_dato
	//
	//*** cap_thue_mua_xay khong can
	list($x, $y) = $myget->getAddressCell("tbl_loaidat"); $y++;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Đất ở: loại đất", "flag"=> 0),
		array("cellName" => "C", "description" => "Đất ở: diện tích sử dụng", "flag"=> MyGetter::$FLAG_INTEGER_ONLY),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$loaidat 	= $row['B'.$y];
			$dientich 	= $row['C'.$y];
	
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`sohuudat` (`id`, `lylich_id`, `loaidat`, `dientich`) 
			VALUES (NULL, '$lylich_id', '$loaidat', '$dientich')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok sohuudat</p>";
			$y++;
		}
	}
	
	//
	// tbl_thidua
	//
	//*** format ngay/thang/nam trong excel co van de???
	list($x, $y) = $myget->getAddressCell("tbl_thidua"); $y++;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Thi đua: Ngày/Tháng/Năm", "flag"=> MyGetter::$FLAG_DATE),
		array("cellName" => "D", "description" => "Thi đua: Danh hiệu thi đua", "flag"=> 0),
		array("cellName" => "G", "description" => "Thi đua: Lý do không xếp loại", "flag"=> 0),), false);
	if ($array != false && $success){
		//var_dump($array);
		foreach ($array as $row){
			$nam 			= $row['B'.$y];
			$danhhieu 	= $row['D'.$y];
			$lydo 		= $row['G'.$y];
			
			convertDate($nam);
	
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`thidua` (`id`, `lylich_id`, `nam`, `danhhieu`, `lydo`) 
			VALUES (NULL, '$lylich_id', '$nam', '$danhhieu', '$lydo')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok thidua</p>";
			$y++;
		}
	}
	
	if (!$myget->isValidExcelFile()){
		return array(3, array());
	}
	//var_dump($myget->getReturnCode(), $myget->getErrorTexts());die("");
	
	//echo $sql;
	if ($myget->getReturnCode() && $success){
		return array(0, array('ttcb'=>$ttcb));
	} else {
		return array(-1, array('ttcb'=>$ttcb, "errors"=>array_merge($myget->getErrorTexts(), $errors)));
	}
}

function xuLyFile(){
	$file = isset($_FILES['file']) ? $_FILES['file'] : null;
	//var_dump($_FILES, $file);
	if ($file == null || count($file['name']) == 0){
		echo "<p>Error when uploading file, error_code = " . $file['error'] . "</p>";
	} else {
		// init file from array file[]
		$files = array();
		for ($i = 0; $i < count($_FILES['file']['name']); $i++){
			$files[] = array("name"=>$_FILES['file']['name'][$i],
				"tmp_name"=>$_FILES['file']['tmp_name'][$i]);
		}
		//var_dump($files);
		
		$results = array();
		foreach ($files as $f){
			list($retCode, $data) = xuLyFile2($f['tmp_name']);
			//echo "<p><font color='red'>Return Code:</font></p>";
			//var_dump($retCode);
			$results[] = array("file"=> $f, 
				"retcode" => $retCode, 
				"data" => $data);
			//var_dump($data);
		}
		
		echo "<p><h1>Kết quả nhập tập tin:</h1></p>";		
		echo "<table class='tg' style='undefined;table-layout: fixed; width: 100%;'>
					<colgroup>
					<col style='width: 136px'>
					<col style='width: 146px'>
					<col style='width: 91px'>
					<col style='width: 186px'>
					<col style='width: 248px'>
					</colgroup>
			  <tr>
					<th class='tg-s6z2'>Tên file</th>
					<th class='tg-s6z2'>Họ và tên</th>
					<th class='tg-s6z2'>Ngày sinh</th>
					<th class='tg-s6z2'>Chức vụ - Đơn vị</th>
					<th class='tg-s6z2'>Thông báo</th>
			  </tr>";
		$i = 1; // for show/hide errorString_$i
		foreach ($results as $row){
			
			$errorTitle = "";
			$errorList = "";
			$display = "style='display:none'";
			$retCode = $row['retcode'];
			switch ($retCode){
				case 0:
					$errorTitle = "Nhập thành công thông tin cán bộ";
					break;		
				case 1:
					$errorTitle = "<font color='red'>Lỗi:</font> Tập tin tải lên không phải là tập tin Excel.";
					break;
				case 2:
					$errorTitle = "<font color='red'>Lỗi:</font> Thông tin của cán bộ đã tồn tại.
					<br>Liên hệ admin để nhập lại tập tin.";
					break;
				case 3:
					$errorTitle = "<font color='red'>Lỗi:</font> Tập tin excel bị lỗi hoặc không được hỗ trợ.";
					$errorList = "Hãy chắc chắn rằng tập tin excel này được tải từ trang chủ rồi mới chỉnh sửa, mọi thao thác chỉnh sửa trên tập tin excel khác đều không được hỗ trợ.";
					$display = "";					
					break;
				default:
					$errorTitle = "<font color='red'>Lỗi:</font> Hãy chắc chắn rằng các trường sau đã được điền đầy đủ và đúng theo định dạng:";
					//var_dump($row['errors']);
					foreach ($row['data']['errors'] as $err){
						$errorList = $errorList . "<li>$err</li>";
					}
					$display = "";
					break;
			}
			
			$fileName = $row['file']['name'];
			
			$ttcb = isset($row['data']['ttcb']) ? $row['data']['ttcb'] : false;
			if (!$ttcb){
				$hoten = "Lỗi khi đọc";
				$namsinh = "Lỗi khi đọc";
				$capuy_donvi = "Lỗi khi đọc";
			} else {
				$hoten = $ttcb['hoten'];
				$namsinh = $ttcb['namsinh'];
				$capuy_donvi = $ttcb['capuy_donvi'];
			}
			echo "<tr>
					<td class='tg-s6z2'>$fileName</td>
					<td class='tg-s6z2'>$hoten</td>
					<td class='tg-s6z2'>$namsinh</td>
					<td class='tg-s6z2'>$capuy_donvi</td>
					<td class='tg-s6z2'>$errorTitle<br><br>
						<div style='display:none; margin-bottom:10px;text-align:left;' id='errorString$i'>$errorList						
						</div>
						<input type='button' $display id='showButton$i' onclick=\"javascript:showErrorString('#errorString$i', '#showButton$i')\" value='Hiện lỗi'>
					</td>
			  	</tr>";
			$i++;
		}
		echo "</table>";
	}
	//echo "<p><a href='../../PL/NhapFileCB/PLNhapFileCB.php'>Okay</a></p>";
}

