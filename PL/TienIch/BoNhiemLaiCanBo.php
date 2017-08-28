<?php
  ob_start();
  session_start();
  include("../../config/config.php");
  $menu_active = "Bổ nhiệm lại cán bộ";
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
</html>
<?php
  }
?>