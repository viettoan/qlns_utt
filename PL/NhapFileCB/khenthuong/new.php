<form action="khenthuong/control.php" method="POST" class="form-horizontal" role="form">
	<input type="text" class="hidden" name="lylich_id" value="<?php echo $_GET['lylich_id'] ?>">
	<div class="form-group">
		<legend>Thêm khen thưởng</legend>
	</div>

	<div class="form-group">
		<label>Khen thưởng <span style="color: red;">*</span></label>
		<select class="form-control" name="khenthuong" required>
			<option value="">Chọn</option>
			<option value="CÁ NHÂN ĐƯỢC TẶNG BẰNG KHEN CỦA BỘ GTVT">CÁ NHÂN ĐƯỢC TẶNG BẰNG KHEN CỦA BỘ GTVT</option>
			<option value="DANH HIỆU CHIẾN SỸ THI ĐUA CƠ SỞ, BỘ NGÀNH">DANH HIỆU CHIẾN SỸ THI ĐUA CƠ SỞ, BỘ NGÀNH</option>
			<option value="DANH HIỆU CHIẾN SỸ THI ĐUA BỘ NGÀNH">DANH HIỆU CHIẾN SỸ THI ĐUA BỘ NGÀNH</option>
			<option value="KHEN THƯỞNG CẤP NHÀ NƯỚC">KHEN THƯỞNG CẤP NHÀ NƯỚC</option>
		</select>
	</div>

	<div class="form-group">
		<label>Loại khen thưởng <span style="color: red;">*</span></label>
		<select class="form-control" name="loaikhenthuong" required>
			<option value="">Chọn</option>
			<option value="Bằng khen">Bằng khen</option>
			<option value="Chiến sỹ thi đua cấp cơ sở">Chiến sỹ thi đua cấp cơ sở</option>
			<option value="Chiến sỹ thi đua cấp ngành">Chiến sỹ thi đua cấp ngành</option>
		</select>
	</div>

	<div class="form-group">
		<label>Cấp <span style="color: red;">*</span></label>
		<select class="form-control" name="cap" required>
			<option value="">Chọn</option>
			<option value="Trường">Cấp Trường</option>
			<option value="Bộ">Cấp Bộ</option>
			<option value="Nhà nước">Cấp Nhà nước</option>
		</select>
	</div>

	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Từ năm <span style="color: red;">*</span></label>
				<select class="form-control" name="tunam" required>
					<option value="">Năm</option>
				<?php for($i = 1990; $i <= 2020; $i++): ?>
					<option value="<?php echo $i ?>"><?php echo $i ?></option>
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
					<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php endfor ?>
				</select>
			</div>
		</div>
	</div>

	

	<div class="form-group">
		<label>Mô tả / Nội dung khen thưởng</label>
		<textarea class="form-control" rows="4" name="noidung"></textarea>
	</div>
	
	
	<div class="form-group">
		<div class="text-right">
			<button type="submit" name="action" class="btn btn-primary" value="new">Thêm mới</button>
		</div>
	</div>
</form>