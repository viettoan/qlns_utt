<?php require_once('khenthuongtapthe/_functions.php') ?>
<?php $khenthuongtapthes = get_khenthuongtapthes() ?>

<a href="#ex1" onclick="new_()" rel="modal:open" style="padding-bottom: 20px"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm mới</button></a>
<a href="<?php echo $host . '/PL/TienIch/khenthuongtapthe.php' ?>" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Cập nhật</a>
<hr>
<table class="display">
	<thead>
		<th>ID</th>
		<th>Cá nhân / Tập thể</th>
		<th>Khen thưởng</th>
		<th>Loại khen thưởng</th>
		<th>Cấp</th>
		<th>Từ năm</th>
		<th>Đến năm</th>
		<th></th>
	</thead>
	<tbody>
	<?php while ($row = mysql_fetch_array($khenthuongtapthes)): ?>
		<tr>
			<td><?php echo $row['id'] ?></td>
			<?php $loaitapthe = $row['loaitapthe'] ?>
			<?php $tapthe_id  = $row['tapthe_id']  ?>
			<td>
				<?php if ($loaitapthe == "Cơ sở đào tạo"): ?>
					<?php echo get_csdt_from_csdt($tapthe_id)['name'] ?>
				<?php endif ?>
				<?php if ($loaitapthe == "Khoa phòng ban"): ?>
					<?php
						$donvi = get_all_from_kpb($tapthe_id);
						echo $donvi['kpb_name'] . ' _ ' . $donvi['csdt_name'];
					?>
				<?php endif ?>
				<?php if ($loaitapthe == "Bộ môn tổ"): ?>
					<?php
						$donvi = get_all_from_bmt($tapthe_id);
						echo $donvi['bmt_name'] . ' _ ' . $donvi['kpb_name'] . ' _ ' . $donvi['csdt_name'];
					?>
				<?php endif ?>
				<?php if ($loaitapthe == "Cán bộ"): ?>
					<?php
						$donvi = get_all_from_lylich($tapthe_id);
						echo $donvi['lylich_hoten'] . ' _ ' . $donvi['bmt_name'] . ' _ ' . $donvi['kpb_name'] . ' _ ' . $donvi['csdt_name'];
					?>
				<?php endif ?>
			</td>
			<td><?php echo $row['khenthuong'] ?></td>
			<td><?php echo $row['loaikhenthuong'] ?></td>
			<td><?php echo $row['cap'] ?></td>
			<td><?php echo $row['tunam'] ?></td>
			<td><?php echo $row['dennam'] ?></td>
			<td>
				<center>
					<a href="#ex1" rel="modal:open" onclick="edit_(<?php echo $row['id'] ?>)">Chi tiết</a>
					<a href="#" onclick="del_(<?php echo $row['id'] ?>)">Xóa</a>
				</center>
			</td>
		</tr>
	<?php endwhile; ?>
	</tbody>
</table>

<div id="ex1" style="display:none;">
</div>

<script>
	$('table').DataTable({ order: [0, "desc"]});

	function del_(id) {
		var r = confirm("Bạn chắc chắn xóa!");
		if (r == true) {
		    $.get('khenthuongtapthe/control.php?action=destroy&id=' + id, function(data) { alert(data); location.reload(); });
		    location.reload();
		}
	}

	function new_() {
		$('#ex1').html('<p>Đang tải...</p>');
		$.get('khenthuongtapthe/new.php', function(data) { 
			$('#ex1').html(data);
		});
	}

	function edit_(id) {
		$('#ex1').html('<p>Đang tải...</p>');
		$.get('khenthuongtapthe/edit.php?id=' + id, function(data) { 
			$('#ex1').html(data);
		});
	}

</script>