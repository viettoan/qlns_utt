<!DOCTYPE html>
<html>
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
      <div>
                  <div id="menu" style="float:left;width:19%;border-radius:7px;">
		 		<ul>
			 		<li ><a href="Nhapmanhinh.php"><i class="fa fa-home"></i>LÝ LỊCH</a></li>
                    <li><a href="Daotao.php"><i class="fa fa-cog" class="active"></i>ĐÀO TẠO</a></li>
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
                  
                
<script>

function keypress(str,str1) {
    
          
		  var tentruong,lophoc,thoigian,hinhthuc,vanbang,noidaotao,khoahoc,dean,qdinh,thangnamcu,doituong;
		  if(str1 != 0){
				  tentruong = document.getElementById("tentruong"+str1).value;
				  lophoc = document.getElementById("lophoc"+str1).value;
				  thoigian = document.getElementById("thoigian"+str1).value;
				  hinhthuc = document.getElementById("hinhthuc"+str1).value;
				  
				  vanbang = document.getElementById("vanbang"+str1).value;
				  noidaotao = document.getElementById("noidaotao"+str1).value;
				  khoahoc = document.getElementById("khoahoc"+str1).value;
				  dean = document.getElementById("dean"+str1).value;
				  qdinh = document.getElementById("qdinh"+str1).value;
				  thangnamcu = document.getElementById("thangnamcu"+str1).value;
				  doituong = document.getElementById("doituong"+str1).value;
		  }
		  else{
			  	  tentruong = document.getElementById("tentruong").value;
				  lophoc = document.getElementById("lophoc").value;
				  thoigian = document.getElementById("thoigian").value;
				  hinhthuc = document.getElementById("hinhthuc").value;
				  
				  vanbang = document.getElementById("vanbang").value;
				  noidaotao = document.getElementById("noidaotao").value;
				  khoahoc = document.getElementById("khoahoc").value;
				  dean = document.getElementById("dean").value;
				  qdinh = document.getElementById("qdinh").value;
				  thangnamcu = document.getElementById("thangnamcu").value;
				  doituong = document.getElementById("doituong").value;
		  }
  if ( event.which == 13 ) {
	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("load_edu").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_edu.php?action="+str+"&&tentruong="+tentruong+"&&lophoc="+lophoc+"&&thoigian="+thoigian+
		"&&hinhthuc="+hinhthuc+"&&vanbang="+vanbang+"&&noidaotao="+noidaotao+"&&khoahoc="+khoahoc+"&&dean="+dean+"&&qdinh="+qdinh+
		"&&thangnamcu="+thangnamcu+"&&doituong="+doituong+"&&id="+str1,true);
        xmlhttp.send();
     event.preventDefault();
 }
 else{
	 if(str==2){
	       if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("load_edu").innerHTML = xmlhttp.responseText;
            }
        };
		       xmlhttp.open("GET","../load_data/load_edu.php?action="+str+"&&id="+str1,true);
	       xmlhttp.send();
     event.preventDefault();
	 }
 }
 // });*/
}

