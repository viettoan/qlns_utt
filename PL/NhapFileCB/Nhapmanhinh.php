<?php
  ob_start();
  session_start();
  include("../../config/config.php");
  $menu_active = "Lý lịch";
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
      <script src="../../js/jquery-1.11.1.min.js"></script>
  <script src="../../js/jquery.js"></script>
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
</style>
<script>
function keypress(str) {

	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("huyen").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_huyen.php?id="+str,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}
function keypress1(str) {
    

	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("huyenns").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_huyenns.php?id="+str,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}


function keypress2(str) {
    

	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("tochuctructhuoc").innerHTML = xmlhttp.responseText;
				document.getElementById("khoaphongban").innerHTML = "";
				document.getElementById("bomonto").innerHTML = "";

			
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_tochuctructhuoc.php?id="+str,true);


        xmlhttp.send();
     event.preventDefault();

 // });*/
}


 function keypress3(str) {
    

	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var check=xmlhttp.responseText;
				
                document.getElementById("khoaphongban").innerHTML = xmlhttp.responseText;
				document.getElementById("bomonto").innerHTML = "";
				if(check!="<option value=''>Chọn</option>"){
					$("#khoaphongban").attr("required","required");
/*					$("#bomonto").attr("selected","selected");
*/				}
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_khoaphongban.php?id="+str,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}

	
 function keypress4(str) {
    

	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var check=xmlhttp.responseText;
                document.getElementById("bomonto").innerHTML = xmlhttp.responseText;
					if(check != "<option value=''>Chọn</option>"){
				
					$("#bomonto").attr("required","required");
				}
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_bomonto.php?id="+str,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}

function keypress5(str) {
    

	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("bac_heso").innerHTML = xmlhttp.responseText;
				document.getElementById("heso").innerHTML =""; 
				var temp = $("#bac_heso").val();

	  	$("#mangach").val(temp);
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_bac_ngach1.php?id="+str,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}

function keypress6(str) {
    

	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("bac_heso").innerHTML = xmlhttp.responseText;
				document.getElementById("heso").innerHTML =""; 
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_bac1.php?id="+str,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}
function keypress7(str) {
    
             var mangach = $("#mangach").val();
	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("heso").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_heso1.php?id="+str+"&&mangach="+mangach,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}
function UploadFile() {
   var cmnd = document.getElementById("txtCMND").value;
   var check_image = document.getElementById("check").value;
   window.open("upload_image.php?cmnd="+cmnd+"&&check_image="+check_image, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=500,width=400,height=400");
}

function closeWin() {
    myWindow.close();   // Closes the new window
}


</script>
 
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
<?php
    	  // $_SESSION['admin_id']=$_SESSION['temp_id'];
   function getHuyenID($huyen){
	$sql = "SELECT districtid FROM `huyen` WHERE name = '$huyen'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) == 1){
		$array = mysql_fetch_assoc($result);
		return $array['districtid'];
	}
	//die("get districtid");
	// error occur
	return "";
}
function getHuyenID2($huyen, $tinh){
	$sql = "SELECT districtid FROM `huyen` WHERE name = '$huyen' and provinceid = '$tinh'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) == 1){
		$array = mysql_fetch_assoc($result);
		return $array['districtid'];
	}
	//die("get districtid");
	// error occur
	return "";
}

function getTinhID($tinh){
	$sql = "SELECT provinceid FROM `tinh` WHERE name = '$tinh'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) == 1){
		$array = mysql_fetch_assoc($result);
		return $array['provinceid'];
	}
	//die("get provinceid");
	return "";
}
function getCoSoDaoTaoID($cosodaotao){
	$sql = "SELECT cosodaotaoid FROM `cosodaotao` WHERE name = '$cosodaotao'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) == 1){
		$array = mysql_fetch_assoc($result);
		return $array['cosodaotaoid'];
	}
	//die("get provinceid");
	return "";
}
function getToChucTrucThuocID($cosodaotao, $tochuctructhuoc){
	$sql = "SELECT tochuctructhuocid FROM `tochuctructhuoc` WHERE name = '$tochuctructhuoc' and cosodaotaoid='$cosodaotao'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) == 1){
		$array = mysql_fetch_assoc($result);
		return $array['tochuctructhuocid'];
	}
	//die("get provinceid");
	return "";
}
function getKhoaPhongBanID($tochuctructhuoc, $khoaphongban){
	$sql = "SELECT khoaphongbanid FROM `khoaphongban` WHERE name = '$khoaphongban' and tochuctructhuocid='$tochuctructhuoc'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) == 1){
		$array = mysql_fetch_assoc($result);
		return $array['khoaphongbanid'];
	}
	//die("get provinceid");
	return "";
}
function getBoMonToID($khoaphongban, $bomonto){
	$sql = "SELECT bomontoid FROM `bomonto` WHERE name = '$bomonto' and khoaphongbanid='$khoaphongban'";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result) == 1){
		$array = mysql_fetch_assoc($result);
		return $array['bomontoid'];
	}
	//die("get provinceid");
	return "";
}
?>
<body>
  
          <?php
      include("../../header1.php");
	   $check_image=0;
	
      $cosodaotaoid=0;
	  if(isset($_SESSION['khuvuc']))
	  {
		  if($_SESSION['khuvuc']==1||$_SESSION['khuvuc']==2||$_SESSION['khuvuc']==3)
		    $cosodaotaoid=$_SESSION['khuvuc']; 
	  }
	   /*if($_SESSION['username_user']=="admin_vinhphuc"){
			  $query ="Select * from cosodaotao where name ='CƠ SỞ ĐÀO TẠO VĨNH PHÚC'";
			  $result = mysql_query($query);
			  $row = mysql_fetch_row($result);
			  $cosodaotaoid=$row[0];
		
             
		  }else if($_SESSION['username_user']=="admin_thainguyen"){
			  $query ="Select * from cosodaotao where name ='CƠ SỞ ĐÀO TẠO THÁI NGUYÊN'";
			  $result = mysql_query($query);
			  $row = mysql_fetch_row($result);
			  $cosodaotaoid=$row[0];
		 
		  }
		  else if($_SESSION['username_user']=="admin_hanoi"){
	
			  $query ="Select * from cosodaotao where name ='CƠ SỞ ĐÀO TẠO HÀ NỘI'";
			  $result = mysql_query($query);
			  $row = mysql_fetch_row($result);
			  $cosodaotaoid=$row[0];
		  }*/
		   $taikhoan_id=0;
		   $lylich_id=0;

	    
		 if(isset($_SESSION['lylich_id1']))
			{
				        $check_image=1;
						$lylich_id = $_SESSION['lylich_id1'];
						unset($_SESSION['admin_id']);
			}
				
		else{
			     $taikhoan_id = $_SESSION['admin_id'];

		}
		
		
	  if($taikhoan_id!=0   ){
		
	      $sql = "Select * from lylich where taikhoan_id='$taikhoan_id'";

			  $result_select = mysql_query($sql);
			  $row_select = mysql_fetch_array($result_select);
			  $_SESSION['lylich_id'] = $row_select[0];
			  $check_image=1;
		
			    $sohieucanbo= $row_select['sohieucanbo']; 
				$hoten=$row_select['hoten'];
				$_SESSION['hoten']=$row_select[5];
				$gioitinh=$row_select['gioitinh'];
				$tenkhac=$row_select['tengoikhac'];
				$ngaysinh=$row_select['ngaysinh'];
				$noisinh= $row_select['noisinh']; 
				$xa=$row_select['quequan_xa'];
				$huyen=$row_select['quequan_huyen'];
				$tinh=$row_select['quequan_tinh']; 
				$noiohiennay=$row_select['noiohiennay'];
				$dienthoai=$row_select['dienthoai'];
				$dantoc=$row_select['dantoc']; 
				$tongiao=$row_select['tongiao']; 
				$xuatthan=$row_select['xuatthan'];
				$nghetruoctd=$row_select['nghetruoctuyendung'];
				$ngaytd=$row_select['ngaytuyendung'];
				$ngayvaocq=$row_select['coquanhientai_ngayvao'];
				$ngaythamgiacm=$row_select['cachmang_ngayvao']; 
				$ngayvaodang =$row_select['dangcongsan_ngayvao'];
				$ngaychinhthuc=$row_select['dangcongsan_ngaychinhthuc']; 
				$ngaythamgiatc=$row_select['doantncs_ngayvao']; 
				$ngaynn=$row_select['ngaynhapngu'];
				$ngayxn=$row_select['ngayxuatngu']; 
				$quanham=$row_select['quanhamcaonhat_ten']; 
				$namquanham= $row_select['quanhamcaonhat_nam'];
				$lophocvan=$row_select['giaoducphothong']; 
				$giaoducphothong=$row_select['giaoducphothong'];
				$hocvi =$row_select['hochamcaonhat_ten'];
				$namhocham=$row_select['hochamcaonhat_nam'];
				$chuyennganh = $row_select['hochamcaonhat_chuyennganh']; 
				$caplyluan=$row_select['lyluanchinhtri'];
				$ngoaingu=$row_select['ngoaingu_ten']; 
				$ngoaingu_trinhdo= $row_select['ngoaingu_trinhdo'];
				$congtacchinh =$row_select['congtacdanglam']; 
				// $ngachcongchuc =$row_select['ngachcongchuc_ten'];
			 //    $mangach=$row_select['ngachcongchuc_maso'];
				// $bacluong=$row_select['ngachcongchuc_bacluong'];
				// $hesoluong=$row_select['ngachcongchuc_heso'];
				// $thangluong=$row_select['ngachcongchuc_thang']; 
				// $namluong=$row_select['ngachcongchuc_nam'];
				$danhhieu=$row_select['danhhieu_ten'];
				$namdanhhieu=$row_select['danhhieu_nam'];
				$sotruong=$row_select['sotruongcongtac'];
				$baohiemxahoi=$row_select['sosobaohiem']; 
				$suckhoe=$row_select['tinhtrangsuckhoe'];
				$chieucao=$row_select['chieucao'];
				$nang=$row_select['cannang'];
				$nhommau=$row_select['nhommau'];
				$cmnd=$row_select['cmnd']; 
				$cmnd1 = $row_select['cmnd']; 
				$thuongbinhloai=$row_select['thuongbinhloai']; 
				$doituong=$row_select['giadinhlietsy'];
				$chucvu=$row_select['chucvu'];
				$chucvungay =$row_select['chucvudate'];
				$luong=$row_select['luong'];
				$thunhapkhac=$row_select['thunhapkhac'];
				$huanchuong=$row_select['khenthuong'];
				$namhuanchuong=$row_select['namkhenthuong'];
				$kyluatcaonhat=$row_select['kyluatcaonhat']; 
				$namkyluatcaonhat=$row_select['namkyluatcaonhat'];
				$cosodaotao=$row_select['cosodaotao_id'];
			
				$tochuctructhuoc=$row_select['tochuctructhuoc_id'];
				$khoaphongban=$row_select['khoaphongban_id'];
				$bomonto=$row_select['bomonto_id'];
				$quanlynhanuoc=$row_select['quanlynhanuoc'];
				$phucapcv=$row_select['phucapchucvu'];
				$phucapkhac=$row_select['phucapkhac'];
				$ngaypctnng=$row_select['ngaypctnng'];
				$ngaypctn = $row['ngaypctn'];
				$ngaypcqs = $row['ngaypcqs'];
				$ngaypcgv = $row['ngaypcgv'];
				$hokhauthuongtru=$row_select['hokhauthuongtru'];
				$loaituyendung=$row_select['loaihopdongtuyendung'];
				$ngaytd=$row_select['ngayhopdonglamviec'];
				$loaihopdong=$row_select['loaihopdonglamviec'];
				$chucdanhkhoahoc=$row_select['chucdanhkhoahoc'];
				$tinhoc=$row_select['tinhoc_trinhdo'];
				// $vuotkhung=$row_select['vuotkhung'];
				$coquantd=$row_select['coquantuyendung'];
				$ngaycapCMND=$row_select['ngaycapcmt'];
				$noicapCMND=$row_select['noicapcmt'];
				$ngaythamgiatc=$row_select['ngaythamgiatc'];
				$noithamgiatc=$row_select['noithamgiatc'];
				$phucaptn=$row_select['phucaptrachnhiem'];
				$phucapqs=$row_select['phucapquansu'];
				$phucapgv=$row_select['phucapgiaovien'];
				$chungchiNVSP=$row_select['chungchiNVSP'];
	       $noiTN=$row_select['hochamcaonhat_noiTN'];
	
			
				
				$tinhns=$row_select['tinhns'];
				
				$huyenns = $row_select['huyenns'];
		
				$xans = $row_select['xans'];
				// $avartar =$row_select['avartar'];
         // $trangthailamviec=$row_select['trangthailamviec'];
	  }
	  else if($lylich_id!=0)
	  {
		  
		  $sql = "Select * from lylich where id='$lylich_id'";

			  $result_select = mysql_query($sql);
			  $row_select = mysql_fetch_array($result_select);
			  $_SESSION['lylich_id'] = $row_select[0];
			  
			    $sohieucanbo= $row_select['sohieucanbo']; 
				$hoten=$row_select['hoten'];
				$_SESSION['hoten']=$row_select[5];
				$gioitinh=$row_select['gioitinh'];
				$tenkhac=$row_select['tengoikhac'];
				$ngaysinh=$row_select['ngaysinh'];
				$noisinh= $row_select['noisinh']; 
				$xa=$row_select['quequan_xa'];
				$huyen=$row_select['quequan_huyen'];
				$tinh=$row_select['quequan_tinh']; 
				$noiohiennay=$row_select['noiohiennay'];
				$dienthoai=$row_select['dienthoai'];
				$dantoc=$row_select['dantoc']; 
				$tongiao=$row_select['tongiao']; 
				$xuatthan=$row_select['xuatthan'];
				$nghetruoctd=$row_select['nghetruoctuyendung'];
				$ngaytd=$row_select['ngaytuyendung'];
        $ngayhopdong =$row_select['ngaytuyendung'];
				$ngayvaocq=$row_select['coquanhientai_ngayvao'];
				$ngaythamgiacm=$row_select['cachmang_ngayvao']; 
				$ngayvaodang =$row_select['dangcongsan_ngayvao'];
				$ngaychinhthuc=$row_select['dangcongsan_ngaychinhthuc']; 
				$ngaythamgiatc=$row_select['doantncs_ngayvao']; 
				$ngaynn=$row_select['ngaynhapngu'];
				$ngayxn=$row_select['ngayxuatngu']; 
				$quanham=$row_select['quanhamcaonhat_ten']; 
				$namquanham= $row_select['quanhamcaonhat_nam'];
				$lophocvan=$row_select['giaoducphothong']; 
				$giaoducphothong=$row_select['giaoducphothong'];
				$hocvi =$row_select['hochamcaonhat_ten'];
				$namhocham=$row_select['hochamcaonhat_nam'];
				$chuyennganh = $row_select['hochamcaonhat_chuyennganh']; 
				$caplyluan=$row_select['lyluanchinhtri'];
				$ngoaingu=$row_select['ngoaingu_ten']; 
				$ngoaingu_trinhdo= $row_select['ngoaingu_trinhdo'];
				$congtacchinh =$row_select['congtacdanglam']; 
				// $ngachcongchuc =$row_select['ngachcongchuc_ten'];
			 //    $mangach=$row_select['ngachcongchuc_maso'];
				// $bacluong=$row_select['ngachcongchuc_bacluong'];
				// $hesoluong=$row_select['ngachcongchuc_heso'];
				// $thangluong=$row_select['ngachcongchuc_thang']; 
				// $namluong=$row_select['ngachcongchuc_nam']; 
				$danhhieu=$row_select['danhhieu_ten'];
				$namdanhhieu=$row_select['danhhieu_nam'];
				$sotruong=$row_select['sotruongcongtac'];
				$baohiemxahoi=$row_select['sosobaohiem']; 
				$suckhoe=$row_select['tinhtrangsuckhoe'];
				$chieucao=$row_select['chieucao'];
				$nang=$row_select['cannang'];
				$nhommau=$row_select['nhommau'];
				$cmnd=$row_select['cmnd']; 
				$cmnd1 = $row_select['cmnd']; 
				$thuongbinhloai=$row_select['thuongbinhloai']; 
				$doituong=$row_select['giadinhlietsy'];
				$chucvu=$row_select['chucvu'];
				$chucvungay =$row_select['chucvudate'];
				$luong=$row_select['luong'];
				$thunhapkhac=$row_select['thunhapkhac'];
				$huanchuong=$row_select['khenthuong'];
				$namhuanchuong=$row_select['namkhenthuong'];
				$kyluatcaonhat=$row_select['kyluatcaonhat']; 
				$namkyluatcaonhat=$row_select['namkyluatcaonhat'];
				$cosodaotao=$row_select['cosodaotao_id'];
			
				$tochuctructhuoc=$row_select['tochuctructhuoc_id'];
				$khoaphongban=$row_select['khoaphongban_id'];
				$bomonto=$row_select['bomonto_id'];
				$quanlynhanuoc=$row_select['quanlynhanuoc'];
				$phucapcv=$row_select['phucapchucvu'];
				$phucapkhac=$row_select['phucapkhac'];
				$ngaypctnng=$row_select['ngaypctnng'];
				$ngaypctn = $row_select['ngaypctn'];
				$ngaypcqs = $row_select['ngaypcqs'];
				$ngaypcgv = $row_select['ngaypcgv'];
				$hokhauthuongtru=$row_select['hokhauthuongtru'];
				$loaituyendung=$row_select['loaihopdongtuyendung'];
				$ngaytd=$row_select['ngayhopdonglamviec'];
				$loaihopdong=$row_select['loaihopdonglamviec'];
				$chucdanhkhoahoc=$row_select['chucdanhkhoahoc'];
				$tinhoc=$row_select['tinhoc_trinhdo'];
				// $vuotkhung=$row_select['vuotkhung'];
				$coquantd=$row_select['coquantuyendung'];
				$ngaycapCMND=$row_select['ngaycapcmt'];
				$noicapCMND=$row_select['noicapcmt'];
				$ngaythamgiatc=$row_select['ngaythamgiatc'];
				$noithamgiatc=$row_select['noithamgiatc'];
				$phucaptn=$row_select['phucaptrachnhiem'];
				$phucapqs=$row_select['phucapquansu'];
				$phucapgv=$row_select['phucapgiaovien'];
				$chungchiNVSP=$row_select['chungchiNVSP'];
	            $noiTN=$row_select['hochamcaonhat_noiTN'];
	
			
				
				$tinhns=$row_select['tinhns'];
				
				$huyenns = $row_select['huyenns'];
		
				$xans = $row_select['xans'];
				// $avartar =$row_select['avartar'];
				$trangthailamviec = $row_select['trangthailamviec'];
	  }
	  else
	  {
		        $_SESSION['lylich_id']="";
		        $sohieucanbo="";
		  	    $hoten="";
				$gioitinh="";
				$tenkhac="";
				$ngaysinh="";
				$noisinh= ""; 
				$xa="";
				$huyen="";
				$tinh=""; 
				$noiohiennay="";
				$dienthoai="";
				$dantoc="";
				$tongiao=""; 
				$xuatthan="";
				$nghetruoctd="";
				$ngaytd="";
				$ngayvaocq="";
				$ngaythamgiacm=""; 
				$ngayvaodang ="";
				$ngaychinhthuc="";
				$ngaythamgiatc=""; 
				$ngaynn="";
				$ngayxn=""; 
				$quanham="";
				$namquanham= "";
				$lophocvan=""; 
				$giaoducphothong="";
				$namhocham="";
				$chuyennganh = ""; 
				$caplyluan="";
				$ngoaingu=""; 
				$congtacchinh ="";
				// $ngachcongchuc ="";
			 //    $mangach="";
				// $bacluong="";
				// $hesoluong="";
				// $thangluong=""; 
				// $namluong="";
				$danhhieu="";
				$namdanhhieu="";
				$sotruong="";
				$baohiemxahoi=""; 
				$suckhoe="";
				$chieucao="";
				$nang="";
				$nhommau="";
				$cmnd=""; 
				$thuongbinhloai=""; 
				$doituong="";
				$chucvu="";
				$chucvungay ="";
				$luong="";
				$thunhapkhac="";
				$huanchuong="";
				$namhuanchuong="";
				$kyluatcaonhat=""; 
				$namkyluatcaonhat="";
				$cosodaotao="";
				$tochuctructhuoc="";
				$khoaphongban="";
				$bomonto="";
				$quanlynhanuoc="";
				$phucapcv="";
				$phucapkhac="";
				$ngaypctnng="";
				$ngaypcqs = "";
				$ngaypcgv = "";
				$ngaypctn = "";
				$hokhauthuongtru="";
				$loaituyendung="";
				$ngaytd="";
				$loaihopdong="";
				$chucdanhkhoahoc="";
				$tinhoc="";;
				// $vuotkhung="";
				$coquantd="";
				$ngaycapCMND="";
				$noicapCMND="";
				$ngaythamgiatc="";
				$noithamgiatc="";
				$phucaptn="";
				$phucapqs="";
				$phucapgv="";
				$chungchiNVSP="";
	            $ngoaingu_trinhdo="";
				$chucdanhkhoahoc="";
				$ngayhopdong ="";
				$noiTN = "";
				$tinhns="";
				$huyenns = "";
				$xans = "";
				$hocvi="";
				//$avartar ="";
	  }
	  if(isset($_POST['btnLuu'])){
		//  if(isset($_SESSION['temp_id']))
		    
		  $sohieucanbo = isset($_POST['sohieucanbo'])?$_POST['sohieucanbo']:'';
		  $hoten = isset($_POST['txtHoTen'])?$_POST['txtHoTen']:'';
		  $ngaysinh = isset($_POST['txtNgaySinh'])?$_POST['txtNgaySinh']:'';
		  $gioitinh = isset($_POST['GioiTinh'])?$_POST['GioiTinh']:'';
		  $tenkhac = isset($_POST['tenkhac'])?$_POST['tenkhac']:'';
		  $nghetruoctd = isset($_POST['nghetruoctd'])?$_POST['nghetruoctd']:'';
		  $hoten = isset($_POST['txtHoTen'])?$_POST['txtHoTen']:'';
		  $ngaysinh = isset($_POST['txtNgaySinh'])?$_POST['txtNgaySinh']:'';
		  $gioitinh = isset($_POST['GioiTinh'])?$_POST['GioiTinh']:'';
		  $tenkhac = isset($_POST['tenkhac'])?$_POST['tenkhac']:'';
		  $dienthoai = isset($_POST['dienthoai'])?$_POST['dienthoai']:'';
		  $ngoaingu_trinhdo= isset($_POST['trinhdo'])?$_POST['trinhdo']:'';
		   $chucvu = isset($_POST['chucvu'])?$_POST['chucvu']:'';
		  $chucvungay = isset($_POST['chucvungay'])?$_POST['chucvungay']:'';
		  $phucapcv = isset($_POST['phucapcv'])?$_POST['phucapcv']:'';
		  $phucaptn = isset($_POST['phucaptn'])?$_POST['phucaptn']:'';
		  $phucapqs = isset($_POST['phucapqs'])?$_POST['phucapqs']:'';
		  $phucapgv = isset($_POST['phucapgv'])?$_POST['phucapgv']:'';
		  $phucapkhac = isset($_POST['phucapkhac'])?$_POST['phucapkhac']:'';
		  $ngaypctnng = isset($_POST['ngaypctnng'])?$_POST['ngaypctnng']:'';
		  $ngaypcqs = isset($_POST['ngaypcqs'])?$_POST['ngaypcqs']:'';
		  $ngaypcgv = isset($_POST['ngaypcgv'])?$_POST['ngaypcgv']:'';
		  $ngaypctn = isset($_POST['ngaypctn'])?$_POST['ngaypctn']:'';
		  $dantoc = isset($_POST['DropDantoc'])?$_POST['DropDantoc']:'';

		  $tongiao = isset($_POST['DropTonGiao'])?$_POST['DropTonGiao']:'';
		  $cmnd = isset($_POST['txtCMND'])?$_POST['txtCMND']:'';
		  
		  $ngaycapCMND = isset($_POST['txtNgayCapCMND'])?$_POST['txtNgayCapCMND']:'';
		  $noicapCMND = isset($_POST['txtNoiCapCMND'])?$_POST['txtNoiCapCMND']:'';
		  $xuatthan = isset($_POST['DropXuatThan1'])?$_POST['DropXuatThan1']:'';
		  $nhommau = isset($_POST['dropNhomMau'])?$_POST['dropNhomMau']:'';
		  $suckhoe = isset($_POST['tbTinhTrangSK'])?$_POST['tbTinhTrangSK']:'';
		  $chieucao = isset($_POST['tbCao'])?$_POST['tbCao']:'';
		  $nang = isset($_POST['tbNang'])?$_POST['tbNang']:'';
		  $ngayvaocq = isset($_POST['ngayvaocq'])?$_POST['ngayvaocq']:'';
		  $ngaythamgiacm = isset($_POST['ngaythamgiacm'])?$_POST['ngaythamgiacm']:'';
		  $ngayvaodang = isset($_POST['ngayvaodang'])?$_POST['ngayvaodang']:'';
		  $ngaychinhthuc = isset($_POST['ngaychinhthuc'])?$_POST['ngaychinhthuc']:'';
		  
		  $ngaythamgiatc = isset($_POST['ngaythamgiatc'])?$_POST['ngaythamgiatc']:'';
		  $noithamgiatc = isset($_POST['noithamgiatc'])?$_POST['noithamgiatc']:'';
		  
		 //H?p d?ng lao d?ng
		   $ngayhopdong = isset($_POST['ngayhopdong'])?$_POST['ngayhopdong']:'';
		  $loaituyendung = isset($_POST['loaituyendung'])?$_POST['loaituyendung']:'';
		  $ngaytd = isset($_POST['ngaytd'])?$_POST['ngaytd']:'';
		  $loaihopdong = isset($_POST['loaihopdong'])?$_POST['loaihopdong']:'';
		  $coquantd = isset($_POST['coquantd'])?$_POST['coquantd']:'';
		  
		  //Nghia v? quân s?
		  
		  $ngaynn = isset($_POST['ngaynn'])?$_POST['ngaynn']:'';
		  $ngayxn = isset($_POST['ngayxn'])?$_POST['ngayxn']:'';
		  $quanham = isset($_POST['quanham'])?$_POST['quanham']:'';
		  $ngayvaodang = isset($_POST['ngayvaodang'])?$_POST['ngayvaodang']:'';
		  $namquanham = isset($_POST['namquanham'])?$_POST['namquanham']:'';
		  
		  //Dịch vụ cấp
		  if($cosodaotaoid==0)
		     $cosodaotao = isset($_POST['cosodaotao'])?$_POST['cosodaotao']:'';
		  else
		     $cosodaotao = $cosodaotaoid;
		
		  $tochuctructhuoc = isset($_POST['tochuctructhuoc'])?$_POST['tochuctructhuoc']:'';
		  $khoaphongban = isset($_POST['khoaphongban'])?$_POST['khoaphongban']:'';
		  $bomonto = isset($_POST['bomonto'])?$_POST['bomonto']:'';
		  
		  //Trình d? h?c v?n 
		  $lophocvan = isset($_POST['lophocvan'])?$_POST['lophocvan']:'';
		  $hocvi = isset($_POST['hocvi'])?$_POST['hocvi']:'';
		  $namhocvi = isset($_POST['namhocvi'])?$_POST['namhocvi']:'';
		  $danhhieu = isset($_POST['danhhieu'])?$_POST['danhhieu']:'';
		  $namdanhhieu = isset($_POST['namdanhhieu'])?$_POST['namdanhhieu']:'';
		  $chuyennganh = isset($_POST['chuyennganh'])?$_POST['chuyennganh']:'';
		  $noiTN = isset($_POST['noiTN'])?$_POST['noiTN']:'';
		  $caplyluan = isset($_POST['caplyluan'])?$_POST['caplyluan']:'';
		  $quanlynhanuoc = isset($_POST['quanlynhanuoc'])?$_POST['quanlynhanuoc']:'';
		  $chucdanhkhoahoc = isset($_POST['chucdanhkhoahoc'])?$_POST['chucdanhkhoahoc']:'';
		  $ngoaingu = isset($_POST['ngoaingu'])?$_POST['ngoaingu']:'';
		  $chungchiNVSP = isset($_POST['chungchiNVSP'])?$_POST['chungchiNVSP']:'';
		  $tinhoc = isset($_POST['tinhoc'])?$_POST['tinhoc']:'';
		  
		  //Quê quán 
		   $tinh = isset($_POST['tinh'])?$_POST['tinh']:'';
		  $huyen = isset($_POST['huyen'])?$_POST['huyen']:'';
		  $xa = isset($_POST['txtPXQueQuan'])?$_POST['txtPXQueQuan']:'';
		  
		  //Noi sinh
		     $tinhns=isset($_POST['tinhns'])?$_POST['tinhns']:'';
			 $huyenns = isset($_POST['huyenns'])?$_POST['huyenns']:'';
			 $xans = isset($_POST['xans'])?$_POST['xans']:'';
			 $query = "Select tinh.provinceid,huyen.provinceid,tinh.name,huyen.name from  tinh inner join huyen on tinh.provinceid=huyen.provinceid where tinh.provinceid='$tinhns' and districtid='$huyenns'";
			 $result = mysql_query($query);
			 $row = mysql_fetch_row($result);
			 $noisinh = $xans."-".$row[3]."-".$row[2];

		  
		  //Thu?ng trú
		   $hokhauthuongtru = isset($_POST['hokhauthuongtru'])?$_POST['hokhauthuongtru']:'';

		  //Noi ? hi?n nay
		  $noiohiennay = isset($_POST['noiohiennay'])?$_POST['noiohiennay']:'';
		  
		  //Khen thu?ng k? lu?t
		  $huanchuong = isset($_POST['huanchuong'])?$_POST['huanchuong']:'';
		  $namhuanchuong = isset($_POST['namhuanchuong'])?$_POST['namhuanchuong']:'';
		  $kyluatcaonhat = isset($_POST['kyluatcaonhat'])?$_POST['kyluatcaonhat']:'';
		  $namkyluatcaonhat = isset($_POST['namkyluatcaonhat'])?$_POST['namkyluatcaonhat']:'';
		  
		  //Ng?ch công ch?c viên ch?c
		  //  $ngachcongchuc = isset($_POST['ngach'])?$_POST['ngach']:'';
		  // $mangach = isset($_POST['mangach'])?$_POST['mangach']:'';
		  // $bacluong = isset($_POST['bac_heso'])?$_POST['bac_heso']:'';
		  // $hesoluong = isset($_POST['heso'])?$_POST['heso']:'';
		  //  $thangluong = isset($_POST['thangluong'])?$_POST['thangluong']:'';
		  //  $namluong =  isset($_POST['namluong'])?$_POST['namluong']:'';
		  // $vuotkhung = isset($_POST['vuotkhung'])?$_POST['vuotkhung']:'';
		  
		  //Thông tin chính sách , b?o hi?m
		  $doituong = isset($_POST['DropDoiTuong'])?$_POST['DropDoiTuong']:'';
		  $baohiemxahoi = isset($_POST['txtBHXH'])?$_POST['txtBHXH']:'';
		  $sotruong = isset($_POST['sotruong'])?$_POST['sotruong']:'';
		  $thuongbinhloai = isset($_POST['thuongbinhloai'])?$_POST['thuongbinhloai']:'';
		  $congtacchinh = isset($_POST['congtacchinh'])?$_POST['congtacchinh']:'';
		  
		  
		  //Thu nh?p
		   $luong = isset($_POST['luong'])?$_POST['luong']:'';
		  $nguonkhac = isset($_POST['nguonkhac'])?$_POST['nguonkhac']:'';
		  $check_select=0;
		  $temp_update="";
		  if($taikhoan_id!=0){
		  $check = "Select taikhoan_id from lylich where taikhoan_id = '$taikhoan_id'";
		  $result_check = mysql_query($check);
		  $row_check = mysql_fetch_row($result_check);
		  $check_select = $row_check[0];
		  $temp_update = "where taikhoan_id='$taikhoan_id'";
		  }
	
		  else if($lylich_id!=0){
		     $check_select=1;
			 $temp_update="where id='$lylich_id'";
	      }
		  if(isset($cmnd1))
		      $temp = " and cmnd !='$cmnd1'";
		  else
		     $temp ='';
	      if($check_select==0)
		     $check_cmnd = "Select taikhoan_id from lylich where cmnd = '$cmnd' ";
		  else{
		    $check_cmnd = "Select taikhoan_id from lylich where cmnd = '$cmnd' $temp  ";
			$check_image=1;
		  }
		  $result_check = mysql_query($check_cmnd);
		  $number = mysql_num_rows($result_check);
		  if($number==0){
		  if($check_select==0) {
		  
						$sql = "INSERT INTO `lylich`(`id`, `botinh`, `kyluatcaonhat`, `namkyluatcaonhat`, `sohieucanbo`, `hoten`, `gioitinh`, `tengoikhac`, `capuyhientai`, `capuykiem`, `ngaysinh`, `noisinh`, `quequan_xa`, `quequan_huyen`, `quequan_tinh`, `noiohiennay`, `dienthoai`, `dantoc`, `tongiao`, `xuatthan`, `nghetruoctuyendung`, `ngaytuyendung`, `coquanhientai_ngayvao`, `cachmang_ngayvao`, `dangcongsan_ngayvao`, `dangcongsan_ngaychinhthuc`, `doantncs_ngayvao`, `congdoan_ngayvao`, `ngaynhapngu`, `ngayxuatngu`, `quanhamcaonhat_ten`, `quanhamcaonhat_nam`, `giaoducphothong`, `hochamcaonhat_ten`, `hochamcaonhat_nam`, `hochamcaonhat_chuyennganh`, `lyluanchinhtri`, `ngoaingu_ten`, `ngoaingu_trinhdo`, `congtacdanglam`, `ngachcongchuc_ten`, `ngachcongchuc_maso`, `ngachcongchuc_bacluong`, `ngachcongchuc_heso`, `ngachcongchuc_thang`, `ngachcongchuc_nam`, `danhhieu_ten`, `danhhieu_nam`, `sotruongcongtac`, `sosobaohiem`, `tinhtrangsuckhoe`, `chieucao`, `cannang`, `nhommau`, `cmnd`, `thuongbinhloai`, `giadinhlietsy`, `chucvu`, `chucvudate`, `luong`, `thunhapkhac`, `khenthuong`, `namkhenthuong`, `cosodaotao_id`, `tochuctructhuoc_id`, `khoaphongban_id`, `bomonto_id`, `quanlynhanuoc`, `phucapchucvu`, `phucapkhac`, `ngaypctnng`, `ngaypcqs`, `ngaypctn`, `ngaypcgv`, `hokhauthuongtru`, `loaihopdongtuyendung`, `ngayhopdonglamviec`, `loaihopdonglamviec`, `chucdanhkhoahoc`, `tinhoc_trinhdo`, `vuotkhung`, `coquantuyendung`, `ngaycapcmt`, `noicapcmt`, `ngaythamgiatc`, `noithamgiatc`, `phucaptrachnhiem`, `phucapquansu`, `phucapgiaovien`, `chungchiNVSP`, `hochamcaonhat_noiTN`, `taikhoan_id`,  `trangthai`,`tinhns`,`huyenns`,`xans`)
				VALUES (NULL, 
				NULL,'$kyluatcaonhat','$namkyluatcaonhat', '$sohieucanbo', 
				'$hoten', '$gioitinh', '$tenkhac', '', '', 
				'$ngaysinh', '$noisinh', '$xa', '$huyen', '$tinh', 
				'$noiohiennay', '$dienthoai', 
				'$dantoc', '$tongiao',
				'$xuatthan', '$nghetruoctd', '$ngayhopdong', '$ngayvaocq', 
				'$ngaythamgiacm', '$ngayvaodang', '$ngaychinhthuc', 
				'$ngaythamgiatc', '$ngoaingu_trinhdo', '$ngaynn', '$ngayxn', 
				'$quanham', '$namquanham', '$lophocvan', 
				'$hocvi', '$namhocvi', '$chuyennganh', 
				'$caplyluan', '$ngoaingu','$ngoaingu_trinhdo', '$congtacchinh', 
				'', '', '', '', 
				'', '', 
				'$danhhieu', '$namdanhhieu', '$sotruong', '$baohiemxahoi', 
				'$suckhoe', '$chieucao', '$nang', '$nhommau', '$cmnd',
				'$thuongbinhloai', '$doituong','$chucvu',
				'$chucvungay',
				'$luong', '$nguonkhac','$huanchuong', '$namhuanchuong',
				'$cosodaotao','$tochuctructhuoc','$khoaphongban','$bomonto',
				'$quanlynhanuoc','$phucapcv','$phucapkhac', '$ngaypctnng', '$ngaypcqs', '$ngaypctn', '$ngaypcgv', '$hokhauthuongtru','$loaituyendung','$ngaytd',
				'$loaihopdong','$chucdanhkhoahoc','$tinhoc','','$coquantd','$ngaycapCMND','$noicapCMND','$ngaythamgiatc',
				'$noithamgiatc','$phucaptn','$phucapqs','$phucapgv','$chungchiNVSP','$noiTN','$_SESSION[admin_id]','0','$tinhns','$huyenns','$xans')";
		  }else
		  {
			
			  
			  $sql = "Update `lylich`  set  
				`sohieucanbo`='$sohieucanbo', 
				`hoten`='$hoten', `gioitinh`='$gioitinh', `tengoikhac`='$tenkhac',
				`ngaysinh`='$ngaysinh', `noisinh`= '$noisinh', `quequan_xa`='$xa', `quequan_huyen`='$huyen', `quequan_tinh`='$tinh', 
				`noiohiennay`='$noiohiennay', `dienthoai`='$dienthoai', 
				`dantoc`='$dantoc', `tongiao`='$tongiao', 
				`xuatthan`='$xuatthan', `nghetruoctuyendung`='$nghetruoctd', `coquanhientai_ngayvao`='$ngayvaocq',
				`cachmang_ngayvao`='$ngaythamgiacm', `dangcongsan_ngayvao`='$ngayvaodang', `dangcongsan_ngaychinhthuc`='$ngaychinhthuc', 
				`doantncs_ngayvao`='$ngaythamgiatc', `congdoan_ngayvao`='noithamgiatc', `ngaynhapngu`='$ngaynn', `ngayxuatngu`='$ngayxn', 
				`quanhamcaonhat_ten`='$quanham', `quanhamcaonhat_nam`= '$namquanham', `giaoducphothong`='$lophocvan', 
				`hochamcaonhat_ten`='$hocvi', `hochamcaonhat_nam`='$namhocvi', `hochamcaonhat_chuyennganh`='$chuyennganh', 
				`lyluanchinhtri`='$caplyluan', `ngoaingu_ten`='$ngoaingu',ngoaingu_trinhdo='$ngoaingu_trinhdo', `congtacdanglam`='$congtacchinh', 
				`ngachcongchuc_ten`='', `ngachcongchuc_maso`='', `ngachcongchuc_bacluong`='', `ngachcongchuc_heso`='', 
				`ngachcongchuc_thang`='',`ngachcongchuc_nam`='',
				`danhhieu_ten`='$danhhieu', `danhhieu_nam`='$namdanhhieu', `sotruongcongtac`='$sotruong', `sosobaohiem`='$baohiemxahoi', 
				`tinhtrangsuckhoe`='$suckhoe', `chieucao`='$chieucao', `cannang`='$nang', `nhommau`='$nhommau', `cmnd`='$cmnd', 
				`thuongbinhloai`='$thuongbinhloai', `giadinhlietsy`='$doituong',`chucvu`='$chucvu',
				`chucvudate`='$chucvungay',
				`luong`='$luong', `thunhapkhac`='$nguonkhac',`khenthuong`='$huanchuong', `namkhenthuong`='$namhuanchuong',`kyluatcaonhat`='$kyluatcaonhat', `namkyluatcaonhat`='$namkyluatcaonhat',
				`cosodaotao_id`='$cosodaotao',`tochuctructhuoc_id`='$tochuctructhuoc',`khoaphongban_id`='$khoaphongban',`bomonto_id`='$bomonto',
				`quanlynhanuoc`='$quanlynhanuoc',`phucapchucvu`='$phucapcv',`phucapkhac`='$phucapkhac', `ngaypctnng` = '$ngaypctnng', `ngaypctn` = '$ngaypctn', `ngaypcqs` = '$ngaypcqs', `ngaypcgv` = '$ngaypcgv',`hokhauthuongtru`='$hokhauthuongtru',`loaihopdongtuyendung`='$loaituyendung',`ngayhopdonglamviec`='$ngaytd',
				`loaihopdonglamviec`='$loaihopdong',`chucdanhkhoahoc`='$chucdanhkhoahoc',`tinhoc_trinhdo`='$tinhoc',`vuotkhung`='',`coquantuyendung`='$coquantd',`ngaycapcmt`='$ngaycapCMND',`noiCapcmt`='$noicapCMND',`ngaythamgiatc`='$ngaythamgiatc',
				`noithamgiatc`='$noithamgiatc',`phucaptrachnhiem`='$phucaptn',`phucapquansu`='$phucapqs',`phucapgiaovien`='$phucapgv',`chungchiNVSP`='$chungchiNVSP',`chucvudate`='$chucvungay',`tinhns`='$tinhns',`huyenns`='$huyenns',
				`xans`='$xans' , trangthai='0'  $temp_update ";
				
			
		  }

	 $result = mysql_query( $sql);
	 if($result){
	   echo "<script>alert('Cập nhật thành công !');</script>";
	   $_SESSION['hoten']=$hoten;
       $last_id = mysql_insert_id();
	   if($last_id>0 ){
	      $_SESSION['lylich_id1']= $last_id;
		   unset($_SESSION['admin_id']);
		   $_SESSION['lylich_id']=$_SESSION['lylich_id1'];
	   }
	   
	 }
	 else
	     echo "<script>alert('Cập nhật không thành công !');</script>";
	   
	    }else{
			  
			echo "<script>alert('Trùng số chứng minh nhân dân')</script>";  
		  }
	  
	  }
		 
      ?>
    <form method="post" action="#tinh" >
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
          <script type="text/javascript">
