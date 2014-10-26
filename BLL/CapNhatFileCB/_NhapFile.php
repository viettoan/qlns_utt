<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', TRUE);
echo "<meta charset='utf-8'>";*/
ini_set('max_execution_time', 3*60);

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
			
			// highlight cell
			$this->highLightCell($cellName);
		} else {
			// remove highlight
			list($x,$y) = $this->getAddressCell($cellName);
			if ($x < 0 || $y < 0){
				return $val;
			}
			$cellName = $x.$y;
			$this->_excel->getActiveSheet()->getStyle($cellName)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$this->_excel->getActiveSheet()->getStyle($cellName)->getFill()->getStartColor()->setARGB('FFFFFFFF');
		}
		
		//var_dump($val);
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
	function highLightCell($cellName){
		//$cellName = "D36";
		list($x,$y) = $this->getAddressCell($cellName);
		if ($x < 0 || $y < 0)
			return;
		$cellName = $x.$y;
		$this->_excel->getActiveSheet()->getStyle($cellName)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$this->_excel->getActiveSheet()->getStyle($cellName)->getFill()->getStartColor()->setARGB('FFFFFF00');
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

function buildQuery(& $sql, $key, $var){
	if ($var != "")
		$sql = $sql . " $key = '$var', ";
	return $sql;
}

function getLyLichIdFromCmnd($cmnd){
	$sql = "SELECT * FROM lylich WHERE cmnd='$cmnd'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	if ($count == 1){
		$lylich_id = $row['id'];
	} else {
		$lylich_id = false;
	}
	return $lylich_id;
}

