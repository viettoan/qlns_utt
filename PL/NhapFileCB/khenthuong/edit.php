<?php 
	require_once('../../../config/config.php');
	require_once ('_functions.php');
	$id = $_GET['id'];
	$row = get_khenthuong($id);
?>
<form action="khenthuong/control.php" method="POST" class="form-horizontal" role="form">
	<input type="text" class="hidden" name="id" value="<?php echo $id ?>">
	<input type="text" class="hidden" name="lylich_id" value="<?php echo $row['lylich_id'] ?>">
	<div class="form-group">
		<legend>Chi tiết khen thưởng</legend>
	</div>

	<div class="form-group">
		<label>Khen thưởng <span style="color: red;">*</span></label>
		<select class="form-control" name="khenthuong" required>
			<option value="">Chọn</option>
			<option value="CÁ NHÂN ĐƯỢC TẶNG BẰNG KHEN CỦA BỘ GTVT" <?php if ( $row['khenthuong'] ==  "CÁ NHÂN ĐƯỢC TẶNG BẰNG KHEN CỦA BỘ GTVT" ) echo 'selected' ?>>CÁ NHÂN ĐƯỢC TẶNG BẰNG KHEN CỦA BỘ GTVT</option>
			<option value="DANH HIỆU CHIẾN SỸ THI ĐUA CƠ SỞ, BỘ NGÀNH" <?php if ( $row['khenthuong'] ==  "DANH HIỆU CHIẾN SỸ THI ĐUA CƠ SỞ, BỘ NGÀNH" ) echo 'selected' ?>>DANH HIỆU CHIẾN SỸ THI ĐUA CƠ SỞ, BỘ NGÀNH</option>
			<option value="DANH HIỆU CHIẾN SỸ THI ĐUA BỘ NGÀNH" <?php if ( $row['khenthuong'] ==  "DANH HIỆU CHIẾN SỸ THI ĐUA CƠ SỞ, BỘ NGÀNH" ) echo 'selected' ?>>DANH HIỆU CHIẾN SỸ THI ĐUA BỘ NGÀNH</option>
			<option value="KHEN THƯỞNG CẤP NHÀ NƯỚC" <?php if ( $row['khenthuong'] ==  "DANH HIỆU CHIẾN SỸ THI ĐUA CƠ SỞ, BỘ NGÀNH" ) echo 'selected' ?>>KHEN THƯỞNG CẤP NHÀ NƯỚC</option>
		</select>
	</div>

	<div class="form-group">
		<label>Loại khen thưởng <span style="color: red;">*</span></label>
		<select class="form-control" name="loaikhenthuong" required>
			<option value="">Chọn</option>
			<option value="Bằng khen" <?php if($row['loaikhenthuong'] == 'Bằng khen') echo 'selected' ?>>Bằng khen</option>
			<option value="Chiến sỹ thi đua cấp cơ sở" <?php if($row['loaikhenthuong'] == 'Chiến sỹ thi đua cấp cơ sở') echo 'selected' ?>>Chiến sỹ thi đua cấp cơ sở</option>
			<option value="Chiến sỹ thi đua cấp ngành" <?php if($row['loaikhenthuong'] == 'Chiến sỹ thi đua cấp ngành') echo 'selected' ?>>Chiến sỹ thi đua cấp ngành</option>
		</select>
	</div>

	<div class="form-group">
		<label>Cấp <span style="color: red;">*</span></label>
		<select class="form-control" name="cap" required>
			<option value="">Chọn</option>
			<option value="Trường" <?php if($row['cap'] == 'Trường') echo 'selected' ?>>Cấp Trường</option>
			<option value="Bộ" <?php if($row['cap'] == 'Bộ') echo 'selected' ?>>Cấp Bộ</option>
			<option value="Nhà nước" <?php if($row['cap'] == 'Nhà nước') echo 'selected' ?>>Cấp Nhà nước</option>
		</select>
	</div>

	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Từ năm <span style="color: red;">*</span></label>
				<select class="form-control" name="tunam" required>
					<option value="">Năm</option>
				<?php for($i = 1990; $i <= 2020; $i++): ?>
					<option value="<?php echo $i ?>" <?php if($row['tunam'] == $i) echo 'selected' ?>><?php echo $i ?></option>
				<?php endfor ?>
				</select>
			</div>
		</div>

		<div class="col-md-2">
		</div>

		<div class="col-md-5">
			<div class="form-group">
				<label>Đến năm <span style="color: red;">*</span></label>
				<select class="form-control" name="dennam" required>
					<option value="">Năm</option>
				<?php for($i = 1990; $i <= 2020; $i++): ?>
					<option value="<?php echo $i ?>" <?php if($row['dennam'] == $i) echo 'selected' ?>><?php echo $i ?></option>
				<?php endfor ?>
				</select>
			</div>
		</div>
	</div>

	

	<div class="form-group">
		<label>Mô tả / Nội dung khen thưởng</label>
		<textarea class="form-control" rows="4" name="noidung"><?php echo $row['noidung'] ?></textarea>
	</div>
	
	
	<div class="form-group">
		<div class="text-right">
			<button type="submit" name="action" class="btn btn-primary" value="edit">Cập nhật</button>
		</div>
	</div>
</form>