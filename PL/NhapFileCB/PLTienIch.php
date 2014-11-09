<?php
  ob_start();
  session_start();
  include("../../config/config.php");
  include_once("header.php");
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
		<li><a href="../DieuChuyenCB/PLDieuChuyenCB.php" class="">Điều chuyển</a></li>
        <li><a href="../NhapFileCB/PLTienIch.php" class="active">Tiện ích</a></li>
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
                  <p>
                    <b>Tải tài liệu:</b><br>
                    <ul>
                      <li>Mẫu M1: <a href="../../BLL/BieuMau/m1.php">Download</a> | <a href="../../BLL/BieuMau/m1_online.php" target="_blank">Xem online</a></li>
                      <li>Mẫu M2: <a href="../../BLL/BieuMau/m2.php">Download</a> | <a href="../../BLL/BieuMau/m2_online.php" target="_blank">Xem online</a></li>
                      <li>Mẫu M3: <a href="../../BLL/BieuMau/m3.php">Download</a> | <a href="../../BLL/BieuMau/m3_online.php" target="_blank">Xem online</a></li>
                      <li>Mẫu M4: <a href="../../BLL/BieuMau/m4.php">Download</a> | <a href="../../BLL/BieuMau/m4_online.php" target="_blank">Xem online</a></li>
					  <li>Mẫu M5: <a href="../../BLL/BieuMau/m5.php">Download</a> | <a href="../../BLL/BieuMau/m5_online.php" target="_blank">Xem online</a></li>
                    </ul>
                  </p>
                    <fieldset style="border: 1px solid lightgray;">
                    <legend><span style="font-weight: bold; color: #0080FF">Cán bộ được bổ nhiệm lại</span></legend>
                    <div style:="width:">
                    <p>Tải danh sách: 
                    <a href="../../BLL/TienIch/bo_nhiem/BLLDanhSach.php">
                      <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Danh sách bổ nhiệm lại">
                    </a></p>
                      <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                        <tbody>
                          <tr style="font-weight: bold;">
                            <td style="width: 60px;">Ảnh</td>
                            <td style="width: 150px;">Họ tên</td>
                            <td style="width: 70px;">Ngày sinh</td>
                            <td style="width: 100px;">Số hiệu CB</td>
                            <td style="width: 170px;">Chức vụ</td>
                            <td style="width: 100px;">Ngày bổ nhiệm</td>
                            <td style="width: 100px;">Tải</td>
                          </tr>
                          <?php
                            // Thong bao 3 thang truoc han 5 nam duoc bo nhiem lai
                            $sql = "SELECT * FROM lylich WHERE DATEDIFF(curdate(),chucvudate)>(5*365-3*30)";
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
                                    <p><?php echo $row["sohieucanbo"];?></p>
                                  </td>
                                  <td>
                                    <p><?php echo $row["chucvu"];?></p>
                                  </td>
                                  <td><p><?php echo date("d-m-Y",strtotime($row["chucvudate"]));?></p></td>
                                  <td>
                                    <!-- <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Quyết định"> -->
                                    <a href="../../BLL/TienIch/bo_nhiem/BLLThongBao.php?lylich_id=<?php echo $row["id"];?>">
                                      <p style="margin: 0 0 2px 0; padding: 0; height: 23px; line-height: 23px; clear:left; float:left;">
                                          <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Tải file thông báo">
                                          : Thông báo
                                      </p>
                                    </a>
                                    <!-- <br> -->
                                    <a style="height: 23px; line-height: 23px; clear:left; float:left;" href="../../BLL/TienIch/bo_nhiem/BLLQuyetDinh.php?lylich_id=<?php echo $row["id"];?>">
                                      <p style="margin: 0 0 2px 0; padding: 0; height: 23px; line-height: 23px; clear:left; float:left;">
                                        <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Tải file quyết định">
                                      : Quyết định
                                      </p>
                                    </a>
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
                      <br>
                    <fieldset style="border: 1px solid lightgray;">
                    <legend><span style="font-weight: bold; color: #0080FF">Cán bộ sắp nghỉ hưu</span></legend>
                    <p>Tải danh sách: 
                    <a href="../../BLL/TienIch/huu_tri/BLLDanhSach.php">
                      <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Danh sách bổ nhiệm lại">
                    </a></p>

                    <div style:="width:">
                      <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                        <tbody>
                          <tr style="font-weight: bold;">
                            <td style="width: 60px;">Ảnh</td>
                            <td style="width: 150px;">Họ tên</td>
                            <td style="width: 70px;">Ngày sinh</td>
                            <td style="width: 70px;">Giới tinh</td>
                            <td style="width: 100px;">Số hiệu CB</td>
                            <td style="width: 170px;">Chức vụ</td>
                            <td style="width: 100px;">Tải</td>
                          </tr>
                          <?php
                          // Thong bao truoc 6 thang han 60 tuoi NAM hoac 55 tuoi NU
                            $sql = "SELECT * FROM lylich WHERE (gioitinh = 1 AND DATEDIFF(curdate(),ngaysinh)>(60*365-6*30)) OR (gioitinh = 0 AND DATEDIFF(curdate(),ngaysinh)>(55*365-6*30))";
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
                              </tr>
                            <?php } ?>
                            <?php if (mysql_num_rows($result) == 0){?>
                              <tr><td colspan="5" style="width: 100%; text-align: center;">Không có cán bộ</td></tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                      </fieldset>
                      <br>
                    <fieldset style="border: 1px solid lightgray;">
                    <legend><span style="font-weight: bold; color: #0080FF">Cán bộ được nâng lương</span></legend>
                    <p>Tải danh sách: 
                      <a href="../../BLL/TienIch/nang_luong/BLLDanhSach.php">
                        <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Danh sách bổ nhiệm lại">
                      </a>
                    </p>
                    <p>Tải tờ trình: 
                    <?php
                      $count_can_bo = 0;
                      $sql = "SELECT * FROM lylich WHERE 1";
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
                      <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                        <tbody>
                          <tr style="font-weight: bold;">
                            <td style="width: 60px;">Ảnh</td>
                            <td style="width: 150px;">Họ tên</td>
                            <td style="width: 70px;">Ngày sinh</td>
                            <td style="width: 100px;">Số hiệu CB</td>
                            <td style="width: 170px;">Chức vụ</td>
                            <td style="width: 100px;">T/điểm gần nhất</td>
                            <td style="width: 100px;">Tải</td>
                          </tr>
                          <?php
                            $sql = "SELECT * FROM lylich WHERE 1";
                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)){
                              $lylich_id = $row["id"];
                              $sql_qtluong = "SELECT * FROM quatrinhluong WHERE lylich_id = '$lylich_id' ORDER BY thoidiem DESC LIMIT 1";
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
                                  <td>
                                    <p><?php echo $row["sohieucanbo"];?></p>
                                  </td>
                                  <td>
                                    <p><?php echo $row["chucvu"];?></p>
                                  </td>
                                  <td>
                                    <p>
                                    <?php
                                      echo $row_qtluong["thoidiem"];
                                    ?>
                                    </p>
                                  </td>
                                  <td>
                                    <!-- <a href="../../BLL/TienIch/nang_luong/BLLThongBao.php?lylich_id=<?php echo $row["id"];?>">
                                      <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Tải file thông báo">
                                    </a>: Thông báo
                                    <br> -->
                                    <a href="../../BLL/TienIch/nang_luong/BLLQuyetDinh.php?lylich_id=<?php echo $row["id"];?>">
                                      <p style="margin: 0 0 2px 0; padding: 0; height: 23px; line-height: 23px; clear:left; float:left;">
                                        <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Tải file quyết định">
                                        : Quyết định
                                      </p>
                                    </a>
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
</html>
<?php
  }
?>