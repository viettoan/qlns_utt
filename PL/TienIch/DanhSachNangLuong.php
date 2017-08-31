<?php
  ob_start();
  session_start();
  include("../../config/config.php");
  $menu_active = "Danh sách nâng lương";
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

    if(isset($_POST['quatrinhluong'])){
    $_SESSION['lylich_id1']=$_POST['quatrinhluong'];
    header("location: ../NhapFileCB/Nhapmanhinh.php");
  }
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
                    
                    <fieldset style="border: 1px solid lightgray;">
                    <legend><span style="font-weight: bold; color: #0080FF">Cán bộ được nâng lương</span></legend>
                    <p>Tải danh sách: 
                      <a href="../../BLL/TienIch/nang_luong/BLLDanhSach.php">
                        <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Danh sách bổ nhiệm lại">
                      </a>
                      &nbsp
                      <label for="">Từ</label>
                      <input type="date" id="batdau" value="2017-01-01">
                      <label for="">đến</label>
                      <input type="date" id="ketthuc" value="2017-12-31">
                      <button class="btn" id="taive">Tải về</button>
                    </p>
                    <p>Tải tờ trình: 
                    <?php
                      $count_can_bo = 0;
                      //$sql = "SELECT * FROM lylich WHERE 1";
                      $sql = "SELECT * FROM lylich WHERE trangthailamviec='Đang công tác'";
                      $result = mysql_query($sql);
                      while ($row = mysql_fetch_array($result)){
                        $lylich_id = $row["id"];
                        $sql_qtluong = "SELECT * FROM quatrinhluong WHERE lylich_id = '$lylich_id' ORDER BY thoidiem DESC LIMIT 1";
                        $result_qtluong = mysql_query($sql_qtluong);
                        $row_qtluong = mysql_fetch_array($result_qtluong);

                        $date1=date_create(date("Y-m-d"));
                        $date2=date_create($row_qtluong["thoidiem"]);
                        $diff=date_diff($date2,$date1);
                        if ((int)($diff->format("%R%a"))>3*365) $count_can_bo++;
                      }
                    ?>
                      <a href="../../BLL/TienIch/nang_luong/BLLToTrinh.php?count_can_bo=<?php echo $count_can_bo; ?>">
                        <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Danh sách bổ nhiệm lại">
                      </a>
                    </p>

                    <div style:="width:">
                      <table id="table" class="display">
                        <thead>
                          <th>Ảnh</th>
                          <th>Họ tên</th>
                          <th>Ngày sinh</th>
                          <th>Giới tính</th>
                          <th>Số hiệu CB</th>
                          <th>Chức vụ</th>
                          <th>T/điểm gần nhất</th>
                          <th>Thời điểm tính bậc</th>
                          <th>Quyết định</th>
                          <th>Quá trình lương</th>
                        </thead>
                        <tbody>
                          <?php
                            //$sql = "SELECT * FROM lylich WHERE 1";
                            $sql = "SELECT * FROM lylich WHERE trangthailamviec='Đang công tác'";
                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)){
                              $lylich_id = $row["id"];
                              //$sql_qtluong = "SELECT * FROM quatrinhluong WHERE lylich_id = '$lylich_id' ORDER BY thoidiem DESC LIMIT 1";
                              $sql_qtluong = "SELECT *, date_add(thoidiem, INTERVAL  3 YEAR) as thoidiemtinh, datediff(date_add(thoidiem, INTERVAL 3 YEAR), date(now())) as songayconlai FROM quatrinhluong WHERE lylich_id = $lylich_id ORDER BY thoidiem DESC LIMIT 1";
                              $result_qtluong = mysql_query($sql_qtluong);
                              $row_qtluong = mysql_fetch_array($result_qtluong);

                              $date1=date_create(date("Y-m-d"));
                              $date2=date_create($row_qtluong["thoidiem"]);
                              $diff=date_diff($date2,$date1);
                              if ((int)($diff->format("%R%a"))>3*365){
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
                                  <td><?php echo $row['gioitinh'] ? "Nam" : "Nữ" ?></td>
                                  <td>
                                    <p><?php echo $row["sohieucanbo"];?></p>
                                  </td>
                                  <td>
                                    <p><?php echo $row["chucvu"];?></p>
                                  </td>
                                  <td>
                                    <p>
                                    <?php
                                      echo ($row_qtluong["thoidiem"] == "0000-00-00") ? "" : $row_qtluong["thoidiem"];
                                    ?>
                                    </p>
                                  </td>
                                  <td>
<?php
  if ($row_qtluong["thoidiem"] != "0000-00-00") {
    if ($row_qtluong["songayconlai"] >= 0)
      echo $row_qtluong["thoidiemtinh"] . " (còn " . $row_qtluong["songayconlai"] . " ngày)";
    else 
      echo $row_qtluong["thoidiemtinh"] . " (quá " . (-1 * $row_qtluong["songayconlai"]) . " ngày)";
  }
?>
                                  </td>
                                  <td>
                                    <!-- <a href="../../BLL/TienIch/nang_luong/BLLThongBao.php?lylich_id=<?php //echo $row["id"];?>">
                                      <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Tải file thông báo">
                                    </a>: Thông báo
                                    <br> -->
                                    <a href="../../BLL/TienIch/nang_luong/BLLQuyetDinh.php?lylich_id=<?php echo $row["id"];?>">
                                      <p style="margin: 0 0 2px 0; padding: 0; height: 23px; line-height: 23px; clear:left; float:left;">
                                        <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Tải file quyết định">
                                        Tải về
                                      </p>
                                    </a>
                                  </td>
                                  <td class="text-center">
                                    <button type="submit" name="btnXem" id="btnXem" class="btn btn-primary" onclick="quatrinhluong(<?php echo $row['id']; ?>)">Xem QTL</button>
                                  </td>
                              </tr>
                            <?php 
                                }
                              }
                            ?>
                            <?php if (mysql_num_rows($result) == 0){?>
                              <tr><td colspan="5" style="width: 100%; text-align: center;">Không có cán bộ</td></tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                      </fieldset>

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
  </div>
  </div>
  <form id="form-quatrinhluong" action="" method="post" hidden="hidden">
  <input type="text" name="quatrinhluong" id="quatrinhluong">
</form>
  <script>
  function quatrinhluong(id) {
    $('#quatrinhluong').val(id);
    $('#form-quatrinhluong').submit();
  }
    $(document).ready(function(){
      $('#table').DataTable({
        "order": [[ 7, "desc" ]]
      });
    });

    $('#taive').click(function(){
      var batdau = $('#batdau').val();
      var ketthuc = $('#ketthuc').val();
      window.open('../../BLL/TienIch/nang_luong/BLLDanhSach.php?batdau=' + batdau + '&ketthuc=' + ketthuc);
    })


  </script>
</body>
</html>
<?php
  }
?>