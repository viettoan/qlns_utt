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
                  
                 <script>
						  
function keypress(str,str1) {
    
          
		  var thoigian,diadiem,donvi,coquan,chucvu;
		  if(str1 != 0){
				  thoigian = document.getElementById("thoigianlamviec"+str1).value;
				  diadiem = document.getElementById("diadiem"+str1).value;
				  donvi = document.getElementById("donvi"+str1).value;
			      coquan = document.getElementById("coquan"+str1).value;
				  chucvu = document.getElementById("chucvu"+str1).value;
				
		  }
		  else{
			  	  thoigian = document.getElementById("thoigianlamviec").value;
				  diadiem = document.getElementById("diadiem").value;
				  donvi = document.getElementById("donvi").value;
			      coquan = document.getElementById("coquan").value;
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
                document.getElementById("load_chedocu").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_chedocu.php?action="+str+"&&thoigian="+thoigian+"&&chucvu="+chucvu+"&&diadiem="+diadiem+"&&donvi="+donvi+"&&coquan="+coquan+"&&id="+str1,true);
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
                document.getElementById("load_chedocu").innerHTML = xmlhttp.responseText;
            }
        };
		       xmlhttp.open("GET","../load_data/load_chedocu.php?action="+str+"&&id="+str1,true);
	       xmlhttp.send();
     event.preventDefault();
	 }
 }
 // });*/
}


function keypress100(str,str1) {
    
          
		  var thoigian,diadiem,donvi,coquan,chucvu;
		  if(str1 != 0){
				  thoigian = document.getElementById("thoigianlamviec"+str1).value;
				  diadiem = document.getElementById("diadiem"+str1).value;
				  donvi = document.getElementById("donvi"+str1).value;
			      coquan = document.getElementById("coquan"+str1).value;
				  chucvu = document.getElementById("chucvu"+str1).value;
				
		  }
		  else{
			  	  thoigian = document.getElementById("thoigianlamviec").value;
				  diadiem = document.getElementById("diadiem").value;
				  donvi = document.getElementById("donvi").value;
			      coquan = document.getElementById("coquan").value;
				  chucvu = document.getElementById("chucvu").value;

			
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
                document.getElementById("load_chedocu").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_chedocu.php?action="+str+"&&thoigian="+thoigian+"&&chucvu="+chucvu+"&&diadiem="+diadiem+"&&donvi="+donvi+"&&coquan="+coquan+"&&id="+str1,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}


function keypress1(str,str1) {
    
          
		  var lydo,thoidiem_batdau,thoidiem_ketthuc,odau,khaibaocho,vande;
		  if(str1 != 0){
				  lydo = document.getElementById("lydo"+str1).value;
				  thoidiem_batdau = document.getElementById("thoidiem_batdau"+str1).value;
				  thoidiem_ketthuc = document.getElementById("thoidiem_ketthuc"+str1).value;
			      odau = document.getElementById("odau"+str1).value;
				  khaibaocho = document.getElementById("khaibaocho"+str1).value;
				  vande = document.getElementById("vande"+str1).value;
		  }
		  else{
			  	  lydo = document.getElementById("lydo").value;
				  thoidiem_batdau = document.getElementById("thoidiem_batdau").value;
				  thoidiem_ketthuc = document.getElementById("thoidiem_ketthuc").value;
			      odau = document.getElementById("odau").value;
				  khaibaocho = document.getElementById("khaibaocho").value;
                  vande = document.getElementById("vande").value;
			
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
                document.getElementById("load_trespass").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_trespass.php?action="+str+"&&lydo="+lydo+"&&odau="+odau+"&&khaibaocho="+khaibaocho+"&&thoidiem_batdau="+thoidiem_batdau+"&&thoidiem_ketthuc="+thoidiem_ketthuc+"&&vande="+vande+"&&id="+str1,true);
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
                document.getElementById("load_trespass").innerHTML = xmlhttp.responseText;
            }
        };
		       xmlhttp.open("GET","../load_data/load_trespass.php?action="+str+"&&id="+str1,true);
	       xmlhttp.send();
     event.preventDefault();
	 }
 }
 // });*/
}

