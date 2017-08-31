<?php require_once('khenthuong/_functions.php') ?>

<a href="#ex1" onclick="new_(<?php echo $_SESSION['lylich_id'] ?>)" rel="modal:open"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm mới</button></a>

<?php $khenthuongs = get_khenthuongs($_SESSION['lylich_id']) ?>
<?php if (mysql_num_rows($khenthuongs) == 0): ?>
	<h3>Không có khen thưởng nào, chọn <kbd>Thêm mới</kbd> để thêm một khen thưởng.</h3>
<?php else: ?>
<table class="table table-striped table-hover table-bordered">
	<thead>
	  <tr>
	    <th>Khen thưởng</th>
	    <th>Loại khen thưởng</th>
	    <th>Cấp</th>
	    <th>Từ năm</th>
	    <th>Đến năm</th>
	    <th></th>
	  </tr>
	</thead>
	<tbody>

	<?php while ($row = mysql_fetch_array($khenthuongs)): ?>
	  <tr>
	    <td><?php echo $row['khenthuong'] ?></td>
	    <td><?php echo $row['loaikhenthuong'] ?></td>
	    <td><center><?php echo $row['cap'] ?></center></td>
	    <td><center><?php echo $row['tunam'] ?></center></td>
	    <td><center><?php echo $row['dennam'] ?></center></td>
	    <td>
	    	<center>
		      <a href="#ex1" onclick="edit_(<?php echo $row['id'] ?>)" rel="modal:open">Chi tiết</a> - 
		      <a href="#" onclick="del_(<?php echo $row['id'] ?>)">Xóa</a>
		    </center>
	    </td>
	  </tr>
	 <?php endwhile; ?>
<?php endif; ?>
</tbody>
</table>

<div id="ex1" style="display:none;">
</div>

<script>
	function del_(id) {
		var r = confirm("Bạn chắc chắn xóa!");
		if (r == true) {
		    $.get('khenthuong/control.php?action=destroy&id=' + id, function(data) { alert(data); location.reload(); });
		    location.reload();
		}
	}

	function new_(lylich_id) {
		$('#ex1').html('<p>Đang tải...</p>');
		$.get('khenthuong/new.php?lylich_id=' + lylich_id, function(data) { 
			$('#ex1').html(data);
		});
	}

	function edit_(id) {
		$('#ex1').html('<p>Đang tải...</p>');
		$.get('khenthuong/edit.php?id=' + id, function(data) { 
			$('#ex1').html(data);
		});
	}
</script>