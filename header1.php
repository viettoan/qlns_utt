<?php
require_once 'config/config.php';
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<header class="art-header">
  <div class="art-shapes">
  </div>

  <!-- <img src="<?php echo $host ?>/images/header.jpg" alt="" style="width: 100%"> -->

</header>
<header style=""> 
  <nav class="art-nav" style="position: relative;">
    <ul class="art-hmenu">
      <li>
        <a href="<?php echo $host ?>/PL/NhapFileCB/Nhapmanhinh.php" <?php if ($menu_active == "Lý lịch") echo "class='active'" ?>>Nhập lý lịch</a>
      </li>
      <?php if($_SESSION['role']!=0) { ?>
      <li>
        <a href="<?php echo $host ?>/PL/NhapFileCB/PLDanhSachCB.php" <?php if ($menu_active == "Danh sách cán bộ" || $menu_active == "Điều chuyển" || $menu_active == "Danh sách cán bộ") echo "class='active'" ?>>Quản lý cán bộ</a>
        <ul>
          <li><a href="<?php echo $host ?>/PL/NhapFileCB/PLDanhSachCB.php" >Danh sách cán bộ</a></li>
          <li><a href="<?php echo $host ?>/PL/DieuChuyenCB/PLDieuChuyenCB.php">Điều chuyển</a></li>

        </ul>
      </li>
      <li>
        <a href="<?php echo $host ?>/PL/NhapFileCB/PLDanhSachTK.php" <?php if ($menu_active == "Thống kê") echo "class='active'" ?>>Thống kê</a>
      </li>
      <li>
        <a href="<?php echo $host ?>/PL/NhapFileCB/PLDanhSachBC.php" <?php if ($menu_active == "Báo cáo") echo "class='active'" ?>>Báo cáo</a>
      </li>

      <?php if($_SESSION['role']==1) { ?>

      <li >
        <a href="#" <?php if ( ($menu_active == "Bổ nhiệm lại cán bộ") || 
                                ($menu_active == "Danh sách nâng lương") || 
                                ($menu_active == "Cán bộ sắp nghỉ hưu") || 
                                ($menu_active == "Danh sách báo ký hợp đồng") || 
                                ($menu_active == "Quá trình thay đổi chức vụ") ||
                                ($menu_active == "Khen thưởng tập thể") ) echo "class='active'" ?>>Tiện ích</a>
        <ul>
          <!-- <li><a href="<?php// echo $host ?>/PL/TienIch/BoNhiemLaiCanBo.php">Danh sách cán bộ được bổ nhiệm lại</a></li> -->
          <li><a href="<?php echo $host ?>/PL/TienIch/DanhSachNangLuong.php">Cán bộ được nâng lương</a></li>
          <li><a href="<?php echo $host ?>/PL/TienIch/CanBoSapNghiHuu.php">Cán bộ sắp nghỉ hưu</a></li>
          <li><a href="<?php echo $host ?>/PL/TienIch/BaoKyHopDong.php">Danh sách báo ký hợp đồng</a></li>
          <li><a href="<?php echo $host ?>/PL/TienIch/khenthuongtapthe.php">Khen thưởng</a></li>
          <!-- <li><a href="<?php// echo $host ?>/PL/TienIch/quatrinhchucvu.php">Quá trình thay đổi chức vụ</a></li> -->
        </ul>
      </li>
        <?php  } ?>
      <?php } ?>
    </ul>
    <ul class="art-hmenu-user">
      <li>
        <a href="#" <?php if ($menu_active == "Cán bộ được bổ nhiệm lại" || $menu_active == "Cán bộ sắp nghỉ hưu" || $menu_active == "Cán bộ được nâng lương") echo "class='active'" ?>>Chào, <?=$_SESSION["username_user"]?></a>
        <ul class="active">
          <li><a href="#">Hộp thư</a></li>
          <?php if($_SESSION['role']==1) { ?>
            <li>
              <a href="<?php echo $host ?>/PL/NhapFileCB/Danh_sach_tai_khoan.php" <?php if ($menu_active == "Tài khoản") echo "class='active'" ?> >Quản lý tài khoản</a>
            </li>
            <?php } ?>
          <li><a href="<?php echo $host ?>/PL/QLTaikhoan/PLchangepass.php">Đổi mật khẩu</a></li>
          <li><a href="<?php echo $host ?>/BLL/QLTaikhoan/BLLlogout.php">Thoát</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</header>
