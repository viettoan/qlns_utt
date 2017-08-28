<?php
ob_start();
session_start();
include("../../config/config.php");
$menu_active = "Danh sách cán bộ";
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
  <!--Search Function start-->
  <script type="text/javascript">
    function search_fucn() {
      if((document.search_form.search_name.value()=="") ) {
        alert("Thông tin tìm kiếm chưa được điền vào!");
        document.search_form.search_name.focus();
        return false;
      }else {
        return true;
      }
    }
  </script>
  <!--End of Search Function-->
  <body>
    <style>
     #danhsachcanbo_bang td{
      border:1px;
      border-collapse:collapse;
      border-bottom-style:solid;
    }
  </style>
  <!-- header start -->    
  <!--header stop -->   
  <?php
  include("../../header1.php");
  $sql_trangthai = isset($_POST['s_trangthai'])?$_POST['s_trangthai']:2;				
  if(isset($_POST['btnDuyet'])){
    $lylich_id2=$_POST['btnDuyet'];
    $query="Update lylich set trangthai='1' where id='$lylich_id2'";
    $result=mysql_query($query);
    if($result)
     echo "<script>alert('Duyệt thành công !')</script>";
   else
    echo "<script>alert('Duyệt thất bại !')</script>";
}

?>
<!--Search Form start -->
<script type="text/javascript">
 function search_func() {
  if(document.s_form.s_ten.value=="") {      

    if(document.s_form.s_donvi.value=="") {
      if(document.s_form.s_huyen.value=="") {
        if(document.s_form.s_tinh.value=="") {
          alert("Thông tin tìm kiếm chưa được nhập. Cần nhập ít nhất một thông tin tìm kiếm !");

          document.s_form.s_ten.focus();
          return false;
        }
      }
    }
  }else{
    return true;
  }
}
</script>



<!-- Thông tin tất cả các cán bộ
-->

