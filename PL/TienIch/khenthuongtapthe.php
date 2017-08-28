<?php
  ob_start();
  session_start();
  include("../../config/config.php");
  $menu_active = "Khen thưởng tập thể";
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
  }
  ?>
<body>
  <?php
    include("../../header1.php");
  ?>
  <div class="art-content-layout">
    <div class="art-content-layout-row">
      <div class="art-layout-cell art-content">
        <article class="art-post art-article">
          <div class="container">
            <h2 class="page-header">Khen thưởng</h2>
            <?php 
              require_once('khenthuongtapthe/index.php');
            ?>
          </div>
        </article>
        <div class="art-content-layout layout-item-2" style="margin-top: 40px">
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
    </div>
  </div>
  <script>
    
  </script>
</body>
