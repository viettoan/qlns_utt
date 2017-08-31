<?php
  ob_start();
  session_start();
  include("../../config/config.php");
  $menu_active = "Cán bộ sắp nghỉ hưu";
  include_once("../NhapFileCB/header.php");
  $songayconlai = isset($_POST['songayconlai']) ? $_POST['songayconlai'] : "30 DAY";
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else {
    if (!isset($_SESSION["message"])) $_SESSION["message"] = array();
    if (!isset($_SESSION["success"])) $_SESSION["success"] = "";
    if (!isset($_SESSION["notice"])) $_SESSION["notice"] = "";
    if (!isset($_SESSION["error"])) $_SESSION["error"] = array();
    if (!isset($_SESSION["count"])) $_SESSION["count"] = 0;
  ?>

  <?php 
    if(isset($_POST['submit'])) {
      $canbocu = $_POST['canbocu'];
      $hinhthuc = $_POST['hinhthuc'];
      $ngaydc = empty($_POST['ngaydc']) ? '0000-00-00' : $_POST['ngaydc'] ;
      $lydo = $_POST['lydo'];
      $mota = $_POST['mota'];


      $sql1 = "SELECT * FROM lylich WHERE id = $canbocu";
      $canbo = mysql_query($sql1);
      $canbo_arr = mysql_fetch_array($canbo);

      $cosodaotao_cu      = $canbo_arr['cosodaotao_id'];
      $tochuctructhuoc_cu = $canbo_arr['tochuctructhuoc_id'];
      $khoaphongban_cu    = $canbo_arr['khoaphongban_id'];
      $bomonto_cu         = $canbo_arr['bomonto_id'];

      $sql = "UPDATE `lylich` 
              SET cosodaotao_id=0, 
              tochuctructhuoc_id=0, 
              khoaphongban_id=0, 
              bomonto_id=0, 
              trangthailamviec='$hinhthuc' 
              WHERE id = $canbocu;
      ";

      if(mysql_query($sql)) {
        $sql = "INSERT INTO `luanchuyen` 
              (
              `canbo_id`, 
              `cosodaotao_cu`, 
              `tochuctructhuoc_cu`, 
              `khoaphongban_cu`, 
              `bomonto_cu`, 
              `cosodaotao_id`, 
              `tochuctructhuoc_id`, 
              `khoaphongban_id`, 
              `bomonto_id`, 
              `ngaydieuchuyen`, 
              `lydodieuchuyen`, 
              `mota`, 
              `flag`,
              `hinhthuc`)
              VALUES ($canbocu, 
              $cosodaotao_cu, 
              $tochuctructhuoc_cu, 
              $khoaphongban_cu, 
              $bomonto_cu, 
              0, 0, 0, 0, 
              '$ngaydc', 
              '$lydo',
              '$mota', 
              0,
              '$hinhthuc'
               );";
    if(mysql_query($sql))   
      echo "<script>alert('Xét nghỉ hưu thành công.')</script>";
    else echo "<script>alert('Xét nghỉ hưu thất bại.')</script>";
      } else {
        echo "<script>alert('Xét nghỉ hưu thất bại.')</script>";
      }
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
                      <br>
                    <fieldset style="border: 1px solid lightgray;">
                    <legend><span style="font-weight: bold; color: #0080FF">Cán bộ sắp nghỉ hưu</span></legend>
                    <p>Độ tuổi nghỉ hưu của các cán bộ trên hệ thống là 60 tuổi đối với Nam và 55 tuổi đối với Nữ. Dưới đây là danh sách các cán bộ sắp nghỉ hưu tính tới ngày <strong><?php echo date('d-m-Y', strtotime($songayconlai)); ?></strong>.</p>
                      <form action="" method="POST">
                        <label>Số ngày lựa chọn là khác: </label>
                        <select name="songayconlai" id="" onchange="submit()">
                          <option value="30 DAY" <?php if($songayconlai == "30 DAY") echo "selected" ?>>30 ngày</option>
                          <option value="3 MONTH" <?php if($songayconlai == "3 MONTH") echo "selected" ?>>3 tháng</option>
                          <option value="6 MONTH" <?php if($songayconlai == "6 MONTH") echo "selected" ?>>6 tháng</option>
                          <option value="1 YEAR" <?php if($songayconlai == "1 YEAR") echo "selected" ?>>1 năm</option>
                        </select>
                      </form>
                    <p>Tải danh sách cán bộ nghỉ hưu năm 2017: 
                    <a href="../../BLL/TienIch/huu_tri/BLLDanhSach.php">
                      <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Danh sách bổ nhiệm lại">
                    </a></p>

                    <div style:="width:">
                      <table id="table" class="display">
                          <thead>
                            <th>Ảnh</th>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Số hiệu CB</th>
                            <th>Chức vụ</th>
                            <th>Ngày nghỉ hưu</th>
                            <th>Tải</th>
                            <th>Hưu</th>
                          </thead>
                          <tbody>
                          <?php
                          // Thong bao truoc 6 thang han 60 tuoi NAM hoac 55 tuoi NU
                            $sql = "SELECT *, datediff(ngaynghihuu, date(now())) as songayconlai
                              FROM (
                                SELECT id, hoten, cmnd, ngaysinh, sohieucanbo, gioitinh, chucvu,
                                  (CASE 
                                    WHEN gioitinh = 1 THEN DATE_ADD(ngaysinh, INTERVAL 60 YEAR) 
                                    ELSE DATE_ADD(ngaysinh, INTERVAL 55 YEAR) 
                                  END) as 'ngaynghihuu'
                                FROM lylich 
                                WHERE id not in (SELECT canbo_id FROM luanchuyen WHERE hinhthuc = 'Nghỉ hưu')
                              ) H
                              WHERE H.ngaynghihuu < DATE_ADD(date(now()), INTERVAL " . $songayconlai . ")
                              ORDER BY ngaynghihuu";
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
                                  <td>
                                    <p><?php echo $row["hoten"];?></p>
                                  </td>
                                  <td>
                                    <p><?php echo date("d-m-Y",strtotime($row["ngaysinh"]));?></p>
                                  </td>
                                  <td>
                                    <p><?php if ($row["gioitinh"] == 1) echo "Nam"; else echo "Nữ";?></p>
                                  </td>
                                  <td>
                                    <p><?php echo $row["sohieucanbo"];?></p>
                                  </td>
                                  <td>
                                    <p><?php echo $row["chucvu"];?></p>
                                  </td>
                                  <td><?php echo date("d-m-Y",strtotime($row["ngaynghihuu"])) ?> (còn <strong><?php echo $row["songayconlai"] ?></strong> ngày)</td>
                                  <td>
                                    <a href="../../BLL/TienIch/huu_tri/BLLThongBao.php?lylich_id=<?php echo $row["id"];?>">
                                      <p style="margin: 0 0 2px 0; padding: 0; height: 23px; line-height: 23px; clear:left; float:left;">
                                        <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Tải file thông báo">
                                        : Thông báo
                                      </p>
                                    </a>
                                    <br>
                                    <a href="../../BLL/TienIch/huu_tri/BLLQuyetDinh.php?lylich_id=<?php echo $row["id"];?>">
                                      <p style="margin: 0 0 2px 0; padding: 0; height: 23px; line-height: 23px; clear:left; float:left;">
                                        <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Tải file quyết định">
                                        : Quyết định
                                      </p>
                                    </a>
                                  </td>
                                  <td>
                                    <a href="#ex1" class="btn btn-default" rel="modal:open" onclick="duyet('<?php echo $row["id"] ?>', '<?php echo $row["hoten"];?>')">Hưu</a>
                                  </td>
                              </tr>
                            <?php } ?>
                            <?php if (mysql_num_rows($result) == 0){?>
                              <tr><td colspan="5" style="width: 100%; text-align: center;">Không có cán bộ</td></tr>
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
 <div id="ex1" style="display:none;">
    <h3 class="form-group" id="ex-hoten"></h3>
    <form action="" class="form" method="post">
      <input type="text" name="canbocu" id="canbocu" hidden="hidden">
      <input type="text" name="hinhthuc" id="hinhthuc" value="Nghỉ hưu" hidden="hidden">
      <!-- <input type="text" name="tienich-ref" value="tienich-ref" hidden="hidden"> -->
      <div class="form-group">
        <label>Ngày quyết định:</label>
        <input type="date" name="ngaydc">
      </div>
      <div class="form-group">
        <label>Lý do:</label>
        <textarea class="form-control" name="lydo"></textarea>
      </div>
      <div class="form-group" >
        <label>Mô tả:</label>
        <textarea class="form-control" name="mota"></textarea>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Gửi đi</button>
    </form>
  </div>

  
  <?php
    //include_once("footer.php");
    ?>
  </div>
  </div>
  <script>
  $(document).ready(function(){
    $('#table').DataTable();
  });

  function duyet(id, hoten) {
    $('#ex-hoten').html("Xét nghỉ hưu: " + hoten);
    $('#canbocu').val(id);
  }
</script>
</body>
</html>
<?php
  }
?>