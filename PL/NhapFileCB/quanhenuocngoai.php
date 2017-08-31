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
    
          
		  var lamgi,tochuc,truso;
		  if(str1 != 0){
				  lamgi = document.getElementById("nhiemvu"+str1).value;
				  tochuc = document.getElementById("tochuc"+str1).value;
				  truso = document.getElementById("truso"+str1).value;
			  
				
		  }
		  else{
			  	  lamgi = document.getElementById("nhiemvu").value;
				
				  tochuc = document.getElementById("tochuc").value;
			      truso = document.getElementById("truso").value;
			
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
                document.getElementById("load_quanhenuocngoai").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_quanhenuocngoai.php?action="+str+"&&lamgi="+lamgi+"&&truso="+truso+"&&tochuc="+tochuc+"&&id="+str1,true);
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
                document.getElementById("load_quanhenuocngoai").innerHTML = xmlhttp.responseText;
            }
        };
		       xmlhttp.open("GET","../load_data/load_quanhenuocngoai.php?action="+str+"&&id="+str1,true);
	       xmlhttp.send();
     event.preventDefault();
	 }
 }
 // });*/
}


function keypress100(str,str1) {
    
          
		  var lamgi,tochuc,truso;
		  if(str1 != 0){
				  lamgi = document.getElementById("nhiemvu"+str1).value;
				  tochuc = document.getElementById("tochuc"+str1).value;
				  truso = document.getElementById("truso"+str1).value;
			  
				
		  }
		  else{
			  	  lamgi = document.getElementById("nhiemvu").value;
				
				  tochuc = document.getElementById("tochuc").value;
			      truso = document.getElementById("truso").value;
			
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
                document.getElementById("load_quanhenuocngoai").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_quanhenuocngoai.php?action="+str+"&&lamgi="+lamgi+"&&truso="+truso+"&&tochuc="+tochuc+"&&id="+str1,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}



function keypress1(str,str1) {
    
          
		  var quanhe,hoten,lamgi,diachi;
		  if(str1 != 0){
				  lamgi = document.getElementById("congviec"+str1).value;
				  hoten = document.getElementById("hoten"+str1).value;
				  diachi = document.getElementById("diachi"+str1).value;
			      quanhe = document.getElementById("quanhe"+str1).value;
				
		  }
		  else{
			  	  lamgi = document.getElementById("congviec").value;
				
				  hoten = document.getElementById("hoten").value;
			      diachi = document.getElementById("diachi").value;
			      quanhe = document.getElementById("quanhe").value;
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
                document.getElementById("load_thannhannuocngoai").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_thannhannuocngoai.php?action="+str+"&&lamgi="+lamgi+"&&quanhe="+quanhe+"&&hoten="+hoten+"&&diachi="+diachi+"&&id="+str1,true);
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
                document.getElementById("load_thannhannuocngoai").innerHTML = xmlhttp.responseText;
            }
        };
		       xmlhttp.open("GET","../load_data/load_thannhannuocngoai.php?action="+str+"&&id="+str1,true);
	       xmlhttp.send();
     event.preventDefault();
	 }
 }
 // });*/
}



