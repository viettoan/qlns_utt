<h3>Sửa thông tin loại chức vụ</h3>
<a href="<?php echo $host ?>/PL/TienIch/loaichucvu.php">Trở về danh sách</a>
<br><br>
<?php if ( (isset($_GET['action'])) && ($_GET['action'] == 'edit') ): ?>
	<?php $id = $_GET['id'] ?>
	<?php $loaichucvu = get_loaichucvu($id) ?>
	<?php require_once('_form.php') ?>
<?php endif ?>