function keypress100(str,str1) {
    
          
		  var tentruong,lophoc,thoigian,hinhthuc,vanbang,noidaotao,khoahoc,dean,qdinh,thangnamcu,doituong;
		  if(str1 != 0){
				  tentruong = document.getElementById("tentruong"+str1).value;
				  lophoc = document.getElementById("lophoc"+str1).value;
				  thoigian = document.getElementById("thoigian"+str1).value;
				  hinhthuc = document.getElementById("hinhthuc"+str1).value;
				  
				  vanbang = document.getElementById("vanbang"+str1).value;
				  noidaotao = document.getElementById("noidaotao"+str1).value;
				  khoahoc = document.getElementById("khoahoc"+str1).value;
				  dean = document.getElementById("dean"+str1).value;
				  qdinh = document.getElementById("qdinh"+str1).value;
				  thangnamcu = document.getElementById("thangnamcu"+str1).value;
				  doituong = document.getElementById("doituong"+str1).value;
		  }
		  else{
			  	  tentruong = document.getElementById("tentruong").value;
				  lophoc = document.getElementById("lophoc").value;
				  thoigian = document.getElementById("thoigian").value;
				  hinhthuc = document.getElementById("hinhthuc").value;
				  
				  vanbang = document.getElementById("vanbang").value;
				  noidaotao = document.getElementById("noidaotao").value;
				  khoahoc = document.getElementById("khoahoc").value;
				  dean = document.getElementById("dean").value;
				  qdinh = document.getElementById("qdinh").value;
				  thangnamcu = document.getElementById("thangnamcu").value;
				  doituong = document.getElementById("doituong").value;
		  }
 
	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("load_edu").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_edu.php?action="+str+"&&tentruong="+tentruong+"&&lophoc="+lophoc+"&&thoigian="+thoigian+
		"&&hinhthuc="+hinhthuc+"&&vanbang="+vanbang+"&&noidaotao="+noidaotao+"&&khoahoc="+khoahoc+"&&dean="+dean+"&&qdinh="+qdinh+
		"&&thangnamcu="+thangnamcu+"&&doituong="+doituong+"&&id="+str1,true);
        xmlhttp.send();
     event.preventDefault();


 // });*/
}

/*function onchange(str,str1,str2) {
    
          
		  var tentruong,lophoc,thoigian,hinhthuc,vanbang,noidaotao,khoahoc,dean,qdinh,thangnamcu,doituong;
		  if(str1 != 0){
				  tentruong = document.getElementById("tentruong"+str1).value;
				  lophoc = document.getElementById("lophoc"+str1).value;
				  thoigian = document.getElementById("thoigian"+str1).value;
				  hinhthuc = document.getElementById("hinhthuc"+str1).value;
				  
				  vanbang = document.getElementById("vanbang"+str1).value;
				  noidaotao = document.getElementById("noidaotao"+str1).value;
				  khoahoc = document.getElementById("khoahoc"+str1).value;
				  dean = document.getElementById("dean"+str1).value;
				  qdinh = document.getElementById("qdinh"+str1).value;
				  thangnamcu = document.getElementById("thangnamcu"+str1).value;
				  //doituong = document.getElementById("doituong"+str1).value;
		  }
		  else{
			  	  tentruong = document.getElementById("tentruong").value;
				  lophoc = document.getElementById("lophoc").value;
				  thoigian = document.getElementById("thoigian").value;
				  hinhthuc = document.getElementById("hinhthuc").value;
				  
				  vanbang = document.getElementById("vanbang").value;
				  noidaotao = document.getElementById("noidaotao").value;
				  khoahoc = document.getElementById("khoahoc").value;
				  dean = document.getElementById("dean").value;
				  qdinh = document.getElementById("qdinh").value;
				  thangnamcu = document.getElementById("thangnamcu").value;
				 // doituong = document.getElementById("doituong").value;
		  }
 
	         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("load_edu").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_edu.php?action="+str+"&&tentruong="+tentruong+"&&lophoc="+lophoc+"&&thoigian="+thoigian+
		"&&hinhthuc="+hinhthuc+"&&vanbang="+vanbang+"&&noidaotao="+noidaotao+"&&khoahoc="+khoahoc+"&&dean="+dean+"&&qdinh="+qdinh+
		"&&thangnamcu="+thangnamcu+"&&doituong="+str2+"&&id="+str1,true);
        xmlhttp.send();
     event.preventDefault();

}
	
$(document).ready(function(e) {
    $("#doituong").change(
	function(){
		 onchange(1,0,$(this).attr("value"));
	}
	)

    $("#doituong").change(
	function(){
		 onchange(1,0,$(this).attr("value"));
	}
	)

});*/


</script>
<div style="float:left;width:75%;margin-left:10px">
 <div id="s_box" style="text-align:center"><h1>ĐÀO TẠO - <?php if(isset($_SESSION['hoten'])) echo $_SESSION['hoten'] ?></h1></div>
