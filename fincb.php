<?php 
session_start();
$khuvuc = isset($_REQUEST['thu'])?$_REQUEST['khuvuc']:'';
if(isset($_REQUEST['thu'])){
	include("../../config/config.php");
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
  function createcb($table,$col1,$col2,$cmt,$sql,$selected=4){ // hàm tạo select
            $re_s=mysql_query($sql);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            $str= '<select name="'.$table.'" id='.$table.' style="width:24%;margin-left:5px;">
                    <option value="0">'.$cmt.'</option>';
            foreach ($ar as $k => $v) {
              $str.= '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
            }
            $str.= '</select>';
            return $str;
          }
	$a=explode("_",$_REQUEST['thu']);
  $arrshow=array();
	$sql_bm="SELECT * FROM `bomonto` WHERE 1";//bộ môn
	$sql_cs="SELECT * FROM `cosodaotao` WHERE 1";// cơ sở
	$sql_tc="SELECT * FROM `tochuctructhuoc` WHERE 1";//tở chức
	$sql_k="SELECT * FROM `khoaphongban` WHERE 1";//khoa
	$sql = "SELECT * FROM lylich WHERE 1";
	if($a[0]!=0){ 
    $sql.= " AND cosodaotao_id='".$a[0]."' AND cosodaotao_id='".$khuvuc."' ";
    $sql_kt="select tochuctructhuocid,name from tochuctructhuoc  where cosodaotaoid = ".$a[0];
    $arrshow['tc']= createcb("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC",$sql_kt, $a[1]);
    $sql_kt="select khoaphongbanid,name from khoaphongban  where tochuctructhuocid in (select tochuctructhuocid from tochuctructhuoc  where cosodaotaoid = ".$a[0].")";
    $arrshow['kh']= createcb("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$sql_kt, $a[2]);
    $sql_kt=$sql_kt="select bomontoid,name from bomonto  where khoaphongbanid in (select khoaphongbanid from khoaphongban  where tochuctructhuocid in (select tochuctructhuocid from tochuctructhuoc  where cosodaotaoid = ".$a[0]."))";
    $arrshow['bm']= createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$sql_kt, $a[3]);

  }
	if($a[1]!=0){ 
    $sql.= " AND tochuctructhuoc_id='".$a[1]."' ";
    $sql_kt="select khoaphongbanid,name from khoaphongban  where tochuctructhuocid = ".$a[1];
    $arrshow['kh']= createcb("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$sql_kt, $a[2]);
    $sql_kt="select bomontoid,name from bomonto  where khoaphongbanid in (select khoaphongbanid from tochuctructhuoc  where tochuctructhuocid = ".$a[1].")";
    $arrshow['bm']= createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$sql_kt, $a[3]);
  }
	if($a[2]!=0){ 
    $sql.= " AND khoaphongban_id='".$a[2]."' ";
    $sql_kt="select bomontoid,name from bomonto  where khoaphongbanid = ".$a[2];
    $arrshow['bm']= createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$sql_kt, $a[3]);
  }
	if($a[3]!=0){ $sql.= " AND bomonto_id='".$a[3]."' ";}
	$sql.="  ORDER BY trangthai,hoten COLLATE utf8_vietnamese_ci";
	$result_cs= mysql_query($sql_cs) or die($sql_cs);
	$result_bm = mysql_query($sql_bm) or die($sql_bm);
	$result_tc = mysql_query($sql_tc) or die($sql_tc);
	$result_k = mysql_query($sql_k) or die($sql_k);

	$bm=array();
	$tc=array();
	$cs=array();
	$k=array();
	 while ($row=mysql_fetch_array($result_cs)) {
	 	$cs[$row['cosodaotaoid']]=$row['name'];
	 }
	 while ($row=mysql_fetch_array($result_tc)) {
	 	$tc[$row['tochuctructhuocid']]=$row['name'];
	 }
	 while ($row=mysql_fetch_array($result_k)) {
	 	$k[$row['khoaphongbanid']]=$row['name'];
	 }
	 while ($row=mysql_fetch_array($result_bm)) {
	 	$bm[$row['bomontoid']]=$row['name'];
	 }
	$result = mysql_query($sql) or die($sql);
            $sum_pp=mysql_num_rows($result);
            $stt=1;
            $tr="";
            $tr.='
