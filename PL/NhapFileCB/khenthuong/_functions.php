<?php 
function get_khenthuongs($lylich_id) {
	$sql = "SELECT * FROM khenthuong
			WHERE lylich_id = $lylich_id
			ORDER BY tunam ASC";
	$result = mysql_query($sql);
	return $result; 
}

function get_khenthuong($id) {
	$sql = "SELECT * FROM khenthuong
			WHERE id = $id";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row;
}

function destroy_($id) {
	$sql = "DELETE FROM khenthuong
			WHERE id = $id";
	$result = mysql_query($sql);
	return $result; 
}

function new_($lylich_id, $khenthuong, $loaikhenthuong, $cap, $tunam, $dennam, $noidung) {
	$sql = "INSERT INTO `khenthuong`
			(
			`lylich_id`,
			`khenthuong`,
			`loaikhenthuong`,
			`cap`,
			`tunam`,
			`dennam`,
			`noidung`)
			VALUES
			(
			$lylich_id,
			'$khenthuong',
			'$loaikhenthuong',
			'$cap',
			$tunam,
			$dennam,
			'$noidung');
			";
	$result = mysql_query($sql);
	return $result; 
}

function edit_($id, $lylich_id, $khenthuong, $loaikhenthuong, $cap, $tunam, $dennam, $noidung) {
	$sql = "UPDATE `quanlynhansu`.`khenthuong`
			SET
			`lylich_id` = $lylich_id,
			`khenthuong` = '$khenthuong',
			`loaikhenthuong` = '$loaikhenthuong',
			`cap` = '$cap',
			`tunam` = $tunam,
			`dennam` = $dennam,
			`noidung` = '$noidung'
			WHERE `id` = $id;
			";
	$result = mysql_query($sql);
	return $result; 
}
?>