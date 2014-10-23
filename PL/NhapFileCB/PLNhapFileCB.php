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
    if (!isset($_SESSION["file_list_import"])) $_SESSION["file_list_import"] = array();
  ?>
<style>
#uploadBtn{
   font-family: calibri;
   width: 150px;
   padding: 10px;
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border: 1px dashed #BBB; 
   text-align: center;
   background-color: #DDD;
   cursor:pointer;
  }
</style>
<script type="text/javascript">
 function getFile(){
   document.getElementById("upfile").click();
 }
 function sub(obj){
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("uploadBtn").innerHTML = fileName[fileName.length-1];
    document.uploadForm.submit();
    event.preventDefault();
  }
</script>
<body>
  <header class="art-header">
    <div class="art-shapes">
    </div>
    <nav class="art-nav">
      <ul class="art-hmenu">
        <li><a href="PLNhapFileCB.php" class="active">Nhập lý lịch</a></li>
        <li><a href="PLDanhSachCB.php" class="">Danh sách cán bộ</a></li>
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
                    <fieldset style="border: 1px solid lightgray;">
                      <legend><i><b>Upload hồ sơ mới</b></i></legend>
                      <div style:="width:">
                        <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                          <tbody>
                            <tr>
                              <td style="width: 100%; border-style: hidden">
              								<p>Chọn 1 hoặc nhiều hồ sơ</p>

                                <?php
                                # error messages
                                if (isset($message)) {
                                  foreach ($message as $msg) {
                                    printf("<p class='status'>%s</p></ br>\n", $msg);
                                    $_SESSION["message"] = array();
                                  }
                                }
                                # success message
                                if($_SESSION["count"] !=0){
                                  printf("<p style='color: green'>%d hồ sơ đã tải lên thành công!</p>\n", $_SESSION["count"]);
                                  $_SESSION["count"] = 0;
                                }
                                ?>
                                <p>Kích thuớc tối đa 1Mb, chấp nhận đuôi xls, xlsx</p>
                                <!-- Multiple file upload html form-->
                                <form action="../../BLL/NhapFileCB/UploadFiles.php" method="post" enctype="multipart/form-data" name="uploadForm">
								  <div id="uploadBtn" onclick="getFile()">Chọn hồ sơ để tải lên</div>
								  <!-- this is your file input tag, so i hide it!-->
								  <!-- i used the onchange event to fire the form submission-->
								  <div style='height: 0px;width: 0px; overflow:hidden;'>
								  <input id="upfile" type="file" name="files[]" value="upload" multiple="multiple" accept=".xls, .xlsx, .xlsm" onchange="sub(this)"/></div>
								  <!-- here you can have file submit button or you can write a simple script to upload the file automatically-->
								  <!-- <input type="submit" value='submit' > -->
                                </form>
                              </td>
                              <td style="width: 2%; border-style: hidden">
                              </td>
                              <td style="width: 65%; border-style: hidden">
                                
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <br>                            
                    </fieldset>
                    <br>
                    <fieldset style="border: 1px solid lightgray;">
                      <legend><i><b>Danh sách hồ sơ chờ nhập</b></i></legend>
                      <?php if ($_SESSION["success"] != ""){
                      ?>
                        <p style="color: green"><?php echo $_SESSION["success"]; $_SESSION["success"] = ""; ?></p>
                      <?php
                        }
                      ?>
                      <?php if ($_SESSION["notice"] != ""){
                      ?>
                        <p style="color: gray"><?php echo $_SESSION["notice"]; $_SESSION["notice"] = ""; ?></p>
                      <?php
                        }
                      ?>
                      <?php
                        if (count($_SESSION["error"]) > 0){
                          for ($i = 0; $i < count($_SESSION["error"]); $i++){
                      ?>
                        <p style="color: red"><?php echo $_SESSION["error"][$i]; ?></p>
                      <?php
                          }
                          $_SESSION["error"] = array();
                        }
                      ?>
                      <div style:="width:">
                        <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                          <tbody>
                            <tr style="font-weight: bold;">
                              <td style="width: 60px;">Ảnh</td>
                              <td style="width: 330px;">Tên hồ sơ</td>
                              <td style="width: 150px;">Họ tên</td>
                              <td style="width: 140px;">Tình trạng</td>
                              <td style="width: 150px;">Thao tác</td>
                            </tr>
                                <?php
                                $_SESSION["file_list_import"] = array();
                                $dir    = '../../upload/';
                                $files = scandir($dir,1);
                                $check_empty = true;
                                
                                for ($i=0; $i < count($files); $i++)
                                  //var_dump($files[$i]);
                                  if ($files[$i][0] != "." && $files[$i][0] != "o" && $files[$i][0] != "d" && $files[$i] != "ReadMe.txt"){
                                    $check_empty= false;
                                ?>
                                  <tr>
                                    <?php                                    
                                      // Bat dau goi thu vien PHPEXCEL
                                      error_reporting(E_ALL);
                                      ini_set('display_errors', TRUE);
                                      ini_set('display_startup_errors', TRUE);

                                      // define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

                                      date_default_timezone_set('Europe/London');

                                      /** Include PHPExcel_IOFactory */
                                      require_once dirname(__FILE__) . '/../../BLL/lib/PHPExcel/Classes/PHPExcel/IOFactory.php';

                                      // Bat dau doc file
                                      $objPHPExcel = PHPExcel_IOFactory::load("../../upload/".$files[$i]);
                                      $objWorksheet = $objPHPExcel->setActiveSheetIndex('0');
                                      try {
                                      	$cmnd = $objPHPExcel->getActiveSheet()->getCell('cmnd')->getFormattedValue();
                                      	$hoten = $objPHPExcel->getActiveSheet()->getCell('hoten')->getFormattedValue();
                                      	$soyeulylich = $objPHPExcel->getActiveSheet()->getCell('J2')->getFormattedValue();
                                      } catch (Exception $ex){
                                      	$cmnd = "";
                                      	$hoten = "";
                                      	$soyeulylich = "";
                                      }
                                      
                                      $file_chuan = true;
                                      if ((int)($cmnd) == 0 || $soyeulylich != "SƠ YẾU LÝ LỊCH") $file_chuan = false;
                                    ?>

                                    <td>
                                    <?php if (file_exists("../../images/avatar/".$cmnd.".jpg")) {?>
                                      <img src="../../images/avatar/<?php echo $cmnd;?>.jpg" alt="" style="width: 40px; height: 40px;">
                                    <?php } else { ?>
                                      <img src="../../images/avatar/noavatar" alt="" style="width: 40px; height: 40px;">
                                    <?php }?>
                                    </td>
                                    <td>
                                      <?php echo "<p>".$files[$i]."</p>"; ?>
                                    </td>
                                    <td>
                                      <p><?php if ($file_chuan == true) echo $hoten;?></p>
                                    </td>
                                    <td>
                                    <?php
                                      $sql = "SELECT * FROM lylich WHERE cmnd='$cmnd'";
                                      $result = mysql_query($sql);
                                      $count = mysql_num_rows($result);
                                      $row = mysql_fetch_array($result);
                                      if ($file_chuan == false){
                                        $lylich_tontai = 0;
                                        echo "<p style='color: gray; text-decoration: line-through;'>Hồ sơ không đúng chuẩn</p>";
                                      } elseif ($count > 0){
                                        $lylich_tontai = 1;
                                        $lylich_id = $row['id'];
                                        echo "<p style='color: red'>Đã tồn tại</p>";
                                      } else {
                                        $lylich_tontai = 0;
                                        echo "<p style='color: #0080FF'>Chưa được nhập</p>";
                                      }
                                    ?>
                                    </td>
                                    <td>
                                      <?php if ($lylich_tontai == 0 && $file_chuan == true){
                                        $_SESSION["file_list_import"][count($_SESSION["file_list_import"])] = $files[$i];
                                      ?>
                                        <form action="../../BLL/NhapFileCB/ImportData.php" method="post" style="width: 55px; float: left;">
                                        <input type="hidden" name="filename" value="<?php echo $files[$i]; ?>">
                                          <button type="submit">Nhập</button>
                                        </form>
                                      <?php } elseif ($file_chuan == true) {?>
                                        <form action="../../BLL/NhapFileCB/ImportData.php" method="post" style="width: 60px; float: left;">
                                        <input type="hidden" name="filename" value="<?php echo $files[$i]; ?>">
                                        <input type="hidden" name="overwrite" value="true">
                                        <input type="hidden" name="lylich_id" value="<?php echo $lylich_id; ?>">
                                          <button type="submit">Ghi đè</button>
                                        </form>
                                      <?php }?>
                                      <form action="../../BLL/NhapFileCB/CancelFile.php" method="post" style="width: 50px; float: left;">
                                        <input type="hidden" name="filename" value="<?php echo $files[$i]; ?>">
                                        <button type="submit">Hủy</button>
                                      </form>
                                    </td>
                                  </tr>
                                <?php } ?>
                                <?php if (count($_SESSION["file_list_import"]) > 0) {?>
                                <tr>
                                  <td colspan="5">
                                    <form action="PLNhapTatCaHoSoCB.php" method="post" style="width: 100%; text-align: center;">
                                      <button type="submit">Nhập tất cả</button>
                                    </form>                                        
                                  </td>
                                </tr>
                                <?php } ?>
                              <?php if ($check_empty == true){?>
                              <tr><td colspan="5" style="width: 100%; text-align: center;">Không có hồ sơ dữ liệu</td></tr>
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