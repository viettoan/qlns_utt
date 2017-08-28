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
    text-align: left;
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
                    <script >

                      function keypress(str,str1) {


                        var thoidiem,bac,heso,vuotkhung,mangach,ngach, phantram_hs;
                        if(str == 0){
                          thoidiem = document.getElementById("thoidiem"+str1).value;
                          bac = document.getElementById("bac"+str1).value;
                          heso = document.getElementById("hesoluong"+str1).value;
                          vuotkhung = document.getElementById("vuotkhung"+str1).value;
                          mangach = document.getElementById("mangach"+str1).value;
                          ngach = document.getElementById("ngach"+str1).value;
                          phantram_hs = document.getElementById("phantram_hs"+str1).value;
                        }
                        else if(str==1){
                          thoidiem = document.getElementById("thoidiem").value;
                          bac = document.getElementById("bac").value;
                          heso = document.getElementById("hesoluong").value;
                          vuotkhung = document.getElementById("vuotkhung").value;
                          mangach = document.getElementById("mangach").value;
                          ngach = document.getElementById("ngach").value;
                          phantram_hs = document.getElementById("phantram_hs").value;
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
              document.getElementById("load_salary").innerHTML = xmlhttp.responseText;
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_salary.php?action="+str+"&&thoidiem="+thoidiem+"&&bac="+bac+"&&heso="+heso+"&&ngach="+ngach+"&&mangach="+mangach+"&&vuotkhung="+vuotkhung+"&&phantram_hs="+phantram_hs+"&&id="+str1,true);
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
              document.getElementById("load_salary").innerHTML = xmlhttp.responseText;
            }
          };
          xmlhttp.open("GET","../load_data/load_salary.php?action="+str+"&&id="+str1,true);
          xmlhttp.send();
          event.preventDefault();
        }
      }
 // });*/
}


function keypress100(str,str1) {


  var thoidiem,bac,heso,vuotkhung,mangach,ngach, phantram_hs;
  if(str == 0){
    thoidiem = document.getElementById("thoidiem"+str1).value;
    bac = document.getElementById("bac"+str1).value;
    heso = document.getElementById("hesoluong"+str1).value;
    vuotkhung = document.getElementById("vuotkhung"+str1).value;
    mangach = document.getElementById("mangach"+str1).value;
    ngach = document.getElementById("ngach"+str1).value;
    phantram_hs =document.getElementById("phantram_hs"+str1).value;
  }
  else if(str==1){
    thoidiem = document.getElementById("thoidiem").value;
    bac = document.getElementById("bac").value;
    heso = document.getElementById("hesoluong").value;
    vuotkhung = document.getElementById("vuotkhung").value;
    mangach = document.getElementById("mangach").value;
    ngach = document.getElementById("ngach").value;
    phantram_hs = document.getElementById("phantram_hs").value;
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
              document.getElementById("load_salary").innerHTML = xmlhttp.responseText;
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_salary.php?action="+str+"&&thoidiem="+thoidiem+"&&bac="+bac+"&&heso="+heso+"&&ngach="+ngach+"&&mangach="+mangach+"&&vuotkhung="+vuotkhung+"&&phantram_hs="+phantram_hs+"&&id="+str1,true);
    xmlhttp.send();
    event.preventDefault();


 // });*/
}


function keypress1(str,str1) {


  var loaihdlaodong,ngayhdlaodong,loaihdlamviec,ngayhdlamviec;
  if(str1 != 0){
    loaihdlaodong = document.getElementById("loaihdlaodong"+str1).value;
    ngayhdlaodong = document.getElementById("ngayhdlaodong"+str1).value;
    loaihdlamviec = document.getElementById("loaihdlamviec"+str1).value;
    ngayhdlamviec = document.getElementById("ngayhdlamviec"+str1).value;

  }
  else{
    loaihdlaodong = document.getElementById("loaihdlaodong").value;
    ngayhdlaodong = document.getElementById("ngayhdlaodong").value;
    loaihdlamviec = document.getElementById("loaihdlamviec").value;
    ngayhdlamviec = document.getElementById("ngayhdlamviec").value;

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
              document.getElementById("load_contract").innerHTML = xmlhttp.responseText;
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_contract.php?action="+str+"&&ngayhdlaodong="+ngayhdlaodong+"&&loaihdlaodong="+loaihdlaodong+"&&ngayhdlamviec="+ngayhdlamviec+"&&loaihdlamviec="+loaihdlamviec+"&&id="+str1,true);
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
              document.getElementById("load_contract").innerHTML = xmlhttp.responseText;
            }
          };
          xmlhttp.open("GET","../load_data/load_contract.php?action="+str+"&&id="+str1,true);
          xmlhttp.send();
          event.preventDefault();
        }
      }
 // });*/
}

