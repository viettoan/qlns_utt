<form action="loaichucvu/control.php" method="post">
	<?php if ( isset($_GET['id']) && $_GET['id'] != '' ): ?>
		<input type="text" name="id" class="hidden" value="<?php echo $id ?>">
	<?php endif ?>
	<div class="form-group">
		<label>Tên chức vụ <span style="color:red">*</span></label>
		<input type="text" name="ten" class="form-control" value="<?php echo $loaichucvu['ten'] ?>" required>
	</div>
	<?php if ($action == 'new'): ?>
		<input type="submit" name="submit" class="btn btn-primary" value="Thêm mới thông tin">
	<?php else: ?>
		<input type="submit" name="submit" class="btn btn-primary" value="Cập nhật thông tin">
	<?php endif ?>
</form>