function xuLyFile2($fileName){
	$success = true;
	$errors = array();
	$ttcb = array();
	$ttcb['hoten'] = 'ho ten';
	$ttcb['namsinh'] = 'nam sinh';
	$ttcb['capuy_donvi'] = 'cap uy don vi';
	$ttcb['cmnd'] = 123;
	
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
	
	$sql = "UPDATE lylich SET ";
	
	
	// read from excel
	$cmnd = $myget->getCell("cmnd", "CMND", MyGetter::$FLAG_INTEGER_ONLY);
	if (!isExistCMND($cmnd)){
		return array(2, array('ttcb'=>$ttcb));
	}
	
	//1
	$hoTen = $myget->getCell("hoten", "Mục 1: Họ và tên khai sinh");
	buildQuery($sql, 'hoten', $hoTen);
	$gioiTinh = $myget->getCell("gioitinh", "Mục 4: Giới tính");
	if ($gioiTinh == "Nam") $gioiTinh = 1;
	else $gioiTinh = 0;
	buildQuery($sql, 'gioitinh', $gioiTinh);
	//2
	$tenKhac = $myget->getCell("tengoikhac", "Mục 1: Tên khác");
	buildQuery($sql, 'tengoikhac', $tenKhac);
	//3
	$chucVu = $myget->getCell("chucvu", "Mục 3: Chức vụ");	
	buildQuery($sql, 'chucvu', $chucVu);
	//***$phuCapCV = $myget->getCell("phucap_chucvu", "Mục 9: Phụ cấp chức vụ");
	//4
	$ngaySinh = $myget->getCell("ngaysinh", "Mục 3: ngày sinh", MyGetter::$FLAG_DATE);
	convertDate($ngaySinh);
	buildQuery($sql, 'ngaysinh', $ngaySinh);
	
	//14
	$ngayVaoDang = $myget->getCell("dang_ngayvao", "Mục 9: Ngày vào Đảng Cộng Sản", MyGetter::$FLAG_DATE);
	convertDate($ngayVaoDang);
	buildQuery($sql, 'dangcongsan_ngayvao', $ngayVaoDang);
	
	$ngayChinhThucDang = $myget->getCell("dang_ngaychinhthuc", "Mục 9: Ngày vào Đảng Cộng Sản chính thức", MyGetter::$FLAG_DATE);
	convertDate($ngayChinhThucDang);
	buildQuery($sql, 'dangcongsan_ngaychinhthuc', $ngayChinhThucDang);
	
	//19
	$ngachCongChuc = $myget->getCell("congchuc_ngach", "Mục 5: Tên ngạch công chức");
	buildQuery($sql, 'ngachcongchuc_ten', $ngachCongChuc);
	$maNgach = $myget->getCell("congchuc_mangach", "Mục 6: Mã ngạch");
	buildQuery($sql, 'ngachcongchuc_maso', $maNgach);
	$bacLuong = $myget->getCell("bacluong", "Mục 7: Bậc lương");
	buildQuery($sql, 'ngachcongchuc_bacluong', $bacLuong);
	$heSoLuong = $myget->getCell("luong_heso", "Mục 8: Hệ số lương");
	buildQuery($sql, 'ngachcongchuc_heso', $heSoLuong);
	$ngayLuong = $myget->getCell("ngayluong", "Mục 8: Ngày lương", MyGetter::$FLAG_MONTHDATE);
	$tmp = explode('/', $ngayLuong);
	if (count($tmp) == 2){
		$ngayLuongNam = $tmp[1];
		$ngayLuongThang = $tmp[0];
	} else {
		$ngayLuongNam = "";
		$ngayLuongThang = "";
	}
	buildQuery($sql, 'ngachcongchuc_thang', "$ngayLuongNam-$ngayLuongThang");
	
	//20
	$tmp = $myget->getCell2(array(
		array("cellName" => "khenthuong", "description" => "Khen thưởng", "flag"=> 0), 
		array("cellName" => "khenthuong_nam", "description" => "Năm khen thưởng", "flag"=> 0)));
	$tenDanhHieu = $tmp["khenthuong"];
	$namDanhHieu = $tmp["khenthuong_nam"];
	buildQuery($sql, 'danhhieu_ten', $tenDanhHieu);
	buildQuery($sql, 'danhhieu_nam', $namDanhHieu);

	
	//24
	$sucKhoe = $myget->getCell("suckhoe_tinhtrang", "Sức khỏe: tình trạng");
	$cao = $myget->getCell("suckhoe_chieucao", "Sức khỏe: Chiều cao");
	$nang = $myget->getCell("suckhoe_cannang", "Sức khỏe: Cân nặng");
	$nhomMau = $myget->getCell("suckhoe_nhommau", "Sức khỏe: Nhóm máu");
	
	buildQuery($sql, 'tinhtrangsuckhoe', $sucKhoe);
	buildQuery($sql, 'chieucao', $cao);
	buildQuery($sql, 'cannang', $nang);
	buildQuery($sql, 'nhommau', $nhomMau);
	
	// thong tin can bo -> thong bao ket qua
	$ttcb = array();
	$ttcb['hoten'] = ($hoTen != "") ? $hoTen : "Lỗi khi đọc";
	$ttcb['namsinh'] = ($ngaySinh != "") ? ($ngaySinh) : "Lỗi khi đọc";
	
	//31
	$luong = $myget->getCell("kinhte_luong", "Lương");
	$nguonKhac = $myget->getCell("kinhte_nguonkhac", "Nguồn khác");
	
	buildQuery($sql, 'luong', $luong);
	buildQuery($sql, 'thunhapkhac', $nguonKhac);
	
	
	//
	// insert to lylich
	//
	$sql = $sql . " cmnd = $cmnd where cmnd = $cmnd ";
	
	// execute sql if no error found
	$success = $success && $myget->getReturnCode();
	if ($success){
		$result = mysql_query($sql);
		if (!$result){
			die(mysql_error());
		}
	}
	$lylich_id = getLyLichIdFromCmnd($cmnd);
	
	//
	// tbl_daotao
	//
	list($x, $y) = $myget->getAddressCell("tbl_daotao");
	$y++;
	$array = $myget->getCellTable("A".$y, array(
		array("cellName" => "A", "description" => "Mục 26: Tên trường", "flag"=> 0),
		array("cellName" => "D", "description" => "Mục 26: Ngành học hoặc tên lớp", "flag"=> 0), 
		array("cellName" => "H", "description" => "Mục 26: Thời gian học", "flag"=> MyGetter::$FLAG_2DATE),
		array("cellName" => "K", "description" => "Mục 26: Hình thức học", "flag"=> 0),
		array("cellName" => "M", "description" => "Mục 26: Văn bằng, chứng chỉ", "flag"=> 0),), false);
	//var_dump($array);
	if ($array != false && $success){
		foreach ($array as $row){
			$tenTruong 		= $row['A'.$y];
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
	
	//return array(-1, array('ttcb'=>$ttcb, 'errors'=>array("dsfasf","dfasfd")));
	
	//
	// tbl_kyluat
	//
	list($x, $y) = $myget->getAddressCell("tbl_kyluat");
	$y++;
	$array = $myget->getCellTable("A".$y, array(
		array("cellName" => "A", "description" => "Mục 23: Cấp quyết định", "flag"=> 0),
		array("cellName" => "D", "description" => "Mục 23: Năm quyết định", "flag"=> MyGetter::$FLAG_INTEGER_ONLY), 
		array("cellName" => "E", "description" => "Mục 23: Lý do", "flag"=> 0),
		array("cellName" => "J", "description" => "Mục 23: Hình thức", "flag"=> 0),), false);
	//var_dump($array);
	if ($array != false && $success){
		foreach ($array as $row){
			$capQuyetDinh 	= $row['A'.$y];
			$namKL 			= $row['D'.$y];
			$lyDoKL 		= $row['E'.$y];
			$hinhThucKL 	= $row['J'.$y];
			
			// insert to database
			$sql = "INSERT INTO `QLCBDoan`.`kyluat` (`id`, `lylich_id`, `capquyetdinh`, `nam`, `lydo`, `hinhthuc`) 
			VALUES (NULL, '$lylich_id', '$capQuyetDinh', '$namKL', '$lyDoKL', '$hinhThucKL')";
	
			$result = mysql_query($sql);
			if (!$result){
				die(mysql_error());
			}
			//echo "<p>ok kyluat</p>";
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
		array("cellName" => "E", "description" => "Mục 29: Trụ sở", "flag"=> 0),
		array("cellName" => "H", "description" => "Mục 29: Nhiệm vụ", "flag"=> 0),), false);
	//var_dump($array);
	if ($array != false && $success){
		foreach ($array as $row){
			$tenToChuc 	= $row['B'.$y];
			$truSo 		= $row['E'.$y];
			$nhiemVu 	= $row['H'.$y];
	
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
	// tbl_quanhegiadinh benruot
	//
	$gd = array();
	list($x, $y) = $myget->getAddressCell("tbl_giadinh");
	$y++; // jump to value row
	$allowBreak = false;
	while (!($x < 0))
	{
		$quanhe = $myget->getCell("$x$y", "Mục 30a: Quan hệ", MyGetter::$FLAG_OPTION);
		if ($quanhe == "Anh chị em ruột") {
			$allowBreak = true;
		}
		// bo qua tieu de
		$title = array("Bố mẹ", "Vợ, chồng", "Các con", "Anh chị em ruột");
		if (in_array($quanhe, $title)){
			$y++;
			continue;
		}
		
		// bo qua dong trong
		if ($quanhe == ""){
			if ($allowBreak) break;
			$y++; continue;
		}
		
		// process data here
		$hoten = $myget->getCell("D".$y, "Mục 30a: Họ và tên");
		$namSinh = $myget->getCell("G".$y, "Mục 30a: Năm sinh", MyGetter::$FLAG_INTEGER_ONLY);
		$mota = $myget->getCell("H".$y, "Mục 30a: Quê quán, nghề nghiệp, chức danh, chức vụ,  đơn vị, công tác, học tập, nơi ở");
		$banthan_vochong = 0; // anh, chi, em ruot
		
		$row = array();
		$row['quanhe'] = $quanhe;
		$row['hoten'] = $hoten;
		$row['namsinh'] = $namSinh;
		$row['mota'] = $mota;
		$gd[] = $row;
		
		$y++;
	}
	//var_dump($gd);
	foreach ($gd as $row){
		// neu co quan he truoc do -> set thong tin
		$sql = "SELECT * FROM quanhegiadinh WHERE lylich_id='$lylich_id' and banthan_vochong=0 and quanhe='{$row['quanhe']}' and namsinh='{$row['namsinh']}'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		if ($count == 1){
			$qh = mysql_fetch_array($result);
			$id = $qh['id'];
			$sql = "UPDATE quanhegiadinh set hoten = '{$row['hoten']}' , namsinh='{$row['namsinh']}', mota='{$row['mota']}' where id={$id}";
		}
		// neu chua co -> them vao
		else if ($count == 0) {
			$sql = "INSERT INTO `quanhegiadinh` (`id`, `lylich_id`, `quanhe`, `hoten`, `namsinh`, `mota`, `banthan_vochong`) 
				VALUES (NULL, '$lylich_id', '{$row['quanhe']}', '{$row['hoten']}', '{$row['namsinh']}', '{$row['mota']}', '0')";
		}
		
		$result = mysql_query($sql);
		if (!$result){
			die(mysql_error());
		}
	}
	
	//
	// tbl_quatrinhluong
	//
	list($x, $y) = $myget->getAddressCell("tbl_qtluong"); $y++;
	$array = $myget->getCellTable("$x$y", array(
		array("cellName" => "B", "description" => "Mục 31: Tháng/Năm", "flag"=> MyGetter::$FLAG_MONTHDATE),
		array("cellName" => "D", "description" => "Mục 31: Ngạch", "flag"=> 0),
		array("cellName" => "E", "description" => "Mục 31: Bậc", "flag"=> 0),
		array("cellName" => "F", "description" => "Mục 31: Hế số lương", "flag"=> 0),), false);
	//var_dump($array);
	if ($array != false && $success){
		foreach ($array as $row){
			$thoidiem 	= $row['B'.$y];
			$ngach 		= $row['D'.$y];
			$bac 		= $row['E'.$y];
			$heso 		= $row['F'.$y];
			
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
		array("cellName" => "D", "description" => "Nhà ở: diện tích sử dụng", "flag" => MyGetter::$FLAG_INTEGER_ONLY),), false);
	//var_dump($array);
	if ($array != false && $success){
		
		foreach ($array as $row){
			$loainha 	= $row['B'.$y];
			$dientich 	= $row['D'.$y];
	
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
		array("cellName" => "D", "description" => "Đất ở: diện tích sử dụng", "flag"=> MyGetter::$FLAG_INTEGER_ONLY),), false);
	//var_dump($array);
	if ($array != false && $success){
		
		foreach ($array as $row){
			$loaidat 	= $row['B'.$y];
			$dientich 	= $row['D'.$y];
	
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
	
	if (!$myget->isValidExcelFile()){
		return array(3, array());
	}
	//var_dump($myget->getReturnCode(), $myget->getErrorTexts());
	
	if ($myget->getReturnCode() && $success){
		return array(0, array('ttcb'=>$ttcb));
	} else {
		$errors = array_merge($myget->getErrorTexts(), $errors);
		$worksheet = $excel->getActiveSheet();
		$worksheet->setCellValue('dsLoi', "Danh sách lỗi");
		list($x, $y) = $myget->getAddressCell('dsLoi');
		if ($x < 0 || $y < 0){
			die('Cannot set error texts');
		}
		$oldErrorCount = $myget->getCell('soLoi', "", MyGetter::$FLAG_OPTION);
		if ($oldErrorCount != ""){
			$y2 = $y;
			for ($i = 0; $i < $oldErrorCount; $i++){
				++$y2;
				$worksheet->setCellValue($x.$y2, "");
			}
		}
		$worksheet->setCellValue('soLoi', count($errors));
		foreach ($errors as $err){
			++$y;
			$worksheet->setCellValue($x.$y , $err);
		}
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$objWriter->save($fileName);
		return array(-1, array('ttcb'=>$ttcb, "errors"=>$errors));
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

