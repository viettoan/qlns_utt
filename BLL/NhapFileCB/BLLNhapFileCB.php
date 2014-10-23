<?php
  ob_start();
  session_start();
  include_once("header.php");
  if( !isset($_SESSION["login_user"]) ) {
    header('Location: index.php');
    exit();
  } else { 
  ?>
<body>
  <header class="art-header">
    <div class="art-shapes">
    </div>
    <nav class="art-nav">
      <ul class="art-hmenu">
        <li><a href="../../PL/NhapFileCB/PLNhapFileCB.php" class="active">Nhập lý lịch</a></li>
        <li><a href="qua-trinh-hoc-tap-cong-tac.php" class="">Quá trình học tập - công tác</a></li>
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
                  <div class="art-layout-cell layout-item-0" style="width: 100%" >
                  </div>
                </div>
              </div>
              <div class="art-content-layout">
                <div class="art-content-layout-row">
                  <div class="art-layout-cell layout-item-1" style="width: 50%" >
                    <p></p>
                    <p>
                    </p>
                    <p></p>
                    <p></p>
                    <p></p>
                    <fieldset style="border: 1px solid lightgray;">
                    <?php
					/*
					 * Bat dau --- Xu ly file nhap
					 *
					 */
					if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
						//echo 'ok';
						require_once('_NhapFile.php');
						xuLyFile();
					/*
					 * Ket thuc --- Xu ly file nhap
					 *
					 */
					}
					
					?>                     
                    </fieldset>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                  </div>
                  
                </div>
              </div>
              
              <div class="art-content-layout layout-item-2">
                <div class="art-content-layout-row">
                  <div class="art-layout-cell layout-item-3" style="width: 35%" >
                    <p><br></p>
                  </div>
                  <div class="art-layout-cell layout-item-3" style="width: 37%" >
                    <p><br></p>
                  </div>
                  <div class="art-layout-cell layout-item-3" style="width: 28%" >
                    <p><br></p>
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
