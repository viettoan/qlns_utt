<?php require_once('../../../config/config.php'); ?>
<?php require_once('control.php'); ?>
<?php $kt = get_khenthuongtapthe($_GET['id']) ?>

<?php 
	if($kt['loaitapthe'] == 'Cơ sở đào tạo') {
		$info					 = get_csdt_from_csdt($kt['tapthe_id']);
		$cosodaotao_id 			= $info['cosodaotaoid'];
		$cosodaotao_value 		= $info['name'];

	}

	if($kt['loaitapthe'] == 'Khoa phòng ban') {
		$info 					= get_all_from_kpb($kt['tapthe_id']);
		$khoaphongban_id		= $info['kpb_id'];
		$khoaphongban_value 	= $info['kpb_name'];
		$tochuctructhuoc_id 	= $info['tctt_id'];
		$tochuctructhuoc_value 	= $info['tctt_name'];
		$cosodaotao_id 			= $info['csdt_id'];
		$cosodaotao_value 		= $info['csdt_name'];
	}

	if($kt['loaitapthe'] == 'Bộ môn tổ') {
		$info 					= get_all_from_bmt($kt['tapthe_id']);
		$bomonto_id 			= $info['bmt_id'];
		$bomonto_value			= $info['bmt_name'];	
		$khoaphongban_id		= $info['kpb_id'];
		$khoaphongban_value 	= $info['kpb_name'];
		$tochuctructhuoc_id 	= $info['tctt_id'];
		$tochuctructhuoc_value 	= $info['tctt_name'];
		$cosodaotao_id 			= $info['csdt_id'];
		$cosodaotao_value 		= $info['csdt_name'];
	}

	if($kt['loaitapthe'] == 'Cán bộ') {
		$info 					= get_all_from_lylich($kt['tapthe_id']);
		$canbo_id				= $info['lylich_id'];
		$canbo_value			= $info['lylich_hoten'];
		$bomonto_id 			= $info['bmt_id'];
		$bomonto_value			= $info['bmt_name'];	
		$khoaphongban_id		= $info['kpb_id'];
		$khoaphongban_value 	= $info['kpb_name'];
		$tochuctructhuoc_id 	= $info['tctt_id'];
		$tochuctructhuoc_value 	= $info['tctt_name'];
		$cosodaotao_id 			= $info['csdt_id'];
		$cosodaotao_value 		= $info['csdt_name'];
	}
?>

<?php require_once('_form.php') ?>