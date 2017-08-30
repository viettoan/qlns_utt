<?php 
if(isset($_REQUEST['thu'])){
	include("../../config/config.php");
  function createcb($table,$col1,$col2,$cmt,$sql,$selected=0, $name=""){ // hàm tạo select
            $re_s=mysql_query($sql);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            $str= '<select name="'.$table.$name.'" id='.$table.$name.' style="width:24%;margin-left:5px;">
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
    $arrshow['tc']= createcb("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC",$sql_kt, $a[1], "moi");
    $sql_kt="select khoaphongbanid,name from khoaphongban  where tochuctructhuocid in (select tochuctructhuocid from tochuctructhuoc  where cosodaotaoid = ".$a[0].")";
    $arrshow['kh']= createcb("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$sql_kt, $a[2], "moi");
    $sql_kt=$sql_kt="select bomontoid,name from bomonto  where khoaphongbanid in (select khoaphongbanid from khoaphongban  where tochuctructhuocid in (select tochuctructhuocid from tochuctructhuoc  where cosodaotaoid = ".$a[0]."))";
    $arrshow['bm']= createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$sql_kt, $a[3], "moi");

  }
	if($a[1]!=0){ 
    $sql.= " AND tochuctructhuoc_id='".$a[1]."' ";
    $sql_kt="select khoaphongbanid,name from khoaphongban  where tochuctructhuocid = ".$a[1];
    $arrshow['kh']= createcb("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$sql_kt, $a[2], "moi");
    $sql_kt="select bomontoid,name from bomonto  where khoaphongbanid in (select khoaphongbanid from tochuctructhuoc  where tochuctructhuocid = ".$a[1].")";
    $arrshow['bm']= createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$sql_kt, $a[3], "moi");
  }
	if($a[2]!=0){ 
    $sql.= " AND khoaphongban_id='".$a[2]."' ";
    $sql_kt="select bomontoid,name from bomonto  where khoaphongbanid = ".$a[2];
    $arrshow['bm']= createcb("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$sql_kt, $a[3], "moi");
  }
	if($a[3]!=0){ $sql.= " AND bomonto_id='".$a[3]."' ";}
	$sql.=" ORDER BY hoten COLLATE utf8_vietnamese_ci";
  echo json_encode($arrshow);
 } ?>