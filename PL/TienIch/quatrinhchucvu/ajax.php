<?php 
	require_once('../../../config/config.php');
	require_once('functions.php');
?>
<?php if( isset($_GET['lylich_id']) ): ?>
	<?php $lylich_id = $_GET['lylich_id']; ?>
	<?php $hoten = get_lylich($lylich_id)['hoten']; ?>		
	<h3 style="padding-bottom: 10px"><?php echo $hoten; ?></h3>
	<a href="<?php echo $host ?>/PL/TienIch/quatrinhchucvu.php?lylich_id=<?php echo $lylich_id ?>">Xem lịch sử thay đổi chức vụ của <?php echo $hoten ?></a><br>
	<a href="<?php echo $host ?>/PL/TienIch/quatrinhchucvu.php?action=new&lylich_id=<?php echo $lylich_id ?>">Thêm mới chức vụ cho <?php echo $hoten ?></a>
	<?php $chucvus = get_chucvus($lylich_id); ?>
	<?php if ( mysql_num_rows($chucvus) == 0 ): ?>
		<p>Chưa có lịch sử thay đổi chức vụ của cán bộ.</p>
	<?php else: ?>
		<?php while($row = mysql_fetch_array($chucvus)): ?>
			<p><strong>[<?php echo $row['thoidiem'] ?>]</strong> <?php echo $row['ten'] ?> <a href="<?php echo $host ?>/PL/TienIch/quatrinhchucvu.php?action=edit&id=<?php echo $row['id'] ?>">(Chi tiết)</a></p>

			<center>
				<?php $files = $row['file_name'] ?>
				<?php if ( $files != '' ): ?>
					<?php $file_arr = explode(",",$files) ?>
					<?php for($i=0; $i < count($file_arr); $i++): ?>
							<a href="<?php echo $host ?>/PL/TienIch/quatrinhchucvu/uploads/<?php echo $file_arr[$i] ?>"  target="_blank">
								<img src="<?php echo $host ?>/PL/TienIch/quatrinhchucvu/uploads/<?php echo $file_arr[$i] ?>" style="max-width: 250px;" align="middle">
							</a>
					<?php endfor; ?>
				<?php endif ?>
			</center>
		<?php endwhile ?>
	<?php endif ?>
<?php endif ?>

