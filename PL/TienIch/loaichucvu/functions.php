<?php 

	function get_loaichucvus() {
		$sql = "SELECT * FROM loaichucvu;";
		$result = mysql_query($sql);
		return $result;
	}

	function chucvu_count($loaichucvu_id) {
		$sql = "SELECT COUNT(*) AS count FROM chucvu WHERE loaichucvu_id = " . $loaichucvu_id;
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		return $row['count'];
	}

	function get_loaichucvu($id) {
		$sql = "SELECT * FROM loaichucvu WHERE id = " . $id;
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		return $row;
	}

	function get_last_insert() {
		$sql = "SELECT MAX(id) AS LastID FROM loaichucvu";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		return $row['LastID'];
	}

	function loaichucvu_edit($id, $ten) {
		$sql = "UPDATE `loaichucvu`
				SET
				`ten` = '$ten'
				WHERE `id` = $id;
				";
		$result = mysql_query($sql);
		return $result;
	}

	function loaichucvu_new($ten) {
		$sql = "INSERT INTO `loaichucvu`
				(`ten`)
				VALUES
				('$ten');
				";
		$result = mysql_query($sql);
		return $result;

	}

	function chucvu_destroy($id) {
		$sql = "DELETE FROM `loaichucvu`
				WHERE id = $id;
				";
		$result = mysql_query($sql);
		return $result;	
	}

?>