function keypress101(str,str1) {


  var loaihdlaodong,ngayhdlaodong,loaihdlamviec,ngayhdlamviec;
  if(str1 != 0){
    loaihdlaodong = document.getElementById("loaihdlaodong"+str1).value;
    ngayhdlaodong = document.getElementById("ngayhdlaodong"+str1).value;
    loaihdlamviec = document.getElementById("loaihdlamviec"+str1).value;
    ngayhdlamviec = document.getElementById("ngayhdlamviec"+str1).value;

  }
  else{
    loaihdlaodong = document.getElementById("loaihdlaodong").value;
    ngayhdlaodong = document.getElementById("ngayhdlaodong").value;
    loaihdlamviec = document.getElementById("loaihdlamviec").value;
    ngayhdlamviec = document.getElementById("ngayhdlamviec").value;

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
              document.getElementById("load_contract").innerHTML = xmlhttp.responseText;
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_contract.php?action="+str+"&&ngayhdlaodong="+ngayhdlaodong+"&&loaihdlaodong="+loaihdlaodong+"&&ngayhdlamviec="+ngayhdlamviec+"&&loaihdlamviec="+loaihdlamviec+"&&id="+str1,true);
    xmlhttp.send();
    event.preventDefault();


 // });*/
}


function keypress2(str,str1) {


  var loaihdlaodong,ngayhdlaodong,loaihdlamviec,ngayhdlamviec;
  if(str1 != 0){
    ngaythangnam = document.getElementById("ngaythangnam"+str1).value;
    nhanxet = document.getElementById("nhanxet"+str1).value;
    lydo = document.getElementById("lydo"+str1).value;

  }
  else{
    ngaythangnam = document.getElementById("ngaythangnam").value;
    nhanxet = document.getElementById("nhanxet").value;
    lydo = document.getElementById("lydo").value;


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
              document.getElementById("load_comment").innerHTML = xmlhttp.responseText;
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_comment.php?action="+str+"&&ngaythangnam="+ngaythangnam+"&&nhanxet="+nhanxet+"&&lydo="+lydo+"&&id="+str1,true);
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
              document.getElementById("load_comment").innerHTML = xmlhttp.responseText;
            }
          };
          xmlhttp.open("GET","../load_data/load_comment.php?action="+str+"&&id="+str1,true);
          xmlhttp.send();
          event.preventDefault();
        }
      }
 // });*/
}

function keypress102(str,str1) {


  var loaihdlaodong,ngayhdlaodong,loaihdlamviec,ngayhdlamviec;
  if(str1 != 0){
    ngaythangnam = document.getElementById("ngaythangnam"+str1).value;
    nhanxet = document.getElementById("nhanxet"+str1).value;
    lydo = document.getElementById("lydo"+str1).value;

  }
  else{
    ngaythangnam = document.getElementById("ngaythangnam").value;
    nhanxet = document.getElementById("nhanxet").value;
    lydo = document.getElementById("lydo").value;


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
              document.getElementById("load_comment").innerHTML = xmlhttp.responseText;
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_comment.php?action="+str+"&&ngaythangnam="+ngaythangnam+"&&nhanxet="+nhanxet+"&&lydo="+lydo+"&&id="+str1,true);
    xmlhttp.send();
    event.preventDefault();


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
              document.getElementById("bac").innerHTML = xmlhttp.responseText;
              document.getElementById("hesoluong").innerHTML ="";

              var check = document.getElementById("bac").value;
              if(check!='')
               $("#mangach").val(check);

           }
         };

         xmlhttp.open("GET","../load_data/load_bac_ngach.php?id="+str,true);
         xmlhttp.send();
         event.preventDefault();
       }

       function keypress52() {
        ngach = document.getElementById("ngach").value;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("bac").innerHTML = xmlhttp.responseText;
              document.getElementById("hesoluong").innerHTML =""; 
              var check = document.getElementById("bac").value;
              if(check!='')
               $("#mangach").val(check);
           }
         };

         xmlhttp.open("GET","../load_data/load_bac_ngach.php?id="+ngach,true);
         xmlhttp.send();
         event.preventDefault();
       }

       function keypress51(str) {

        var manganh ;
        manganh = $("#ngach"+str).val();
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("bac"+str).innerHTML = xmlhttp.responseText;
              document.getElementById("hesoluong"+str).innerHTML =""; 
              var check = $("#bac"+str).val();

              if(check!='')
               $("#mangach"+str).val(check);
           }
         };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_bac_ngach.php?id="+manganh,true);
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
              document.getElementById("bac").innerHTML = xmlhttp.responseText;
              document.getElementById("hesoluong").innerHTML =""; 
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_bac.php?id="+str,true);
    xmlhttp.send();
    event.preventDefault();

 // });*/
}