<div id="id_content">
<table class="kyluat" border="1" style="width:100%" >
                                    <thead>
                                       <th >Tên trường</th>
                                       <th>Ngành học hoặc tên lớp học</th>
                                       <th>Thời gian học</th>
                                       <th>Hình thức học</th>
                                       <th>Văn bằng chứng từ </th>
                                       <th>Nơi đào tạo</th>
                                       <th>Khóa học</th>
                                       <th>Đề án </th>
                                     
                                       <th>Tháng năm cử đi</th>
                                       <th>Đối tượng</th>
                                         <th>Quyết định</th>
                                       <th>Hành động</th>
                                    </thead>
                                    <tbody id="load_edu">
                                    <?php
                                        

        
				  $query = "Select * from daotao where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
           echo '<td width="117px"> <input type="text" name="tentruong'.$row['id'].'" id="tentruong'.$row['id'].'" value="'.$row['tentruong'].'" size="15" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
		   echo '<td width="152px"> <input type="text" name="lophoc'.$row['id'].'" id="lophoc'.$row['id'].'" value="'.$row['nganhhoc'].'" size="20" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
	       echo '<td width="117px"> <input type="text" name="thoigian'.$row['id'].'" id="thoigian'.$row['id'].'" value="'.$row['thoigianhoc'].'" size="15" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
	
		   echo ' <td width="100px">  <select name="hinhthuc'.$row['id'].'" id="hinhthuc'.$row['id'].'"   onKeyPress="keypress(0,
		   '.$row['id'].')" style="width:100px" >
                                                <option ';
												if($row['hinhthuchoc']=='')
												echo "selected";
												 echo' value="">---Chọn---</option>
                                                <option ';
												if($row['hinhthuchoc']=='Chính quy')
												echo'selected';
												echo' value="Chính quy">Chính quy</option>
                                                <option ';
												if($row['hinhthuchoc']=='Tại chức')
												echo 'selected';
												echo ' value="Tại chức">Tại chức</option>
                                                <option ';
												if($row['hinhthuchoc']=='Chuyên tu')
												echo'selected';
												echo' value="Chuyên tu">Chuyên tu</option>
                                                 <option ';
												 if($row['hinhthuchoc']=='Bồi dưỡng')
												 echo'selected';
												 echo ' value="Bồi dưỡng">Bồi dưỡng</option>
                                                <option ';
												if($row['hinhthuchoc']=='Tập trung')
												echo'selected';
												echo ' value="Tập trung">Tập trung</option>
                                                 <option ';
												 if($row['hinhthuchoc']=='Không tập trung')
												 echo'selected';
												 echo' value="Không tập trung">Không tập trung</option>
                                                <option ';
												if($row['hinhthuchoc']=='Khác')
												echo 'selected ';
												echo 'value="Khác">Khác</option>
                                            </select></td>';

		   echo ' <td width="100px">   <select style="width:100px" name="vanbang'.$row['id'].'" id="vanbang'.$row['id'].'"  onKeyPress="keypress(0,
		   '.$row['id'].')"   >
                                                 <option ';
												 if($row['vanbang']=='')
												 echo 'selected';
												 echo ' value="">---Chọn---</option>';
                                                 if($row['vanbang']=='TSKH')
												 echo'selected';
												 echo' value="TSKH">TSKH</option>
                                                 <option ';
												 if($row['vanbang']=='TS')
												 echo'selected';
												 echo' value="TS">TS</option>
                                                 <option ';
												 if($row['vanbang']=='NCS')
												 echo 'selected';
												 echo' value="NCS">NCS</option>
                                                 <option ';
												 if($row['vanbang']=='Ths')
												 echo 'selected';
												 echo' value="Ths">Ths</option>
                                                 <option ';
												 if($row['vanbang']=='Cử nhân')
												 echo'selected';
												 echo' value="Cử nhân">Cử nhân</option>
                                                 <option ';
												 if($row['vanbang']=='Kỹ sư')
												 echo'selected';
												 echo' value="Kỹ sư">Kỹ sư</option>
                                                 <option ';
												 if($row['vanbang']=='Cao đẳng')
												 echo'selected';
												 echo' value="Cao đẳng">Cao đẳng</option>
                                                 <option ';
												 if($row['vanbang']=='Trung cấp')
												 echo 'selected';
												 echo' value="Trung cấp">Trung cấp</option>
                                                 <option ';
												 if($row['vanbang']=='Sơ cấp')
												 echo 'selected';
												 echo' value="Sơ cấp">Sơ cấp</option>
                                                 <option ';
												 if($row['vanbang']=='Chuyên ngành')
												 echo'selected';
												 echo' value="Chuyên ngành">Chuyên ngành</option>
                                                 <option ';
												 if($row['vanbang']=='Bằng tốt nghiệp')
												 echo'selected';
												 echo' value="Bằng tốt nghiệp">Bằng tốt nghiệp</option>
                                                 <option ';
												 if($row['vanbang']=='Chứng chỉ')
												 echo'selected';
												 echo' value="Chứng chỉ">Chứng chỉ</option>
                                                <option ';
												if($row['vanbang']=='Khác')
												echo'selected';
												echo ' value="Khác">Khác</option>
                                            </select></td>';

		   		echo '      <td width="80px">   <select style="width:80px" name="noidaotao'.$row['id'].'" id="noidaotao'.$row['id'].'"   onKeyPress="keypress(0,
		   '.$row['id'].')"  >
                                                 <option ';
												 if($row['noidaotao']=="")
												 echo'selected';
												 echo' value="">---Chọn---</option>
                                                 <option ';
												 if($row['noidaotao']=='Trong nước')
												 echo'selected';
												 echo' value="Trong nước">Trong nước</option>
                                                 <option ';
												 if($row['noidaotao']=='Ngoài nước')
												 echo'selected';
												 echo' value="Ngoài nước">Ngoài nước</option>
                                                  <option ';
												 if($row['noidaotao']=='Liên kết')
												 echo'selected';
												 echo'  value="Liên kết">Liên kết</option>
                                                <option ';
												if($row['noidaotao']=='Khác')
												echo'selected';
												echo'  value="Khác">Khác</option>
                                            </select></td>';
		   echo '<td> <select name="khoahoc'.$row['id'].'" id="khoahoc'.$row['id'].'"   onKeyPress="keypress(0,
		   '.$row['id'].')"   >
                                                 <option';
												  if($row['khoahoc']=='')
												  echo' selected';
												  echo' value="">---Chọn---</option>
                                                 <option ';
												 if($row['khoahoc']=='Ngắn hạn')
												 echo 'selected';
												 echo' value="Ngắn hạn">Ngắn hạn</option>
                                                 <option ';
												 if($row['khoahoc']=='Dài hạn')
												 echo'selected';
												 echo' value="Dài hạn">Dài hạn</option>
                                              
                                            </select></td>';
	       echo '<td width="68px"> <input type="text"  name="dean'.$row['id'].'" id="dean'.$row['id'].'" value="'.$row['dean'].'" size="8" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
		  
		   echo '<td > <input style="width:135px"   type="month" name="thangnamcu'.$row['id'].'" id="thangnamcu'.$row['id'].'" value="'.$row['ngaycudi'].'" onKeyPress="keypress(0,
		   '.$row['id'].')"   /></td >';
	      echo ' <td width="56px">  <input size ="5" name="doituong'.$row['id'].'" id="doituong'.$row['id'].'" value ="'.$row['doituong'].'" /></td>';	
											  echo '<td width="68px"> <input type="text" name="qdinh'.$row['id'].'" id="qdinh'.$row['id'].'" value="'.$row['quyetdinh'].'" size="8" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
		   echo '<td ><button name="btnDelete" class="btnDelete" value = "'.$row['id'].'" >Xóa</button>
		   <button name="btnUpdate" class="btnUpdate"  value = "'.$row['id'].'" >Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr >
                                        
                                        <td >
                                           <input autofocus type="text" name="tentruong" id="tentruong" size="15" onKeyPress="keypress(1,0)" />
                                        </td>
                                        <td >
                                               <input type="text" name="lophoc" id="lophoc" size="20" onKeyPress="keypress(1,0)"  />  
                                        </td>
                                        <td>
                                                <input type="text" name="thoigian" id="thoigian" size="15"  onKeyPress="keypress(1,0)" /> 
                                        </td>
                                        <td width="100px" >
                                       
                                            <select name="hinhthuc" id="hinhthuc"  style="width:100px"  onKeyPress="keypress(1,0)" >
                                                <option value="">---Chọn---</option>
                                                <option value="Chính quy">Chính quy</option>
                                                 <option value="Tại chức">Tại chức</option>
                                                <option value="Chuyên tu">Chuyên tu</option>
                                                 <option value="Bồi dưỡng">Bồi dưỡng</option>
                                                <option value="Tập trung">Tập trung</option>
                                                 <option value="Không tập trung">Không tập trung</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </td>
                                           <td width="100px">
                                      
                                             <select name="vanbang" id="vanbang"  style="width:100px"   onKeyPress="keypress(1,0)"  >
                                                 <option value="">---Chọn---</option>
                                                 <option value="TSKH">TSKH</option>
                                                 <option value="TS">TS</option>
                                                 <option value="NCS">NCS</option>
                                                 <option value="Ths">Ths</option>
                                                 <option value="Cử nhân">Cử nhân</option>
                                                 <option value="Kỹ sư">Kỹ sư</option>
                                                 <option value="Cao đẳng">Cao đẳng</option>
                                                 <option value="Trung cấp">Trung cấp</option>
                                                 <option value="Sơ cấp">Sơ cấp</option>
                                                 <option value="Chuyên ngành">Chuyên ngành</option>
                                                 <option value="Bằng tốt nghiệp">Bằng tốt nghiệp</option>
                                                 <option value="Chứng chỉ">Chứng chỉ</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </td>
                                        <td width="80px">
                                               
                                                <select name="noidaotao" style="width:80px" id="noidaotao" onKeyPress="keypress(1,0)"  >
                                                 <option value="">---Chọn---</option>
                                                 <option value="Trong nước">Trong nước</option>
                                                 <option value="Ngoài nước">Ngoài nước</option>
                                                  <option value="Liên kết">Liên kết</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </td>
                                        <td width="80px" >
                                               
                                                  <select name="khoahoc" id="khoahoc" style="width:80px"   onKeyPress="keypress(1,0)"  >
                                                 <option value="">---Chọn---</option>
                                                 <option value="Ngắn hạn">Ngắn hạn</option>
                                                 <option value="Dài hạn">Dài hạn</option>
                                              
                                            </select>
                                        </td>
                                       <td  >
                                            <input type="text" name="dean" id="dean" size="8" onKeyPress="keypress(1,0)" /> 
                                        </td>
                                      
                                        <td width="100px">
                                               <input type="month" style="width:135px"  name="thangnamcu" id="thangnamcu" style="width:150px"onKeyPress="keypress(1,0)" />  
                                        </td>
                                        <td >
                                                  <select name="doituong" id="doituong"  >
                                                 <option value="">Chọn</option>
                                                 <option value="I">I</option>
                                                 <option value="II">II</option>
                                                  <option value="III">III</option>
                                                 <option value="IV">IV</option>
                                                 <option value="V">V</option>
                                                 <option value="Khác">Khác</option>
                                            </select>
                                        </td>
                                             <td >
                                            <input type="text" name="qdinh" id="qdinh" size="8" onKeyPress="keypress(1,0)" />
                                        </td>
                                        <td>
                                           <button name="btnInsert" class="btnInsert" >Thêm</button>
                                        </td>
                                    </tr>
                                    
                                    
                                    
                          
                        
                        
                        
  
                    
                    </tbody></table>
</div>
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
	$("button.btnUpdate").click(
	  function(){
       // alert($(this).attr("value"));
       keypress100(0,$(this).attr("value"))	
	
}
	);
   $("button.btnInsert").click(
	  function(){
       // alert($(this).attr("value"));
       keypress100(1,$(this).attr("value"))	
	
}
	);
	
  </script>
</body>
</html>
<?php
  }
  ?>