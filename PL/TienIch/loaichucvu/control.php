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

		$ten = $_POST['ten'];

		if($submit == 'Thêm mới thông tin') {
			$loaichucvu_new = loaichucvu_new($ten);
			if($loaichucvu_new == false) {
				echo "<script>alert('Có lỗi xảy ra, thêm mới thất bại.');window.location.replace(\"$host/PL/TienIch/loaichucvu.php?action=new\");</script>";
				// echo '<br>' . mysql_error();
				//echo '<br>' . $sql;
			} else {
				echo "<script>alert('Thêm mới thành công');window.location.replace(\"$host/PL/TienIch/loaichucvu.php?action=edit&id=" . get_last_insert() . "\");</script>";
			}
		}

		if($submit == 'Cập nhật thông tin') {

			$id = $_POST['id'];

			$loaichucvu_edit = loaichucvu_edit($id, $ten);
			if($loaichucvu_edit == false) {
				echo "<script>alert('Cập nhật thất bại');window.location.replace(\"$host/PL/TienIch/loaichucvu.php?action=edit&id=$id\");</script>";
				// echo '<br>' . mysql_error();
				//echo '<br>' . $sql;
			} else {
				echo "<script>alert('Cập nhật thành công');window.location.replace(\"$host/PL/TienIch/loaichucvu.php?action=edit&id=$id\");</script>";
			}
		}

	}

?>