function keypress62() {

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
              document.getElementById("bac").innerHTML = xmlhttp.responseText;
              document.getElementById("hesoluong").innerHTML =""; 
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_bac.php?id="+mangach,true);
    xmlhttp.send();
    event.preventDefault();

 // });*/
}


function keypress61(str) {

 var mangach ;
 mangach = $("#mangach"+str).val();
 if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("bac"+str).innerHTML = xmlhttp.responseText;
              document.getElementById("hesoluong"+str).innerHTML =""; 
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_bac.php?id="+mangach,true);
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
              document.getElementById("hesoluong").innerHTML = xmlhttp.responseText;
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_heso.php?id="+str+"&&mangach="+mangach,true);
    xmlhttp.send();
    event.preventDefault();

 // });*/
}

function keypress72() {
  var bac = $("#bac").val();
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
              document.getElementById("hesoluong").innerHTML = xmlhttp.responseText;
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_heso.php?id="+bac+"&&mangach="+mangach,true);
    xmlhttp.send();
    event.preventDefault();

 // });*/
}


function keypress71(str) {

  var bac = $("#bac"+str).val();
  var mangach = $("#mangach"+str).val();
  if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("hesoluong"+str).innerHTML = xmlhttp.responseText;
            }
          };

		//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_heso.php?id="+bac+"&&mangach="+mangach,true);
    xmlhttp.send();
    event.preventDefault();

 // });
}

function keypress8(str) {
  $("#mangach").val(str);
}

function keypress81(str) {
 var mangach =  $("#ngach"+str).val();
 $("#mangach"+str).val(mangach);
}

function keypress82() {
 var mangach =  $("#ngach").val();
 $("#mangach").val(mangach);
}

</script>
<div style="width:63%;float:left;margin-left:10px" >
 <div id="s_box" style="text-align:center"><h1>QUÁ TRÌNH LƯƠNG VÀ HỢP ĐỒNG - <?php if(isset($_SESSION['hoten'])) echo $_SESSION['hoten'] ?></h1></div>

 <div  style="overflow:auto"">
  <fieldset >
   <legend>Quá trình lương của bản thân: </legend>
   <table class="kyluat" border="1" >
    <thead>
     <th>Tháng/năm</th>
     <th>Ngạch</th>
     <th> Mã ngạch</th>
     <th>Bậc</th>
     <th> Hệ số lương</th>
     <th>85%</th>
     <th> V. khung</th>
     <th>Hành động</th>
   </thead>
   <tbody id="load_salary">
     <?php

