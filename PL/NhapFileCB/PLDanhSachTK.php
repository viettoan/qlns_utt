<?php
ob_start();
session_start();
include("../../config/config.php");
$menu_active = "Thống kê";
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
  $sql_trinhdo = isset($_POST['s_trinhdo'])?$_POST['s_trinhdo']:'';
  // $sql_hopdong = isset($_POST['s_hopdong'])?$_POST['s_hopdong']:'';
  $sql_tinhtrang = isset($_POST['s_tinhtrang'])?$_POST['s_tinhtrang']:'';
  $sql_dantoc = isset($_POST['s_dantoc']) ? $_POST['s_dantoc'] : '';
  $sql_tongiao = isset($_POST['s_tongiao']) ? $_POST['s_tongiao'] : '';
        //echo $sql_trangthai;
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
                  

                  <fieldset style="width: auto; hight: 100l; margin: auto;">
                    <legend>Tìm kiếm cán bộ</legend>
                    <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden;  width: auto;">
                        <tr>



                          <!-- <td>Hợp đồng</td>
                          <td>
                            <select name="s_hopdong" id="" onChange="submit()">
                              <option value="">All</option>
                              <option value="Không có hợp đồng" <?php// if($sql_hopdong == "Không có hợp đồng") echo "selected" ?>>Không có ĐH</option>
                              <option value="Hợp đồng vụ việc" <?php// if($sql_hopdong == "Hợp đồng vụ việc") echo "selected" ?>>HĐ vụ việc</option>
                              <option value="Hợp đồng 1 năm" <?php// if($sql_hopdong == "Hợp đồng 1 năm") echo "selected" ?>>HĐ lao động 1 năm</option>
                              <option value="Hợp đồng 3 năm" <?php// if($sql_hopdong == "Hợp đồng 3 năm") echo "selected" ?>>HĐ làm việc 3 năm</option>
                              <option value="HĐ không xác định thời hạn" <?php// if($sql_hopdong == "HĐ không xác định thời hạn") echo "selected" ?>>HĐ làm việc không XĐTH</option>
                            </select>
                          </td> -->

                          <td>Trình độ</td>
                          <td>
                          <form method="POST" action="">
                            <select name="s_trinhdo" id="" onChange="submit()" class="form-control">
                              <option value="Tất cả trình độ" <?php if($sql_trinhdo == "Tất cả trình độ") echo "selected" ?>>Tất cả</option>
                              <option value="Giáo sư" <?php if($sql_trinhdo == "Giáo sư") echo "selected" ?>>GS. TS</option>
                              <option value="Phó giáo sư" <?php if($sql_trinhdo == "Phó giáo sư") echo "selected" ?>>PGS. TS</option>
                              <option value="TS" <?php if($sql_trinhdo == "TS") echo "selected" ?>>TS</option>
                              <option value="NCS" <?php if($sql_trinhdo == "NCS") echo "selected" ?>>NCS</option>
                              <option value="Ths" <?php if($sql_trinhdo == "Ths") echo "selected" ?>>Ths</option>
                              <option value="Đ. Học cao học" <?php if($sql_trinhdo == "Đ. Học cao học") echo "selected" ?>>Đ. Học cao học</option>
                              <option value="Đại học" <?php if($sql_trinhdo == "Đại học") echo "selected" ?>>Đại học</option>
                              <option value="Cao đẳng" <?php if($sql_trinhdo == "Cao đẳng") echo "selected" ?>>Cao đẳng</option>
                              <option value="Trình độ khác" <?php if($sql_trinhdo == "Trình độ khác") echo "selected" ?>>Trình độ khác</option>
                            </select>
                          </form>
                            
                          </td>


                          <td>Tình trạng làm việc</td>
                          <td>
                          <form method="POST" action="">
                            <select name="s_tinhtrang" id="" onChange="submit()" class="form-control">
                              <option value="">Chọn</option>
                              <option value="Đang công tác" <?php if($sql_tinhtrang == "Đang công tác") echo 'selected' ?>>Đang công tác</option>
                              <option value="Nghỉ hưu" <?php if($sql_tinhtrang == "Nghỉ hưu") echo 'selected' ?>>Nghỉ hưu</option>
                              <option value="Thôi việc" <?php if($sql_tinhtrang == "Thôi việc") echo 'selected' ?>>Thôi việc</option>
                              <option value="Chuyển công tác">#Chuyển công tác</option>
                            </select>
                          </form>
                          </td>

                          <td>Dân tộc</td>
                          
                          <td>
                          <form method="POST" action="">
                            <select name="s_dantoc" onchange="submit()" class="form-control">
                              <option value="Tất cả dân tộc">Tất cả</option>
                              <?php 
                                $query = mysql_query("Select count(*) as count from lylich WHERE dantoc = 'Kinh';");
                                $row = mysql_fetch_array($query); 
                              ?>
                              <option value="Kinh" <?php if($sql_dantoc == "Kinh") echo "selected" ?>>Kinh (<?php echo $row['count'] ?>)</option>
                              <?php 
                                $query = mysql_query("Select count(*) as count from lylich WHERE dantoc <> 'Kinh';");
                                $row = mysql_fetch_array($query); 
                              ?>
                              <option value="Khác" <?php if($sql_dantoc == "Khác") echo "selected" ?>>Khác (<?php echo $row['count'] ?>)</option>
                            </select>
                            </form>
                          </td>

                          <td>Tôn giáo</td>
                          <td>
                          <form method="POST" action="">
                          <select name="s_tongiao" onchange="submit()" class="form-control">
                            <option value="Tất cả tôn giáo">Tất cả</option>
                            <?php 
                              $query = mysql_query("SELECT tongiao, count(*) AS tongso
                                                    FROM lylich
                                                    WHERE tongiao is not null
                                                    GROUP BY tongiao");
                              while ($row = mysql_fetch_array($query)) {
                                ?>
                                <option value="<?php echo $row['tongiao'] ?>" <?php if($sql_tongiao == $row['tongiao']) echo "selected" ?>>
                                  <?php echo $row['tongiao'] . " (" . $row['tongso'] . ")" ?>
                                </option>
                                <?php
                              }
                            ?>
                          </select>
                          </form>
                          </td>

                        </tr>
                      </table>
                    <form name="s_form" action="" method="POST" onsubmit="return search_func()">
                      
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


            // if ($sql_trinhdo == "All") {
            //   $sql="SELECT * FROM lylich where 1";
            // }else
            if(!empty($sql_trinhdo)) {
              if ($sql_trinhdo == "Đại học") {
                $sql="SELECT * FROM lylich where `hochamcaonhat_ten`='Cử nhân' or `hochamcaonhat_ten`='Kỹ sư' or `hochamcaonhat_ten`='Đ. Học cao học'";
              } elseif ($sql_trinhdo == "Trình độ khác") {
                $sql = "SELECT * FROM `lylich` where `chucdanhkhoahoc` NOT IN ('Giáo sư','Phó giáo sư') AND `hochamcaonhat_ten` NOT IN ('TS','NCS','Ths','Đ. Học cao học','Cử nhân','Kỹ sư','Cao đẳng')";
              } elseif($sql_trinhdo == "Ths") {
                $sql = "SELECT * FROM `lylich` where `hochamcaonhat_ten` = 'NCS' or `hochamcaonhat_ten` = 'Ths'";
              } elseif($sql_trinhdo == "Tất cả trình độ") {
                $sql = "SELECT * FROM `lylich`";
              } else {
                $sql = "SELECT * FROM `lylich` where `chucdanhkhoahoc` = '$sql_trinhdo' OR `hochamcaonhat_ten` = '$sql_trinhdo'";
              }
            }

            if($sql_dantoc == "Kinh") {
              $sql = "SELECT * from lylich WHERE dantoc = 'Kinh'";
            } elseif ($sql_dantoc == "Khác") {
              $sql = "SELECT * from lylich WHERE dantoc <> 'Kinh'";
            } elseif ($sql_dantoc == "Tất cả dân tộc") {
              $sql = "SELECT * from lylich";
            }

            if($sql_tongiao != "" && $sql_tongiao != "Tất cả tôn giáo") {
              $sql = "SELECT * FROM lylich WHERE tongiao = '$sql_tongiao'";
            } elseif ($sql_tongiao == "Tất cả tôn giáo") {
              $sql = "SELECT * from lylich";
            }

            // if ($sql_tinhtrang == "All") {
            //   $sql = "SELECT * FROM lylich"; 
            // } else
            if ($sql_tinhtrang == "Thôi việc") {
              $sql = "SELECT * FROM lylich WHERE trangthailamviec = 'Thôi việc'";
            } elseif ($sql_tinhtrang == "Nghỉ hưu") {
              $sql = "SELECT * FROM lylich WHERE trangthailamviec = 'Nghỉ hưu'";
            } elseif ($sql_tinhtrang == "Đang công tác") {
              $sql = "SELECT * FROM lylich WHERE trangthailamviec = 'Đang công tác'";
            }

            // if ($sql_hopdong == "Không có hợp đồng") {
            //   $sql = "Select lylich.* from lylich, (SELECT * FROM hopdong H WHERE ngayhdlaodong = (SELECT max(ngayhdlaodong) from hopdong where lylich_id = H.lylich_id)) hopdongcuoi where lylich.id = hopdongcuoi.lylich_id and loaihdlaodong = 'HĐ không xác định thời hạn' AND ngayhdlaodong = 0";
            // } elseif ($sql_hopdong == "Hợp đồng vụ việc") {
            //   //Hợp đồng LĐ vụ việc
            //   $sql = "Select lylich.* from lylich, (SELECT * FROM hopdong H WHERE ngayhdlaodong = (SELECT max(ngayhdlaodong) from hopdong where lylich_id = H.lylich_id)) hopdongcuoi where lylich.id = hopdongcuoi.lylich_id and loaihdlaodong = 'Hợp đồng vụ việc'";
            // } elseif ($sql_hopdong == "Hợp đồng 1 năm") {
            //     //Hợp đồng LĐ 1 năm
            //   $sql = "Select lylich.* from lylich, (SELECT * FROM hopdong H WHERE ngayhdlaodong = (SELECT max(ngayhdlaodong) from hopdong where lylich_id = H.lylich_id)) hopdongcuoi where lylich.id = hopdongcuoi.lylich_id and loaihdlaodong = 'Hợp đồng 1 năm'";
            // } elseif ($sql_hopdong == "Hợp đồng 3 năm") {
            //    //Hợp đồng LĐ 3 năm
            //   $sql = "Select lylich.* from lylich, (SELECT * FROM hopdong H WHERE ngayhdlaodong = (SELECT max(ngayhdlaodong) from hopdong where lylich_id = H.lylich_id)) hopdongcuoi where lylich.id = hopdongcuoi.lylich_id and loaihdlaodong = 'Hợp đồng 3 năm'";
            // } elseif ($sql_hopdong == "HĐ không xác định thời hạn") {
            //     //Hợp đồng LĐ k xác định
            //   $sql = "Select lylich.* from lylich, (SELECT * FROM hopdong H WHERE ngayhdlaodong = (SELECT max(ngayhdlaodong) from hopdong where lylich_id = H.lylich_id)) hopdongcuoi where lylich.id = hopdongcuoi.lylich_id and loaihdlaodong = 'HĐ không xác định thời hạn' AND ngayhdlaodong <> 0";
            // }
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
                  

                  <?php if( $sql_dantoc != "" ) { ?>
                    <th>Dân tộc</th>
                  <?php } ?> 

                  <?php if ( $sql_tongiao != "" ) { ?>
                    <th>Tôn giáo</th>
                  <?php } ?>
                    <!-- <th>Điều Chuyển</th> -->
                  <!-- <th>Xem</th> -->
                  
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
                    
                    <?php if( $sql_dantoc != "" ) { ?>
                    <td><?php echo $row['dantoc'] ?></td>
                  <?php } ?> 

                  <?php if ( $sql_tongiao != "" ) { ?>
                    <td><?php echo $row['tongiao'] ?></td>
                  <?php } ?>
                    <!-- <td></td> -->
                    <!-- <form method="post">
                      <td><button type="submit" name="btnXem" id="btnXem" class="btn btn-info" value="<?php// echo $row['id'] ?>">Chi tiết</button></td> -->
                      
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
            targets: [ 1 ]
        }]
    });
  });
</script>

