<?php 
	require_once('../../../config/config.php');
	require_once('functions.php');

	$destroy_id = ( isset($_GET['action']) 
					&& ($_GET['action'] == 'destroy') 
					&& (isset($_GET['id'])) ) ? $_GET['id'] : false;
	if($destroy_id != false) {
		if(chucvu_destroy($destroy_id)) {
			echo 'Xóa thành công';
		} else {
			echo 'Xóa thất bại';
		}
	}

	$submit = isset($_POST['submit']) ? $_POST['submit'] : false;

	if($submit != false) {
		$lylich_id 		= $_POST['lylich_id'];
		$ten 			= $_POST['ten'];
		$loaichucvu_id 	= $_POST['loaichucvu_id'];
		$thoidiem 		= $_POST['thoidiem'];
		$phucap 		= $_POST['phucap'];
		$files 			= $_FILES['file_scan'];
		$ghichu 		= $_POST['ghichu'];
		if($submit == 'Thêm mới thông tin') {
			$chucvu_new = chucvu_new($lylich_id, $ten, $loaichucvu_id, $thoidiem, $phucap, $files, $ghichu);
			if($chucvu_new == false) {
				echo "<script>alert('Có lỗi xảy ra, thêm mới thất bại.');window.location.replace(\"$host/PL/TienIch/quatrinhchucvu.php?action=new&lylich_id=$lylich_id\");</script>";
				// echo '<br>' . mysql_error();
				//echo '<br>' . $sql;
			} else {
				echo "<script>alert('Thêm mới thành công');window.location.replace(\"$host/PL/TienIch/quatrinhchucvu.php?action=edit&id=" . get_last_insert() . "\");</script>";
			}
		}

		if($submit == 'Cập nhật thông tin') {

			$id = $_POST['id'];

			$chucvu_edit = chucvu_edit($id, $lylich_id, $ten, $loaichucvu_id, $thoidiem, $phucap, $files, $ghichu);
			if($chucvu_edit == false) {
				echo "<script>alert('Cập nhật thất bại');window.location.replace(\"$host/PL/TienIch/quatrinhchucvu.php?action=edit&id=$id\");</script>";
				// echo '<br>' . mysql_error();
				//echo '<br>' . $sql;
				echo 'false';
			} else {
				echo "<script>alert('Cập nhật thành công');window.location.replace(\"$host/PL/TienIch/quatrinhchucvu.php?action=edit&id=$id\");</script>";
			}
		}

	}

?>