function createcb4($table,$col1,$cmt,$selected=0,$keypress){ // hàm tạo select
  $sql1="select $col1 from $table ";
  $re_s=mysql_query($sql1);
  $ar=array();
  while($row=mysql_fetch_array($re_s)){
    $ar[$row[$col1]]=$row[$col1];
  }
  echo '<select '.$keypress.'
  required  name="'.$table.'" id='.$table.' style="margin-left:5px;">';
  echo'<option value="">Chọn</option>';
  foreach ($ar as $k => $v) {
    echo '<option '.($selected==$k?"selected":"").' $keypress  value="'.$k.'">'.$v.'</option>';
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
            echo '<select '.$keypress.' required name="mangach" id="mangach" style="margin-left:5px;">';
            echo'<option value="">chọn</option>';
           	  /*	  $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
		  $result_check = mysql_query($check);
		  $row_check = mysql_fetch_row($result_check);
		  $check_select = $row_check[0];
     if($check_select!=0){*/
      foreach ($ar as $k => $v) {
        echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
      }
		/*		
 }*/
 echo '</select>';
}

		        function createcb6($table,$col1,$cmt,$selected=0,$keypress){ // hàm tạo select
              $sql1="select $col1 from $table  ";
              $re_s=mysql_query($sql1);
              $ar=array();
              while($row=mysql_fetch_array($re_s)){
                $ar[$row[$col1]]=$row[$col1];
              }
              echo '<select '.$keypress.' required   name="hesoluong" id="hesoluong" style="margin-left:5px;">';
              echo'<option value="">chọn</option>';
      	/*	  $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
		  $result_check = mysql_query($check);
		  $row_check = mysql_fetch_row($result_check);
		  $check_select = $row_check[0];
			if($check_select!=0){
				foreach ($ar as $k => $v) {
				  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
				}
				
      }*/
      echo '</select>';
    }
		       function createcb10($table,$col1,$cmt,$selected=0,$keypress){ // hàm tạo select
            $sql1="select $col1 from $table  ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select '.$keypress.' required  name="bac" id="bac" >';
            echo'<option value="">-chọn</option>';

		/*	   foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
            }*/
            echo '</select>';
          }

		 function createcb51($table,$col1,$col2,$cmt,$selected=0,$keypress,$stt){ // hàm tạo select
      $sql1="select $col1,$col2 from $table   ";
      $re_s=mysql_query($sql1);
      $ar=array();
      while($row=mysql_fetch_array($re_s)){
        $ar[$row[$col1]]=$row[$col2];
        $temp = $row[$col1];
      }
      echo '<select '.$keypress.' onChange="keypress61('.$stt.')" required name="mangach'.$stt.'" id="mangach'.$stt.'" style="margin-left:5px;">';
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

		        function createcb61($table,$col1,$cmt,$selected=0,$keypress,$ten,$dk,$ten1,$dk1,$stt){ // hàm tạo select
              $sql1="select $col1 from $table inner join ngach on ngach.id=$table.ngachid where $ten = '$dk' and $ten1 ='$dk1'  ";
              $re_s=mysql_query($sql1);
              $ar=array();
              while($row=mysql_fetch_array($re_s)){
                $ar[$row[$col1]]=$row[$col1];
              }
              echo '<select '.$keypress.'required   name="hesoluong'.$stt.'" id="hesoluong'.$stt.'" style="margin-left:5px;">';
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
		       function createcb101($table,$col1,$cmt,$selected=0,$keypress,$ten,$dk,$stt){ // hàm tạo select
            $sql1="select $col1 from $table inner join ngach on ngach.id=$table.ngachid where $ten='$dk' ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select '.$keypress.' onChange="keypress71('.$stt.')" required  name="bac'.$stt.'" id="bac'.$stt.'" >';
            echo'<option value="">-chọn</option>';
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
		function createcb41($table,$col1,$cmt,$selected=0,$keypress,$stt){ // hàm tạo select
      $sql1="select $col1 from $table ";
      $re_s=mysql_query($sql1);
      $ar=array();
      while($row=mysql_fetch_array($re_s)){
        $ar[$row[$col1]]=$row[$col1];
      }
      echo '<select onChange="keypress51('.$stt.');keypress81('.$stt.')" '.$keypress.' required  name="ngach'.$stt.'" id="ngach'.$stt.'" style="margin-left:5px;">';
      echo'<option value="">Chọn</option>';
      foreach ($ar as $k => $v) {
        echo '<option '.($selected==$k?"selected":"").' $keypress  value="'.$k.'">'.$v.'</option>';
      }
      echo '</select>';
    }
    $query = "Select * from quatrinhluong where lylich_id = '$_SESSION[lylich_id]'";

    $result = mysql_query($query);


    while($row = mysql_fetch_array($result)){
      $thoidiem = substr( $row['thoidiem'],0,7);

      echo '<tr> ';

      echo '<td> <input type="month" name="thoidiem'.$row['id'].'" id="thoidiem'.$row['id'].'" value="'.$thoidiem .'" size="20" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
      echo '<td> ';
      createcb41('ngach','tenngach','name',$row['ngach'],'onKeyPress="keypress(0,'.$row['id'].')"' ,$row['id']);
      echo'</td>';
      echo '<td> ';
      createcb51('ngach','mangach','mangach','name',$row['mangach'],'onKeyPress="keypress(0,'.$row['id'].')"',$row['id']);
      echo' </td>';	
      echo '<td> 
      ';
      createcb101('bac_heso','bac','name',$row['bac'],'onKeyPress="keypress(0,'.$row['id'].')"' ,'mangach',$row['mangach'],$row['id']);
      echo'</td>';
      echo '<td> ';
      createcb61('bac_heso','heso','name',$row['heso'],'onKeyPress="keypress(0,'.$row['id'].')"','mangach',$row['mangach'],'bac',$row['bac'],$row['id']);
      echo'</td>';	
      // echo '<td> <input type="checkbox" name="phantram_hs'.$row['id'].'" id="phantram_hs'.$row['id'].'" value="'.$row['phantram_hs'].'" ';
      // if($row['phantram_hs']) echo " checked "; 
      // echo 'onKeyPress="keypress(0,'.$row['id'].')"  />';

      echo "<td><select name='phantram_hs".$row['id']."' id='phantram_hs".$row['id']."' >";
       if($row['phantram_hs']==0){
      echo"<option value='0' selected>Không</option>";
      echo"<option value='1'>Có</option>";
       } 
       else{
      echo"<option value='1' selected>Có</option>";
      echo"<option value='0' >Không</option>";
       }
       echo"</select></td>";
      echo '<td> <input type="text" name="vuotkhung'.$row['id'].'" id="vuotkhung'.$row['id'].'" value="'.$row['vuotkhung'].'" size="5" 
      onKeyPress="keypress(0,'.$row['id'].')"  />';

      echo'</td>';

      echo '<td><button name="btnDelete" class="btnDelete" value = "'.$row['id'].'" >Xóa</button>
      <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')" >Sửa</button>
    </td>';
    echo'</tr>';
  }
  ?>
  <tr>
    <td >
     <input type="month" name="thoidiem" id="thoidiem" size="20" onKeyPress="keypress(1,0)"  />
   </td>
   <td >

     <?php createcb4("ngach",'tenngach','name','0','onKeyPress="keypress(1,0)"') ?>
   </td>
   <td>

    <?php createcb5("ngach",'mangach','mangach','name','0','onKeyPress="keypress(1,0)') ?>
  </td>
  <td>

   <?php createcb10("bac_heso",'bac','name','0','onKeyPress="keypress(1,0)"') ?>
 </td>
 <td>

  <?php createcb6("bac_heso",'heso','name','0','onKeyPress="keypress(1,0)') ?>
</td>
<td>
  <!-- <input type="checkbox" name="phantram_hs" id="phantram_hs" size="15" onKeyPress="keypress(1,0)"  />  -->
  <select name="phantram_hs" id="phantram_hs">
                          <option value="0">Không</option>
                          <option value="1">Có</option>
                        </select>
</td>
<td>
  <input type="text" name="vuotkhung" id="vuotkhung" size="5" onKeyPress="keypress(1,0)"  /> 

</td>


<td>
 <button name="btnInsert" name="btnInsert"  onClick="keypress100(1,0)">Thêm</button>
</td>

</tr>
</tbody></table>
</fieldset >
<fieldset >
 <legend>Thông tin hợp đồng</legend>

 <table class="kyluat" border="1"  >
   <th>Loại HĐ lao động</th>
   <th> Ngày HĐ lao động</th>
   <th>Loại HĐ làm việc</th>
   <th> Ngày HĐ làm việc</th>
   <th>Hành động</th>
 </thead>
 <tbody id="load_contract">
  <?php



  $query = "Select * from hopdong where lylich_id = '$_SESSION[lylich_id]'";

  $result = mysql_query($query);


  while($row = mysql_fetch_array($result)){


    echo '<tr> ';

    echo '<td> 
    <select  name="loaihdlaodong'.$row['id'].'" id="loaihdlaodong'.$row['id'].'"  onKeyPress="keypress1(0,'.$row['id'].')"  >
     <option   value="">Chọn</option>
     <option ';
     if($row['loaihdlaodong']=='Hợp đồng vụ việc')
       echo " selected ";
     echo  'value="Hợp đồng vụ việc">Hợp đồng vụ việc</option>
     <option ';
     if($row['loaihdlaodong']=='Hợp đồng 1 năm')
       echo " selected ";
     echo  'value="Hợp đồng 1 năm">Hợp đồng 1 năm</option>
     <option ';
     if($row['loaihdlaodong']=='Hợp đồng 2 năm')
       echo " selected ";
     echo  'value="Hợp đồng 2 năm">Hợp đồng 2 năm</option>
     <option ';
     if($row['loaihdlaodong']=='Hợp đồng 3 năm')
      echo " selected ";
    echo '  value="Hợp đồng 3 năm">Hợp đồng 3 năm</option>
    <option';
    if($row['loaihdlaodong']=='HĐ không xác định thời hạn')
      echo " selected ";
    echo'   value="HĐ không xác định thời hạn">HĐ không xác định thời hạn</option>  
  </select> 
</td>';
echo '<td> <input type="date" name="ngayhdlaodong'.$row['id'].'" id="ngayhdlaodong'.$row['id'].'" value="'.$row['ngayhdlaodong'].'" size="20" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
echo '<td> 
<select name="loaihdlamviec'.$row['id'].'" id="loaihdlamviec'.$row['id'].'" 
onKeyPress="keypress1(0,'.$row['id'].')"  /> 
<option value="">Chọn</option>
<option';
if($row['loaihdlamviec']=='Hợp đồng thử việc')
 echo " selected ";
echo ' value="Hợp đồng thử việc">Hợp đồng thử việc (1 năm)</option>
<option';
if($row['loaihdlamviec']=="Hợp đồng 2 năm")
 echo " selected ";
echo ' value="Hợp đồng 2 năm">Hợp đồng 2 năm</option>
<option ';
if($row['loaihdlamviec']=="Hợp đồng 3 năm")
 echo " selected ";
echo ' value="Hợp đồng 3 năm">Hợp đồng 3 năm</option>
<option ';
if($row['loaihdlamviec']=="HĐ không xác định thời hạn")
 echo " selected ";
echo' value="HĐ không xác định thời hạn">HĐ không xác định thời hạn</option>  
</select>
</td> ';
echo '<td> <input type="date" name="ngayhdlamviec'.$row['id'].'" id="ngayhdlamviec'.$row['id'].'" value="'.$row['ngayhdlamviec'].'" size="20" 
onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';	

echo '<td><button name="btnDelete1" class="btnDelete1" value = "'.$row['id'].'" onClick="keypress101(-1,'.$row['id'].')">Xóa</button>
<button name="btnUpdate" class="btnUpdate" onClick="keypress101(0,'.$row['id'].')">Sửa</button>
</td>';
echo'</tr>';
}
?>
<tr >

  <td >

   <select   name="loaihdlaodong" id="loaihdlaodong"  onKeyPress="keypress1(1,0)"  >
     <option   value="">Chọn</option>
     <option   value="Hợp đồng vụ việc">Hợp đồng vụ việc</option>
     <option   value="Hợp đồng 1 năm">Hợp đồng 1 năm</option>
     <option   value="Hợp đồng 2 năm">Hợp đồng 2 năm</option>
     <option   value="Hợp đồng 3 năm">Hợp đồng 3 năm</option>
     <option   value="HĐ không xác định thời hạn">HĐ không xác định thời hạn</option>  
   </select> 
 </td>
 <td>
  <input type="date" name="ngayhdlaodong" id="ngayhdlaodong" size="20"  onKeyPress="keypress1(1,0)"  /> 
</td>
<td>

 <select name="loaihdlamviec" id="loaihdlamviec"  onKeyPress="keypress1(1,0)"  >
  <option value="">Chọn</option>
  <option value="Hợp đồng thử việc">Hợp đồng thử việc (1 năm)</option>
  <option value="Hợp đồng 2 năm">Hợp đồng 2 năm</option>
  <option value="Hợp đồng 3 năm">Hợp đồng 3 năm</option>
  <option  value="HĐ không xác định thời hạn">HĐ không xác định thời hạn</option>  
</select>
</td>
<td>
  <input type="date" name="ngayhdlamviec" id="ngayhdlamviec" size="20" onKeyPress="keypress1(1,0)"   /> 

</td>
<td>
 <button id="btnInsert" name="btnInsert" onClick="keypress101(1,0)">Thêm</button>
</td>


</tr>
</tbody></table>

</fieldset>
<fieldset >
 <legend>Đánh giá phân loại hằng năm</legend>

 <table class="kyluat" border="1"  >
  <thead>
   <th width="20%">Ngày/Tháng/Năm</th>
   <th width="30%">Nhận xét đánh giá</th>
   <th width="40%">Lý do không đánh giá</th>
   <th>Hành động</th>
 </thead>
 <tbody id="load_comment">
  <?php




  $query = "Select * from danhgia where lylich_id = '$_SESSION[lylich_id]'";

  $result = mysql_query($query);


  while($row = mysql_fetch_array($result)){


    echo '<tr> ';

    echo '<td> <input type="date" name="ngaythangnam'.$row['id'].'" id="ngaythangnam'.$row['id'].'" value="'.$row['nam'].'"  onKeyPress="keypress2(0,'.$row['id'].')"  /></td>';
    echo '<td> 


    <select name="nhanxet'.$row['id'].'" id="nhanxet'.$row['id'].'" 
    onKeyPress="keypress2(0,'.$row['id'].')"  /> 
    <option value="">Chọn</option>
    <option';
    if($row['nhanxetdanhgia']=='Hoàn thành xuất sắc nhiệm vụ')
     echo " selected ";
   echo ' value="Hoàn thành xuất sắc nhiệm vụ">Hoàn thành xuất sắc nhiệm vụ</option>
   <option';
   if($row['nhanxetdanhgia']=="Hoàn thành tốt nhiệm vụ")
     echo " selected ";
   echo ' value="Hoàn thành tốt nhiệm vụ">Hoàn thành tốt nhiệm vụ</option>
   <option ';
   if($row['nhanxetdanhgia']=="Hoàn thành nhiệm vụ")
     echo " selected ";
   echo' value="Hoàn thành nhiệm vụ">Hoàn thành nhiệm vụ</option> <option ';
   if($row['nhanxetdanhgia']=="Không hoàn thành nhiệm vụ")
     echo " selected ";
   echo ' value="Không hoàn thành nhiệm vụ">Không hoàn thành nhiệm vụ</option></select>
 </td>';

 echo '<td> <input type="text" name="lydo'.$row['id'].'" id="lydo'.$row['id'].'" value="'.$row['lydo'].'"  onKeyPress="keypress2(0,'.$row['id'].')"  /></td>';

 echo '<td><button name="btnDelete2" class="btnDelete2" value = "'.$row['id'].'" >Xóa</button>
 <button name="btnUpdate" class="btnUpdate" onClick="keypress102(0,'.$row['id'].')">Sửa</button>
</td>';
echo'</tr>';
}
?>
<tr>
  <td >
   <input type="date" name="ngaythangnam" id="ngaythangnam"  OnKeyPress="keypress2(1,0)"  />
 </td>
 <td>
   <select  name="nhanxet" id="nhanxet"  OnKeyPress="keypress2(1,0)">
     <option value="">Chọn</option>
     <option value="Hoàn thành xuất sắc nhiệm vụ">Hoàn thành xuất sắc nhiệm vụ</option>
     <option value="Hoàn thành tốt nhiệm vụ">Hoàn thành tốt nhiệm vụ</option>
     <option value="Hoàn thành nhiệm vụ">Hoàn thành nhiệm vụ</option>
     <option value="Không hoàn thành nhiệm vụ">Không hoàn thành nhiệm vụ</option>
   </select>
 </td>
 <td>
  <input type="text" name="lydo" id="lydo"   OnKeyPress="keypress2(1,0)"  /> 
</td>

<td><button name="btnInsert" id="btnInsert" onClick="keypress102(1,0)">Thêm</button></td>


</tr>
</tbody></table>

</fieldset>
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
  $("button.btnDelete1").click(
   function(){
       // alert($(this).attr("value"));
       keypress1(2,$(this).attr("value"))	

     }
     );
  $("button.btnDelete2").click(
   function(){
       // alert($(this).attr("value"));
       keypress2(2,$(this).attr("value"))	

     }
     );
  $(document).ready(function(e) {
    $("#ngach").change(
      function(e){
        keypress5($(this).attr("value"));
        keypress8($(this).attr("value"));

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
    $("#bac").change(
      function(e){
        keypress7($(this).attr("value"));

      }

      );
  });
</script>
</body>
</html>
<?php
}
?>