function keypress101(str,str1) {
    
          
		  var quanhe,hoten,lamgi,diachi;
		  if(str1 != 0){
				  lamgi = document.getElementById("congviec"+str1).value;
				  hoten = document.getElementById("hoten"+str1).value;
				  diachi = document.getElementById("diachi"+str1).value;
			      quanhe = document.getElementById("quanhe"+str1).value;
				
		  }
		  else{
			  	  lamgi = document.getElementById("congviec").value;
				
				  hoten = document.getElementById("hoten").value;
			      diachi = document.getElementById("diachi").value;
			      quanhe = document.getElementById("quanhe").value;
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
                document.getElementById("load_thannhannuocngoai").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_thannhannuocngoai.php?action="+str+"&&lamgi="+lamgi+"&&quanhe="+quanhe+"&&hoten="+hoten+"&&diachi="+diachi+"&&id="+str1,true);
        xmlhttp.send();
     event.preventDefault();

}


						  </script>
 <div style="width:65%;float:left;margin-left:10px">
                 <div id="s_box" style="text-align:center" ><h1>QUAN HỆ NƯỚC NGOÀI - <?php if(isset($_SESSION['hoten'])) echo $_SESSION['hoten'] ?></h1></div>
                              <div >
                              <fieldset >
                               <legend>Quan hệ tổ chức nước ngoài</legend>
                                <table class="kyluat"  border="1" style="width:100%"  >
                                    <thead>
                                       <th>Tên tổ chức</th>
                                       <th>Trụ sở</th>
                                       <th>Nhiệm vụ</th>
                                       <th>Hành động</th>
                                     </thead>
                                    <tbody id="load_quanhenuocngoai">
                                                                                                                <?php
                                        

        
				  $query = "Select * from tochucnuocngoai where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> <input type="text" name="tochuc'.$row['id'].'" id="tochuc'.$row['id'].'" value="'.$row['tochuc'].'" size="40" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   echo '<td> <input type="text" name="truso'.$row['id'].'" id="truso'.$row['id'].'" value="'.$row['truso'].'" size="40" 
		   onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="nhiemvu'.$row['id'].'" id="nhiemvu'.$row['id'].'" value="'.$row['lamgi'].'" size="40" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
	
						
		   echo '<td><button name="btnDelete" class="btnDelete" value = "'.$row['id'].'" >Xóa</button>
		      <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="text" name="tochuc" id="tochuc" size="40" onKeyPress="keypress(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="text" name="truso" id="truso" size="40"  onKeyPress="keypress(1,0)"  />  
                                        </td>
                                        <td>
                                                <input type="text" name="nhiemvu" id="nhiemvu" size="40" onKeyPress="keypress(1,0)"  /> 
                                        </td>
                                        <td>
                                            <button name="btnInsert" id="btnInsert" onClick="keypress100(1,0)">Thêm</button>
                                        </td>
                                        
                                  
                                      
                                    </tr>
                                    </tbody></table>
                                    </fieldset >
                                     <fieldset >
                               <legend>Thân nhân ở nước ngoài</legend>
                                <table class="kyluat" border="1"  >
                                    <thead>
                                       <th>Mối quan hệ</th>
                                       <th>Họ tên</th>
                                       <th>Công việc </th>
                                    
                                       <th>Địa chỉ </th>
                                       <th>Hành động</th>
                                     </thead>
                                    <tbody id="load_thannhannuocngoai">
                                                                                                                                            <?php
                                        

        
				  $query = "Select * from thannhannuocngoai where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> <input type="text" name="quanhe'.$row['id'].'" id="quanhe'.$row['id'].'" value="'.$row['quanhe'].'" size="30" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
		   echo '<td> <input type="text" name="hoten'.$row['id'].'" id="hoten'.$row['id'].'" value="'.$row['hoten'].'" size="30" 
		   onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="congviec'.$row['id'].'" id="congviec'.$row['id'].'" value="'.$row['lamgi'].'" size="30" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
	
	  	   echo '<td> <input type="text" name="diachi'.$row['id'].'" id="diachi'.$row['id'].'" value="'.$row['diachi'].'" size="30" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
						
		   echo '<td><button name="btnDelete1" class="btnDelete1" value = "'.$row['id'].'" >Xóa</button>
		         <button name="btnUpdate" class="btnUpdate" onClick="keypress101(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="text" name="quanhe" id="quanhe" size="30" onKeyPress="keypress1(1,0)" />
                                        </td>
                                        <td >
                                               <input type="text" name="hoten" id="hoten" size="30" onKeyPress="keypress1(1,0)"  />  
                                        </td>
                                        <td>
                                                <input type="text" name="congviec" id="congviec" size="30" onKeyPress="keypress1(1,0)" /> 
                                        </td>
                                   
                                           <td >
                                           <input type="text" name="diachi" id="diachi" size="30" onKeyPress="keypress1(1,0)"  />
                                        </td>
                                      <td>
                                          <button id="btnInsert" name="btnInsert" onClick="keypress101(1,0)">Thêm</button>
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