<form action="quatrinhchucvu/control.php" method="post" enctype="multipart/form-data">
	<?php if ( isset($_GET['id']) && $_GET['id'] != '' ): ?>
		<input type="text" name="id" class="hidden" value="<?php echo $id ?>">
	<?php endif ?>
	<div class="form-group" style="padding-top: 10px;">
		<label>Cán bộ <span style="color:red">*</span></label>
		<select name="lylich_id" class="form-control" required <?php// if ( (isset($_GET['action'])) && ($_GET['action'] == 'edit') ) echo 'disabled' ?>>
			<option>Chọn một cán bộ</option>
			<?php 
				$lylichs_donvi = get_lylichs_donvi();
				while ($row = mysql_fetch_array($lylichs_donvi)):			
			?>
				<option value="<?php echo $row['id'] ?>" <?php if( ($row['id'] == $chucvu['lylich_id']) || ( ($_GET['action'] == 'new') && ( $_GET['lylich_id'] == $row['id'] ) ) ) echo 'selected' ?>>
					<?php
						echo $row['hoten'] . 
								' (EM' . $row['id'] . ') - ' . 
								$row['bomonto'] . ' - ' .
								$row['khoaphongban'] . ' - ' .
								$row['cosodaotao'];
					?>	
				</option>
			<?php 
				endwhile;
			?>
		</select>
	</div>
	<div class="form-group">
		<label>Tên chức vụ <span style="color:red">*</span></label>
		<input type="text" name="ten" class="form-control" value="<?php echo $chucvu['ten'] ?>" required>
	</div>
	<div class="form-group">
		<label>Loại chức vụ <span style="color:red">*</span> <i><a href="<?php echo $host ?>/PL/TienIch/loaichucvu.php">Bổ sung loại chức vụ</a></i></label>
		<select name="loaichucvu_id" class="form-control" required>
			<!-- <option>Chọn</option> -->
			<?php 
				$loaichucvus = get_loaichucvus();
				while ($row = mysql_fetch_array($loaichucvus)):			
			?>
				<option value="<?php echo $row['id'] ?>" <?php if($row['id'] == $chucvu['loaichucvu_id']) echo 'selected' ?>>
					<?php
						echo $row['ten'];
					?>	
				</option>
			<?php 
				endwhile;
			?>
		</select>	
	</div>
	<div class="form-group col-md-6">
		<label>Thời điểm</label>
		<input type="date" name="thoidiem" class="form-control" value="<?php echo $chucvu['thoidiem'] ?>">
	</div>
	<div class="form-group col-md-6">
		<label>Phụ cấp</label>
		<select name="phucap" id="" class="form-control">
			<?php $phucaps = [0, 1, 0.8, 0.6, 0.5, 0.4, 0.3, 0.25, 0.2] ?>
			<?php for($i=0; $i < count($phucaps); $i++): ?>
				<option value="<?php echo $phucaps[$i] ?>" <?php if($phucaps[$i] == $chucvu['phucap']) echo 'selected' ?>><?php echo $phucaps[$i] ?></option>
			<?php endfor ?>
		</select>
	</div>
	<div class="row"></div>
	<div class="form-group">
		<label>Bản scan văn bản (max. 20mb)</label>
		<input type="file" name="file_scan[]" multiple class="form-control">
	</div>
	
	<?php $files = $chucvu['file_name'] ?>
	<?php if ( $files != '' ): ?>
		<div class="form-group">
		<?php $file_arr = explode(",",$files) ?>
		<?php for($i=0; $i < count($file_arr); $i++): ?>
				<?php 
					// $imageFileType = pathinfo($file_arr[$i],PATHINFO_EXTENSION);
					// if($imageFileType == "jpg") {
					// 	$exif = exif_read_data('quatrinhchucvu/uploads/' . $file_arr[$i]);
					// 	$ort = $exif['Orientation'];
					// 	switch($ort)
			  //           {

			  //               case 3: // 180 rotate left
			  //               	$style = "transform:rotate(180deg);-ms-transform:rotate(180deg);-webkit-transform:rotate(180deg);";
			  //                   break;


			  //               case 6: // 90 rotate right
			  //                   $style = "transform:rotate(90deg);-ms-transform:rotate(90deg);-webkit-transform:rotate(90deg);";
			  //                   break;

			  //               case 8:    // 90 rotate left
			  //                   $style = "transform:rotate(-90deg);-ms-transform:rotate(-90deg);-webkit-transform:rotate(-90deg);";
			  //                   break;
			  //           } 
					// }
				?>
				<a href="quatrinhchucvu/uploads/<?php echo $file_arr[$i] ?>"  target="_blank">
					<img src="quatrinhchucvu/uploads/<?php echo $file_arr[$i] ?>" style="max-width: 250px; <?php if(isset($style)) echo $style ?>" align="middle">
				</a>
		<?php endfor; ?>
		</div>
	<?php endif ?>

	<div class="form-group">
		<label>Ghi chú</label>
		<textarea name="ghichu" rows="10" class="form-control"><?php echo $chucvu['ghichu'] ?></textarea>
	</div>
	<!-- <div class="form-group">
		<label>Các tập tin đính kèm (nếu có)</label>
	</div> -->
	<?php if ($action == 'new'): ?>
		<input type="submit" name="submit" class="btn btn-primary" value="Thêm mới thông tin">
	<?php else: ?>
		<input type="submit" name="submit" class="btn btn-primary" value="Cập nhật thông tin">
	<?php endif ?>
</form>