//          $(document).ready(function(){ // ajax
//            $("#s_box > select").change(function(){
//              var fin;
//              fin=$("#cosodaotao").val();
//              fin=fin+'_'+$("#tochuctructhuoc").val();
//              fin=fin+'_'+$("#khoaphongban").val();
//              fin=fin+'_'+$("#bomonto").val();
//              $.ajax({
//                method:'post',
//                dataType:"json",
//                data:{thu:fin},
//                url:'../ajax/fincb.php',
//                success:function(data){
//                  if(data){
//                    $("#findcb").html(data.da);
//                    if(data.tc){$("#tochuctructhuoc").html(data.tc);}
//                    if(data.kh){$("#khoaphongban").html(data.kh);}
//                    if(data.bm){$("#bomonto").html(data.bm);}
//                  }
//                }
//              });
//              console.log(fin);
//            });
//          });
         </script>
                  <div id="s_box" style="margin-bottom:12px;width: 80%;
float: right">
            <?php 
          function createcb($table,$col1,$col2,$cmt,$selected=0){ // hàm tạo select
            $sql1="select $col1,$col2 from $table";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select required name="'.$table.'" id="'.$table.'" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px; margin-right: 10px">
                    <option value="">'.$cmt.'</option>';
            foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
            }
            echo '</select>';
          }
		   function createcb8($table,$col1,$col2,$cmt,$selected=0,$ten,$dk){ // hàm tạo select
            $sql1="select $col1,$col2 from $table where $ten='$dk'";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select required name="'.$table.'" id="'.$table.'" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px;">
                    <option value="">'.$cmt.'</option>';
		     $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
		  $result_check = mysql_query($check);
		  $row_check = mysql_fetch_row($result_check);
		  $check_select = $row_check[0];
			if($check_select!=0){
					foreach ($ar as $k => $v) {
					  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
					}
			}
            echo '</select>';
          }
		     function createcb11($table,$col1,$col2,$cmt,$selected=0,$chon){ // hàm tạo select
            $sql1="select $col1,$col2 from $table where provinceid='$chon'";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select required name="'.$table.'" id="'.$table.'" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px;">
                    <option value="">'.$cmt.'</option>';
			   if(isset($_SESSION['admin_id']))
						  {
									 $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
					  $result_check = mysql_query($check);
					  $row_check = mysql_fetch_row($result_check);
					  $check_select = $row_check[0];  
						  }
						  else if($_SESSION['lylich_id1'])
						      $check_select=1;
			if($check_select!=0){
					foreach ($ar as $k => $v) {
					  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
					}
			}
            echo '</select>';
          }
		  
		      function createcb2($table,$col1,$col2,$cmt,$selected=0){ // hàm tạo select
            $sql1="select $col1,$col2 from $table";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select required name="'.$table.'ns" id="'.$table.'ns" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px;">
                    <option value="">'.$cmt.'</option>';
			
				
	
				foreach ($ar as $k => $v) {
				  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
				}
				echo '</select>';
				
				
          }
		     function createcb9($table,$col1,$col2,$cmt,$selected=0,$chon){ // hàm tạo select
            $sql1="select $col1,$col2 from $table where provinceid='$chon'";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select required name="'.$table.'ns" id="'.$table.'ns" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px;">
                    <option value="">'.$cmt.'</option>';
				  if(isset($_SESSION['admin_id']))
						  {
									 $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
					  $result_check = mysql_query($check);
					  $row_check = mysql_fetch_row($result_check);
					  $check_select = $row_check[0];  
						  }
						  else if($_SESSION['lylich_id1'])
						      $check_select=1;
			if($check_select!=0){
				foreach ($ar as $k => $v) {
				  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
				}
			
				}
					echo '</select>';
          }
		 
		       function createcb1($table,$col1,$col2,$cmt,$selected=0){ // hàm tạo select
            $sql1="select $col1,$col2 from $table ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select required name="'.$table.'" id="'.$table.'" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px;">
                    <option value="">'.$cmt.'</option>';
            foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
            }
            echo '</select>';
          }
		    function createcb3($table,$col1,$col2,$cmt,$selected=0,$ten,$dk){ // hàm tạo select
            $sql1="select $col1,$col2 from $table where $ten = '$dk'";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select name="'.$table.'" id='.$table.' style="border: 1px solid #ccc;padding: 6px 12px;width: 200px;">';
                    echo'<option value="01">MỜI CHỌN TỔ CHỨC TRỰC THUỘC</option>';
		
			   foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
            }
            echo '</select>';
          }
		      function createcb10($table,$col1,$col2,$cmt,$selected=0,$ten,$dk){ // hàm tạo select
            $sql1="select $col1,$col2 from $table inner join ngach on $table.ngachid=ngach.id  where $ten = '$dk'";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select required  name="'.$table.'" id='.$table.' >';
                    echo'<option value="">chọn</option>';
		
			   foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
            }
            echo '</select>';
          }
		    function createcb4($table,$col1,$cmt,$selected=0){ // hàm tạo select
            $sql1="select $col1 from $table ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select required  name="'.$table.'" id='.$table.' style="width:120px;margin-left:5px;">';
                    echo'<option value="">chọn</option>';
            foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
            }
            echo '</select>';
          }
		        function createcb5($table,$col1,$col2,$cmt,$selected=0,$keypress){ // hàm tạo select
            $sql1="select $col1,$col2 from $table  ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col2]]=$row[$col1];
            }
            echo '<select $keypress  required name="mangach" id="mangach" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px; margin-right: 10px">';
                    echo'<option value="">chọn</option>';
           		/*  $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
		  $result_check = mysql_query($check);
		  $row_check = mysql_fetch_row($result_check);
		  $check_select = $row_check[0];
			if($check_select!=0){*/
				foreach ($ar as $k => $v) {
				  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
				}
				
		/*	}*/
			echo '</select>';
          }
	
		        function createcb6($table,$col1,$cmt,$selected=0,$ten,$dk,$ten1,$dk1){ // hàm tạo select
            $sql1="select $col1 from $table inner join ngach on ngach.id=$table.ngachid where $ten='$dk' and $ten1='$dk1' ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select required   name="heso" id="heso" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px; margin-right: 10px">';
                    echo'<option value="">chọn</option>';
					   if(isset($_SESSION['admin_id']))
						  {
									 $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
					  $result_check = mysql_query($check);
					  $row_check = mysql_fetch_row($result_check);
					  $check_select = $row_check[0];  
						  }
						  else if($_SESSION['lylich_id1'])
						      $check_select=1;
			if($check_select!=0){
				foreach ($ar as $k => $v) {
				  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
				}
				
				}
				echo '</select>';
          }
		  
		   function createcb15($table,$col1,$col2,$cmt,$selected=0,$ten,$dk){ // hàm tạo select
            $sql1="select $col1,$col2 from $table where $ten='$dk'";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select name="'.$table.'" id="'.$table.'" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px; margin-right:10px">
                    <option value="">'.$cmt.'</option>';
			
				   if(isset($_SESSION['admin_id']))
						  {
									 $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
					  $result_check = mysql_query($check);
					  $row_check = mysql_fetch_row($result_check);
					  $check_select = $row_check[0];  
						  }
						  else if($_SESSION['lylich_id1'])
						      $check_select=1;
					if($check_select!=0){
						foreach ($ar as $k => $v) {
						  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
						}
					}
				
			 
			 echo '</select>';
          }
		  
		    function createcb16($table,$col1,$col2,$cmt,$selected=0,$ten,$dk){ // hàm tạo select
            $sql1="select $col1,$col2 from $table where $ten='$dk'";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
            }
            echo '<select name="'.$table.'" id="'.$table.'" style="border: 1px solid #ccc;padding: 6px 12px;width: 200px; margin-right:10px">
                    <option value="">'.$cmt.'</option>';
					     
					      if(isset($_SESSION['admin_id']))
						  {
								  $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
								  $result_check = mysql_query($check);
								  $row_check = mysql_fetch_row($result_check);
								  $check_select = $row_check[0];  
						  }
						  else if($_SESSION['lylich_id1'])
						      $check_select=1;
						 /*     $temp = $_SESSION['temp_id'];
					      echo  $temp;*/
						  //
				
						if($check_select!=0){
								foreach ($ar as $k => $v) {
								  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
								}
						}
					
            echo '</select>';
          }
		  
		  
          if($cosodaotaoid=="2" && $_SESSION['role']==3 ){
		
			  echo "<input name='cosodaotao' id='cosodaotao' value='CƠ SỞ ĐÀO TẠO VĨNH PHÚC' style='width:18%;border: 1px solid #ccc;padding: 6px 12px;width: 200px; margin-right:10px'  />";
			  createcb3("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC",$tochuctructhuoc,'cosodaotaoid',$cosodaotaoid);
			  createcb15("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$khoaphongban,'tochuctructhuocid',$tochuctructhuoc);
			  createcb15("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$bomonto,'khoaphongbanid',$khoaphongban);
             
		  }else if($cosodaotaoid=="3"&& $_SESSION['role']==3){
			
		       echo "<input name='cosodaotao' id='cosodaotao' value='CƠ SỞ ĐÀO TẠO THÁI NGUYÊN' style='width:18%;border: 1px solid #ccc;padding: 6px 12px;width: 200px; margin-right:10px'  />";
			  createcb3("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC",$tochuctructhuoc,'cosodaotaoid',$cosodaotaoid);
			   createcb15("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$khoaphongban,'tochuctructhuocid',$tochuctructhuoc);
			 createcb15("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$bomonto,'khoaphongbanid',$khoaphongban);
		  }
		  else if($cosodaotaoid=="1" && $_SESSION['role']==3){
	
		
		      echo "<input name='cosodaotao' id='cosodaotao' value='CƠ SỞ ĐÀO TẠO HÀ NỘI' style='width:18%;border: 1px solid #ccc;padding: 6px 12px;width: 200px; margin-right:10px'  />";
			  createcb3("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC",$tochuctructhuoc,'cosodaotaoid',$cosodaotaoid);
			  createcb15("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$khoaphongban,'tochuctructhuocid',$tochuctructhuoc);
			  createcb15("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$bomonto,'khoaphongbanid',$khoaphongban);
		  }
		  else{
			  //@error2
				  createcb("cosodaotao","cosodaotaoid","name","MỜI CHỌN CƠ SỞ ĐÀO TẠO",$cosodaotao);
				  createcb16("tochuctructhuoc","tochuctructhuocid","name","MỜI CHỌN TỔ CHỨC TRỰC THUỘC",$tochuctructhuoc,'cosodaotaoid',$cosodaotao);
				  createcb16("khoaphongban","khoaphongbanid","name","MỜI CHỌN KHOA PHÒNG BAN",$khoaphongban,'tochuctructhuocid',$tochuctructhuoc);
			      createcb16("bomonto","bomontoid","name","MỜI CHỌN TỔ BỘ MÔN",$bomonto,'khoaphongbanid',$khoaphongban);
		  } 
		    
		  ?>
          </div>
            
               <div style=";overflow:auto;width:80%;float:left;margin-left:10px">
                  <table border="0" cellpadding="5" cellspacing="0" >
                   <button style=" margin-left: 20px; 
    margin-bottom: 6px;color: red;
    font-size: 15px;" type="submit" name ="btnLuu" id="btnLuu">Lưu</button>
                      <?php
                      if (isset($trangthailamviec)){
                          if ($trangthailamviec == "Đang công tác")
                              echo "&nbsp<span style=\"color:green;\">$trangthailamviec</span>";
                          else if ($trangthailamviec == "Nghỉ hưu" || $trangthailamviec == "Thôi việc")
                              echo "&nbsp<span style=\"color:red;\">$trangthailamviec</span>";
                      }

                      ?>
        <tbody><tr valign="top">
            <td width="34%" >
                <fieldset>
                    <legend>Thông tin cơ bản</legend>
                    <table border="0" cellpadding="2" cellspacing="0" width="100%" >
                        <tbody><tr>
                            <td align="right" class="style6">
                                <div id="divImg" style="background-color: #66EEFF; width: 111px; height: 146px; border: 2px solid #CAD4E6;" onClick="javascript:UploadFile()">
                                    <img id="imgStd" alt="Quí vị nhấn vào đây để tải ảnh. Ảnh phải có đuôi là JPG và dung lượng không được quá 1 MB." style="background-color: #66EEFF; width: 111px; height: 146px" align="middle" src="../../images/avatar/">
                                </div>
                            </td>
                            <td>
                                <table >
                                    <tbody><tr>
                                        <td>
                                            Số hiệu cán bộ <br>
                                            <input name="sohieucanbo" type="text" value="<?php echo $sohieucanbo; ?>"   id="sohieucanbo" style="width: 200px">
                                        </td>
                                        <td align="center" width="5%">&nbsp;
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Họ và tên <b><font color="red">*</font></b><br>
                                            <input name="txtHoTen" type="text" value="<?php echo $hoten; ?>"   id="txtHoTen" style="width: 200px" required />
                                          
                                        </td>
                                        <td align="center" width="5%">
                                            <span id="RequiredFieldValidator1" style="color:Red;visibility:hidden;">*</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Ngày sinh <b><font color="red">*</font></b><br>
                                            <input name="txtNgaySinh" type="date"  maxlength="10" id="txtNgaySinh" value="<?php echo $ngaysinh; ?>" required style="width: 200px; border: 1px solid #ccc; padding: 3px 12px;">
                                        </td>
                                        <td align="center" class="style4" width="5%">
                                            <span id="RequiredNgaySinh" style="color:Red;visibility:hidden;">*</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Giới tính <b><font color="red">*</font></b><br>
                                            <input id="radNam" type="radio" name="GioiTinh" value="1" <?php if($gioitinh==1) echo 'checked="checked"';
											 ?>> <label for="radNam">Nam</label>
                                            &nbsp;&nbsp;&nbsp;
                                            <input id="radNu" type="radio" name="GioiTinh" value="0" <?php if($gioitinh==0) echo 'checked="checked"'; 
											?>><label for="radNu">Nữ</label>
                                        </td>
                                        <td align="center" class="style4" width="5%">&nbsp;
                                            
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                            <td align="center" width="5%">&nbsp;
                                
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Tên gọi khác : 
                            </td>
                            <td>
                                <input name="tenkhac" type="text" id="tenkhac" value="<?php  echo $tenkhac ; ?>" style="width:200px;">
                             	
                            </td>
                            <td align="center" width="5%">&nbsp;
                                
                            </td>
                        </tr>
                              <tr>
                            <td align="right" class="style6">
                                Điện thoại : 
                            </td>
                            <td>
                                <input name="dienthoai" type="number" id="dienthoai" style="width:200px;; border: 1px solid #ccc; padding: 6px 12px;" value="<?php  echo $dienthoai ; ?>">
                             	
                            </td>
                            <td align="center" width="5%">&nbsp;
                                
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Nghề nghiệp trước tuyển dụng :<b><font color="red">*</font></b><br>
                            </td>
                            <td>
                                <input name="nghetruoctd" type="text" id="nghetruoctd" value="<?php  echo $nghetruoctd ; ?>" style="width:200px;" required>
                             	
                            </td>
                            <td align="center" width="5%">&nbsp;
                                
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Vào cơ quan nào , ở đâu
                            </td>
                            <td>
                                <textarea name="coquantd" rows="2" cols="10"  id="coquantd" style="width: 200px"><?php echo $coquantd ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td align="right" class="style6">
                                Chức vụ 
                            </td>
                            <td>
                               <textarea name="chucvu" id="chucvu" rows="2" cols="10"  style="width:200px"  ><?php  echo $chucvu ; ?></textarea>
                           
                            </td>
                            <td align="center" width="5%">&nbsp;
                                
                            </td>
                        </tr>

                        <tr>
                        	<td></td>
                        	<td colspan="2">
                        	<a href="#ex1" rel="modal:open" onclick="get_quatrinhchucvu(<?php echo $lylich_id ?>)">Quá trình thay đổi chức vụ
                        	<?php $chucvu_count = mysql_query("SELECT COUNT(*) AS count FROM chucvu WHERE lylich_id = " . $lylich_id); ?>
                        	<?php $chucvu_count_result = mysql_fetch_array($chucvu_count) ?>
                        	<?php echo "(" . $chucvu_count_result['count'] . ")"; ?>
                        		
                        	</a></td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Ngày bổ nhiệm CV 
                            </td>
                            <td>
                                <input name="chucvungay" type="date" id="chucvungay" value="<?php  echo $chucvungay ; ?>" style="width: 200px; border: 1px solid #ccc; padding: 3px 12px;" />
                            </td>
                            <td align="center" width="5%">&nbsp;
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Phụ cấp CV
                                </td>
                                <td>
                                 <select name="phucapcv" id="phucapcv" style="width: 200px; border: 1px solid #ccc; padding: 6px 12px;">
                                <option <?php if($phucapcv=='0') echo "selected";  ?>   value="0">0</option>
                                <option <?php if($phucapcv=='1.0') echo "selected";  ?>   value="1.0">1.0</option>
                                <option <?php if($phucapcv=='0.8') echo "selected";  ?> value="0.8">0.8</option>
                                <option <?php if($phucapcv=='0.6') echo "selected";  ?> value="0.6">0.6</option>
                                <option <?php if($phucapcv=='0.5') echo "selected";  ?> value="0.5">0.5</option>
                                <option <?php if($phucapcv=='0.4') echo "selected";  ?> value="0.4">0.4</option>
                                <option <?php if($phucapcv=='0.3') echo "selected";  ?> value="0.3">0.3</option>
                                <option <?php if($phucapcv=='0.25') echo "selected";  ?> value="0.25">0.25</option>
                                <option <?php if($phucapcv=='0.2') echo "selected";  ?> value="0.2">0.2</option>
                                </select>
                             
                                                         
</td>
                           
                           
                        </tr>
                        <tr>
                        	<td class="form-inline">Phụ cấp TN / Ngày  </td><td><input name="phucaptn" value="<?php echo $phucaptn  ?>" type="text" id="phucaptn" style="width: 40px" />
							<input name="ngaypctn" value="<?php echo $ngaypctn  ?>" type="date" id="ngaypctn" style="border: 1px solid #ccc;padding: 4px 12px;width: 156px;"/>
                        	</td>
                        </tr>
                            <tr> <td>
                            
                                Phụ cấp QS / Ngày 
                                </td>
                                <td> <input name="phucapqs" value="<?php echo $phucapqs  ?>" type="text" id="phucapqs" style="width: 40px" />
                                <input name="ngaypcqs" value="<?php echo $ngaypcqs  ?>" type="date" id="ngaypcqs" style="border: 1px solid #ccc;padding: 4px 12px;width: 156px;"/>
                                                                         
</td>
                               
                        </tr>
                        <tr>
                        	<td>Phụ cấp GV / Ngày</td>
                        	<td><input name="phucapgv" value="<?php echo $phucapgv  ?>" type="text" id="phucapgv" style="width: 40px"/>
                        	<input name="ngaypcgv" value="<?php echo $ngaypcgv  ?>" type="date" id="ngaypcgv" style="border: 1px solid #ccc;padding: 4px 12px;width: 156px;"/>
                        	</td>
                        </tr>
                        <tr>
                            <td>P. cấp TNNG / Ngày  </td>
                          <td><input name="phucapkhac" value="<?php echo $phucapkhac  ?>" type="text" id="phucapkhac" style="width: 40px"/>
                          <input name="ngaypctnng" value="<?php echo $ngaypctnng  ?>" type="date" id="ngaypctnng" style="border: 1px solid #ccc;padding: 4px 12px;width: 156px;"/>
                          </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Dân tộc <b><font color="red">*</font></b>
                            </td>
                            <td>
                                <select name="DropDantoc" id="DropDantoc" type="text" style="px;width:200px;border: 1px solid #ccc; padding: 6px 12px;" required>
	<option value="">Chọn</option>
	<option <?php if($dantoc=='Kinh') echo "selected";  ?> value="Kinh">Kinh</option>
	<option <?php if($dantoc=='Bố Y') echo "selected";  ?>  value="Bố Y">Bố Y</option>
	<option <?php if($dantoc=='Brâu') echo "selected";  ?> value="Brâu">Brâu</option>
	<option <?php if($dantoc=='Bru - Vân Kiều') echo "selected";  ?>  value="Bru - Vân Kiều">Bru - Vân Kiều</option>
	<option <?php if($dantoc=='Chăm / Chàm') echo "selected";  ?> value="Chăm / Chàm">Chăm / Chàm</option>
	<option <?php if($dantoc=='Chơ Ro') echo "selected";  ?> value="Chơ Ro">Chơ Ro</option>
	<option <?php if($dantoc=='Chu Ru') echo "selected";  ?> value="Chu Ru">Chu Ru</option>
	<option <?php if($dantoc=='Chứt') echo "selected";  ?>  value="Chứt">Chứt</option>
	<option <?php if($dantoc=='Co') echo "selected";  ?>  value="Co">Co</option>
	<option <?php if($dantoc=='Cống') echo "selected";  ?> value="Cống">Cống</option>
	<option <?php if($dantoc=='Cơ Ho') echo "selected";  ?> value="Cơ Ho">Cơ Ho</option>
	<option <?php if($dantoc=='Cơ Lao') echo "selected";  ?> value="Cơ Lao">Cơ Lao</option>
	<option <?php if($dantoc=='Cơ Tu') echo "selected";  ?> value="Cơ Tu">Cơ Tu</option>
	<option <?php if($dantoc=='Dao') echo "selected";  ?> value="Dao">Dao</option>
	<option <?php if($dantoc=='Ê Đê') echo "selected";  ?> value="Ê Đê">Ê Đê</option>
	<option <?php if($dantoc=='Giáy') echo "selected";  ?>  value="Giáy">Giáy</option>
	<option <?php if($dantoc=='Gia Rai') echo "selected";  ?> value="Gia Rai">Gia Rai</option>
	<option <?php if($dantoc=='Giẻ - Triêng') echo "selected";  ?> value="Giẻ - Triêng">Giẻ - Triêng</option>
	<option value="Hà Nhì" <?php if($dantoc=='Hà Nhì') echo "selected";  ?>>Hà Nhì</option>
	<option <?php if($dantoc=='Hoa') echo "selected";  ?> value="Hoa">Hoa</option>
	<option <?php if($dantoc=='H’rê') echo "selected";  ?>  value="H’rê">H’rê</option>
	<option <?php if($dantoc=='Hmông / Mèo') echo "selected";  ?>  value="Hmông / Mèo">Hmông / Mèo</option>
	<option <?php if($dantoc=='Ba Na') echo "selected";  ?> value="Ba Na">Ba Na</option>
	<option <?php if($dantoc=='Kháng') echo "selected";  ?> value="Kháng">Kháng</option>
	<option <?php if($dantoc=='Khmer') echo "selected";  ?> value="Khmer">Khmer</option>
	<option <?php if($dantoc=='Khơ Mú') echo "selected";  ?> value="Khơ Mú">Khơ Mú</option>
	<option <?php if($dantoc=='La Chí') echo "selected";  ?>  value="La Chí">La Chí</option>
	<option <?php if($dantoc=='La Ha') echo "selected";  ?> value="La Ha">La Ha</option>
	<option <?php if($dantoc=='La Hủ') echo "selected";  ?> value="La Hủ">La Hủ</option>
	<option <?php if($dantoc=='Lào') echo "selected";  ?> value="Lào">Lào</option>
	<option <?php if($dantoc=='Lô lô') echo "selected";  ?> value="Lô lô">Lô lô</option>
	<option <?php if($dantoc=='Lự') echo "selected";  ?> value="Lự">Lự</option>
	<option <?php if($dantoc=='Mạ') echo "selected";  ?> value="Mạ">Mạ</option>
	<option <?php if($dantoc=='Mảng') echo "selected";  ?> value="Mảng">Mảng</option>
	<option <?php if($dantoc=='Mường') echo "selected";  ?>  value="Mường">Mường</option>
	<option <?php if($dantoc=='Mnông') echo "selected";  ?> value="Mnông">Mnông</option>
	<option <?php if($dantoc=='Ngái') echo "selected";  ?> value="Ngái">Ngái</option>
	<option <?php if($dantoc=='Nùng') echo "selected";  ?> value="Nùng">Nùng</option>
	<option <?php if($dantoc=='Ơ Đu') echo "selected";  ?> value="Ơ Đu">Ơ Đu</option>
	<option <?php if($dantoc=='Pà Thẻn') echo "selected";  ?>  value="Pà Thẻn">Pà Thẻn</option>
	<option <?php if($dantoc=='Phù Lá') echo "selected";  ?> value="Phù Lá">Phù Lá</option>
	<option <?php if($dantoc=='Pu Péo') echo "selected";  ?>  value="Pu Péo">Pu Péo</option>
	<option <?php if($dantoc=='Raglay') echo "selected";  ?> value="Raglay">Raglay</option>
	<option <?php if($dantoc=='Rơ Măm') echo "selected";  ?> value="Rơ Măm">Rơ Măm</option>
	<option <?php if($dantoc=='Sán chay') echo "selected";  ?> value="Sán chay">Sán chay</option>
	<option <?php if($dantoc=='Sán Dìu') echo "selected";  ?> value="Sán Dìu">Sán Dìu</option>
	<option <?php if($dantoc=='Si La') echo "selected";  ?> value="Si La">Si La</option>
	<option <?php if($dantoc=='Tày') echo "selected";  ?>  value="Tày">Tày</option>
	<option <?php if($dantoc=='Tà Ôi') echo "selected";  ?> value="Tà Ôi">Tà Ôi</option>
	<option <?php if($dantoc=='Thái') echo "selected";  ?> value="Thái">Thái</option>
	<option <?php if($dantoc=='Thổ') echo "selected";  ?> value="Thổ">Thổ</option>
	<option <?php if($dantoc=='Xinh Mun') echo "selected";  ?> value="Xinh Mun">Xinh Mun</option>
	<option <?php if($dantoc=='Xê Đăng') echo "selected";  ?> value="Xê Đăng">Xê Đăng</option>
	<option <?php if($dantoc=='X’tiêng') echo "selected";  ?>  value="X’tiêng">X’tiêng</option>
	<option <?php if($dantoc=='Cao Lan') echo "selected";  ?> value="Cao Lan">Cao Lan</option>

	<option <?php if($dantoc=='Pa Rí') echo "selected";  ?> value="Pa Rí">Pa Rí</option>
	<option <?php if($dantoc=='Tu Rí') echo "selected";  ?> value="Tu Rí">Tu Rí</option>

</select>
                                <span id="RequiredFieldValidator8" style="color:Red;visibility:hidden;">Chưa chọn dân tộc</span>
                                <input id="txtNationalityID" type="hidden" value="">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Tôn giáo <b><font color="red">*</font></b>
                            </td>
                            <td>
                                <input id="txtReligionID" type="hidden" value="">
                                <select name="DropTonGiao" id="DropTonGiao" type="text" style="border: 1px solid #ccc; padding: 6px 12px;width:200px;" required>
	<option value="">Chọn</option>
	<option <?php if($tongiao=='Không tôn giáo') echo "selected";  ?> value="Không tôn giáo">Không tôn giáo</option>
	<option <?php if($tongiao=='Phật giáo') echo "selected";  ?> value="Phật giáo">Phật giáo</option>
	<option <?php if($tongiao=='Công giáo Rôma') echo "selected";  ?> value="Công giáo Rôma">Công giáo Rôma</option>
	<option <?php if($tongiao=='Phật giáo Hòa Hảo') echo "selected";  ?> value="Phật giáo Hòa Hảo">Phật giáo Hòa Hảo</option>
	<option <?php if($tongiao=='Tin Lành') echo "selected";  ?> value="Tin Lành">Tin Lành</option>
	<option <?php if($tongiao=='Bửu Sơn Kỳ Hương') echo "selected";  ?> value="Bửu Sơn Kỳ Hương">Bửu Sơn Kỳ Hương</option>
	<option <?php if($tongiao=='Tứ Ân Hiếu Nghĩa') echo "selected";  ?> value="Tứ Ân Hiếu Nghĩa">Tứ Ân Hiếu Nghĩa</option>
	<option <?php if($tongiao=='Đạo Dừa') echo "selected";  ?> value="Đạo Dừa">Đạo Dừa</option>
	<option <?php if($tongiao=='Đạo Mẫu') echo "selected";  ?> value="Đạo Mẫu">Đạo Mẫu</option>
	<option <?php if($tongiao=='Đạo giáo') echo "selected";  ?> value="Đạo giáo">Đạo giáo</option>
	<option <?php if($tongiao=='Khổng giáo') echo "selected";  ?> value="Khổng giáo">Khổng giáo</option>
	<option <?php if($tongiao=='Bà la môn') echo "selected";  ?> value="Bà la môn">Bà la môn</option>
	<option <?php if($tongiao=='Cao Đà') echo "selected";  ?> value="Cao Đà">Cao Đà</option>

</select>
                                <span id="RequiredFieldValidator9" style="color:Red;visibility:hidden;">Chưa chọn tôn giáo</span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Số chứng minh thư <b><font color="red">*</font></b>
                            </td>
                            <td>
                                <input required value="<?php echo $cmnd  ?>" name="txtCMND" type="number"  id="txtCMND" style="width: 200px;border: 1px solid #ccc; padding: 6px 12px;">
                                <span id="RequiredFieldValidator3" style="color:Red"></span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Ngày cấp <b><font color="red">*</font></b>
                            </td>
                            <td>
                                <input name="txtNgayCapCMND" value="<?php echo $ngaycapCMND  ?>" required type="date"  
                                id="txtNgayCapCMND" style="width: 200px; border: 1px solid #ccc; padding: 3px 12px;">
                                <span id="RequiredFieldValidator4" style="color:Red;visibility:hidden;">Chưa nhập ngày CMT</span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Nơi cấp <b><font color="red">*</font></b>
                            </td>
                            <td>
                                <input name="txtNoiCapCMND" value="<?php echo $noicapCMND  ?>" type="text"  id="txtNoiCapCMND" style="width: 200px" required>
                                <span id="RequiredFieldValidator5" style="color:Red;visibility:hidden;">Chưa nhập nơi cấp CMT</span>
                            </td>
                        </tr>
                        <!--<tr>
                            <td align="right" class="style6">
                                Số hộ chiếu
                            </td>
                            <td>
                                <input name="txtSoHC" type="text" id="txtSoHC" style="width: 200px">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Ngày cấp
                            </td>
                            <td>
                                <input name="txtNgayCapHC" type="text" maxlength="10" id="txtNgayCapHC" onKeyUp="javascript:chuanhoangay(event,this,this.value)" style="width: 200px">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Nơi cấp
                            </td>
                            <td>
                                <input name="txtNoiCapHC" type="text" id="txtNoiCapHC" style="width: 200px">
                            </td>
                        </tr>-->
                        <tr>
                            <td align="right" class="style6" id="tdHCXT">Hoàn cảnh xuất thân<b><font color="red">*</font></b></td>
                            <td>
                      












                                <select name="DropXuatThan1" id="DropXuatThan1" type="text" onChange="javascript:showhideDivExpand(this,'divHCXTkhac','txtHCXTkhac');" style="width:200px; border: 1px solid #ccc; padding: 3px 12px;" required>
	<option value="">Chọn</option>
	<option <?php if($xuatthan=='Tư sản') echo "selected"; ?> value="Tư sản" >Tư sản</option>
	<option <?php if($xuatthan=='Công nhân') echo "selected"; ?>   value="Công nhân">Công nhân</option>
	<option <?php if($xuatthan=='Trí thức') echo "selected"; ?> value="Trí thức">Trí thức</option>
	<option <?php if($xuatthan=='Tiểu chủ') echo "selected"; ?> value="Tiểu chủ">Tiểu chủ</option>
  <option <?php if($xuatthan=='Nông dân') echo "selected"; ?> value="Nông dân">Nông dân</option>
	<option <?php if($xuatthan=='Cán bộ') echo "selected"; ?> value="Cán bộ">Cán bộ</option>
    <option <?php if($xuatthan=='Công chức') echo "selected"; ?> value="Công chức">Công chức</option>
	<option <?php if($xuatthan=='Quân nhân') echo "selected"; ?> value="Quân nhân">Quân nhân</option>
	<option <?php if($xuatthan=='Dân nghèo') echo "selected"; ?> value="Dân nghèo">Dân nghèo</option>
     <option <?php if($xuatthan=='Thành thị') echo "selected"; ?> value="Thành thị">Thành thị</option>
	<option <?php if($xuatthan=='Hưu trí') echo "selected"; ?> value="Hưu trí">Hưu trí</option>
	<option <?php if($xuatthan=='Cán bộ hưu trí') echo "selected"; ?> value="Cán bộ hưu trí">Cán bộ hưu trí</option>
	<option <?php if($xuatthan=='Hoàn cảnh khác') echo "selected"; ?> value="Hoàn cảnh khác">Hoàn cảnh khác</option>

</select>
                                <div id="divHCXTkhac" style="display: none;">
                                    <input name="txtHCXTkhac"  type="text" id="txtHCXTkhac" style="width: 200px">
                                </div>
                                
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Nhóm máu
                            </td>
                            <td>
                                <select name="dropNhomMau" id="dropNhomMau" type="text" style="width:200px; border: 1px solid #ccc; padding: 3px 12px;" >
	<option value="">Chọn</option>
  <option <?php if($nhommau=='O') echo "selected"; ?>  value="O">O</option>
	<option <?php if($nhommau=='A') echo "selected"; ?> value="A">A</option>	
	<option <?php if($nhommau=='B') echo "selected"; ?>  value="B">B</option>
	<option <?php if($nhommau=='AB') echo "selected"; ?>  value="AB">AB</option>

</select>
                                
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Tình trạng sức khỏe
                            </td>
                            <td>
                                <input value="<?php echo $suckhoe;  ?>" name="tbTinhTrangSK" type="text"  id="tbTinhTrangSK" style="width:200px;" >
                            </td>
                        </tr>
                    
                        <tr>
                            <td align="right" class="style6">
                                Chiều cao (m) 
                            </td>
                            <td>
                                <input value="<?php echo $chieucao  ?>" name="tbCao" type="text"  id="tbCao" style="width:200px;" >
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Cân nặng (kg) 
                            </td>
                            <td>
                                <input value="<?php echo $nang  ?>" name="tbNang" type="text"  id="tbNang" style="width:200px;">
              
                            </td>
                                <tr>
                            <td align="right" class="style6">
                                Ngày vào cơ quan hiện đang công tác 
                            </td>
                            <td>
                                <input name="ngayvaocq" value="<?php echo $ngayvaocq;  ?>" type="date"  id="ngayvaocq" style="width:200px; border: 1px solid #ccc; padding: 3px 12px;">
                                
                                <span id="RequiredFieldValidator22" style="color:Red;visibility:hidden;">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Ngày tham gia cách mạng 
                            </td>
                            <td>
                                <input name="ngaythamgiacm" value="<?php echo $ngaythamgiacm;  ?>" type="date"  id="ngaythamgiacm" style="width:200px; border: 1px solid #ccc; padding: 3px 12px;">
                                
                                <span id="RequiredFieldValidator22" style="color:Red;visibility:hidden;">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Ngày vào ĐCSVN 
                            </td>
                            <td>
                                <input name="ngayvaodang" value="<?php echo $ngayvaodang  ?>" type="date"  id="ngayvaodang" style="width:200px; border: 1px solid #ccc; padding: 3px 12px;">
                                
                                <span id="RequiredFieldValidator22" style="color:Red;visibility:hidden;">*</span>
                            </td>
                        </tr>
                          
                        <tr>
                            <td align="right" class="style6">
                                Ngày chính thức ĐCSVN : 
                            </td>
                            <td>
                                <input name="ngaychinhthuc" value="<?php echo $ngaychinhthuc;  ?>" type="date"  id="ngaychinhthuc" style="width:200px; border: 1px solid #ccc; padding: 3px 12px;">
                                
                                <span id="RequiredFieldValidator22" style="color:Red;visibility:hidden;">*</span>
                            </td>
                            
                        </tr>
                           <tr>
                            <td align="right" class="style6">
                                Ngày tham gia tổ chức chính trị: 
                            </td>
                            <td>
                                <input name="ngaythamgiatc" value="<?php echo $ngaythamgiatc;  ?>" type="date"  id="ngaythamgiatc" style="width:200px; border: 1px solid #ccc; padding: 3px 12px;">
                                
                                <span id="RequiredFieldValidator22" style="color:Red;visibility:hidden;">*</span>
                            </td>
                            
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Nơi tham gia: 
                            </td>
                            <td>
                                <input name="noithamgiatc" type="text" value="<?php echo $noithamgiatc;  ?>"  id="noithamgiatc" style="width:200px;">
                                
                                <span id="RequiredFieldValidator22" style="color:Red;visibility:hidden;">*</span>
                            </td>
                            
                        </tr>
                    </tbody></table>
                </fieldset>
                
            </td>
            <td width="33%" style="vertical-align:top">
            <fieldset>
                    <legend>Nghĩa vụ quân sự </legend>
                    <table cellpadding="2" cellspacing="0" width="100%">
                        <tbody><tr>
                            <td align="right" class="style6">
                                Ngày nhập ngũ 
                            </td>
                            <td class="style9">
                                <input type="date" value="<?php echo $ngaynn ?>" name="ngaynn" id="ngaynn" style="width: 200px; border: 1px solid #ccc; padding: 3px 12px;" />
                            </td>
                            <td>
                               
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Ngày xuất ngũ 
                            </td>
                            <td class="style9">
                               <input value="<?php echo $ngayxn ?>" type="date" name="ngayxn" id="ngayxn" style="width: 200px; border: 1px solid #ccc; padding: 3px 12px;" />
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Quân hàm chức vụ cao nhất  
                            </td>
                            <td class="style9">
                                         <input type="text" name="quanham" value="<?php echo $quanham ?>" id="quanham" style="width: 200px" />

                            </td>
                            <td>
                             

                            </td>
                            
                        </tr>
                        
                        <tr>
                            <td align="right" class="style6">
                                Năm  
                            </td>
                            <td class="style9">
                                         <input type="number" value="<?php echo $namquanham ?>" name="namquanham" id="namquanham" style="width: 200px; border: 1px solid #ccc; padding: 6px 12px;" />

                            </td>
                            <td>
                              
                            

                            </td>
                            
                        </tr>
                        
                        
                        
                        
                    </tbody></table>
                </fieldset>
            <fieldset>
                    <legend>Trình độ học vấn </legend>
                    <table cellpadding="2" cellspacing="0" width="100%">
                        <tbody><tr>
                            <td align="right" class="style6">
                                Giáo dục phổ thông <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                                <select  name="lophocvan" id="lophocvan" style="width: 200px;border: 1px solid #ccc; padding: 6px 12px;" >
                                <option <?php if($giaoducphothong==12) echo "selected"; ?> value="12">12</option>
                                <option <?php if($giaoducphothong==11) echo "selected"; ?>  value="11">11</option>
                                <option <?php if($giaoducphothong==10) echo "selected"; ?>  value="10">10</option>
                                <option <?php if($giaoducphothong==9) echo "selected"; ?>  value="9">9</option>
                                <option <?php if($giaoducphothong==8) echo "selected"; ?>  value="8">8</option>
                                <option <?php if($giaoducphothong==7) echo "selected"; ?>  value="7">7</option>
                                <option <?php if($giaoducphothong==6) echo "selected"; ?>  value="6">6</option>
                                <option <?php if($giaoducphothong==5) echo "selected"; ?>  value="5">5</option>
                                <option <?php if($giaoducphothong==4) echo "selected"; ?>  value="4">4</option>
                                <option <?php if($giaoducphothong==3) echo "selected"; ?>  value="3">3</option>
                                <option <?php if($giaoducphothong==2) echo "selected"; ?>  value="2">2</option>
                                <option <?php if($giaoducphothong==1) echo "selected"; ?>  value="1">1</option>
                                </select>
                            </td>
                            <td>
                               
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Trình độ chuyên môn cao nhất <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                               
                                <select required name="hocvi" id="hocvi" style="width: 200px;border: 1px solid #ccc; padding: 6px 12px;" >
                                    <option value="">Chọn</option>
                                    <option <?php if($hocvi =="TS") echo "selected"; ?>  value="TS">TS</option>
                                    <option <?php if($hocvi =="NCS") echo "selected"; ?>  value="NCS">NCS</option>
                                    <option <?php if($hocvi =="Ths") echo "selected"; ?>  value="Ths">Ths</option>
                                    <option <?php if($hocvi =="Đ. Học cao học") echo "selected"; ?>  value="Đ. Học cao học">Đang học cao học</option>
                                    <option <?php if($hocvi =="Cử nhân") echo "selected"; ?>  value="Cử nhân">Cử nhân</option>
                                    <option <?php if($hocvi =="Kỹ sư") echo "selected"; ?>  value="Kỹ sư">Kỹ sư</option>
                                    <option <?php if($hocvi =="Đang học Đại học") echo "selected"; ?>  value="Đang học Đại học">Đang học Đại học</option>
                                    <option <?php if($hocvi =="Cao đẳng") echo "selected"; ?>  value="Cao đẳng">Cao đẳng</option>
                                    <option <?php if($hocvi =="Trung cấp") echo "selected"; ?>  value="Trung cấp">Trung cấp</option>
                                    <option <?php if($hocvi =="Đang học Trung cấp") echo "selected"; ?>  value="Đang học Trung cấp">Đang học Trung cấp</option>
                                    <option <?php if($hocvi =="Sơ cấp") echo "selected"; ?>  value="Sơ cấp">Sơ cấp</option>
                                    <option <?php if($hocvi =="Chuyên ngành") echo "selected"; ?>  value="Chuyên ngành">Chuyên ngành</option>
                                    <option <?php if($hocvi =="Phổ thông") echo "selected"; ?>  value="Phổ thông">Phổ thông</option>
                                    <option <?php if($hocvi =="Trung học") echo "selected"; ?>  value="Trung học">Trung học</option>
                                    <option <?php if($hocvi =="Tiểu học") echo "selected"; ?>  value="Tiểu học">Tiểu học</option>
                              
                                 </select>
                            </td>
                            <td>
                              
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                <label> Năm</label>  <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                              <input required value="<?php echo $namhocham ?>" type="number" name="namhocvi" id="namhocvi" style="width: 200px; border: 1px solid #ccc; padding: 6px 12px;" />
                            </td>
                            <td>
                                 
                            </td>
                        </tr>
                             <tr>
                            <td align="right" class="style6">
                                Danh hiệu dược phong 
                            </td>
                            <td class="style9">
                             
                               <textarea  name="danhhieu" id="danhhieu" cols="10" rows="2" style="width: 200px"  ><?php echo $danhhieu ?> </textarea>
                            </td>
                            <td>
                     
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                <label> Năm</label>
                            </td>
                            <td class="style9">
                               <input type="number" value="<?php echo $namdanhhieu ?>" name="namdanhhieu" id="namdanhhieu" style="width: 200px; border: 1px solid #ccc; padding: 6px 12px;" />
                            </td>
                            <td>
                                  
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Chuyên ngành   <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                                         <input type="text"  value="<?php echo $chuyennganh ?>" name="chuyennganh" id="chuyennganh" style="width: 200px" required />

                            </td>
                            <td>
                    
                            </td>
                            
                        </tr>
                                <tr>
                            <td align="right" class="style6">
                                   Nơi tốt nghiệp  
                            </td>
                            <td class="style9">
                                               <select  name="noiTN" id="noiTN" style="border: 1px solid #ccc; padding: 6px 12px; width: 200px"  >
                                 <option value="">Chọn</option>
                                    <option <?php if($noiTN=='Trong nước') echo "selected"; ?>   value="Trong nước">
                                      Trong nước
                                    </option>
                                    <option <?php if($noiTN=='Ngoài nước') echo "selected"; ?>   value="Ngoài nước">
                                      Ngoài nước
                                    </option>
                                 </select>

                            </td>
                            <td>
                              
                          
                            </td>
                            
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Lí luận chính trị
                            </td>
                            <td class="style9">
                                 <select  name="caplyluan" id="caplyluan" style="border: 1px solid #ccc; padding: 6px 12px;; width: 200px">
                                 <option value="">Chọn</option>
                                    <option <?php if($caplyluan=='Cao cấp') echo "selected"; ?>  value="Cao cấp">
                                      Cao cấp 
                                    </option>
                                    <option value="Trung cấp" <?php if($caplyluan=='Trung cấp') echo "selected"; ?>>
                                      Trung cấp
                                    </option>
                                    <option value="Sơ cấp" <?php if($caplyluan=='Sơ cấp và tương đương' || $caplyluan=='Sơ cấp hoặc tương đương' || $caplyluan=='Sơ cấp') echo "selected"; ?>>
                                      Sơ cấp
                                    </option >
                                 </select>

                            </td>
                            <td>
                              
                            </td>
                            
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Quản lí nhà nước : 
                            </td>
                            <td class="style9">
                                  <select  name="quanlynhanuoc" id="quanlynhanuoc" style="border: 1px solid #ccc; padding: 6px 12px; width: 200px">
                                  <option value="">Chọn</option>
                                    <option <?php if($quanlynhanuoc=='Chuyên viên cao cấp') echo "selected"; ?> value="Chuyên viên cao cấp">
                                      Chuyên viên cao cấp
                                    </option>
                                    <option <?php if($quanlynhanuoc=='Chuyên viên chính trị') echo "selected"; ?> value="Chuyên viên chính trị">
                                      Chuyên viên chính trị 
                                    </option>
                                     <option value="Chuyên viên" <?php if($quanlynhanuoc=='Chuyên viên') echo "selected"; ?>>
                                      Chuyên viên 
                                    </option>
                                     <option <?php if($quanlynhanuoc=='Cán sự') echo "selected"; ?> value="Cán sự">
                                      Cán sư
                                    </option>
                                     <option <?php if($quanlynhanuoc=='Khác') echo "selected"; ?> value="Khác">
                                      Khác
                                    </option>
                                 </select>

                            </td>
                            <td>
                                
                            </td>
                            
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Chức danh khoa học  
                            </td>
                            <td class="style9">
                                        <select  name="chucdanhkhoahoc" id="chucdanhkhoahoc" style="border: 1px solid #ccc; padding: 6px 12px; width: 200px">
                                        <option value="">Chọn</option>
                                    <option value="Giáo sư" <?php if($chucdanhkhoahoc=='Giáo sư') echo "selected"; ?>>
                                      Giáo sư
                                    </option>
                                    <option value="Phó giáo sư" <?php if($chucdanhkhoahoc=='Phó giáo sư') echo "selected"; ?>>
                                      Phó giáo sư
                                    </option>
                                 </select>
                            </td>
                            <td>
                                 
                            </td>
                            
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Ngoại ngữ  
                            </td>
                            <td class="style9">
                                  <input type="text" value="<?php echo $ngoaingu; ?>" name="ngoaingu" id="ngoaingu" style="width: 200px" />
                            </td>
                            <td>
                                 
                            </td>
                            
                        </tr>
                             <tr>
                            <td align="right" class="style6">
                                Trình độ 
                            </td>
                            <td class="style9">
                                  <input type="text" value="<?php echo $ngoaingu_trinhdo; ?>" name="trinhdo" id="trinhdo" style="width: 200px" />
                            </td>
                            <td>
                                 
                            </td>
                            
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Chứng chỉ nghiệp vụ sư phạm  
                            </td>
                            <td class="style9">
                               <input type="text" name="chungchiNVSP" value = "<?php echo $chungchiNVSP; ?>" id="chungchiNVSP" style="width: 200px" />

                            </td>
                            <td>
                                 
                            </td>
                            
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Tin học : 
                            </td>
                            <td class="style9">
                                        <select  name="tinhoc" id="tinhoc" style="border: 1px solid #ccc; padding: 6px 12px; width: 200px">
                                        <option value="">Chọn</option>
                                    <option  value="A" <?php if($tinhoc=='A') echo "selected"; ?>>
                                      A
                                    </option>
                                    <option value="B" <?php if($tinhoc=='B') echo "selected"; ?>>
                                      B
                                    </option>
                                     <option value="C" <?php if($tinhoc=='C') echo "selected"; ?>>
                                      C
                                    </option>
                                      <option  value="IC3" <?php if($tinhoc=='IC3') echo "selected"; ?>>
                                      IC3
                                    </option>
                                    <option value="ICDL" <?php if($tinhoc=='ICDL') echo "selected"; ?>>
                                      ICDL
                                    </option>
                                     <option value="Chuyên ngành" <?php if($tinhoc=='Chuyên ngành') echo "selected"; ?>>
                                      Chuyên ngành
                                    </option>
                                 </select>
                            </td>
                            <td>
                                 
                            </td>
                            
                        </tr>
                    </tbody></table>
                </fieldset>
                
                <fieldset>
                    <legend>Quê quán </legend>
                    <table cellpadding="2" cellspacing="0" width="100%">
                        <tbody>
                        <tr>
                            <td align="right" class="style6">
                                Tỉnh / TP <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                                
	
             <?php  
			 createcb("tinh","provinceid","name","Chọn",$tinh);
			 ?>
                                    

                            </td>
                            <td>
                                <span id="RequiredFieldValidator6" style="color:Red;visibility:hidden;">Chưa chọn Tỉnh/TP</span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Quận / Huyện <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                             
	
          <?php  
			 createcb11("huyen","districtid","name","Chọn",$huyen,$tinh);
			 ?>
                                    
               </td>
                            <td>
                                <span id="RequiredFieldValidator2" style="color:Red;visibility:hidden;">Chưa chọn Quận/Huyện</span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Phường / Xã <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                                <input name="txtPXQueQuan" type="text" id="txtPXQueQuan" value="<?php echo $xa ?>" style="width: 200px" required>
                            </td>
                            <td>&nbsp;
                                
                            </td>
                        </tr>
                    </tbody></table>
                </fieldset>
                
                <fieldset>
                    <legend>Nơi sinh</legend>
                    <table cellpadding="2" cellspacing="0" width="100%">
                        <tbody><tr>
                    <td align="right" class="style6">
                                Tỉnh / TP <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                                
	
             <?php  
			 createcb2("tinh","provinceid","name","Chọn",$tinhns);
			 ?>
                                    

                            </td>
                            <td>
                                <span id="RequiredFieldValidator6" style="color:Red;visibility:hidden;">Chưa chọn Tỉnh/TP</span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Quận / Huyện <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                             
	
          <?php  
			 createcb9("huyen","districtid","name","Chọn",$huyenns,$tinhns);
			 ?>
                                    
               </td>
                            <td>
                                <span id="RequiredFieldValidator2" style="color:Red;visibility:hidden;">Chưa chọn Quận/Huyện</span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style6">
                                Phường / Xã <b><font color="red">*</font></b>
                            </td>
                            <td class="style9">
                                <input name="xans" type="text" id="xans" value="<?php echo $xans ?>" style="width: 200px" required>
                            </td>
                            <td>&nbsp;
                                
                            </td>
                        </tr>
                        
                        
         
              
                    </tbody></table>
                </fieldset>
            
            </td>
            <td width="33%" style="vertical-align:top">
                <div id="divMsg">
                            </div><table width="100%" cellpadding="2" cellspacing="0">
                    <tbody><tr>
                        <td>
                        <fieldset>
                    <legend>Hộ khẩu thường trú</legend>
                    <table cellpadding="2" cellspacing="0" width="100%" border="0">
                        <tbody><tr>
                            <td align="right" class="style6">
                                Hộ khẩu thường trú<b><font color="red">*</font></b>
                            </td>
                            <td>
							      <input name="hokhauthuongtru" type="text" id="hokhauthuongtru" value="<?php echo $hokhauthuongtru ?>" style="width: 250px" required>

                            </td>
                                     </tr>
                        
                 
                    </tbody></table>
                </fieldset>
                            <fieldset>
                    <legend>Nơi ở hiện nay<b><font color="red">*</font></b></legend>
                    <table cellpadding="2" cellspacing="0" width="100%">
                        <tbody><tr>
                            <td align="left" colspan="3">
                                
                            </td>
                        </tr>
                        
                        <tr>
                            <td align="right" class="style6">
                                Nơi ở hiện nay <b><font color="red">*</font></b>
                            </td>
                            <td>
                                <div id="UpdatePanel7">

                                  <input name="noiohiennay" type="text" value="<?php echo $noiohiennay ?>"   id="noiohiennay" style="width: 250px; border: 1px solid #ccc; padding: 6px 12px;" required>
    
                                    
</div>
                            </td>
                      
                        </tr>
                        
                        
                        
                        
                    </tbody></table>
                </fieldset>
                <fieldset>
                    <legend>Khen thưởng kỉ luật </legend>
                    <table cellpadding="2" cellspacing="0" width="100%">
                        <tbody><tr>
                            <td align="left" colspan="3">
                                
                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style10">
                                Khen thưởng cao nhất  
                            </td>
                            <td class="style11">
                                <input name="huanchuong" value="<?php echo $huanchuong;?>" type="text" id="huanchuong" style="width: 200px">

                            </td>
                            <td>
                            </td>
                        </tr>

    <tr>
                            <td align="right" class="style10">
                                 Năm 
                            </td>
                            <td class="style11">
                               <input name="namhuanchuong" value="<?php echo $namhuanchuong;?>" type="number" id="namhuanchuong" style="width: 200px; border: 1px solid #ccc; padding: 6px 12px;">

                            </td>
                            <td>
                                
                            </td>
                        </tr>                        <tr>
                            <td align="right" class="style6">
                                Kỷ luật cao nhất 
                            </td>
                            <td>
                                        <input name="kyluatcaonhat" value="<?php echo $kyluatcaonhat;?>"  type="text" id="kyluatcaonhat" style="width: 200px">

                            </td>
                            <td>
                         
                            </td>
                        </tr>
                        
                        <tr>
                            <td align="right" class="style6">
                                Năm 
                            </td>
                            <td>
                                      <input name="namkyluatcaonhat" value="<?php echo $namkyluatcaonhat;?>" type="number" id="namkyluatcaonhat" style="width: 200px; border: 1px solid #ccc; padding: 6px 12px;">

                            </td>
                            <td>
                                
                            </td>
                        </tr>
                        
                        
                    </tbody></table>
                </fieldset>
                <fieldset>
                    <legend>Công tác</legend>
                    <table cellpadding="2" cellspacing="0" width="100%">
                        <tbody><tr>
                            <td align="left" colspan="3">

                            </td>
                        </tr>
                        <tr>
                            <td align="right" class="style10">
                                Công tác chính đang làm <b><font color="red">*</font></b>
                            </td><td> 
                   <input name="congtacchinh" value="<?php echo $congtacchinh;?>" type="text" id="congtacchinh" style="width: 190px" required>
                   
                            </td>
                            <td>                  
                            </td>
                        </tr>
                        <tr>
                                        <td>
                                            Sở trường công tác
                                        </td>
                                        <td>
                                            <input name="sotruong" type="text" id="sotruong" value="<?php echo $sotruong;?>" />
                                        </td>
                                    </tr>
                    </tbody></table>
                </fieldset>
                            <!--<fieldset>
                                <legend>Thông tin cán bộ</legend>
                                <table border="0" cellpadding="2" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td align="right" class="style6">
                                            Trình độ chuyên môn hiện tại <b><font color="red">*</font></b>
                                        </td>
                                        <td>
                                            <select name="dropTDCM" id="dropTDCM" type="text" style="height:23px;width:200px;">
	<option value="TSKH">Tiến sĩ khoa học</option>
	<option value="TS">Tiến sĩ</option>
	<option value="CH">Thạc sĩ</option>
	<option value="NCS">Nghiên cứu sinh</option>
	<option value="DH">Đại học</option>
	<option value="CD">Cao đẳng</option>
	<option selected="selected" value="TH">Trung học chuyên nghiệp</option>
	<option value="KHAC">Khác</option>
	<option value="CKI">Chuyên Khoa I</option>
	<option value="CKII">Chuyên Khoa II</option>
	<option value="BSNT">Bác sỹ nội trú</option>

</select>
                                            
                                        </td>
                                        <td align="center" width="5%">
                                        <span id="RequiredFieldValidator21" style="color:Red;visibility:hidden;">*</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" class="style6">
                                            Chức danh khoa học hiện tại
                                        </td>
                                        <td>
                                            <select name="dropChucDanhKhoaHoc" id="dropChucDanhKhoaHoc" type="text" style="height:23px;width:200px;">
	<option selected="selected" value="">Chọn</option>
	<option value="GS">Giáo sư</option>
	<option value="PGS">Phó giáo sư</option>

</select>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" class="style6">
                                            Chức vụ hiện tại
                                        </td>
                                        <td>
                                            <select name="DropCVHT" id="DropCVHT" type="text" style="height:23px;width:200px;">
	<option selected="selected" value="">Chọn</option>
	<option value="CNK">Chủ nhiệm khoa</option>
	<option value="CVP">Chánh Văn Phòng</option>
	<option value="GD_CT">Giám đốc chương trình</option>
	<option value="GDC">Giám đốc chung</option>
	<option value="GDPH">Giám đốc Phân hiệu ĐHTN </option>
	<option value="GDV">Giám đốc đơn vị trực thuộc</option>
	<option value="GQG">Giám đốc ĐHTN</option>
	<option value="GTT">Giám đốc trung tâm</option>
	<option value="GV">Giám đốc viện</option>
	<option value="HT">Hiệu trưởng</option>
	<option value="NXB">Giám đốc Nhà xuất bản</option>
	<option value="PCNK">Phó chủ nhiệm khoa</option>
	<option value="PCVP">Phó Chánh Văn Phòng</option>
	<option value="PDV">Phó giám đốc đơn vị trực thuộc</option>
	<option value="PGDPH">Phó giám đốc Phân hiệu ĐHTN </option>
	<option value="PHT">Phó hiệu trưởng</option>
	<option value="PK">Phó trưởng khoa</option>
	<option value="PNXB">Phó giám đốc Nhà xuất bản</option>
	<option value="PP">Phó trưởng phòng</option>
	<option value="PQG">Phó giám đốc ĐHTN</option>
	<option value="PTB">Phó trưởng Ban</option>
	<option value="PTBM">Phó trưởng Bộ môn</option>
	<option value="PTT">Phó Giám đốc  trung tâm</option>
	<option value="PV">Phó giám đốc viện</option>
	<option value="PVT">Phó Viện trưởng</option>
	<option value="TB">Trưởng ban</option>
	<option value="TBM">Trưởng Bộ môn</option>
	<option value="TK">Trưởng Khoa</option>
	<option value="TP">Trưởng phòng</option>
	<option value="TPho">Tổ Phó</option>
	<option value="TT">Tổ trưởng</option>
	<option value="VPDU">Phó chánh VP Đảng Ủy ĐHTN</option>
	<option value="VT">Viện trưởng</option>
	<option value="XP">Xưởng phó</option>
	<option value="XT">Xưởng trưởng</option>

</select>
                                            
                                        </td>
                                    </tr>
                                </tbody></table>
                            </fieldset>-->
                            <fieldset>
                                <legend>Thông tin chính sách - Bảo hiểm</legend>
                                <table border="0" cellpadding="2" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td>
                                            Là con gia đình chính sách
                                        </td>
                                        <td>
                                            <select name="DropDoiTuong" id="DropDoiTuong" type="text" style="width:200px;; border: 1px solid #ccc; padding: 3px 12px;">
	<option value="">Chọn</option>
	<option <?php if($doituong=='Thương binh') echo 'selected'; ?> value="Thương binh">Thương binh</option>
	<option <?php if($doituong=='Bệnh binh') echo 'selected'; ?>  value="Bệnh binh">Bệnh binh</option>
	<option <?php if($doituong=='Thân nhân 1 liệt sĩ') echo 'selected'; ?>  value="Thân nhân 1 liệt sĩ">Thân nhân 1 liệt sĩ</option>
	<option <?php if($doituong=='Thân nhân 2 liệt sĩ') echo 'selected'; ?>  value="Thân nhân 2 liệt sĩ">Thân nhân 2 liệt sĩ</option>
	<option <?php if($doituong=='Quân nhân TNLĐ-BNN') echo 'selected'; ?>  value="Quân nhân TNLĐ-BNN">Quân nhân TNLĐ-BNN</option>
	<option <?php if($doituong=='Hoạt động KC- có công CM') echo 'selected'; ?>  value="Hoạt động KC- có công CM">Hoạt động KC- có công CM</option>
	<option <?php if($doituong=='Thương tật hạng 2') echo 'selected'; ?>  value="Thương tật hạng 2">Thương tật hạng 2</option>
	<option <?php if($doituong=='Thương tật hạng 3') echo 'selected'; ?>  value="Thương tật hạng 3">Thương tật hạng 3</option>
	<option <?php if($doituong=='Thương tật hạng 4') echo 'selected'; ?>  value="Thương tật hạng 4">Thương tật hạng 4</option>
	<option <?php if($doituong=='Thương tật hạng 5/6') echo 'selected'; ?>  value="Thương tật hạng 5/6">Thương tật hạng 5/6</option>
	<option <?php if($doituong=='Thương tật hạng 1/8') echo 'selected'; ?>  value="Thương tật hạng 1/8">Thương tật hạng 1/8</option>
	<option <?php if($doituong=='Con thương binh') echo 'selected'; ?>  value="Con thương binh">Con thương binh</option>
	<option <?php if($doituong=='Con liệt sỹ') echo 'selected'; ?>  value="Con liệt sỹ">Con liệt sỹ</option>
	<option <?php if($doituong=='Người nhiễm chất độc da cam Dioxin') echo 'selected'; ?>  value="Người nhiễm chất độc da cam Dioxin">Người nhiễm chất độc da cam Dioxin</option>

</select>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Thương binh loại
                                        </td>
                                        <td>
                                           <input name="thuongbinhloai" type="text" id="thuongbinhloai" value="<?php echo $doituong;?>" /> 
                                           
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>
                                            Số sổ BHXH
                                        </td>
                                        <td>
                                            <input name="txtBHXH" type="text" id="txtBHXH" value="<?php echo $baohiemxahoi;?>"/>
                                        </td>
                                    </tr>
                                     
                                    
                                </tbody></table>
                            </fieldset>
                            <fieldset>
                                <legend>Nguồn thu nhập chính của gia đình (hằng năm): </legend>
                                <table border="0" cellpadding="2" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td>
                                            Lương
                                        </td>
                                        <td>

                                            <input name="luong" type="number" id="luong" value="<?php echo $luong;?>" style="border: 1px solid #ccc; padding: 6px 12px;">
                                        </td>
                                    </tr>
                              
                                    <tr>
                                        <td>
                                            Các nguồn khác 
                                        </td>
                                        <td>
                                           <input name="nguonkhac" type="number" id="nguonkhac" value="<?php echo $thunhapkhac;?>" style="border: 1px solid #ccc; padding: 6px 12px;"/> 
                                           
                                        </td>
                                    </tr>
                                </tbody></table>
                            </fieldset>
                            <!--<fieldset>
                                <legend>Thông tin đặc điểm lịch sử bản thân</legend>
                                <table border="0" cellpadding="2" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td>
                                            Khai rõ: bị bắt, bị tù(từ ngày tháng năm nào, ở đâu), đã khai báo cho ai, những
                                            vấn đề gì? <b><font color="red">*</font></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea name="txtDacDiemLSBanThan" rows="2" cols="20" id="txtDacDiemLSBanThan" style="width:357px;">khong</textarea>
                                                <span id="RequiredFieldValidator26" style="color:Red;visibility:hidden;">*</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Tham gia hoặc có quan hệ với các tổ chức chính trị, kinh tế, xã hội nào ở nước ngoài? <b><font color="red">*</font></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea name="txtThamGiaToChuc" rows="2" cols="20" id="txtThamGiaToChuc" style="width:367px;">khong</textarea>
                                                <span id="RequiredFieldValidator27" style="color:Red;visibility:hidden;">*</span>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </fieldset>-->
                        </td>
                        </tr></tbody></table><table border="0" cellpadding="5" cellspacing="0" width="100%">
                                <tbody><tr>
                                    <td>
                                        <div id="UpdatePanel6">
	
                                                
                                                <div id="ValidationSummary1" style="color:Red;display:none;">

	</div>
                                            
</div>
                                    </td>
                                    <td>
                                        
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td>
                                        <div id="hiddenInfo" visible="False" style="display: none;">
                                            <input type="hidden" name="txtImgFileName" id="txtImgFileName">
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody></table>
                        
                    </td></tr>
                    
                </tbody></table>
                    
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
  </form>
  <?php
    //include_once("footer.php");
    ?>
  </div>
  </div>
        <input type="text" name="check" id="check" value="<?php echo $check_image; ?>" hidden=""/>
   	<div id="ex1" style="display:none;">
	    <h3 class="form-group" id="ex-hoten"></h3>
	    <p></p>
  	</div>
</body>
</html>
<script>
$(document).ready(function(e) {
      $("#tinh").change(
	   function(e){
		   keypress($(this).attr("value"));
	
	   }
	
);
});
 
 $(document).ready(function(e) {
      $("#tinhns").change(
	   function(e){
		   keypress1($(this).attr("value"));
	
	   }
	
);
});

$(document).ready(function(e) {
      $("#cosodaotao").change(
	   function(e){
		   keypress2($(this).attr("value"));
	
	   }
	
);
});

$(document).ready(function(e) {
      $("#tochuctructhuoc").change(
	   function(e){
		   keypress3($(this).attr("value"));
	
	   }
	
);
});

$(document).ready(function(e) {
      $("#khoaphongban").change(
	   function(e){
		   keypress4($(this).attr("value"));
	
	   }
	
);
});
$(document).ready(function(e) {
      $("#ngach").change(
	   function(e){
		  keypress5($(this).attr("value"));
	   }
	
);
});
$(document).ready(function(e) {
      $("#mangach").change(
	   function(e){
		  keypress6($(this).attr("value"));
	     
	   }
	
);
});
$(document).ready(function(e) {
      $("#bac_heso").change(
	   function(e){
		  keypress7($(this).attr("value"));
	     
	   }
	
);
});

function get_quatrinhchucvu(lylich_id) {
	$.get('../TienIch/quatrinhchucvu/ajax.php?lylich_id=' + lylich_id,
			 function(data) { $('#ex1').html(data) }
		);
}
</script>
<?php
  }

  
  ?>