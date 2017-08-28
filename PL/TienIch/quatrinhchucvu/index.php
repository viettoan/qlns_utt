<?php if( isset($_GET['lylich_id']) ): ?>
	<?php $lylich_id = $_GET['lylich_id']; ?>		
	<h3 style="padding-bottom: 20px"><?php echo get_lylich($lylich_id)['hoten']; ?></h3>
	<h4><a href="<?php echo $host ?>/PL/NhapFileCB/Nhapmanhinh.php">Trở về trang Lý lịch của <?php echo get_lylich($lylich_id)['hoten']; ?> </a></h4> 
	<h4 style="padding-bottom: 20px"><a href="<?php echo $host ?>/PL/TienIch/quatrinhchucvu.php?action=new&lylich_id=<?php echo $lylich_id ?>">Thêm mới cho <?php echo get_lylich($lylich_id)['hoten']; ?></a></h4>
<?php else: ?>
	<!-- <h4 style="padding-bottom: 20px"><a href="<?php// echo $host ?>/PL/TienIch/quatrinhchucvu.php?action=new">Thêm mới</a></h4> -->
<?php endif ?>
  
<table class="table display">
	<thead>
	<?php if ( !isset($_GET['lylich_id']) ): ?>
		<th>Họ tên</th>
	<?php endif ?>
		<th>Loại chức vụ</th>
		<th>Chức vụ</th>
		<th>Thời điểm</th>
		<th>Phụ cấp</th>
		<th></th>
	</thead>
	<tbody>

		<?php if (isset($_GET['lylich_id']) ): ?>
			<?php $chucvus = get_chucvus($_GET['lylich_id']); ?>
		<?php else: ?>
			<?php $chucvus = get_chucvus(); ?>
		<?php endif ?>

		<?php while ($row = mysql_fetch_array($chucvus)): ?>
			<tr>
			<?php if (!isset($_GET['lylich_id']) ): ?>
				<td><?php $lylich = get_lylich($row['lylich_id']); echo $lylich['hoten']; ?></td>
			<?php endif ?>
				<td><?php $loaichucvu = get_loaichucvu($row['loaichucvu_id']); echo $loaichucvu['ten']; ?></td>
				<td><?php echo $row['ten']; ?></td>
				<td><?php echo $row['thoidiem'] ?></td>
				<td><?php echo $row['phucap'] ?></td>
				<td>
					<a href="quatrinhchucvu.php?action=edit&id=<?php echo $row['id'] ?>">Xem chi tiết</a> |
					<a href="#" onclick="return delete_row(<?php echo $row['id'] ?>)">Xóa</a>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
<script>
	function delete_row(id) {
		var r = confirm("Bạn chắc chắn xóa!");
		if (r == true) {
		    $.get('<?php echo $host ?>/PL/TienIch/quatrinhchucvu/control.php?action=destroy&id=' + id, function(data) { alert(data); location.reload(); });
		    location.reload();
		}
	}

	$('.table').dataTable({
		<?php if(isset($_GET['lylich_id'])): ?>
			"order": [[ 2, "desc" ]],
			searching: false,
			paging: false,
		<?php else: ?>
			"order": [[ 3, "desc" ]],
		<?php endif ?>
	});
</script>