<?php
ob_start();
session_start();
include_once("header.php");
if( !isset($_SESSION["login_user"]) ) {
	header('Location: index.php');
	exit();
}

/*
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('display_startup_errors', TRUE);
*/

if ($_SERVER['REQUEST_METHOD'] != "POST"){
	exit(1);
}

//echo "in post<br>";
//var_dump ($_SESSION["file_list_import"]);
require("../../BLL/NhapFileCB/ImportAllData.php");
list($ok, $err) = nhapTatCa();
//var_dump($ok, $err);
//die('here');
?>
<body>
  <header class="art-header">
    <div class="art-shapes">
    </div>
    <nav class="art-nav">
      <ul class="art-hmenu">
        <li><a href="PLNhapFileCB.php" class="active">Nhập lý lịch</a></li>
        <li><a href="PLDanhSachCB.php" class="">Danh sách cán bộ</a></li>
        <li><a href="PLTienIch.php" class="">Tiện ích</a></li>
      </ul>
      <ul class="art-hmenu-user">
        <li>
          <a href="#" >Chào, <?=$_SESSION["username_user"]?></a>
          <ul class="active">
            <li><a href="#">Hộp thư</a></li>
            <li><a href="../QLTaikhoan/PLchangepass.php">Đổi mật khẩu</a></li>
            <li><a href="../../BLL/QLTaikhoan/BLLlogout.php">Thoát</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
  <div class="art-layout-wrapper">
    <div class="art-content-layout">
      <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
          <article class="art-post art-article">
            <div class="art-postcontent art-postcontent-0 clearfix">
              <div class="art-content-layout">
                <div class="art-content-layout-row">
                  <div class="art-layout-cell layout-item-1" style="width: 50%" >
				  <br>
				    <fieldset style="border: 1px solid lightgray;">
                      <legend><i><b>Danh sách hồ sơ đã nhập thành công</b></i></legend><br>
                      <div>
                        <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                          <tbody>
                            <tr style="font-weight: bold;">
                              <th style="width: 10%;">Ảnh</th>
                              <th style="width: 30%;">Tên hồ sơ</th>
                              <th style="width: 20%;">Họ tên</th>
                              <th style="width: 40%;">Tình trạng</th>
                            </tr>
							<?php
							$ok__testonly = array(
								array("cmnd"=>123, 'filename'=>'file name 1', "hoten"=>"Ho va ten 1", "err"=>""),
								array("cmnd"=>123, 'filename'=>'file name 2', "hoten"=>"Ho va ten 2", "err"=>""),
								array("cmnd"=>123, 'filename'=>'file name 3', "hoten"=>"Ho va ten 3", "err"=>""),);
							//$ok = array();
							if (count($ok) > 0){
								foreach ($ok as $row){
									echo "<tr><td>";
									if (file_exists("../../images/avatar/{$row['cmnd']}.jpg")) {
										echo "<img src=\"../../images/avatar/{$row['cmnd']}.jpg\" style=\"width: 40px; height: 40px;\">";
									} else {
										echo "<img src=\"../../images/avatar/noavatar\" style=\"width: 40px; height: 40px;\">";
									}
									echo "</td>";
									
									echo "<td>";
									echo $row['filename'];
									echo "</td>";
									
									echo "<td>";
									echo $row['hoten'];
									echo "</td>";
									
									echo "<td>";
									echo "<font color='green'>Nhập thành công</font>";
									echo "</td></tr>";
								}
							} else {
								echo '<tr><td colspan="4"><br><center>Không có hồ sơ</center></td></tr>';
							}
							?>
                            </tbody>
                          </table>
                        </div>
                     </fieldset>
                    <br>
                    <fieldset style="border: 1px solid lightgray;">
                      <legend><i><b>Danh sách hồ sơ không nhập được</b></i></legend><br>
                      <div>
                        <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                          <tbody>
                            <tr style="font-weight: bold;">
                              <th style="width: 10%;">Ảnh</th>
                              <th style="width: 30%;">Tên hồ sơ</th>
                              <th style="width: 20%;">Họ tên</th>
                              <th style="width: 40%;">Tình trạng</th>
                            </tr>
							<?php
							$err__ = array(
								array("cmnd"=>123, 'filename'=>'file name 1', "hoten"=>"Ho va ten 1", "err"=>"Lỗi 1"),
								array("cmnd"=>123, 'filename'=>'file name 2', "hoten"=>"Ho va ten 2", "err"=>"Lỗi 2"),
								array("cmnd"=>123, 'filename'=>'file name 3', "hoten"=>"Ho va ten 3", "err"=>"Lỗi 3"),);
							//$err = array();
							if (count($err) > 0){
								$i = 0;
								foreach ($err as $row){
									echo "<tr><td>";
									if (file_exists("../../images/avatar/".$row['cmnd'].".jpg")) {
										echo "<img src=\"../../images/avatar/{$row['cmnd']}.jpg\" style=\"width: 40px; height: 40px;\">";
									} else {
										echo "<img src=\"../../images/avatar/noavatar\" style=\"width: 40px; height: 40px;\">";
									}
									echo "</td>";
									
									echo "<td>";
									echo $row['filename'];
									echo "</td>";
									
									echo "<td>";
									echo $row['hoten'];
									echo "</td>";
									
									$errorTitle = "";
									$errorList = "";
									$btn_style = "style='display:none;'";
									$retCode = $row['retcode'];
									switch ($retCode){
										case 1:
											$errorTitle = "<font color='red'>Lỗi:</font> Tập tin tải lên không phải là tập tin Excel.";
											break;
										case 2:
											$errorTitle = "<font color='red'>Lỗi:</font> Thông tin của cán bộ đã tồn tại.
											<br>Liên hệ admin để nhập lại tập tin.";
											break;
										case 3:
											$errorTitle = "<font color='red'>Lỗi:</font> Tập tin excel bị lỗi hoặc không được hỗ trợ.";
											$errorList = "Hãy chắc chắn rằng tập tin excel này được tải từ trang chủ rồi mới chỉnh sửa, mọi thao thác chỉnh sửa trên tập tin excel khác đều không được hỗ trợ.";
											$btn_style = "style='float:right'";		
											break;
										default:
											$errorTitle = "<font color='red'>Lỗi:</font> Hãy chắc chắn rằng các trường sau đã được điền đầy đủ và đúng theo định dạng:";
											foreach ($row['data']['errors'] as $err){
												$errorList = $errorList . "<li>$err</li>";
											}
											$btn_style = "style='float:right'";
											break;
									}
									echo "<td >{$errorTitle}<br><br>
											<div style='display:none; margin-bottom:10px;text-align:left;' id='errorString{$i}'>{$errorList}</div>
											<input type='button' {$btn_style}
											id='showButton{$i}'
											onclick=\"javascript:showErrorString('#errorString{$i}', '#showButton{$i}')\"
											value='Hiện lỗi'>
										</td>";
									echo "</tr>";
									
									$i++;
								}
							} else {
									echo '<tr><td colspan="4"><br><center>Không có hồ sơ</center></td></tr>';
								}
							?>
                            </tbody>
                          </table>
                        </div>
                     </fieldset>
                  </div>
                </div>
              </div>
              <br>
              <div class="art-content-layout layout-item-2">
                <div class="art-content-layout-row">
                  <div class="art-layout-cell layout-item-3" style="width: 50%" >
                    <p>
                    	Đoàn TNCS Hồ Chí Minh
                    </p>
                  </div>
                  <div class="art-layout-cell layout-item-3" style="width: 50%" >
                    <p style="float: right;">Hệ thống được phát triển bởi nhóm SV ĐH Công Nghệ</p>
                  </div>
                </div>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
  <?php
    //include_once("footer.php");
    ?>
  </div>
  </div>
</body>

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

</html>