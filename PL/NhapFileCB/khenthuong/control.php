<?php 
require_once('../../../config/config.php');
require_once('_functions.php');

if ( ( isset($_GET['action']) ) && ( $_GET['action'] == "destroy" ) ) {
	$id = $_GET['id'];
	if (destroy_($id) != false) {
		echo "Xóa thành công!";
	} else {
		echo "Xóa thất bại";
	}
}

if ( ( isset($_POST['action']) ) && ( ( $_POST['action'] == 'new' ) || ( $_POST['action'] == 'edit' ) )  ) {
	$lylich_id 		= $_POST['lylich_id'];
	$khenthuong 	= $_POST['khenthuong'];
	$loaikhenthuong = $_POST['loaikhenthuong'];
	$cap 			= $_POST['cap'];
	$tunam 			= $_POST['tunam'];
	$dennam 		= $_POST['dennam'];
	$noidung 		= $_POST['noidung'];

	if ( $_POST['action'] == 'new' ) {		
		if( new_( $lylich_id, $khenthuong, $loaikhenthuong, $cap, $tunam, $dennam, $noidung ) ) {
			echo '<script>alert("Thêm mới thành công!"); window.location.replace("' . $host . '/PL/NhapFileCB/khenthuong.php")</script>';
		} else {
			echo '<script>alert("Thêm mới thất bại!"); window.location.replace("' . $host . '/PL/NhapFileCB/khenthuong.php")</script>';
		}
	}

	if ( $_POST['action'] == 'edit' ) {
		$id = $_POST['id'];
		if( edit_( $id, $lylich_id, $khenthuong, $loaikhenthuong, $cap, $tunam, $dennam, $noidung ) ) {
			echo '<script>alert("Cập nhật thành công!"); window.location.replace("' . $host . '/PL/NhapFileCB/khenthuong.php")</script>';
		} else {
			echo '<script>alert("Cập nhật thất bại!"); window.location.replace("' . $host . '/PL/NhapFileCB/khenthuong.php")</script>';
		}
	}
}

?>