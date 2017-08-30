<?php
ob_start();
session_start();
include("../../config/config.php");
$menu_active = "Báo cáo"; 
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
                      <b>Danh sách các báo cáo:</b><br>

                      <ul>
                        <li>Danh sách chi tiết cán bộ <a href="../../BLL/QuanLyCB/BLLDanhSachChiTiet.php">Download</a> | <a href="../../BLL/QuanLyCB/BLLDanhSachChiTiet_Online.php" target="_blank">Xem online</a></li>                      
                  <!--      <li>Danh sách trích ngang cán bộ <a href="../../BLL/QuanLyCB/BLLDanhSachTrichNgang.php">Download</a> | <a href="../../BLL/QuanLyCB/BLLDanhSachTrichNgang_Online.php" target="_blank">Xem online</a></li>
                        <li>Danh sách thông tin đào tạo <a href="../../BLL/QuanLyCB/BLLDanhSachDaoTao.php">Download</a> | <a href="" target="_blank">Xem online</a></li>
					
                      <li>Mẫu M1:THỐNG KÊ THỰC TRẠNG ĐỘI NGŨ VIÊN CHỨC TRONG ĐƠN VỊ SỰ NGHIỆP CÔNG LẬP <a href="../../BLL/BieuMau/m1.php">Download</a> | <a href="../../BLL/BieuMau/m1_online.php" target="_blank">Xem online</a></li>
                      <li>Mẫu M2:BÁO CÁO SỐ LƯỢNG, CHẤT LƯỢNG, CƠ CẤU ĐỘI NGŨ VIÊN CHỨC TẠI ĐƠN VỊ SỰ NGHIỆP CÔNG LẬP <a href="../../BLL/BieuMau/m2.php">Download</a> | <a href="../../BLL/BieuMau/m2_online.php" target="_blank">Xem online</a></li>
                    -->

                      <li>Mẫu M3:Danh Sách Tổng Hợp Cán Bộ, Viên Chức Trường ĐH CNGTVT
                        <select name="nambaocao" id="m3nambaocao">
                          <option value="">Chọn năm</option>
                          <option value="2017">Năm 2017</option>
                          <option value="2016">Năm 2016</option>
                          <option value="2015">Năm 2015</option>
                          <option value="2014">Năm 2014</option>
                          <option value="2013">Năm 2013</option>
                          <option value="2012">Năm 2012</option>
                          <option value="2011">Năm 2011</option>
                          <option value="2010">Năm 2010</option>
                        </select>
                        <a href="../../BLL/BieuMau/m3.php?nambaocao=2017" id="m3download">Download</a> |
                        <a href="../../BLL/BieuMau/m3_online.php?nambaocao=2017" id="m3online" target="_blank">Xem online</a>                        
                      <li>Mẫu M6:Danh Sách Tổng Hợp Cán Bộ, Viên Chức Trường Đại học Công nghệ GTVT <a href="../../BLL/BieuMau/m6.php">Download</a> | 
                        <a href="../../BLL/BieuMau/m6_online.php" target="_blank">Xem online</a>
                      </ul>
                    </p>
                    
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

<script>
  $('#m3nambaocao').on('change',function() {
    var nambaocao = $('#m3nambaocao :selected').val();
    $('#m3download').attr('href', '../../BLL/BieuMau/m3.php?nambaocao=' + nambaocao);
    $('#m3online').attr('href', '../../BLL/BieuMau/m3_online.php?nambaocao=' + nambaocao);
  });
</script>
</body>
</html>
<?php
}
?>