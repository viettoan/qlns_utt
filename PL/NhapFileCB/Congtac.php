<?php
  ob_start();
  session_start();
  include("../../config/config.php");
  include("../../library/config.php");
  include("../../library/function.php");
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
                  
                <script>

function keypress(str,str1) {
    
          
		  var thoidiembatdau,thoidiemketthuc,chucvu;
		  if(str1 != 0){
				  thoidiembatdau = document.getElementById("thoidiembatdau"+str1).value;
				  thoidiemketthuc = document.getElementById("thoidiemketthuc"+str1).value;
				  chucvu = document.getElementById("chucvu"+str1).value;
			
		  }
		  else{
			  	  thoidiembatdau = document.getElementById("thoidiembatdau").value;
				  thoidiemketthuc = document.getElementById("thoidiemketthuc").value;
				  chucvu = document.getElementById("chucvu").value;
			
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
                document.getElementById("load_bussiness").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_business.php?action="+str+"&&thoidiembatdau="+thoidiembatdau+"&&thoidiemketthuc="+thoidiemketthuc+"&&chucvu="+chucvu+"&&id="+str1,true);
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
                document.getElementById("load_bussiness").innerHTML = xmlhttp.responseText;
            }
        };
		       xmlhttp.open("GET","../load_data/load_business.php?action="+str+"&&id="+str1,true);
	       xmlhttp.send();
     event.preventDefault();
	 }
 }
 // });*/
}

function keypress100(str,str1) {
    var thoidiembatdau, thoidiemketthuc, chucvu, image;
    if(str1 != 0){
        thoidiembatdau = document.getElementById("thoidiembatdau" + str1).value;
        image = document.getElementById("image" + str1);
        thoidiemketthuc = document.getElementById("thoidiemketthuc" + str1).value;
        chucvu = document.getElementById("chucvu" + str1).value;
        type = document.getElementById("image" + str1).getAttribute("data-type");

    } else {
        thoidiembatdau = document.getElementById("thoidiembatdau").value;
        thoidiemketthuc = document.getElementById("thoidiemketthuc").value;
        image = document.getElementById("image").value;
        chucvu = document.getElementById("chucvu").value;
        type = document.getElementById("image").getAttribute("data-type");
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
        document.getElementById("load_bussiness").innerHTML = xmlhttp.responseText;
    }
};

//var comment = document.getElementById("txtComment").text;

    xmlhttp.open("GET","../load_data/load_business.php?action="+str+"&&thoidiembatdau="+thoidiembatdau+"&&thoidiemketthuc="+thoidiemketthuc+"&&chucvu="+chucvu+"&&image="+image+"&&type="+type+"&&id="+str1,true);
    xmlhttp.send();
    event.preventDefault();
}
</script>
<div style="width:70% ;float:left;margin-left:10px;">
        <div id="s_box" style="text-align:center"><h1>CÔNG TÁC - <?php  if(isset($_SESSION['hoten'])) echo $_SESSION['hoten'] ?> </h1></div>                   
            <form enctype="multipart/form-data">            
                                <table class="kyluat" border="1"  style="width:100%">
                                    <thead>
                                       <th>Thời điểm bắt đầu</th>
                                       <th>Thời điểm kết thúc</th>
                                       <th>Chức danh, chức vụ, đơn vị công tác</th>
									   <th>Hình ảnh</th>
                                       <th>Hành động</th>
                                    </thead>
                                    <tbody id="load_bussiness">
                                                  <?php
                                        

        
				  $query = "Select * from congtac where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  $batdau = substr( $row['thoidiem_batdau'],0,7);
							  $ketthuc =substr( $row['thoidiem_ketthuc'],0,7);
					
									 echo '<tr> ';
		   
           echo '<td style="width:140px" > <input style="width:140px" type="month" name="thoidiembatdau'.$row['id'].'" id="thoidiembatdau'.$row['id'].'" value="'.$batdau.'" size="25" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   
		   echo '<td style="width:140px" > <input style="width:140px"  type="month" name="thoidiemketthuc'.$row['id'].'"
				    id="thoidiemketthuc'.$row['id'].'" value="'.$ketthuc .'" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   
		   echo '<td> <input type="text" name="chucvu'.$row['id'].'" id="chucvu'.$row['id'].'" value="'.$row['chucvu'].'" size="100" 
		   onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   echo '<td>hình ảnh</td>';
		
		   echo '<td><button name="btnDelete" class="btnDelete" value = "'.$row['id'].'" >Xóa</button>
		      <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr >
                                        <td style="width:140px" >
                                           <input style="width:140px"  type="month"  name="thoidiembatdau" id="thoidiembatdau" size="25" onKeyPress=""="keypress(1,0)"  />
                                        </td>
                                         <td style="width:140px" >
                                           <input style="width:140px"  type="month"   name="thoidiemketthuc" id="thoidiemketthuc" size="25" onKeyPress="keypress(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="text" name="chucvu" id="chucvu" size="100" onKeyPress="keypress(1,0)"  />  
                                        </td>
                    										<td>
                    											<input type="file" name="image" id="image" onKeyPress="keypress(1,0)" data-type ="<?php echo $type_image['congtac']; ?>" />
                    										</td>
                                        <td >
                                                <button name="btnInsert" id="btnInsert" onClick="keypress100(1,0)" >Thêm</button>
                                        </td>
                                    </tr>
                    </tbody></table>
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
		  </form>
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