<fieldset name="fs_list_all">
              <legend>Danh sách tất cả cán bộ:'; 
              $tr.= isset($cs[$a[0]])?$cs[$a[0]]:' ';
              $tr.= isset($tc[$a[1]])?' - '.$tc[$a[1]]:' ';
              $tr.= isset($k[$a[2]])?' - '.$k[$a[2]]:' ';
              $tr.= isset($bm[$a[3]])?' - '.$bm[$a[3]]:' ';
              $tr.= '    '.$sum_pp.' Người';
              $tr.='</legend>
                <div style:="width:">
                  <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                    <tbody>
                      <tr style="font-weight: bold;">
                          <td style="width: 2%;">STT</td>
                      <td style="width: 5%;">Ảnh</td>
                      <td style="width: 10%;">Họ tên</td>
                      <td style="width: 14%;">Ngày sinh</td>
                      <!--td style="width: 50px;">Số hiệu CB</td-->
                      <td style="width: 22%;">Chức vụ</td>
                      <td style="width: 4%;">Đ.Tạo</td>
                      <td style="width: 6%;">Cử Đ.Học</td>
                      <td style="width: 6%;">Đ.Chuyển</td>
                      <td style="width: 6%;">Xem</td>
                      <td style="width: 6%;">Trạng thái</td>
                      <td style="width: 6%;">Duyệt</td>
                      <td style="width: 6%;">Xóa</td>
                    </tr>';
                    while ($row = mysql_fetch_array($result)){
							if($row['trangthai']==0)
						      $temp = 'bgcolor="#FFCC33"';
					    else
						      $temp='bgcolor="00FFFF"';
                      $tr.='<tr '.$temp.'>
                      <td>'.$stt.'</td>
                      <td>';
                      if (file_exists("../../images/avatar/".$row["cmnd"].".jpg")) {
                      $tr.='<img src="../../images/avatar/'.$row["cmnd"].'.jpg" alt="" style="width: 40px; height: 40px;">';
                      } else { 
                      $tr.='<img src="../../images/avatar/noavatar" alt="" style="width: 40px; height: 40px;">';
                      }
                      $tr.='</td>
                      <td>
                      <a href="../../BLL/XuatLylichCb/BLLExport.php?lylich_id='.$row["id"].'" alt="Tải Lý lịch trích ngang">
                      <p>'.$row["hoten"].'</p>
                      </a>
                      </td>
                      <td>
                      <p>'.date("d-m-Y",strtotime($row["ngaysinh"])).'</p>
                      </td>
                      <td>
                      <p>'.$row["chucvu"].'</p>
                      </td>
                      <td>
                      <!-- <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Quyết định"> -->
                      <a href="../../BLL/QuanLyCB/BLLCanBoDaoTao.php?lylich_id='.$row["id"].'">
                      <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Lý lịch trích ngang">
                      </a>
                      </td>
					    <td></td>
                      <td></td>
					  <form method="post">
                      <td><button onClick="abc()" type="submit" name="btnXem" class="btnXem" value="'. $row['id'].'">Xem</button></td><td>';
                     if($row['trangthai']==1) $tr.="Đã duyệt"; else $tr.="Chưa duyệt"; 
                     $tr.=' </td>
				
                      <td>
                         <button onClick="abcd()" type="submit" name="btnDuyet" class="btnDuyet" value="'.$row['id'].'" >Duyệt</button>
                      </td>
					  	 </form>
                      <td>
                      <!--img src="../../images/edit.png" style="width: 20px; height: 20px; cursor: pointer;"-->
                      <form action="../../BLL/QuanLyCB/BLLDelete.php" method="post" id="delete_form'.$row["id"].'" style="display: none">
                      <input type="hidden" name="lylich_id" value="'.$row["id"].'"/>
                      </form>
                      <img src="../../images/delete.png" style="width: 20px; height: 20px; cursor: pointer;" onclick="if (confirm(\'Bạn có thực sự muốn xóa cán bộ: '.$row["hoten"].'?\')) $(\'#delete_form'.$row["id"].'\').submit()">
                      </td>
                      </tr>';
                      $stt++;} 
                      if (mysql_num_rows($result) == 0){
                      $tr.='<tr><td colspan="5" style="width: 100%; text-align: center;">Không có file dữ liệu</td></tr>';
                       } 
                    $tr.='</tbody>
                  </table>
                </div>
              </fieldset>';
              $arrshow['da']=$tr;
echo json_encode($arrshow);
// echo "du";
 } ?>
 


