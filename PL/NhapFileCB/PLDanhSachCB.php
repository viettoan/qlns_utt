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
        <li><a href="PLNhapFileCB.php">Nhập lý lịch</a></li>
        <li><a href="PLDanhSachCB.php" class="active">Danh sách cán bộ</a></li>
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
                  <p>
                    <b>Tải tài liệu:</b><br>
                    <ul>
                      <li><a href="../../BLL/QuanLyCB/BLLDanhSachTrichNgang.php">Danh sách trích ngang cán bộ</a></li>
                      <li><a href="../../BLL/QuanLyCB/BLLDanhSachDaoTao.php">Danh sách thông tin đào tạo</a></li>
                    </ul>
                    
                  </p>
                    <div style:="width:">
                      <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                        <tbody>
                          <tr style="font-weight: bold;">
                            <td style="width: 60px;">Ảnh</td>
                            <td style="width: 180px;">Họ tên</td>
                            <td style="width: 70px;">Ngày sinh</td>
                            <td style="width: 100px;">Số hiệu CB</td>
                            <td style="width: 170px;">Cấp ủy hiện tại</td>
                            <td style="width: 70px;">Tải lý lịch</td>
                            <td style="width: 90px;">Thao tác</td>
                          </tr>
                          <?php
                            $sql = "SELECT * FROM lylich WHERE 1";
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
                                    <p><?php echo $row["capuyhientai"];?></p>
                                  </td>
                                  <td>
                                    <!-- <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Quyết định"> -->
                                    <a href="../../BLL/XuatLylichCb/BLLExport.php?lylich_id=<?php echo $row["id"];?>">
                                      <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Lý lịch trích ngang">
                                    </a>
                                  </td>
                                  <td>
                                    <img src="../../images/edit.png" style="width: 20px; height: 20px; cursor: pointer;">
                                    <form action="../../BLL/QuanLyCB/BLLDelete.php" method="post" id="delete_form" style="display: none">
                                      <input type="hidden" name="lylich_id" value="<?php echo $row["id"];?>"/>
                                    </form>
                                      <img src="../../images/delete.png" style="width: 20px; height: 20px; cursor: pointer;" onclick="if (confirm('Bạn có thực sự muốn xóa cán bộ: <?php echo $row["hoten"];?>?')) $('#delete_form').submit()">
                                  </td>
                              </tr>
                            <?php } ?>
                            <?php if (mysql_num_rows($result) == 0){?>
                              <tr><td colspan="5" style="width: 100%; text-align: center;">Không có file dữ liệu</td></tr>
                            <?php } ?>
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
</html>
<?php
  }
  ?>
