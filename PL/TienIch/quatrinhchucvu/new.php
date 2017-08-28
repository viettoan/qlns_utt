<h3>Thêm mới một Chức vụ</h3>
<?php if ( ($_GET['action'] == 'new') && ( $_GET['lylich_id'] ) ): ?>
	<h4 style="padding-top: 10px; padding-bottom: 10px;">Cán bộ <?php echo get_lylich($_GET['lylich_id'])['hoten'] ?></h4>
<?php endif ?>
<!-- <h4><a href="<?php// echo $host ?>/PL/TienIch/quatrinhchucvu.php">Trở về toàn bộ danh sách</a></h4> -->
<?php if(isset($_GET['lylich_id']) ): ?> 
	<h4><a href="<?php echo $host ?>/PL/NhapFileCB/Nhapmanhinh.php">Trở về trang Lý lịch của <?php echo get_lylich($_GET['lylich_id'])['hoten'] ?> </a></h4> 
	<h4><a href="<?php echo $host ?>/PL/TienIch/quatrinhchucvu.php?lylich_id=<?php echo $_GET['lylich_id'] ?>">Trở về danh sách của <?php echo get_lylich($_GET['lylich_id'])['hoten'] ?></a></h4>
<?php endif ?>
<?php 
	require_once('_form.php');
?>