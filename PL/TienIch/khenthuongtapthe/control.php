<?php 
require_once('../../../config/config.php');
require_once('_functions.php');

if ( ( isset($_GET['action']) ) && ( $_GET['action'] == 'ajax' ) ) {
	
	if( isset($_GET['csdt']) ) {
		$tctts = get_tctt_from_csdt($_GET['csdt']);
		$options = '<option value="">Tổ chức trực thuộc</option>';
		while($row = mysql_fetch_array($tctts)) {
			$options .= '<option value="' . $row['tochuctructhuocid'] . '">' . $row['name'] . '</option>';
		}
		echo $options;
	}

	if( isset($_GET['tctt']) ) {
		$kpbs = get_kpb_from_tctt($_GET['tctt']);
		$options = '<option value="">Khoa phòng ban</option>';
		while($row = mysql_fetch_array($kpbs)) {
			$options .= '<option value="' . $row['khoaphongbanid'] . '">' . $row['name'] . '</option>';
		}
		echo $options;
	}

	if( isset($_GET['kpb']) ) {
		$bmts = get_bmt_from_kpb($_GET['kpb']);
		$options = '<option value="">Khoa phòng ban</option>';
		while($row = mysql_fetch_array($bmts)) {
			$options .= '<option value="' . $row['bomontoid'] . '">' . $row['name'] . '</option>';
		}
		echo $options;
	}
}





if ( ( isset($_GET['action']) ) && ( $_GET['action'] == 'cbajax' ) ) {
	if( isset($_GET['csdt']) ) {
		$cbs = get_cb_from_csdt($_GET['csdt']);
		$options = '<option value="">Cán bộ (' . mysql_num_rows($cbs) . ')</option>';
		while($row = mysql_fetch_array($cbs)) {
			$options .= '<option value="' . $row['id'] . '">' . $row['hoten'] . ' (' .date("d-m-Y",strtotime($row['ngaysinh'])) .')</option>';
		}
		echo $options;
	};
	if( isset($_GET['tctt']) ) {
		$cbs = get_cb_from_tctt($_GET['tctt']);
		$options = '<option value="">Cán bộ (' . mysql_num_rows($cbs) . ')</option>';
		while($row = mysql_fetch_array($cbs)) {
			$options .= '<option value="' . $row['id'] . '">' . $row['hoten'] . ' (' .date("d-m-Y",strtotime($row['ngaysinh'])) .')</option>';
		}
		echo $options;
	};
	if( isset($_GET['kpb']) ) {
		$cbs = get_cb_from_kpb($_GET['kpb']);
		$options = '<option value="">Cán bộ (' . mysql_num_rows($cbs) . ')</option>';
		while($row = mysql_fetch_array($cbs)) {
			$options .= '<option value="' . $row['id'] . '">' . $row['hoten'] . ' (' .date("d-m-Y",strtotime($row['ngaysinh'])) .')</option>';
		}
		echo $options;
	};
	if( isset($_GET['bmt']) ) {
		$cbs = get_cb_from_bmt($_GET['bmt']);
		$options = '<option value="">Cán bộ (' . mysql_num_rows($cbs) . ')</option>';
		while($row = mysql_fetch_array($cbs)) {
			$options .= '<option value="' . $row['id'] . '">' . $row['hoten'] . ' (' .date("d-m-Y",strtotime($row['ngaysinh'])) .')</option>';
		}
		echo $options;
	};
};

if ( ( isset($_GET['action']) ) && ( $_GET['action'] == 'destroy' ) ) {
	$id = $_GET['id'];
	if( destroy_($id) ){
		echo 'Xóa thành công!';
	} else {
		echo 'Xóa thất bại.';
	}

};



if ( isset($_POST['action']) ) {
	$loaitapthe = $_POST['loaitapthe'];

	if($loaitapthe == 'Cơ sở đào tạo') {
		$tapthe_id = $_POST['cosodaotao_id'];
	}
	if($loaitapthe == 'Khoa phòng ban') {
		$tapthe_id = $_POST['khoaphongban_id'];
	}
	if($loaitapthe == 'Bộ môn tổ') {
		$tapthe_id = $_POST['bomonto_id'];
	}
	if($loaitapthe == 'Cán bộ') {
		$tapthe_id = $_POST['lylich_id'];
	}

	$khenthuong 	= $_POST['khenthuong'];
	$loaikhenthuong = $_POST['loaikhenthuong'];
	$cap 			= $_POST['cap'];
	$tunam 			= $_POST['tunam'];
	$dennam 		= $_POST['dennam'];
	$noidung 		= $_POST['noidung'];

	if ( $_POST['action'] == 'new' ) {		
		if( new_($loaitapthe, $tapthe_id, $khenthuong, $loaikhenthuong, $cap, $tunam, $dennam, $noidung) ) {
			// echo '<script>alert("Thêm mới thành công!"); window.location.replace("' . $host . '/PL/TienIch/khenthuongtapthe.php")</script>';
			echo "Thêm mới thành công.";
		} else {
			// echo '<script>alert("Thêm mới thất bại!"); window.location.replace("' . $host . '/PL/TienIch/khenthuongtapthe.php")</script>';
			echo "Có lỗi xảy ra, thêm mới thất bại.";
		}
	}

	if ( $_POST['action'] == 'edit' ) {	
		$id = $_POST['id'];
		if( edit_($id, $loaitapthe, $tapthe_id, $khenthuong, $loaikhenthuong, $cap, $tunam, $dennam, $noidung) ) {
			// echo '<script>alert("Cập nhật thành công!"); window.location.replace("' . $host . '/PL/TienIch/khenthuongtapthe.php")</script>';
			echo "Cập nhật thành công.";
		} else {
			// echo '<script>alert("Cập nhật thất bại!"); window.location.replace("' . $host . '/PL/TienIch/khenthuongtapthe.php")</script>';
			echo "Có lỗi xảy ra, cập nhật thất bại.";
		}
	}
}

?>