<div class="art-layout-wrapper">
  <div class="art-content-layout">
    <div class="art-content-layout-row">
      <div class="art-layout-cell art-content">
        <article class="art-post art-article">
          <div class="art-postcontent art-postcontent-0 clearfix">
            <div class="art-content-layout">
              <div class="art-content-layout-row">
                <div class="art-layout-cell layout-item-1" style="width: 50%" >
                  <!--p>
                    <b>Tải tài liệu:</b><br>
                    <ul>
                      <li>Danh sách chi tiết cán bộ <a href="../../BLL/QuanLyCB/BLLDanhSachChiTiet.php">Download</a> | <a href="../../BLL/QuanLyCB/BLLDanhSachChiTiet_Online.php" target="_blank">Xem online</a></li>                      
                      <li><a href="../../BLL/QuanLyCB/BLLDanhSachTrichNgang.php">Danh sách trích ngang cán bộ</a></li>
                      <li><a href="../../BLL/QuanLyCB/BLLDanhSachDaoTao.php">Danh sách thông tin đào tạo</a></li>
                    </ul>                    
                  </p>                                                                       
                  <br /-->

                  <fieldset style="width: auto; hight: 100l; margin: auto;">
                    <legend>Tìm kiếm cán bộ</legend>
                    <form name="s_form" action="" method="POST" onsubmit="return search_func()">
                      <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden;  width: auto;">
                        <tr>
                          <td  style="text-align: right">
                            Tên cán bộ:
                          </td>
                          <td>
                            <input type="text" name="s_ten"  class="form-control"  onChange="submit()"/>
                          </td>

                          <td style="text-align: right">
                            Chức vụ:
                          </td>
                          <td >
                            <input type="text" name="s_chucvu" class="form-control" onChange="submit()" />
                          </td>

                          <td  style="text-align: right">
                            Trạng thái:
                          </td>
                          <td >
                            <select name="s_trangthai" id="s_trangthai" onChange="submit()" class="form-control">
                              <option value="2" <?php if($sql_trangthai==2) echo "selected"; ?> >Chọn</option>
                              <option value="1" <?php if($sql_trangthai==1) echo "selected"; ?>>Duyệt</option>
                              <option value="0" <?php if($sql_trangthai==0) echo "selected"; ?>>Chưa duyệt</option>
                            </select>
                          </td>
                          <td>
                            <button align="right" type="submit" name="search_submit" class="btn btn-info" value="Tìm kiếm" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Tìm kiếm</button>
                          </td>

                        </tr>
                      </table>
                      <br />


                      






                      <?php
                      $cosodaotaoid=0;
                      if(isset($_SESSION['khuvuc'])){
                       $query ="Select * from cosodaotao where cosodaotaoid ='$_SESSION[khuvuc]'";
                       $result = mysql_query($query);
                       $row = mysql_fetch_row($result);
                       $cosodaotaoid=$row[0];
                     }

                     if($cosodaotaoid!=0)
                      $temp ="cosodaotao_id = '$cosodaotaoid' ";
                    else
                     $temp="";


                   $sql_name=isset($_POST['s_ten'])?$_POST['s_ten']:'';
                //$sql_donvi=$_POST['s_donvi'];

                   $sql_chucvu=isset($_POST['s_chucvu'])?$_POST['s_chucvu']:'';

                //$sql_tinh=$_POST['s_tinh'];

               /* $sql_huyen=mysql_query("select * from huyen where name like '%$sql_huyen_1%'");
                $sql_huyen_2=$sql_huyen["districtid"];
                echo $sql_huyen_2;*/  
                
               //$s_result=mysql_query("select * from lylich where hoten LIKE '%$sql_name%' or donvitructhuoc like '%$sql_donvi%' or donvicoso like '%$sql_donvi%'  or quequan_tinh='$sql_tinh'") or die("Không tìm thấy");
               /* if($sql_huyen_1!="") {
                  $sql_huyen_2="select '%$sql_huyen_1%' like name from huyen";
                  
                 // $sql_huyen=$sql_huyen_2['districtid'];
                  echo "$sql_huyen_2";
                  $s_result=  mysql_query("select * from lylich where quequan_huyen=$sql_huyen");
                }*/
                if ($sql_name!="" && $sql_chucvu=="" && $sql_trangthai=="2"  ){
                 if($temp!='')
                   $temp = $temp." and ";
                 $sql = "select * from lylich where  $temp  hoten like '%$sql_name%'   ORDER BY trangthai ,hoten";
               }
               else if ($sql_name=="" and $sql_chucvu!="" and $sql_trangthai=="2"){
                if($temp!='')
                  $temp =$temp." and ";
                $sql="select * from lylich where $temp   chucvu like '%$sql_chucvu%'   ORDER BY trangthai ,hoten";
              }
              else if($sql_name=="" and $sql_chucvu=="" and $sql_trangthai!="2"){
               if($temp!='')
                 $temp = $temp." and " ;
               $sql="select * from lylich where $temp   trangthai = '$sql_trangthai'   ORDER BY trangthai ,hoten";
             }
             else{
               if($temp!='')
                $temp1='where ';
              else
                $temp1='';
              $sql = "SELECT * FROM lylich $temp1   $temp  ORDER BY trangthai ,hoten  COLLATE utf8_vietnamese_ci";

            }

            ?>



          </fieldset>

          
          <br/>
          <div id="s_box">

            <?php 
			//get bien cosodaotao
            $cosodaotao = isset($_POST['cosodaotao'])?$_POST['cosodaotao']:'';
            $tochuctructhuoc = isset($_POST['tochuctructhuoc'])?$_POST['tochuctructhuoc']:'';
            $khoaphongban = isset($_POST['khoaphongban'])?$_POST['khoaphongban']:'';
            $bomonto = isset($_POST['bomonto'])?$_POST['bomonto']:'';
            // echo $cosodaotao.'-'.$tochuctructhuoc.'-'.$khoaphongban .'-'.$bomonto;
          function createcb($table,$col1,$col2,$cmt,$selected=0){ // hàm tạo select
            $sql1="select $col1,$col2 from $table";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select name="'.$table.'" id='.$table.' style="width:25%;border: 1px solid #ccc;height: 34px;border-radius: 4px;">
            <option value="">'.$cmt.'</option>';
            foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
            }
            echo '</select>';
          }
		   function createcb1($table,$col1,$col2,$cmt,$selected=0,$ten,$dk){ // hàm tạo select
        $sql1="select $col1,$col2 from $table where $ten = '$dk'";
        $re_s=mysql_query($sql1);
        $ar=array();
        while($row=mysql_fetch_array($re_s)){
          $ar[$row[$col1]]=$row[$col2];
        }
        echo '<select name="'.$table.'" id='.$table.' style="width:25%;border: 1px solid #ccc;height: 34px;border-radius: 4px;">';
        echo'<option value="01">MỜI CHỌN TỔ CHỨC TRỰC THUỘC</option>';
        foreach ($ar as $k => $v) {
          echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
        }
        echo '</select>';
      }
		  //@co so
      if($cosodaotaoid=='1'||$cosodaotaoid=='2'||$cosodaotaoid=='3'){ 
       $query = "Select * from cosodaotao where cosodaotaoid='$cosodaotaoid'";
       $result = mysql_query($query);
       $row = mysql_fetch_array($result);
       echo "<input name='cosodaotao' id='cosodaotao' value='".$row[1] ."' style='width:24%;margin-left:5px;'  />";
       createcb1("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC",$tochuctructhuoc,'cosodaotaoid',$cosodaotaoid);
       createcb("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$khoaphongban);
       createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$bomonto);

     }
     else{
      createcb("cosodaotao","cosodaotaoid","name","MỜI CHỌN CƠ SỞ ĐÀO TẠO",$cosodaotao);
      createcb("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC",$tochuctructhuoc);
      createcb("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$khoaphongban);
      createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$bomonto);
    }
    ?>  
  </div>

  <script type="text/javascript">
          $(document).ready(function(){ // ajax
            var khuvuc = document.getElementById("khuvuc").value;
            $("#s_box > select").change(function(){
              var fin;
              fin=$("#cosodaotao").val();
              fin=fin+'_'+$("#tochuctructhuoc").val();
              fin=fin+'_'+$("#khoaphongban").val();
              fin=fin+'_'+$("#bomonto").val();
              $.ajax({
                method:'post',
                dataType:"json",
                data:{thu:fin,khuvuc:khuvuc},
                url:'../ajax/fincb.php',
                success:function(data){
                  if(data){
                    $("#findcb").html(data.da);
                    if(data.tc){$("#tochuctructhuoc").html(data.tc);}
                    if(data.kh){$("#khoaphongban").html(data.kh);}
                    if(data.bm){$("#bomonto").html(data.bm);}
                  }
                }
              });
              console.log(fin);
            });
          });
        </script>
        <br/>
        <hr/>


        <div id="findcb">

          <?php

          $result = mysql_query($sql) or die("Không có dữ liệu");
          $sum_pp=mysql_num_rows($result);
          $stt=1;?>
          <fieldset name="fs_list_all">
            <legend>Danh sách tất cả cán bộ:<?php echo $sum_pp.' Người'; ?></legend>
            <div style:="width:">
              <table id="danhsachcanbo_bang"  class="display">
                <thead>
                  <th>STT</th>
                  <th>Ảnh</th>
                  <th>Họ tên</th>
                  <th>Ngày sinh</th>
                  <th>Chức vụ</th>
                  <th>Đào Tạo</th>
                  <th>Xem</th>
                  <th>Xét duyệt</th>
                  <th>Xóa</th>
                </thead>
                <tbody>
                  <?php
                  while ($row = mysql_fetch_array($result)){
                  ?>

                  <tr>
                    <td><?php echo $stt?></td>
                    <td>
                      <?php if (file_exists("../../images/avatar/".$row["cmnd"].".jpg")) {?>
                      <img src="../../images/avatar/<?php echo $row["cmnd"];?>.jpg" alt="" style="width: 40px; height: 40px;">
                      <?php } else { ?>
                      <img src="../../images/avatar/noavatar" alt="" style="width: 40px; height: 40px;">
                      <?php }?>
                    </td>
                    <td>
                      <a href="../../BLL/XuatLylichCb/BLLExport.php?lylich_id=<?php echo $row["id"];?>" alt="Tải Lý lịch trích ngang">
                        <p><?php echo $row["hoten"];?></p>
                      </a>
                    </td>
                    <td>
                      <p><?php echo date("d-m-Y",strtotime($row["ngaysinh"]));?></p>
                    </td>
                      <!--td>
                      <p><?php //echo $row["sohieucanbo"];?></p>
                    </td-->
                    <td>
                      <p><?php echo $row["chucvu"];?></p>
                    </td>
                    <td>
                      <!-- <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Quyết định"> -->
                      <a href="../../BLL/QuanLyCB/BLLCanBoDaoTao.php?lylich_id=<?php echo $row["id"];?>">
                        <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Lý lịch trích ngang">
                      </a>
                    </td>    
                    
                      <td>
                      <form action=""></form>
                      <form method="post">
                      <button type="submit" name="btnXem" id="btnXem" class="btn btn-success" value="<?php echo $row['id'] ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Chi tiết</button>
                      </form>
                      </td>
                      <td>
                      <form method="post">
                      <?php if(!$row['trangthai']) { ?>
                        <button type="submit" name="btnDuyet" id="btnDuyet"  class="btn btn-primary" value="<?php echo $row['id'] ?>" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></span> Duyệt</button>
                      <?php } else { ?>
                        <span class="text-success">Đã duyệt</span>
                      <?php } ?>
                      </form>
                      </td>
                  <!--    <td>
                      <p></p>
                    </td>-->
                   <!--   <td>
                      <p></p>
                    </td>-->
                    <td>
                      <!--img src="../../images/edit.png" style="width: 20px; height: 20px; cursor: pointer;"-->
                      <form action="../../BLL/QuanLyCB/BLLDelete.php" method="post" id="delete_form<?php echo $row["id"];?>" style="display: none">
                        <input type="hidden" name="lylich_id" value="<?php echo $row["id"];?>"/>
                      </form>
                      
                      <button class="btn btn-danger" onClick="if (confirm('Bạn có thực sự muốn xóa cán bộ: <?php echo $row["hoten"];?>?')) $('#delete_form<?php echo $row["id"];?>').submit()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Xóa</button>
                    </td>
                  </tr>
                  <?php $stt++;} ?>
                  <?php if (mysql_num_rows($result) == 0){?>
                  <tr><td colspan="5" style="width: 100%; text-align: center;">Không có file dữ liệu</td></tr>
                  <?php } ?>  
                </tbody>
                <input type="hidden" value="<?php echo $_SESSION['khuvuc'] ?>" name="khuvuc" id="khuvuc" />
              </table>
            </div>
          </fieldset>
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
</body>
</form>
</html>
<?php
}
if(isset($_POST['btnXem'])){
 $_SESSION['lylich_id1']=$_POST['btnXem'];
 header("location:Nhapmanhinh.php");
}

?>
<script>
 function abc(str){

   var xem = $("#btnXem"+str).val();
   window.location="temp1.php?xem="+xem;
 }
 function abcd(str){

   var duyet = $("#btnDuyet"+str).val();

   window.location="temp_duyet.php?duyet="+duyet;
 }
  /* function marked(){
	   var cosodaotao = $("cosodaotao").val();
	   alert(cosodaotao);
  }*/

  $(document).ready(function(){
    $('#danhsachcanbo_bang').DataTable({
      autoWidth: false,
      columnDefs: [{ 
            orderable: false,
            targets: [ 1, 6, 7, 8]
        }]
    });
  });
</script>

