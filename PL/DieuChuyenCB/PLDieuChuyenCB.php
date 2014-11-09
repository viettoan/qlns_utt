<?php
ob_start();
session_start();
include("../../config/config.php");
include_once("header.php");
if( !isset($_SESSION["login_user"]) ) {
	header('Location: index.php');
	exit();
}
require("../../config/config.php");
?>

<body>
  <header class="art-header">
    <div class="art-shapes">
    </div>
    <nav class="art-nav">
        <ul class="art-hmenu">
	    <li>
		  <a href="../NhapFileCB/PLNhapFileCB.php" class="">Nhập lý lịch</a>
          <ul class="active">
            <li><a href="../CapNhatFileCB/PLCapNhatCB.php" >Cập nhật lý lịch</a></li>
          </ul>
        </li>
        <li><a href="../NhapFileCB/PLDanhSachCB.php" class="">Danh sách cán bộ</a></li>
        <li><a href="../DieuChuyenCB/PLDieuChuyenCB.php" class="active">Điều chuyển</a></li>
        <li><a href="../NhapFileCB/PLTienIch.php" class="">Tiện ích</a></li>
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
                    <div style:="width:">
                      <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                        <tbody>
                           <div class="myform01">
							<p><h3 style="font-family: arial;">Điều chuyển cán bộ</h3></p>
							<?php if ($_SERVER['REQUEST_METHOD'] != "POST") {?>
							<!-- START METHOD = GET -->
							<form name="frmDieuChuyen" method="post" action=""
								onsubmit="javascript:return formValidate();">
							<?php
							$sql = "select * from lylich";
							$result = mysql_query($sql) or die(mysql_error());
							$numRow = mysql_num_rows($result);
							if ($numRow <= 0){
								echo "Danh sách cán bộ rỗng. Không thể điều chuyển";
							} else {
								echo "Chọn cán bộ cần điều chuyển: <br><br><div id='canbo_info'></div><br>";
								echo "<select onchange='loadListCB(this.value);' name='phongbancu' id='phongbancu'>";
								echo "<option>Chọn phòng ban</option>";
								$sql = "SELECT LL.hoten, LC.* FROM lylich as LL 
								join luanchuyen as LC 
								on LL.id = LC.canbo_id 
								where (LC.flag = 2 || (LC.vitri = 'Cơ quan Đoàn thể' and LC.flag = 0))
								group by LC.vitri";
								$result = mysql_query($sql) or die(mysql_error());
								while ($row = mysql_fetch_assoc($result)){
									//var_dump($row);
									echo "<option value='{$row['vitri']}'>{$row['vitri']}</option>";
								}
								
								echo "</select> ";
							?>
							<select id='listCB' name='canbo' required="" onchange='getCB(this.value)'>
							</select>
							</p>
							<br>
							Chọn phòng ban cán bộ được điều chuyển đến:<p>
							<?php
								echo "<select name='phongban' id='phongban'>";
								echo "<option value='-1'>Chọn phòng ban</option>";
								$phongbanlist = array("Cơ quan Đảng", "Cơ quan Chính quyền", "Cơ quan Đoàn thể", "Đại biểu HĐND", "Cơ quan khác");
								foreach ($phongbanlist as $row){
									echo "<option value='$row'>$row</option>";
								}
								echo "</select>";
							?>
							<div class="hoz-line-space"></div>
							<p><input type="submit" value="Chuyển" style="float:right;margin-right: 6px;">
							</p>
							<?php } ?>
							</form>
							</div>
							<!-- END METHOD = GET -->
							<?php } else {?>
							<!-- START METHOD = POST -->
							<?php
								// clear flag
								$sql = "delete from luanchuyen where flag = 0 and canbo_id = '{$_POST['canbo']}'";
								$result = mysql_query($sql) or die(mysql_error());
								
								$sql = "update luanchuyen set flag = 1 where canbo_id = '{$_POST['canbo']}'";
								$result = mysql_query($sql) or die(mysql_error());
								
								//var_dump($_POST);
								$curYear = date("Y");
								$sql = "insert into luanchuyen (id, canbo_id, vitri, nam, flag)
								values(null, '{$_POST['canbo']}', '{$_POST['phongban']}', '$curYear', 2);";
								$result = mysql_query($sql) or die(mysql_error());
								
								$sql = "select hoten from lylich where id='{$_POST['canbo']}'";
								$result = mysql_query($sql) or die(mysql_error());
								$row = mysql_fetch_assoc($result);
								$hoten = $row['hoten'];
								echo "Đã chuyển cán bộ <strong>$hoten</strong> từ phòng ban <strong>{$_POST['phongbancu']}</strong> đến phòng ban <strong>{$_POST['phongban']}</strong> thành công";
							?>

							<!-- END METHOD = POST -->
							<?php }?>
                        </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
              
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

<link href="../../css/mystyle1.css" rel="stylesheet" type="text/css" />
<SCRIPT TYPE="text/javascript" SRC="../../js/jquery-1.11.1.min.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="../../js/filterlist.js"></SCRIPT>
<SCRIPT TYPE="text/javascript">
$(document).ready(function(){
	$("#canbo_info").html("<strong><i>Chưa chọn</i></strong>");
});
function loadListCB(phongban){
	$("#listCB").load("ajax.php", {"a":"loadListCB", "phongban":phongban});
}
function getCB(id){
	$("#canbo_info").load("ajax.php", {"a":"getCB", "id":id});
}
function formValidate(){
	if ($("#phongbancu").val() == $("#phongban").val()){
		alert("Phòng ban mới không được trùng phòng ban cũ");
		return false;
	}
	if ($("#listCB").val() == -1){
		alert("Hãy chọn cán bộ để điều chuyển");
		return false;
	}
	if ($("#phongban").val() == -1){
		alert("Hãy chọn phòng ban để điều chuyển đến");
		return false;
	}
	return true || confirm('Xác nhận chuyển cán bộ?');
}
var myfilter = new filterlist(document.frmDieuChuyen.slDonvi);
</SCRIPT>

