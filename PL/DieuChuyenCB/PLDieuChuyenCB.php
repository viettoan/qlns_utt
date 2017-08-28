<?php
//
ob_start();
session_start();
include("../../config/config.php");
include_once("header.php");
if( !isset($_SESSION["login_user"]) ) {
	header('Location: index.php');
	exit();
}

$menu_active = "Điều chuyển";
?>
<?php
	if(isset($_POST)&&!empty($_POST)) {
    $hinhthuc           = $_POST['hinhthuc'];

    $canbo_id           = $_POST['canbocu'];

    $sql = "SELECT * FROM lylich WHERE id = $canbo_id";
    $canbo = mysql_query($sql);
    $canbo_arr = mysql_fetch_array($canbo);

    $cosodaotao_cu      = $canbo_arr['cosodaotao_id'];
    $tochuctructhuoc_cu = $canbo_arr['tochuctructhuoc_id'];
    $khoaphongban_cu    = $canbo_arr['khoaphongban_id'];
    $bomonto_cu         = $canbo_arr['bomonto_id'];

    $ngaydieuchuyen     = $_POST['ngaydc'];
    $lydodieuchuyen     = $_POST['lydo'];
    $mota               = $_POST['mota'];

    if ($hinhthuc == "Đang công tác") {
      $cosodaotao_id      = $_POST['cosodaotaomoi'];
      $tochuctructhuoc_id = $_POST['tochuctructhuocmoi'];
      $khoaphongban_id    = $_POST['khoaphongbanmoi'];
      $bomonto_id         = $_POST['bomontomoi'];
    } else {
      $cosodaotao_id      = 0;
      $tochuctructhuoc_id = 0;
      $khoaphongban_id    = 0;
      $bomonto_id         = 0;
    }


    $sql = "INSERT INTO `luanchuyen`
        (
        `canbo_id`,
        `cosodaotao_id`,
        `tochuctructhuoc_id`,
        `khoaphongban_id`,
        `bomonto_id`,
        `ngaydieuchuyen`,
        `lydodieuchuyen`,
        `mota`,
        `flag`,
        `cosodaotao_cu`,
        `tochuctructhuoc_cu`,
        `khoaphongban_cu`,
        `bomonto_cu`,
        `hinhthuc`)
        VALUES
        ($canbo_id,
        $cosodaotao_id,
        $tochuctructhuoc_id,
        $khoaphongban_id,
        $bomonto_id,
        '$ngaydieuchuyen',
        '$lydodieuchuyen',
        '$mota',
        0,
        $cosodaotao_cu,
        $tochuctructhuoc_cu,
        $khoaphongban_cu,
        $bomonto_cu,
        '$hinhthuc');
        ";

    if (mysql_query($sql)) {

      $sql_lylich = "UPDATE `lylich`
              SET
              `cosodaotao_id` = $cosodaotao_id,
              `tochuctructhuoc_id` = $tochuctructhuoc_id,
              `khoaphongban_id` = $khoaphongban_id,
              `bomonto_id` = $bomonto_id,

              `trangthailamviec` = '$hinhthuc'
              WHERE `id` = $canbo_id;
              ";
      if (mysql_query($sql_lylich)) {
        echo "<script>alert('Điều chuyển thành công.')</script>";
      } else {
        echo "<script>alert('Điều chuyển thất bại #044.')</script>";
        echo $sql_lylich;
      }
    } else {
        echo "<script>alert('Điều chuyển thất bại.')</script>";
        echo $sql;
    }


	}
?>
<body>
<style type="text/css">
	fieldset{
		border: none;
		border-left: 2px red solid;
		margin-bottom: 2px;
	}
	textarea{
		border: 2px #BDBDBD solid;	
	}
