<h4 style="padding-bottom: 20px"><a href="<?php echo $host ?>/PL/TienIch/loaichucvu.php?action=new">Thêm mới</a></h4>
  
<table class="table display">
	<thead>
		<th>Tên loại chức vụ</th>
		<th>Số Chức vụ trong nhóm</th>
		<th></th>
	</thead>
	<tbody>
		<?php $loaichucvus = get_loaichucvus(); ?>
		<?php while ($row = mysql_fetch_array($loaichucvus)): ?>
			<?php $chucvu_count = chucvu_count($row['id']); ?>
			<tr>
				<td><?php echo $row['ten']; ?></td>
				<td><?php if($chucvu_count > 0) echo "$chucvu_count"; ?></td>
				<td>
					<a href="loaichucvu.php?action=edit&id=<?php echo $row['id'] ?>">Xem chi tiết</a>
					<?php if ($chucvu_count == 0) : ?>
						| <a href="#" onclick="return delete_row(<?php echo $row['id'] ?>)">Xóa</a>
					<?php endif ?>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
<script>
	function delete_row(id) {
		var r = confirm("Bạn chắc chắn xóa!");
		if (r == true) {
		    $.get('<?php echo $host ?>/PL/TienIch/loaichucvu/control.php?action=destroy&id=' + id, function(data) { alert(data); location.reload(); });
		    location.reload();
		}
	}

	$('.table').dataTable({
		searching: false,
		paging: false,
	});
</script>