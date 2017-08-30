<?php 

	// function convert_vi_to_en($str) {
	// 	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	// 	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	// 	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	// 	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	// 	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	// 	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	// 	$str = preg_replace("/(đ)/", 'd', $str);
	// 	$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
	// 	$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	// 	$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	// 	$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
	// 	$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	// 	$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	// 	$str = preg_replace("/(Đ)/", 'D', $str);
	// 	$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
	// 	return $str;
	// }

	function get_lylichs () {
		$sql = "SELECT * FROM lylich";
		$result = mysql_query($sql);
		return $result;
	}

	function get_lylich ($id) {
		$sql = "SELECT * FROM lylich WHERE id = " . $id;
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		return $row;
	}

	function get_lylichs_donvi () {
		$sql = "SELECT lylich.id, lylich.hoten, 
					khoaphongban.name AS khoaphongban,
					bomonto.name AS bomonto, 
					tochuctructhuoc.name AS tochuctructhuoc, 
					cosodaotao.name AS cosodaotao
				FROM lylich, bomonto, khoaphongban, tochuctructhuoc, cosodaotao
				WHERE lylich.bomonto_id = bomonto.bomontoid
				AND bomonto.khoaphongbanid = khoaphongban.khoaphongbanid
				AND khoaphongban.tochuctructhuocid = tochuctructhuoc.tochuctructhuocid
				AND tochuctructhuoc.cosodaotaoid = cosodaotao.cosodaotaoid
				ORDER BY lylich.hoten
				";
		$result = mysql_query($sql);
		return $result;
	}

	function get_loaichucvus() {
		$sql = "SELECT * FROM loaichucvu;";
		$result = mysql_query($sql);
		return $result;
	}

	function get_loaichucvu($id) {
		$sql = "SELECT * FROM loaichucvu WHERE id = " . $id;
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		return $row;
	}

	function get_chucvus($lylich_id = false) {
		$sql = "SELECT * FROM chucvu ORDER BY thoidiem DESC;";
		if($lylich_id != false) {
			$sql = "SELECT * FROM chucvu WHERE lylich_id = $lylich_id ORDER BY thoidiem DESC;";
		}
		$result = mysql_query($sql);
		return $result;
	}

	function get_last_insert() {
		$sql = "SELECT MAX(id) AS LastID FROM chucvu";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		return $row['LastID'];
	}

	function get_chucvu($id) {
		$sql = "SELECT * FROM chucvu WHERE id = " . $id;
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		return $row;
	}

	function file_upload($files, $file_name) {

		$target_dir = "uploads/";
		$all_files = array();
		$uploadOk = 1;
		for( $i = 0; $i < count($files['tmp_name']); $i++ ) {
			$target_file = $target_dir . basename($files["name"][$i]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			
		    $check = getimagesize($files["tmp_name"][$i]);
		    if($check !== false) {
		        // echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "Tập tin không phải là hình ảnh.";
		        $uploadOk = 0;
		    }
			
			// // Check if file already exists
			// if (file_exists($target_file)) {
			//     echo "Xin lỗi, tập tin đã tồn tại.";
			//     $uploadOk = 0;
			// }
			// Check file size
			if ($files["size"][$i] > 20480000) {
			    echo "Xin lỗi tập tin quá lớn (max. 20mb)";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Định dạng được phép JPG, JPEG, PNG và GIF.";
			    $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "<p style=\"color: red;\">Xin lỗi tập tin không thể tải lên</p>";
			// if everything is ok, try to upload file
			} else {
				$file_name = $file_name . '-' . $i . '.' . $imageFileType;

			    if (move_uploaded_file($files["tmp_name"][$i], $target_dir . $file_name)) {
			        array_push($all_files, $file_name);

			        //fix exif rota
					if($imageFileType == "jpg") {
						$exif = exif_read_data($target_dir . $file_name);
						$ort = $exif['Orientation'];
						if (!empty($exif['Orientation'])) {
					        $image = imagecreatefromjpeg($target_dir . $file_name);
					        switch ($exif['Orientation']) {
					            case 3:
					                $image = imagerotate($image, 180, 0);
					                break;

					            case 6:
					                $image = imagerotate($image, -90, 0);
					                break;

					            case 8:
					                $image = imagerotate($image, 90, 0);
					                break;
					        }

					        imagejpeg($image, $target_dir . $file_name, 90);
					        imagedestroy($image);
					    }
					}
			    } else {
			        echo "Xin lỗi, có vấn đề khi tải lên.";
			        return false;
			    }
			}
		}
		return join(',',$all_files);
	}

	function delete_file($file_name) {
		return unlink('uploads/' . $file_name);
	}

	// function get_file_upload_id($file_upload) {
	// 	$sql = "SELECT LAST_INSERT_ID() AS 'id';";
	// 	$result = mysql_query($sql);
	// 	$row = mysql_fetch_array($result);
	// 	return $row['id'];
	// }

	function chucvu_edit($id, $lylich_id, $ten, $loaichucvu_id, $thoidiem, $phucap, $files, $ghichu) {
		$phucap = ($phucap == '') ? 0 : $phucap;
		$thoidiem = ($thoidiem == '') ? 'NULL' : "'$thoidiem'";
		// File uploads
		if ($files['name'][0] != '') {
			$file_name = '[' . mktime() . 'CHV' . $lylich_id . ']';
			$file_upload = file_upload($files, $file_name);
			$file_name = ($file_upload != false) ? $file_upload : '';

			$old_file_name = get_chucvu($id)['file_name'];
			if($old_file_name != '') {
				$old_file_arr = explode(',', $old_file_name);
				for ($i = 0; $i < count($old_file_arr); $i++) {
					delete_file($old_file_arr[$i]);
				}
			}

			$sql = "UPDATE `chucvu`
				SET
				`lylich_id` = $lylich_id,
				`loaichucvu_id` = $loaichucvu_id,
				`ten` = '$ten',
				`thoidiem` = $thoidiem,
				`phucap` = $phucap,
				`file_name` = '$file_name',
				`ghichu` = '$ghichu'
				WHERE `id` = $id;
				";
		} else {
			$sql = "UPDATE `chucvu`
					SET
					`lylich_id` = $lylich_id,
					`loaichucvu_id` = $loaichucvu_id,
					`ten` = '$ten',
					`thoidiem` = $thoidiem,
					`phucap` = $phucap,
					`ghichu` = '$ghichu'
					WHERE `id` = $id;
					";
		}
		$result = mysql_query($sql);
		return $result;
	}

	function chucvu_new($lylich_id, $ten, $loaichucvu_id, $thoidiem, $phucap, $files, $ghichu) {
		$phucap = ($phucap == '') ? 0 : $phucap;
		$thoidiem = ($thoidiem == '') ? 'NULL' : "'$thoidiem'";

		// File upload

		$file_name = '[' . mktime() . 'CHV' . $lylich_id . ']';
		$file_upload = file_upload($files, $file_name);
		$file_name = ($file_upload != false) ? $file_upload : '';
		

		$sql = "INSERT INTO `chucvu`
				(`lylich_id`,
				`loaichucvu_id`,
				`ten`,
				`thoidiem`,
				`phucap`,
				`file_name`,
				`ghichu`)
				VALUES
				($lylich_id,
				$loaichucvu_id,
				'$ten',
				$thoidiem,
				$phucap,
				'$file_name',
				'$ghichu');
				";
		$result = mysql_query($sql);
		return $result;
	}

	function chucvu_destroy($id) {
		$file_name = get_chucvu($id)['file_name'];
		if($file_name != '') {
			$file_arr = explode(",",$file_name);
			for($i=0; $i < count($file_arr); $i++) {
				delete_file($file_arr[$i]);
			}
		}

		$sql = "DELETE FROM `chucvu`
				WHERE id = $id;
				";
		$result = mysql_query($sql);
		return $result;	
	}

?>