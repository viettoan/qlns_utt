<form action="khenthuongtapthe/control.php" method="POST" class="form-horizontal" role="form">
	<div class="form-group">
		<legend>Khen thưởng</legend>
	</div>
	<?php if (isset($kt)): ?>
		<input type="text" name="id" hidden="" value="<?php echo $kt['id'] ?>">
	<?php endif ?>
	<div class="form-group">
		<label>Đơn vị <span style="color: red;">*</span></label>
		<div class="row">
			<div class="col-md-4">
				<input type="radio" id="rd_csdt" name="loaitapthe" value="Cơ sở đào tạo"  <?php if(!isset($kt) || ($kt['loaitapthe'] == 'Cơ sở đào tạo')) echo 'checked' ?>>  Cơ sở đào tạo:
			</div>
			<div class="col-md-8">
				<select class="form-control" name="cosodaotao_id" id="cosodaotao" style="margin-bottom: 2px; height: 30px" required>
					<option value="">Cơ sở đào tạo</option>
				<?php $csdts = get_csdt() ?>
				<?php while ($row = mysql_fetch_array($csdts)): ?>
					<option value="<?php echo $row['cosodaotaoid'] ?>"><?php echo $row['name'] ?></option>
				<?php endwhile; ?>
				<?php if (!empty($cosodaotao_id)): ?>
					<option value="<?php echo $cosodaotao_id ?>" selected><?php echo $cosodaotao_value ?></option>
				<?php endif ?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<input type="radio" id="rd_tctt" name="loaitapthe" value="Tổ chức trực thuộc" disabled>  T.chức trực thuộc:
			</div>
			<div class="col-md-8">
				<select class="form-control" id="tochuctructhuoc" style="margin-bottom: 2px; height: 30px" disabled>
				<option value="">Tổ chức trực thuộc</option>
				<?php if (!empty($tochuctructhuoc_id)): ?>
					<option value="<?php echo $tochuctructhuoc_id ?>" selected><?php echo $tochuctructhuoc_value ?></option>
				<?php endif ?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<input type="radio" id="rd_kpb" name="loaitapthe" value="Khoa phòng ban" <?php if(isset($kt) && ($kt['loaitapthe'] == 'Khoa phòng ban')) echo 'checked' ?>>  Khoa phòng ban:
			</div>
			<div class="col-md-8">
				<select class="form-control disabled" name="khoaphongban_id" id="khoaphongban" style="margin-bottom: 2px; height: 30px" disabled>
					<option value="">Khoa phòng ban</option>
					<?php if (!empty($khoaphongban_id)): ?>
						<option value="<?php echo $khoaphongban_id ?>" selected><?php echo $khoaphongban_value ?></option>
					<?php endif ?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<input type="radio" id="rd_bmt" name="loaitapthe" value="Bộ môn tổ" <?php if(isset($kt) && ($kt['loaitapthe'] == 'Bộ môn tổ')) echo 'checked' ?>>  Bộ môn tổ:
			</div>
			<div class="col-md-8">
				<select class="form-control disabled" name="bomonto_id" id="bomonto" style="margin-bottom: 2px; height: 30px" disabled>
					<option value="">Bộ môn tổ</option>
					<?php if (!empty($bomonto_id)): ?>
						<option value="<?php echo $bomonto_id ?>" selected><?php echo $bomonto_value ?></option>
					<?php endif ?>
				</select>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<input type="radio" id="rd_bmt" name="loaitapthe" value="Cán bộ" <?php if(isset($kt) && ($kt['loaitapthe'] == 'Cán bộ')) echo 'checked' ?>>  Cán bộ:
			</div>
			<div class="col-md-8">
				<select class="form-control disabled" name="lylich_id" id="canbo" style="margin-bottom: 2px; height: 30px" disabled>
					<option value="">Cán bộ</option>
					<?php if (!empty($canbo_id)): ?>
						<option value="<?php echo $canbo_id ?>" selected><?php echo $canbo_value ?></option>
					<?php endif ?>
				</select>
			</div>
		</div>

	</div>

	<div class="form-group">
		<label>Khen thưởng <span style="color: red;">*</span></label>
		<select id="khenthuong" class="form-control" name="khenthuong" required>
			<option value="">Khen thưởng tập thể</option>
			<?php 

				//// Khen thưởng

				// Khen thưởng tập thể
				$khenthuongtapthe  = ['1. Tập thể lao động tiên tiến',
								'2. Tập thể lao động xuất sắc',
								'3. Cờ thi đua xuất sắc của Bộ Giao thông vận tải',
								'4. Cờ thi đua Chính phủ',
								'5. Huân, huy chương các loại',
								'6. Bằng khen Bộ trưởng bộ Giao thông vận tải',
								'7. Bằng khen của Thủ tướng Chính phủ'];


				// Khen thưởng cá nhân
				$khenthuongcanhan = ['1. Lao động tiên tiến',
									'2. Chiến sĩ Thi đua cơ sở',
									'3. Bằng khen Bộ trưởng Bộ Giao thông vận tải',
									'4. Chiến sĩ thi đua Ngành Giao thông vận tải',
									'5. Chiến sĩ thi đua Toàn quốc',
									'6. Bằng khen của Thủ tướng chính phủ',
									'7. Huân chương Lao động (Hạng 1,2,3)',
									'8. Kỷ niệm chương Vì sự nghiệp phát triển Giao thông vận tải Việt Nam',
									'9. Kỷ niệm chương Vì sự nghiệp giáo dục'];
				$khenthuong = $khenthuongtapthe;
				if(isset($kt) && ($kt['loaitapthe'] == 'Cán bộ')) 
					$khenthuong = $khenthuongcanhan;

			?>
			<?php foreach ($khenthuong as $key => $value): ?>
				<option value="<?php echo $value ?>" <?php if(isset($kt) && ($kt['khenthuong'] == $value)) echo 'selected' ?>><?php echo $value ?></option>
			<?php endforeach ?>
		</select>
	</div>

	
	
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Loại kh. thưởng: <span style="color: red;">*</span></label>
				<select class="form-control" name="loaikhenthuong" required>
					<option value="">Loại khen thưởng</option>
					<?php 
						$loaikhenthuong = ['Bằng khen',
											'Chiến sỹ thi đua cấp cơ sở',
											'Chiến sỹ thi đua cấp ngành'];
					?>
					<?php foreach ($loaikhenthuong as $key => $value): ?>
						<option value="<?php echo $value ?>" <?php if(isset($kt) && ($kt['loaikhenthuong'] == $value)) echo 'selected' ?>><?php echo $value ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>

		<div class="col-md-2"></div>

		<div class="col-md-5">
			<div class="form-group">
				<label>Cấp <span style="color: red;">*</span></label>
				<select class="form-control" name="cap" required>
					<option value="">Cấp</option>
					<?php 
						$cap = ['Cấp Trường', 
								'Cấp Bộ',
								'Cấp Nhà nước'] 
					?>
					<?php foreach ($cap as $key => $value): ?>
						<option value="<?php echo $value ?>" <?php if(isset($kt) && ($kt['cap'] == $value)) echo 'selected' ?>><?php echo $value ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>
	

	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Từ năm <span style="color: red;">*</span></label>
				<select class="form-control" name="tunam" id="tunam" required>
					<option value="">Năm</option>
				<?php for($i = 1990; $i <= 2030; $i++): ?>
					<option value="<?php echo $i ?>" <?php if(isset($kt) && ($kt['tunam'] == $i)) echo 'selected' ?>><?php echo $i ?></option>
				<?php endfor ?>
				</select>
			</div>
		</div>

		<div class="col-md-2">
		</div>

		<div class="col-md-5">
			<div class="form-group">
				<label>Đến năm <span style="color: red;">*</span></label>
				<select class="form-control" name="dennam" id="dennam" required>
					<option value="">Năm</option>
				<?php for($i = 1990; $i <= 2030; $i++): ?>
					<option value="<?php echo $i ?>" <?php if(isset($kt) && ($kt['dennam'] == $i)) echo 'selected' ?>><?php echo $i ?></option>
				<?php endfor ?>
				</select>
			</div>
		</div>
	</div>

	

	<div class="form-group">
		<label>Mô tả / Nội dung khen thưởng</label>
		<textarea class="form-control" rows="4" name="noidung"><?php if(isset($kt)) echo $kt['noidung'] ?></textarea>
	</div>
	
	
	<div class="form-group">
		<div class="text-right">
			<?php if(isset($kt)): ?>
				<input type="text" name="action" value="edit" hidden="">
				<button type="submit" name="action" class="btn btn-primary" value="">Cập nhật</button>
			<?php else: ?>
				<input type="text" name="action" value="new" hidden="">
				<button type="submit" name="action" class="btn btn-primary" value="">Lưu lại</button>
			<?php endif ?>

		</div>
	</div>
