<?php
ob_start();
session_start();
include("../../config/config.php");
include_once("header.php");
$menu_active = "Lý lịch";
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
    td{
     vertical-align:middle;	
   }
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
   #menu{
    width:100%;
    background-color: #283090;
    line-height:30px;
    box-shadow:1px 4px 10px #222;
    padding-left:0px;
  }
  #menu *{
    padding-top:2px;
  }
  #menu ul li{
    border-top: 2px solid #286E90;
    width:96%;
  }
  #menu ul li a{
    color:white;
  }
  .kyluat th, .kyluat td {
    padding: 0px;
    border: solid 1px #96A5AB;
    vertical-align: top;
/*    text-align: left;
*/	text-align:center;vertical-align:middle
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
                  <div class="art-layout-cell layout-item-1" style="width: 50%"  >
                    <div id="menu" style="float:left;width:19%;border-radius:7px;">
                     <ul>
                      <li class="active"><a href="Nhapmanhinh.php"><i class="fa fa-home"></i>LÝ LỊCH</a></li>
                      <li><a href="Daotao.php"><i class="fa fa-cog"></i>ĐÀO TẠO</a></li>
                      <li><a href="Congtac.php"><i class="fa fa-cog"></i>QUÁ TRÌNH CÔNG TÁC</a></li>
                      <li><a href="hoancanhkinhtegiadinh.php"><i class="fa fa-cog"></i>QUÁ TRÌNH LƯƠNG VÀ HỢP ĐỒNG</a>
                        <li><a href="kyluat.php"><i class="fa fa-cog"></i>KỶ LUẬT</a></li>
                        <li><a href="khenthuong.php"><i class="fa fa-cog"></i>KHEN THƯỞNG</a></li>
                        <li class="active"><a href="lichsubanthan.php"><i class="fa fa-home"></i>LỊCH SỬ BẢN THÂN</a></li>
                        <li><a href="quanhegiadinh.php"><i class="fa fa-cog"></i>QUAN HỆ GIA ĐÌNH</a></li>
                        <li><a href="quanhenuocngoai.php"><i class="fa fa-cog"></i>QUAN HỆ NGOÀI NƯỚC</a>
                        </li>
                      </ul>
                    </div>

                    <div style="width:80%;float:left;margin-left:10px">
                      <div id="s_box" style="text-align:center"><h1>KHEN THƯỞNG - <?php if(isset($_SESSION['hoten'])) echo $_SESSION['hoten'] ?></h1>
                      </div>

                      <?php// require_once('khenthuong/index.php') ?>
                      <p>Mục khen thưởng đã chuyển sang Tiện ích >> Khen thưởng. Nhấp vào <a href="<?php echo $host . '/PL/TienIch/khenthuongtapthe.php' ?>">đây</a> để chuyển tới. </p>


                    </div>
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
  $("button.btnDelete").click(
   function(){
       // alert($(this).attr("value"));
       keypress(2,$(this).attr("value"))	

     }
     );
   </script>
 </body>
 </html>
 <?php
}
?>