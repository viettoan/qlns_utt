<?php 
// ******** NOTE
// csdt :	cosodaotao
// tcct :	tochuctructhuoc
// kpb  : 	khoaphongban
// bmt  : 	bomonto

function get_khenthuongtapthes() {
	$sql = "SELECT * FROM khenthuongtapthe ORDER BY id DESC";
	$result = mysql_query($sql);
	return $result; 
}

function get_khenthuongtapthe($id) {
	$sql = "SELECT * FROM khenthuongtapthe WHERE id = $id";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row;
}

function get_csdt() {
	$sql = "SELECT * FROM cosodaotao";
	$result = mysql_query($sql);
	return $result;
}

function get_tctt_from_csdt($id) {
	$sql = "SELECT * FROM tochuctructhuoc WHERE cosodaotaoid = " . $id;
	$result = mysql_query($sql);
	return $result;
}

function get_kpb_from_tctt($id) {
	$sql = "SELECT * FROM khoaphongban WHERE tochuctructhuocid = " . $id;
	$result = mysql_query($sql);
	return $result;
}

function get_bmt_from_kpb($id) {
	$sql = "SELECT * FROM bomonto WHERE khoaphongbanid = " . $id;
	$result = mysql_query($sql);
	return $result;
}

function get_csdt_from_csdt($id) {
	$sql = "SELECT * FROM cosodaotao WHERE cosodaotaoid = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_tctt_from_tctt($id) {
	$sql = "SELECT * FROM tochuctructhuoc WHERE tochuctructhuocid = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_kpb_from_kpb($id) {
	$sql = "SELECT * FROM khoaphongban WHERE khoaphongbanid = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_bmt_from_bmt($id) {
	$sql = "SELECT * FROM bomonto WHERE bomontoid = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_lylich($id) {
	$sql = "SELECT * FROM lylich WHERE id = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_csdt_from_tctt($id) {
	$sql = "SELECT cosodaotao.cosodaotaoid, cosodaotao.name FROM cosodaotao, tochuctructhuoc WHERE cosodaotao.cosodaotaoid = tochuctructhuoc.cosodaotaoid AND tochuctructhuoc.tochuctructhuocid = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_tctt_from_kpb($id) {
	$sql = "SELECT tochuctructhuoc.tochuctructhuocid, tochuctructhuoc.name FROM khoaphongban, tochuctructhuoc WHERE khoaphongban.tochuctructhuocid = tochuctructhuoc.tochuctructhuocid AND khoaphongban.khoaphongbanid = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_kpb_from_bmt($id) {
	$sql = "SELECT khoaphongban.khoaphongbanid, khoaphongban.name FROM khoaphongban, bomonto WHERE khoaphongban.khoaphongbanid = bomonto.khoaphongbanid AND bomonto.bomontoid = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_all_from_bmt($id) {
	$sql = "SELECT cosodaotao.cosodaotaoid AS 'csdt_id', cosodaotao.name AS 'csdt_name', 
					tochuctructhuoc.tochuctructhuocid AS 'tctt_id', tochuctructhuoc.name AS 'tctt_name',
					khoaphongban.khoaphongbanid AS 'kpb_id', khoaphongban.name AS 'kpb_name',
			        bomonto.bomontoid AS 'bmt_id', bomonto.name AS 'bmt_name'
			FROM cosodaotao, tochuctructhuoc, khoaphongban, bomonto 
			WHERE 
				cosodaotao.cosodaotaoid = tochuctructhuoc.cosodaotaoid
			    AND tochuctructhuoc.tochuctructhuocid = khoaphongban.tochuctructhuocid
			    AND khoaphongban.khoaphongbanid = bomonto.khoaphongbanid
				AND bomonto.bomontoid = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_all_from_lylich($id) {
	$sql = "SELECT cosodaotao.cosodaotaoid AS 'csdt_id', cosodaotao.name AS 'csdt_name', 
					tochuctructhuoc.tochuctructhuocid AS 'tctt_id', tochuctructhuoc.name AS 'tctt_name',
					khoaphongban.khoaphongbanid AS 'kpb_id', khoaphongban.name AS 'kpb_name',
			        bomonto.bomontoid AS 'bmt_id', bomonto.name AS 'bmt_name',
			        lylich.id AS 'lylich_id', lylich.hoten AS 'lylich_hoten'
			FROM cosodaotao, tochuctructhuoc, khoaphongban, bomonto, lylich 
			WHERE 
				cosodaotao.cosodaotaoid = tochuctructhuoc.cosodaotaoid
			    AND tochuctructhuoc.tochuctructhuocid = khoaphongban.tochuctructhuocid
			    AND khoaphongban.khoaphongbanid = bomonto.khoaphongbanid
				AND bomonto.bomontoid = lylich.bomonto_id
				AND lylich.id= $id";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_all_from_kpb($id) {
	$sql = "SELECT cosodaotao.cosodaotaoid AS 'csdt_id', cosodaotao.name AS 'csdt_name', 
					tochuctructhuoc.tochuctructhuocid AS 'tctt_id', tochuctructhuoc.name AS 'tctt_name',
					khoaphongban.khoaphongbanid AS 'kpb_id', khoaphongban.name AS 'kpb_name'
			FROM cosodaotao, tochuctructhuoc, khoaphongban
			WHERE 
				cosodaotao.cosodaotaoid = tochuctructhuoc.cosodaotaoid
			    AND tochuctructhuoc.tochuctructhuocid = khoaphongban.tochuctructhuocid
			    AND khoaphongban.khoaphongbanid = " . $id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	return $row; 
}

function get_cb_from_csdt($id) {
	$sql = "SELECT * FROM lylich WHERE cosodaotao_id = $id ORDER BY hoten ASC";
	$result = mysql_query($sql);
	return $result;
}

function get_cb_from_tctt($id) {
	$sql = "SELECT * FROM lylich WHERE tochuctructhuoc_id = $id ORDER BY hoten ASC";
	$result = mysql_query($sql);
	return $result;
}

function get_cb_from_kpb($id) {
	$sql = "SELECT * FROM lylich WHERE khoaphongban_id = $id ORDER BY hoten ASC";
	$result = mysql_query($sql); echo $sql;
	return $result;
}

function get_cb_from_bmt($id) {
	$sql = "SELECT * FROM lylich WHERE bomonto_id = $id ORDER BY hoten ASC";
	$result = mysql_query($sql);
	return $result;
}

function new_($loaitapthe, $tapthe_id, $khenthuong, $loaikhenthuong, $cap, $tunam, $dennam, $noidung) {
	$sql = "INSERT INTO `khenthuongtapthe`
			(
			`loaitapthe`,
			`tapthe_id`,
			`khenthuong`,
			`loaikhenthuong`,
			`cap`,
			`tunam`,
			`dennam`,
			`noidung`)
			VALUES
			(
			'$loaitapthe',
			$tapthe_id,
			'$khenthuong',
			'$loaikhenthuong',
			'$cap',
			$tunam,
			$dennam,
			'$noidung'
			)";
	$result = mysql_query($sql);
	return $result; 
}

function edit_($id, $loaitapthe, $tapthe_id, $khenthuong, $loaikhenthuong, $cap, $tunam, $dennam, $noidung) {
	$sql = "UPDATE `khenthuongtapthe`
			SET
			`loaitapthe` = '$loaitapthe',
			`tapthe_id` = $tapthe_id,
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

function destroy_($id) {
	$sql = "DELETE FROM `khenthuongtapthe` WHERE id = $id";
	$result = mysql_query($sql);
	return $result; 
}


// function get_khenthuongs($lylich_id) {
// 	$sql = "SELECT * FROM khenthuong
// 			WHERE lylich_id = $lylich_id
// 			ORDER BY tunam ASC";
// 	$result = mysql_query($sql);
// 	return $result; 
// }

// function get_khenthuong($id) {
// 	$sql = "SELECT * FROM khenthuong
// 			WHERE id = $id";
// 	$result = mysql_query($sql);
// 	$row = mysql_fetch_array($result);
// 	return $row;
// }

?>