</style>
  <?php //require_one("../../header1.php"); ?>
  <?php
       include("../../header1.php");
      ?>
  <div class="art-layout-wrapper">
    <div class="art-content-layout">
      <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
          <article class="art-post art-article">
            <div class="art-postcontent art-postcontent-0 clearfix">
              <div class="art-content-layout">
                <div class="art-content-layout-row">
                  <div class="art-layout-cell layout-item-1" style="width: 50%" >
                    <div>
                           <div class="">
							<p><h3 style="font-family: arial;">Điều chuyển cán bộ</h3></p>
                               <form method="POST" name="fmDC">
                               <table style="border-collapse: collapse; width: 100%;">
                                   <thead>
                                   <th style="border: 1px solid #dddddd;padding: 8px; width: 60%; text-align: center"><b>Đơn vị cũ</b></th>
                                   <th style="border: 1px solid #dddddd;padding: 8px; text-align: center"><b>Hành động</b></th>
                                   </thead>
                                   <tbody>
                                   <tr>
                                       <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">
                                           <div id="s_box">
                                               <?php
                                               function createcb($table, $col1, $col2, $cmt, $selected=0, $name="", $w=24){ // hàm tạo select
                                                   $sql1 = "select $col1,$col2 from $table";
                                                   $re_s = mysql_query($sql1);
                                                   $ar = array();
                                                   while($row=mysql_fetch_array($re_s)){
                                                       $ar[$row[$col1]] = $row[$col2];
                                                   }
                                                   echo '<select style="width:'.$w.'%;margin-left:5px; margin-bottom: 4px" name="'.$table.$name.'" id='.$table.$name.' >
													    <option value="0">'.$cmt.'</option>';
                                                   foreach ($ar as $k => $v) {
                                                       echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
                                                   }
                                                   echo '</select>';
                                               }
                                               createcb("cosodaotao","cosodaotaoid","name","MỜI CHỌN CƠ SỞ ĐÀO TẠO");
                                               createcb("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC");
                                               createcb("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN");
                                               createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN");
                                               ?>
                                           </div>
                                       </td>
                                       <td style="border: 1px solid #dddddd;padding: 8px;  text-align: center">
                                           <select name="hinhthuc" id="hinhthuc">
                                               <option value="Đang công tác">Chuyển đơn vị</option>
                                               <option value="Nghỉ hưu">Nghỉ hưu</option>
                                               <option value="Thôi việc">Thôi việc</option>
                                           </select>
                                       </td>
                                   </tr>
                                   <tr>
                                       <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">

                                           <div style="width: 100%; display: table;">
                                               <div style="width: 100%; display: table-cell;">
                                                   <div id="s_box">
                                                   </div>
                                               </div>
                                           </div>
                                           <script type="text/javascript">
                                               $(document).ready(function(){ // ajax
                                                   $("#s_box > select").change(function(){
                                                       var fin;
                                                       fin=$("#cosodaotao").val();
                                                       fin=fin+'_'+$("#tochuctructhuoc").val();
                                                       fin=fin+'_'+$("#khoaphongban").val();
                                                       fin=fin+'_'+$("#bomonto").val();
                                                       $.ajax({
                                                           method:'post',
                                                           dataType:"json",
                                                           data:{thu:fin},
                                                           url:'../ajax/fdc.php',
                                                           success:function(data){
                                                               if(data){
                                                                   $("#findcb").html(data.da);
                                                                   if(data.tc){$("#tochuctructhuoc").html(data.tc);}
                                                                   if(data.kh){$("#khoaphongban").html(data.kh);}
                                                                   if(data.bm){$("#bomonto").html(data.bm);}
                                                               }
                                                           }
                                                       });
                                                       console.log(fin);
                                                   });
                                               });
                                           </script>
                                           <div style="width: 100%;">
                                               <div id="findcb" style="width: 100%; float: left; max-height: 500px; overflow-y: scroll; overflow-x: hidden;">

                                               </div>

                                           </div>
                           </div>
                                       </td>
                                       <td style="border: 1px solid #dddddd;padding: 8px;  text-align: center">
                                           <div id="dvm" style="float: left%">
                                               <p style="text-align: left" >Chọn đơn vị mới</p>

                                               <?php
                                               createcb("cosodaotao","cosodaotaoid","name","MỜI CHỌN CƠ SỞ ĐÀO TẠO", 0, "moi", 100);
                                               createcb("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC", 0, "moi", 100);
                                               createcb("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN", 0, "moi", 100);
                                               createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN", 0, "moi", 100);
                                               ?>
                                               <script type="text/javascript">
                                                   $(document).ready(function(){ // ajax
                                                       $("#dvm > select").change(function(){
                                                           var finz;
                                                           finz=$("#cosodaotaomoi").val();
                                                           finz=finz+'_'+$("#tochuctructhuocmoi").val();
                                                           finz=finz+'_'+$("#khoaphongbanmoi").val();
                                                           finz=finz+'_'+$("#bomontomoi").val();
                                                           $.ajax({
                                                               method:'post',
                                                               dataType:"json",
                                                               data:{thu:finz},
                                                               url:'../ajax/fdcm.php',
                                                               success:function(data){
                                                                   if(data){
                                                                       $("#dvm").html(data.da);
                                                                       if(data.tc){$("#tochuctructhuocmoi").html(data.tc);}
                                                                       if(data.kh){$("#khoaphongbanmoi").html(data.kh);}
                                                                       if(data.bm){$("#bomontomoi").html(data.bm);}
                                                                   }
                                                               }
                                                           });
                                                           console.log(finz);
                                                       });
                                                   });
                                               </script>
                                               <br>
                                           </div>

                                           <div style="text-align: left">
                                               <table width="100%" style="border: none;">
                                                   <tbody>
                                                   <tr style="border: none;" id="thoidiemrathongbao" hidden="true">
                                                       <td>Thời điểm ra thông báo:</td>
                                                       <td>
                                                           <input name="thoidiemrathongbao" type="date" style="border: 1px solid #dddddd;text-align: left;padding: 8px;" value="<?php echo date('Y-m-d'); ?>">
                                                       </td>
                                                   </tr>
                                                   <tr style="border: none;">
                                                       <td id="ngaydc-label">Ngày điều chuyển:</td>
                                                       <td>
                                                           <input name="ngaydc" type="date" style="text-align: left;" value="<?php echo date('Y-m-d'); ?>">
                                                       </td>
                                                   </tr>
                                                   <tr style="border: none;">
                                                       <td colspan="2">
                                                           <lable>Lý do</lable>
                                                           <textarea name="lydo" style="width: 100%"></textarea>
                                                       </td>
                                                   </tr>
                                                   <tr style="border: none;">
                                                       <td colspan="2">
                                                       <label>Mô tả</label>
                                                       <textarea name="mota" style="width: 100%"></textarea>
                                                       </td>
                                                   </tr>
                                                   </tbody>
                                               </table>

                                               <br>
                                               <center><button id="btnDC">Điều Chuyển</button><button type="reset">Reset</button></center></div>
                                           </div>

                                       </td>
                                   </tr>
                                   </tbody>
                               </table>
                               </form>
								<!-- SearhBox -->
                <div class="row">
                  <h5>Lịch sử điều chuyển</h5>
                  <table style="border-collapse: collapse; width: 100%;">
                    <thead>
                      <tr>
                        <th style="border: 1px solid #dddddd; text-align: center">Ngày ĐC</th>
                        <th style="border: 1px solid #dddddd; text-align: center">Tên CB</th>
                        <th style="border: 1px solid #dddddd; text-align: center">Hình thức</th>
                        <th style="border: 1px solid #dddddd; text-align: center">Đơn vị mới</th>
                        <th style="border: 1px solid #dddddd; text-align: center">Đơn vị cũ</th>
                        <th style="border: 1px solid #dddddd; text-align: center">Lý do</th>
                        <th style="border: 1px solid #dddddd; text-align: center">Mô tả</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 

                      function get_dv ($table, $id) {
                        $col = $table . 'id';
                        $query = mysql_query("SELECT * FROM $table WHERE $col = $id");
                        $result = mysql_fetch_array($query);
                        return $result['name'];
                      }

                      function get_hoten_cb ($id) {
                        $col = $table . 'id';
                        $query = mysql_query("SELECT * FROM lylich WHERE id = $id");
                        $result = mysql_fetch_array($query);
                        return $result['hoten'];
                      }

                      $sql = "SELECT * FROM luanchuyen ORDER BY ngaydieuchuyen DESC";

                      $result = mysql_query($sql);

                      while($luanchuyen = mysql_fetch_array($result)):
                    ?>
                      <tr>
                        <td style="border: 1px solid #dddddd;text-align: center;"><?php echo date("d-m-Y",strtotime($luanchuyen['ngaydieuchuyen'])) ?></td>
                        <td style="border: 1px solid #dddddd;text-align: left;"><?php echo get_hoten_cb($luanchuyen['canbo_id']) ?></td>
                        <td style="border: 1px solid #dddddd;text-align: center;"><?php echo $luanchuyen['hinhthuc'] == "Đang công tác" ? 'Điều chuyển' : $luanchuyen['hinhthuc'] ?></td>
                        <td style="border: 1px solid #dddddd;text-align: left;">
                        <?php if($luanchuyen['hinhthuc'] == "Đang công tác"): ?>
                          <?php echo "CSĐT: " . get_dv('cosodaotao', $luanchuyen['cosodaotao_id']) ?> <br>
                          <?php// echo "TCTT: " . get_dv('tochuctructhuoc', $luanchuyen['tochuctructhuoc_id']) ?>
                          <?php echo "KPB : " . get_dv('khoaphongban', $luanchuyen['khoaphongban_id']) ?> <br>
                          <?php echo "BMT : " . get_dv('bomonto', $luanchuyen['bomonto_id']) ?>
                        <?php else: ?>
                          <?php echo '' //$luanchuyen['hinhthuc'] ?>
                        <?php endif ?>
                        </td>
                        <td style="border: 1px solid #dddddd;text-align: left;">
                          <?php echo "CSĐT: " . get_dv('cosodaotao', $luanchuyen['cosodaotao_cu']) ?> <br>
                          <?php// echo "TCTT: " . get_dv('tochuctructhuoc', $luanchuyen['tochuctructhuoc_cu']) ?>
                          <?php echo "KPB : " . get_dv('khoaphongban', $luanchuyen['khoaphongban_cu']) ?> <br>
                          <?php echo "BMT : " . get_dv('bomonto', $luanchuyen['bomonto_cu']) ?>
                        </td>
                        <td style="border: 1px solid #dddddd;text-align: left; width: 20%"><?php echo $luanchuyen['lydodieuchuyen'] ?></td>
                        <td style="border: 1px solid #dddddd;text-align: left;"><?php echo $luanchuyen['mota'] ?></td>
                      </tr>
                    <?php endwhile ?>
                    </tbody>
                  </table>
                </div>
								<div style="width: 100%" >

								<form method="POST" name="fmDC"> <!-- Form điều chuyển -->
								<div style="width: 100%; display: table;">


								</div>
								<div style="width: 100%;">

								</form> <!-- End form điều chuyển -->
								<script>

								</script>
						     	
						     </div>
						     </div>
						     <div style="float: none;clear: both;"></div>
							<div class="hoz-line-space"></div>
							
                        
                      </div>
                  </div>
                </div>
              </div>

              
              
              <div class="art-content-layout layout-item-2">
                <div class="art-content-layout-row">
                  <div class="art-layout-cell layout-item-3" style="width: 50%" >
                    <p>
                    	Cán bộ trường ĐHCNGTVT
                    </p>
                  </div>
                  <div class="art-layout-cell layout-item-3" style="width: 50%" >
                    <p style="float: right;">Hệ thống được phát triển bởi Khoa công nghệ, ĐH Công nghệ GTVT</p>
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
    $('#hinhthuc').on('change', function() {
        var hinhthuc = $('#hinhthuc :selected').text();
        if (hinhthuc == 'Chuyển đơn vị') {
            $('#dvm').removeAttr('hidden');
            $('#thoidiemrathongbao').attr('hidden', true);
            $('#ngaydc-label').text('Ngày điều chuyển:');
            $('#btnDC').click(function () {
                if ($('input[name=canbocu]:checked').val()) {
                }
                else {
                    alert("Chưa chọn cán bộ cần điều chuyển");
                    return false;
                }
                if ($('select#cosodaotaomoi').val() == 0 || $('select#tochuctructhuocmoi').val() == 0) {
                    alert("Chưa chọn đủ vị trí đơn vị mới!");
                    return false;
                }
            });
        } else {
          $('#dvm').attr('hidden', true);
          $('#thoidiemrathongbao').attr('hidden', true);
          $('#ngaydc-label').text('Ngày điều chuyển:');
          if(hinhthuc == 'Nghỉ hưu') {
            $('#thoidiemrathongbao').removeAttr('hidden');
            $('#ngaydc-label').text('Thời điểm ra quyết định:');
          }
        }
    });
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