function keypress101(str,str1) {
    
          
		  var lydo,thoidiem_batdau,thoidiem_ketthuc,odau,khaibaocho,vande;
		  if(str1 != 0){
				  lydo = document.getElementById("lydo"+str1).value;
				  thoidiem_batdau = document.getElementById("thoidiem_batdau"+str1).value;
				  thoidiem_ketthuc = document.getElementById("thoidiem_ketthuc"+str1).value;
			      odau = document.getElementById("odau"+str1).value;
				  khaibaocho = document.getElementById("khaibaocho"+str1).value;
				  vande = document.getElementById("vande"+str1).value;
		  }
		  else{
			  	  lydo = document.getElementById("lydo").value;
				  thoidiem_batdau = document.getElementById("thoidiem_batdau").value;
				  thoidiem_ketthuc = document.getElementById("thoidiem_ketthuc").value;
			      odau = document.getElementById("odau").value;
				  khaibaocho = document.getElementById("khaibaocho").value;
                  vande = document.getElementById("vande").value;
			
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
                document.getElementById("load_trespass").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_trespass.php?action="+str+"&&lydo="+lydo+"&&odau="+odau+"&&khaibaocho="+khaibaocho+"&&thoidiem_batdau="+thoidiem_batdau+"&&thoidiem_ketthuc="+thoidiem_ketthuc+"&&vande="+vande+"&&id="+str1,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}

						  </script>
    <div style="width:75%;float:left;margin-left:10px;overflow:auto">
  <div id="s_box" style="text-align:center"><h1>LỊCH SỬ BẢN THÂN- <?php if(isset($_SESSION['hoten'])) echo $_SESSION['hoten'] ?></h1></div>
                              <div >
                              <fieldset >
                               <legend>Phạm pháp</legend>
                                <table class="kyluat" border="1"  >
                                    <thead>
                                       <th>Thời gian bị bắt</th>
                                       <th>Thời gian kết thúc</th>
                                       <th>Khai báo cho ai</th>
                                       <th>Vấn đề khai báo</th>
                                    
                                       <th>Ở đâu </th>
                                       <th>Lý do</th>
                                       <th>Hành động</th>
                                     </thead>
                                    <tbody id="load_trespass">
                                     <?php
                                        

        
				  $query = "Select * from phamphap where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> <input type="date" name="thoidiem_batdau'.$row['id'].'" id="thoidiem_batdau'.$row['id'].'" value="'.$row['thoidiem_batdau'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
		   echo '<td> <input type="date" name="thoidiem_ketthuc'.$row['id'].'" id="thoidiem_ketthuc'.$row['id'].'" value="'.$row['thoidiem_ketthuc'].'" size="25" 
		   onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="khaibaocho'.$row['id'].'" id="khaibaocho'.$row['id'].'" value="'.$row['khaibaocho'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
					   echo '<td> <input type="text" name="vande'.$row['id'].'" id="vande'.$row['id'].'" value="'.$row['vande'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
					   		   echo '<td> <input type="text" name="odau'.$row['id'].'" id="odau'.$row['id'].'" value="'.$row['odau'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
					   				   echo '<td> <input type="text" name="lydo'.$row['id'].'" id="lydo'.$row['id'].'" value="'.$row['lydo'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
						
		   echo '<td><button name="btnDelete1" class="btnDelete1" value = "'.$row['id'].'" >Xóa</button>
		      <button name="btnUpdate" class="btnUpdate" onClick="keypress101(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="date" name="thoidiem_batdau" id="thoidiem_batdau" size="25" onKeyPress="keypress1(1,0)"  />
                                        </td>
                                          <td >
                                           <input type="date" name="thoidiem_ketthuc" id="thoidiem_ketthuc" size="25" onKeyPress="keypress1(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="text" name="khaibaocho" id="khaibaocho" size="25" onKeyPress="keypress1(1,0)"   />  
                                        </td>
                                        <td>
                                                <input type="text" name="vande" id="vande" size="25" onKeyPress="keypress1(1,0)"  /> 
                                        </td>
                                   
                                           <td >
                                           <input type="text" name="odau" id="odau" size="25"  onKeyPress="keypress1(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="text" name="lydo" id="lydo" size="25" onKeyPress="keypress1(1,0)"   />  
                                      </td>
                                  <td><button name="btnInsert" id="btnInsert" onClick="keypress101(1,0)">Thêm</button></td>
                                      
                                    </tr>
                                    </tbody></table>
                                    </fieldset >
                                     <fieldset >
                               <legend>Chế độ cũ</legend>
                                <table class="kyluat" border="1"  >
                                    <thead>
                                       <th>Thời gian(Số ngày hoặc số năm)</th>
                                       <th>Cơ quan</th>
                                       <th>Đơn vị</th>
                                    
                                       <th>Chức vụ </th>
                                       <th>Địa điểm</th>
                                       <th>Hành động</th>
                                     </thead>
                                    <tbody id="load_chedocu">
                                        <?php
                                        

        
				  $query = "Select * from chedocu where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> <input type="number" name="thoigianlamviec'.$row['id'].'" id="thoigianlamviec'.$row['id'].'" value="'.$row['thoigian'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   echo '<td> <input type="text" name="coquan'.$row['id'].'" id="coquan'.$row['id'].'" value="'.$row['coquan'].'" size="30" 
		   onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="donvi'.$row['id'].'" id="donvi'.$row['id'].'" value="'.$row['donvi'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
					   echo '<td> <input type="text" name="chucvu'.$row['id'].'" id="chucvu'.$row['id'].'" value="'.$row['chucvu'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
					   				   echo '<td> <input type="text" name="diadiem'.$row['id'].'" id="diadiem'.$row['id'].'" value="'.$row['diadiem'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
						
		   echo '<td><button name="btnDelete" class="btnDelete" value = "'.$row['id'].'" >Xóa</button>
		       <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="number" name="thoigianlamviec" id="thoigianlamviec" size="30" onKeyPress="keypress(1,0)"   />
                                        </td>
                                        <td >
                                               <input type="text" name="coquan" id="coquan" size="30"  onKeyPress="keypress(1,0)"   />  
                                        </td>
                                        <td>
                                                <input type="text" name="donvi" id="donvi" size="30"  onKeyPress="keypress(1,0)"  /> 
                                        </td>
                                   
                                           <td >
                                           <input type="text" name="chucvu" id="chucvu" size="30" onKeyPress="keypress(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="text" name="diadiem" id="diadiem" size="30" onKeyPress="keypress(1,0)"  />  
                                      </td>
                                  <td>
                                    <button id="btnInsert" name="btnInsert" onClick="keypress100(1,0)">Thêm</button>
                                  </td>
                                      
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
	</script>
</body>
</html>
<?php
  }
  ?>