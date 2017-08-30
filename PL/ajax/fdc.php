<?php 
if(isset($_REQUEST['thu'])){
	include("../../config/config.php");
  function createcb($table,$col1,$col2,$cmt,$sql,$selected=0){ // hàm tạo select
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
    $sql.= " AND cosodaotao_id='".$a[0]."' ";
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
	$sql.=" ORDER BY hoten COLLATE utf8_vietnamese_ci";
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
		<div name="fs_list_all" style="display: table:cell; float:left;border: 1px solid;">
              <legend>Danh sách tất cả cán bộ:'; 
              $tr.= isset($cs[$a[0]])?$cs[$a[0]]:' ';
              $tr.= isset($tc[$a[1]])?' - '.$tc[$a[1]]:' ';
              $tr.= isset($k[$a[2]])?' - '.$k[$a[2]]:' ';
              $tr.= isset($bm[$a[3]])?' - '.$bm[$a[3]]:' ';
              $tr.= '    '.$sum_pp.' Người';
              $tr.='</legend>
                <div>
                  <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                    <tbody>
                      <tr style="font-weight: bold;">
                      <td style="width: 20px;">STT</td>
                      <td style="width: 50px;">Ảnh</td>
                      <td style="width: 130px;">Họ tên</td>
                      <td style="width: 70px;">Ngày sinh</td>
                      <!--td style="width: 50px;">Số hiệu CB</td-->
                      <td style="width: 330px;">Chức vụ</td>
                      <td style="width: 50px;">Đ.Chuyển</td>
                    </tr>';
                    while ($row = mysql_fetch_array($result)){
                      $tr.='<tr>
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
                      <input type="radio" name="canbocu" value="'.$row["id"].'">
                      </td>
                      </tr>';
                      $stt++;} 
                      if (mysql_num_rows($result) == 0){
                      $tr.='<tr><td colspan="5" style="width: 100%; text-align: center;">Không có file dữ liệu</td></tr>';
                       } 
                    $tr.='</tbody>
                  </table>
                </div>
              </div>';
              $arrshow['da']=$tr;
echo json_encode($arrshow);
 } ?>