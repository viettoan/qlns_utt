<head><!-- Created by Artisteer v4.1.0.59861 -->
    <meta charset="utf-8">
    <title>Quản lý cán bộ đoàn</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="../../css/style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="../../css/style.responsive.css" media="all">

	<link rel="stylesheet" href="../../css/style_lg.css">
    <script src="../../jquery.js"></script>
    <script src="../../js/script.js"></script>
    <script src="../../js/script.responsive.js"></script>

	<style>.art-content .art-postcontent-0 .layout-item-0 { color: #0B0D0E; background: #E1EBEF; padding: 20px;  }
	.art-content .art-postcontent-0 .layout-item-1 { padding: 20px;  }
	.art-content .art-postcontent-0 .layout-item-2 { color: #1C1C1C; background: #FFE8D7;  }
	.art-content .art-postcontent-0 .layout-item-3 { color: #1C1C1C; padding: 20px;  }
	.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
	.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }

	</style>
	
	<style type="text/css">
	.tg  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;margin:0px auto;}
	.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;}
	.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
	.tg .tg-s6z2{text-align:center}
	.tg li {font-family:Arial, sans-serif;font-size:14px;padding:2px 3px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;text-align:left;}
	</style>
	
	<script src="../../js/jquery/1.11.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		//alert('ok');
	});
	function showErrorString(idErrorString, idButton){
		
		var btnVal = $(idButton).val();
		
		//alert('ok' + idString + idButton + " " + btnVal);
		//$(idErrorString).slideUp("fast");
		
		if ($(idButton).val() == "Ẩn lỗi"){
			$(idErrorString).slideUp("fast");
			//$(idErrorString).show();
			$(idButton).val("Hiện lỗi");
		} else {
			$(idErrorString).slideDown("fast");
			//$(idErrorString).hide();
			$(idButton).val("Ẩn lỗi");
		}
	}
	</script>
	
</head>
<body>
<div id="art-main">
    <div class="art-sheet clearfix">

	
