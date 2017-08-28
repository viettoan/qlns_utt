<h3>Sửa thông tin Chức vụ</h3>
<?php if ( (isset($_GET['action'])) && ($_GET['action'] == 'edit') ): ?>
	<?php $id = $_GET['id'] ?>
	<?php $chucvu = get_chucvu($id) ?>
	<!-- <h4><a href="<?php// echo $host ?>/PL/TienIch/quatrinhchucvu.php">Trở về toàn bộ danh sách</a></h4> -->
	<?php if(isset($chucvu['lylich_id']) ): ?> 
		<h4><a href="<?php echo $host ?>/PL/NhapFileCB/Nhapmanhinh.php">Trở về trang Lý lịch của <?php echo get_lylich($chucvu['lylich_id'])['hoten'] ?> </a></h4> 
		<h4><a href="<?php echo $host ?>/PL/TienIch/quatrinhchucvu.php?lylich_id=<?php echo $chucvu['lylich_id'] ?>">Trở về danh sách của <?php echo get_lylich($chucvu['lylich_id'])['hoten'] ?></a></h4>
	<?php endif ?>
	<?php require_once('_form.php') ?>
<?php endif ?>