</form>
<script>

	var input_khenthuongtapthe = "<option value=''>Khen thưởng tập thể</option>";
	<?php for($i = 0; $i < count($khenthuongtapthe); $i++): ?>
		input_khenthuongtapthe += "<option value='" + <?php echo '"'.$khenthuongtapthe[$i].'"' ?> + "'>" + <?php echo '"'.$khenthuongtapthe[$i].'"' ?> + "</option>";
	<?php endfor ?>

	var input_khenthuongcanhan = "<option value=''>Khen thưởng cá nhân</option>";
	<?php for($i = 0; $i < count($khenthuongcanhan); $i++): ?>
		input_khenthuongcanhan += "<option value='" + <?php echo '"'.$khenthuongcanhan[$i].'"' ?> + "'>" + <?php echo '"'.$khenthuongcanhan[$i].'"' ?> + "</option>";
	<?php endfor ?>


	$(document).ready(function(){
		$checked =  $( "input:checked" ).val();
		if ($checked == "Cơ sở đào tạo") {
			$('#tochuctructhuoc').attr('disabled', true);
			$('#khoaphongban').attr('disabled', true);
			$('#bomonto').attr('disabled', true);
			$('#canbo').attr('disabled', true);

			$('#cosodaotao').attr('required', true);
			$('#khoaphongban').removeAttr('required');
			$('#bomonto').removeAttr('required');
			$('#canbo').removeAttr('required');
		}

		if ($checked == "Khoa phòng ban") {
			$('#tochuctructhuoc').removeAttr('disabled');
			$('#khoaphongban').removeAttr('disabled');
			$('#bomonto').attr('disabled', true);
			$('#canbo').attr('disabled', true);

			$('#cosodaotao').attr('required');
			$('#khoaphongban').attr('required', true);
			$('#bomonto').removeAttr('required');
			$('#canbos').removeAttr('required');
		}

		if ($checked == "Bộ môn tổ"	) {
			$('#tochuctructhuoc').removeAttr('disabled');
			$('#khoaphongban').removeAttr('disabled');
			$('#bomonto').removeAttr('disabled');
			$('#canbo').attr('disabled', true);

			$('#cosodaotao').attr('required', true);
			$('#khoaphongban').attr('required', true);
			$('#bomonto').attr('required', true);
			$('#canbo').removeAttr('required');
		}

		if ($checked == "Cán bộ") {
			$('#tochuctructhuoc').removeAttr('disabled');
			$('#khoaphongban').removeAttr('disabled');
			$('#bomonto').removeAttr('disabled');
			$('#canbo').removeAttr('disabled');

			$('#cosodaotao').attr('required', true);
			$('#khoaphongban').removeAttr('required');
			$('#bomonto').removeAttr('required');
			$('#canbo').attr('required', true);
		}

	});



	// this is the id of the form
	$("form").submit(function(e) {

	    var url = "khenthuongtapthe/control.php"; // the script where you handle the form input.

	    $.ajax({
	           type: "POST",
	           url: url,
	           data: $("form").serialize(), // serializes the form's elements.
	           success: function(data)
	           {
	               alert(data); // show response from the php script.
	           }
	    });
	    e.preventDefault(); // avoid to execute the actual submit of the form.
	});



	$( "input" ).on( "click", function() {
		$checked =  $( "input:checked" ).val();
		if ($checked == "Cơ sở đào tạo") {
			$('#tochuctructhuoc').attr('disabled', true);
			$('#khoaphongban').attr('disabled', true);
			$('#bomonto').attr('disabled', true);
			$('#canbo').attr('disabled', true);

			$('#cosodaotao').attr('required', true);
			$('#khoaphongban').removeAttr('required');
			$('#bomonto').removeAttr('required');
			$('#canbo').removeAttr('required');

			$('#khenthuong').html(input_khenthuongtapthe);
		}

		if ($checked == "Khoa phòng ban") {
			$('#tochuctructhuoc').removeAttr('disabled');
			$('#khoaphongban').removeAttr('disabled');
			$('#bomonto').attr('disabled', true);
			$('#canbo').attr('disabled', true);

			$('#cosodaotao').attr('required');
			$('#khoaphongban').attr('required', true);
			$('#bomonto').removeAttr('required');
			$('#canbos').removeAttr('required');

			$('#khenthuong').html(input_khenthuongtapthe);
		}

		if ($checked == "Bộ môn tổ"	) {
			$('#tochuctructhuoc').removeAttr('disabled');
			$('#khoaphongban').removeAttr('disabled');
			$('#bomonto').removeAttr('disabled');
			$('#canbo').attr('disabled', true);

			$('#cosodaotao').attr('required', true);
			$('#khoaphongban').attr('required', true);
			$('#bomonto').attr('required', true);
			$('#canbo').removeAttr('required');

			$('#khenthuong').html(input_khenthuongtapthe);
		}

		if ($checked == "Cán bộ") {
			$('#tochuctructhuoc').removeAttr('disabled');
			$('#khoaphongban').removeAttr('disabled');
			$('#bomonto').removeAttr('disabled');
			$('#canbo').removeAttr('disabled');

			$('#cosodaotao').attr('required', true);
			$('#khoaphongban').removeAttr('required');
			$('#bomonto').removeAttr('required');
			$('#canbo').attr('required', true);

			$('#khenthuong').html(input_khenthuongcanhan);

		}
	});


	$('#cosodaotao').on('change', function() {
		$id =  $('#cosodaotao').val();
		$.get('khenthuongtapthe/control.php?action=ajax&csdt=' + $id, function(data) {
			$('#tochuctructhuoc').html(data);
		});
		$.get('khenthuongtapthe/control.php?action=cbajax&csdt=' + $id, function(data) {
			$('#canbo').html(data); 
		});
	});

	$('#tochuctructhuoc').on('change', function() {
		$id =  $('#tochuctructhuoc').val();
		$.get('khenthuongtapthe/control.php?action=ajax&tctt=' + $id, function(data) {
			$('#khoaphongban').html(data);
		});
		$.get('khenthuongtapthe/control.php?action=cbajax&tctt=' + $id, function(data) {
			$('#canbo').html(data);
		});
	});

	$('#khoaphongban').on('change', function() {
		$id =  $('#khoaphongban').val();
		$.get('khenthuongtapthe/control.php?action=ajax&kpb=' + $id, function(data) {
			$('#bomonto').html(data);
		});
		$.get('khenthuongtapthe/control.php?action=cbajax&kpb=' + $id, function(data) {
			$('#canbo').html(data);
		});
	});

	$('#bomonto').on('change', function() {
		$id =  $('#bomonto').val();
		$.get('khenthuongtapthe/control.php?action=cbajax&bmt=' + $id, function(data) {
			$('#canbo').html(data);
		});
	});

	$('#tunam').on('change', function() {
		var tunam_val =  $('#tunam').val();
		
		var options = "";
		for (var i = tunam_val; i <= 2030; i++) {
			options += "<option>" + i + "</option>";
		}
		
		$('#dennam').html(options);
	});

</script>