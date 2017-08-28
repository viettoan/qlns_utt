<?php
ob_start();
session_start();
include("../../config/config.php");
$menu_active = "Danh sách báo ký hợp đồng";
include_once("../NhapFileCB/header.php");
if( !isset($_SESSION["login_user"]) ) {
  header('Location: index.php');
  exit();
} else {
  if (!isset($_SESSION["message"])) $_SESSION["message"] = array();
  if (!isset($_SESSION["success"])) $_SESSION["success"] = "";
  if (!isset($_SESSION["notice"])) $_SESSION["notice"] = "";
  if (!isset($_SESSION["error"])) $_SESSION["error"] = array();
  if (!isset($_SESSION["count"])) $_SESSION["count"] = 0;

  if(isset($_POST['xemhopdong'])){
    $_SESSION['lylich_id1']=$_POST['xemhopdong'];
    header("location: ../NhapFileCB/Nhapmanhinh.php");
  }

  if(isset($_POST['btn-email-edit-submit'])) {
    $mail_from_name = $_POST['mail_from_name'];
    $mail_subject = $_POST['mail_subject'];
    $mail_body = $_POST['mail_body_edit'];
    $sql1 = "UPDATE `temp` SET `content`='$mail_from_name' WHERE `name`='email_bao_ky_hop_dong_from_name'; ";
    $sql2 = "UPDATE `temp` SET `content`='$mail_subject' WHERE `name`='email_bao_ky_hop_dong_subject'; ";
    $sql3 = "UPDATE `temp` SET `content`='$mail_body' WHERE `name`='email_bao_ky_hop_dong_body'; ";

    if(mysql_query($sql1) && mysql_query($sql2) && mysql_query($sql3))
      echo "<script>alert('Thay đổi thành công!')</script>";
    else 
      echo "<script>alert('Thay đổi thất bại')</script>";
  };


  ?>

  <body>
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
                      <p>
                        <b>Tải tài liệu:</b><br>
                    <!--ul>
                      <li>Mẫu M1:THỐNG KÊ THỰC TRẠNG ĐỘI NGŨ VIÊN CHỨC TRONG ĐƠN VỊ SỰ NGHIỆP CÔNG LẬP <a href="../../BLL/BieuMau/m1.php">Download</a> | <a href="../../BLL/BieuMau/m1_online.php" target="_blank">Xem online</a></li>
                      <li>Mẫu M2:BÁO CÁO SỐ LƯỢNG, CHẤT LƯỢNG, CƠ CẤU ĐỘI NGŨ VIÊN CHỨC TẠI ĐƠN VỊ SỰ NGHIỆP CÔNG LẬP <a href="../../BLL/BieuMau/m2.php">Download</a> | <a href="../../BLL/BieuMau/m2_online.php" target="_blank">Xem online</a></li>
                      <li>Mẫu M3: <a href="../../BLL/BieuMau/m3.php">Download</a> | <a href="../../BLL/BieuMau/m3_online.php" target="_blank">Xem online</a></li>
                      <li>Mẫu M4: <a href="../../BLL/BieuMau/m4.php">Download</a> | <a href="../../BLL/BieuMau/m4_online.php" target="_blank">Xem online</a></li>
					            <li>Mẫu M5: <a href="../../BLL/BieuMau/m5.php">Download</a> | <a href="../../BLL/BieuMau/m5_online.php" target="_blank">Xem online</a></li>
                    </ul-->
                  </p>
                  <!-- <p>Tải danh sách: 
                      <a href="#">
                        <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;">
                      </a></p> -->
                  <br>
                  <fieldset style="border: 1px solid lightgray;">
                    <legend><span style="font-weight: bold; color: #0080FF">Danh sách hợp đồng còn thời hạn</span></legend>

                      <div>
                      <br>
                        <table id="table_conhd" class="display">
                        <thead>
                          <th>Ảnh</th>
                          <th>Họ tên</th>
                          <th>Ngày sinh</th>
                          <th>GT</th>
                          <th>Loại HĐ</th>
                          <th>Thời hạn HĐ</th>
                          <th>Ngày hợp đồng</th>
                          <th>Ngày hết hạn</th>
                          <th>Tình trạng HĐ</th>
                          <th>Liên hệ</th>
                          <th>Xem HĐ</th>
                        </thead>
                        <tbody>
                        <?php 
                          $sql = "SELECT 
                                  lylich.id,
                                  cmnd,
                                  lylich.hoten,
                                  chucvu,
                                  ngaysinh,
                                  gioitinh,
                                  sohieucanbo,
                                  taikhoan_id,
                                  chucvu,
                                  dienthoai,
                                  taikhoan.email,
                                  (CASE
                                      WHEN
                                          hopdong.loaihdlamviec <> NULL
                                              OR hopdong.loaihdlamviec <> ''
                                      THEN
                                          'HĐLV'
                                      WHEN
                                          hopdong.loaihdlaodong <> NULL
                                              OR hopdong.loaihdlaodong <> ''
                                      THEN
                                          'HĐLĐ'
                                      ELSE ''
                                  END) AS loaihd,
                                  HT.ngayhd,
                                  HT.ngayhethan,
                                  HT.loaihd AS thoihanhd,
                                  HT.trangthai AS tranthaihd,
                                  HT.quahan
                              FROM
                                  lylich,
                                  taikhoan,
                                  hopdong,
                                  v_hopdong_cuoi_trangthai HT
                              WHERE
                                  lylich.id = HT.lylich_id
                                      AND hopdong.id = HT.id
                                      AND hopdong.lylich_id = lylich.id
                                      AND lylich.taikhoan_id = taikhoan.id
                                      AND quahan <= 0
                              ORDER BY quahan DESC";
                          $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)){
                        ?>
                          <tr>
                            <td>
                            <?php if (file_exists("../../images/avatar/".$row["cmnd"].".jpg")) {?>
                                    <img src="../../images/avatar/<?php echo $row["cmnd"];?>.jpg" alt="" style="width: 40px; height: 40px;">
                                  <?php } else { ?>
                                    <img src="../../images/avatar/noavatar" alt="" style="width: 40px; height: 40px;">
                                  <?php }?>
                            </td>
                            <td><?php echo $row['hoten'] ?></td>
                            <td><?php echo date("d-m-Y",strtotime($row["ngaysinh"]))?></td>
                            <td><?php echo $row['gioitinh'] ? 'Nam' : 'Nữ' ?></td>
                            <td><?php echo $row['loaihd'] ?></td>
                            <td><?php echo $row['thoihanhd'] ?></td>
                            <td><?php echo date("d-m-Y",strtotime($row["ngayhd"]))?></td>
                            <td>
                              <?php echo ($row["ngayhethan"] != '') ? date("d-m-Y",strtotime($row["ngayhethan"])) : '' ?>
                            </td>
                            <td><?php echo $row['tranthaihd'] ?><?php
                                                                if ($row['quahan'] != '') {
                                                                  if ($row['quahan'] > 365 || $row['quahan'] < -365) 
                                                                    echo ' (hơn 1 năm)';
                                                                  else
                                                                    echo $row['quahan'] >= 0 ? (' ('. $row['quahan'] . ' ngày)') : ( ' (còn ' . -1*$row['quahan'] . ' ngày)');
                                                                }
                                                                ?>
                            </td>
                            <td>
                              <?php echo $row['dienthoai'] ?>
                              <br>
                              <a href="#form-email" rel="modal:open" onclick="send_email('<?php echo $row['hoten'] ?>', '<?php echo $row['loaihd'] ?>', '<?php echo $row['thoihanhd'] ?>', '<?php echo date("d-m-Y",strtotime($row["ngayhd"]))?>', '<?php echo date("d-m-Y",strtotime($row["ngayhethan"]))?>', '<?php echo $row['email'] ?>', '<?php echo $row['taikhoan_id'] ?>')">
                                <?php echo ($row['email'] == '') ? 'Gửi email' : $row['email'] ?>
                              </a>
                            </td>                                          
                            <td>

                              <button type="submit" name="btnXem" id="btnXem" class="btn btn-primary" onclick="xemhopdong(<?php echo $row['id']; ?>)">Xem HĐ</button>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                        </table>
                      </div>
                    </fieldset>  
                    <br>
                    <fieldset style="border: 1px solid lightgray;">
                    <legend><span style="font-weight: bold; color: #0080FF">Danh sách hợp đồng đã hết thời hạn</span></legend>

                      <div>
                      <br>
                        <table id="table_hethd" class="display">
                        <thead>
                          <th>Ảnh</th>
                          <th>Họ tên</th>
                          <th>Ngày sinh</th>
                          <th>GT</th>
                          <th>Loại HĐ</th>
                          <th>Thời hạn HĐ</th>
                          <th>Ngày hợp đồng</th>
                          <th>Ngày hết hạn</th>
                          <th>Tình trạng HĐ</th>
                          <th>Liên hệ</th>
                          <th>Xem HĐ</th>
                        </thead>
                        <tbody>
                        <?php 
                          $sql = "SELECT 
                                  lylich.id,
                                  cmnd,
                                  lylich.hoten,
                                  chucvu,
                                  ngaysinh,
                                  gioitinh,
                                  sohieucanbo,
                                  chucvu,
                                  dienthoai,
                                  taikhoan_id,
                                  taikhoan.email,
                                  (CASE
                                      WHEN
                                          hopdong.loaihdlamviec <> NULL
                                              OR hopdong.loaihdlamviec <> ''
                                      THEN
                                          'HĐLV'
                                      WHEN
                                          hopdong.loaihdlaodong <> NULL
                                              OR hopdong.loaihdlaodong <> ''
                                      THEN
                                          'HĐLĐ'
                                      ELSE ''
                                  END) AS loaihd,
                                  HT.ngayhd,
                                  HT.ngayhethan,
                                  HT.loaihd AS thoihanhd,
                                  HT.trangthai AS tranthaihd,
                                  HT.quahan
                              FROM
                                  lylich,
                                  taikhoan,
                                  hopdong,
                                  v_hopdong_cuoi_trangthai HT
                              WHERE
                                  lylich.id = HT.lylich_id
                                      AND hopdong.id = HT.id
                                      AND hopdong.lylich_id = lylich.id
                                      AND lylich.taikhoan_id = taikhoan.id
                                      AND quahan > 0
                              ORDER BY quahan ASC";
                          $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)){
                        ?>
                          <tr>
                            <td>
                            <?php if (file_exists("../../images/avatar/".$row["cmnd"].".jpg")) {?>
                                    <img src="../../images/avatar/<?php echo $row["cmnd"];?>.jpg" alt="" style="width: 40px; height: 40px;">
                                  <?php } else { ?>
                                    <img src="../../images/avatar/noavatar" alt="" style="width: 40px; height: 40px;">
                                  <?php }?>
                            </td>
                            <td><?php echo $row['hoten'] ?></td>
                            <td><?php echo date("d-m-Y",strtotime($row["ngaysinh"]))?></td>
                            <td><?php echo $row['gioitinh'] ? 'Nam' : 'Nữ' ?></td>
                            <td><?php echo $row['loaihd'] ?></td>
                            <td><?php echo $row['thoihanhd'] ?></td>
                            <td><?php echo date("d-m-Y",strtotime($row["ngayhd"]))?></td>
                            <td>
                              <?php echo ($row["ngayhethan"] != '') ? date("d-m-Y",strtotime($row["ngayhethan"])) : '' ?>
                            </td>
                            <td><?php echo $row['tranthaihd'] ?><?php
                                                                if ($row['quahan'] != '') {
                                                                  if ($row['quahan'] > 365 || $row['quahan'] < -365) 
                                                                    echo ' (hơn 1 năm)';
                                                                  else
                                                                    echo $row['quahan'] >= 0 ? (' ('. $row['quahan'] . ' ngày)') : ( ' (còn ' . -1*$row['quahan'] . ' ngày)');
                                                                }
                                                                ?>
                            </td>
                            <td>
                              <?php echo $row['dienthoai'] ?>
                              <br>
                              <a href="#form-email" rel="modal:open" onclick="send_email('<?php echo $row['hoten'] ?>', '<?php echo $row['loaihd'] ?>', '<?php echo $row['thoihanhd'] ?>', '<?php echo date("d-m-Y",strtotime($row["ngayhd"]))?>', '<?php echo date("d-m-Y",strtotime($row["ngayhethan"]))?>', '<?php echo $row['email'] ?>', '<?php echo $row['taikhoan_id'] ?>')">
                                <?php echo ($row['email'] == '') ? 'Gửi email' : $row['email'] ?>
                              </a>
                            </td>                                          
                            <td>
                              <button type="submit" name="btnXem" id="btnXem" class="btn btn-primary" onclick="xemhopdong(<?php echo $row['id']; ?>)">Xem HĐ</button>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                        </table>
                      </div>
                    </fieldset>     
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
<form id="form-xemhopdong" action="" method="post" hidden="hidden">
  <input type="text" name="xemhopdong" id="xemhopdong">
</form>

<div id="form-email" hidden="hidden">
  <h3 id="mail-nguoinhan"></h3>
  <form action="mail/BaoKyHopDongEmail.php" method="post"> 
  <?php 
    function get_temp($name) {
      $sql = "SELECT * FROM temp WHERE name='$name'";
      $result = mysql_query($sql);
      $row = mysql_fetch_array($result);
      return $row['content'];
    }
  ?>

    <input type="text" id="taikhoan_id" name="taikhoan_id" class="hidden">
    <div class="form-inline">
      <label>Người gửi:</label>
      <input name="mail_from_name" type="text" class="form-control" style="width: 100%" placeholder="mail@example.com" value="<?php echo get_temp('email_bao_ky_hop_dong_from_name') ?>">
    </div>
    <div class="form-inline">
      <label>Người nhận:</label>
      <input id="mail_to" name="mail_to" type="text" class="form-control" style="width: 100%" placeholder="mail@example.com">
      <p id="thong_bao_chua_dang_ky_email" class="hidden">
        <span style="color: red;">Địa chỉ Email người dùng chưa được tạo hoặc người dùng chưa đăng ký trên hệ thống. Chọn "Lưu lại Email và gửi đi" để lưu lại Email vào hệ thống.</span>
      </p>
    </div>
    <div class="form-inline">
      <label>Tiêu đề:</label>
      <input type="text" name="mail_subject" class="form-control" style="width: 100%" placeholder="Tiêu đề" value="<?php echo get_temp('email_bao_ky_hop_dong_subject') ?>">
    </div>
    <textarea id="mail-body-temp" class="form-control" style="display:none;" ><?php echo get_temp('email_bao_ky_hop_dong_body') ?></textarea>
    <div class="form-group">
      <label>Nội dung:</label>
      <textarea id="mail-body" name="mail_body" class="form-control" rows="10"></textarea>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Gửi đi">
      <input type="submit" name="luu_email_va_gui" id="btn_luu_email_va_gui" class="btn btn-primary hidden" value="Lưu lại Email và gửi đi">
      <a href="#form-email-edit" rel="modal:open">Sửa mẫu</a>
    </div>
  </form>
</div>

<div id="form-email-edit" hidden="hidden">
  <h3>Sửa mẫu mail</h3>
  <form action="" method="post"> 
    <div class="form-inline">
      <label>Người gửi:</label>
      <input name="mail_from_name" type="text" class="form-control" style="width: 100%" placeholder="mail@example.com" value="<?php echo get_temp('email_bao_ky_hop_dong_from_name') ?>">
    </div>
    <div class="form-inline">
      <label>Tiêu đề:</label>
      <input type="text" name="mail_subject" class="form-control" style="width: 100%" placeholder="Tiêu đề" value="<?php echo get_temp('email_bao_ky_hop_dong_subject') ?>">
    </div>
    <div class="form-group">
      <label>Nội dung:</label>
      <p>
        <code>{Tên}</code>
        <code>{Loại hợp đồng}</code>
        <code>{Thời hạn hợp đồng}</code>
        <code>{Ngày hợp đồng}</code>
        <code>{Ngày hết hạn}</code>
      </p>
      <br>
      <textarea id="mail-body-edit" name="mail_body_edit" class="form-control" rows="10"><?php echo get_temp('email_bao_ky_hop_dong_body') ?></textarea>
    </div>
    <div class="form-group">
      <a href="#form-email" rel="modal:open">Gửi mail</a>
      <button type="submit" name="btn-email-edit-submit" class="btn btn-primary">Lưu lại</button>
    </div>
  </form>
</div>




<script>
  $(document).ready(function(){
    $('#table_conhd').DataTable();
    $('#table_hethd').DataTable();
  });

  function xemhopdong(id) {
    $('#xemhopdong').val(id);
    $('#form-xemhopdong').submit();
  };

  function send_email(hoten, loaihd, thoihanhd, ngayhd, ngayhethan, email, taikhoan_id) {
    $('#mail-nguoinhan').text('Gửi email tới: ' + hoten);
    $('#taikhoan_id').val(taikhoan_id);
    if(email == "") {
      $('#mail_to').val(email);
      $('#thong_bao_chua_dang_ky_email').removeClass('hidden');
      $('#btn_luu_email_va_gui').removeClass('hidden');
    } else {
      $('#mail_to').val(email);
      $('#thong_bao_chua_dang_ky_email').addClass('hidden');
      $('#btn_luu_email_va_gui').addClass('hidden');
    }
    if (loaihd = "HĐLĐ") 
      loaihd = "Hợp đồng lao động"
    else 
      loaihd = "Hợp đồng làm việc";
    var mail_body = $('#mail-body-temp').text();
    mail_body = mail_body.replace('{Tên}', hoten);
    mail_body = mail_body.replace('{Thời hạn hợp đồng}', thoihanhd);
    mail_body = mail_body.replace('{Loại hợp đồng}', loaihd);
    mail_body = mail_body.replace('{Ngày hợp đồng}', ngayhd);
    mail_body = mail_body.replace('{Ngày hết hạn}', ngayhethan);
    $('#mail-body').text(mail_body);
  };
</script>
</body>
</html>
<?php
}
?>
<script>
   function abc(str){

       var xem = $("#btnXem"+str).val();
     window.location="temp1.php?xem="+xem;
   }  
  /* function marked(){
     var cosodaotao = $("cosodaotao").val();
     alert(cosodaotao);
   }*/
  </script>