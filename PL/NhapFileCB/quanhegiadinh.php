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
    
          
		  var quanhe,hoten,namsinh,mota;
		  if(str1 != 0){
				  quanhe = document.getElementById("quanhe"+str1).value;
				  hoten = document.getElementById("hoten"+str1).value;
				  namsinh = document.getElementById("namsinh"+str1).value;
			      mota = document.getElementById("lienquan"+str1).value;
				
		  }
		  else{
			  	  quanhe = document.getElementById("quanhe").value;
				  hoten = document.getElementById("hoten").value;
				  namsinh = document.getElementById("namsinh").value;
			      mota = document.getElementById("lienquan").value;
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
			
				    document.getElementById("load_quanhegiadinh").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_quanhegiadinh.php?action="+str+"&&quanhe="+quanhe+"&&hoten="+hoten+"&&namsinh="+namsinh+"&&mota="+mota+"&&id="+str1,true);
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
			
                     document.getElementById("load_quanhegiadinh").innerHTML = xmlhttp.responseText;
            }
        };
		       xmlhttp.open("GET","../load_data/load_quanhegiadinh.php?action="+str+"&&id="+str1,true);
	       xmlhttp.send();
     event.preventDefault();
	 }
 }
 // });*/
}

function keypress100(str,str1) {
    
          
		  var quanhe,hoten,namsinh,mota;
		  if(str1 != 0){
				  quanhe = document.getElementById("quanhe"+str1).value;
				  hoten = document.getElementById("hoten"+str1).value;
				  namsinh = document.getElementById("namsinh"+str1).value;
			      mota = document.getElementById("lienquan"+str1).value;
				
		  }
		  else{
			  	  quanhe = document.getElementById("quanhe").value;
				  hoten = document.getElementById("hoten").value;
				  namsinh = document.getElementById("namsinh").value;
			      mota = document.getElementById("lienquan").value;
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
			
				    document.getElementById("load_quanhegiadinh").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_quanhegiadinh.php?action="+str+"&&quanhe="+quanhe+"&&hoten="+hoten+"&&namsinh="+namsinh+"&&mota="+mota+"&&id="+str1,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}


function keypress1(str,str1) {
    
          
		  var quanhe,hoten,namsinh,mota;
		  if(str1 != 0){
				  quanhe = document.getElementById("quanhe_1"+str1).value;
				  hoten = document.getElementById("hoten1"+str1).value;
				  namsinh = document.getElementById("namsinh1"+str1).value;
			      mota = document.getElementById("lienquan1"+str1).value;
				
		  }
		  else{
			  	  quanhe = document.getElementById("quanhe_1").value;
				  hoten = document.getElementById("hoten1").value;
				  namsinh = document.getElementById("namsinh1").value;
			      mota = document.getElementById("lienquan1").value;
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
			
				    document.getElementById("load_thonggia").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_thonggia.php?action="+str+"&&quanhe="+quanhe+"&&hoten="+hoten+"&&namsinh="+namsinh+"&&mota="+mota+"&&id="+str1,true);
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
			
                     document.getElementById("load_thonggia").innerHTML = xmlhttp.responseText;
            }
        };
		       xmlhttp.open("GET","../load_data/load_thonggia.php?action="+str+"&&id="+str1,true);
	       xmlhttp.send();
     event.preventDefault();
	 }
 }
 // });*/
}


function keypress101(str,str1) {
    
          
		  var quanhe,hoten,namsinh,mota;
		  if(str1 != 0){
				  quanhe = document.getElementById("quanhe_1"+str1).value;
				  hoten = document.getElementById("hoten1"+str1).value;
				  namsinh = document.getElementById("namsinh1"+str1).value;
			      mota = document.getElementById("lienquan1"+str1).value;
				
		  }
		  else{
			  	  quanhe = document.getElementById("quanhe_1").value;
				  hoten = document.getElementById("hoten1").value;
				  namsinh = document.getElementById("namsinh1").value;
			      mota = document.getElementById("lienquan1").value;
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
			
				    document.getElementById("load_thonggia").innerHTML = xmlhttp.responseText;
            }
        };
	
		//var comment = document.getElementById("txtComment").text;
	
        xmlhttp.open("GET","../load_data/load_thonggia.php?action="+str+"&&quanhe="+quanhe+"&&hoten="+hoten+"&&namsinh="+namsinh+"&&mota="+mota+"&&id="+str1,true);
        xmlhttp.send();
     event.preventDefault();

 // });*/
}
						  </script>
                          <div style="width:70%;float:left;margin-left:10px;overflow:auto" >
                 <div id="s_box" style="text-align:center"><h1>QUAN HỆ GIA ĐÌNH - <?php if(isset($_SESSION['hoten'])) echo $_SESSION['hoten'] ?></h1></div>
                              <div >
                              <fieldset >
                               <legend>Về bản thân: Bố, Mẹ, Vợ(chồng), các con, anh chị em ruột</legend>
                                <table class="kyluat" border="1"  >
                                    <thead>
                                       <th>Quan hệ</th>
                                       <th>Họ và tên</th>
                                       <th>Năm sinh</th>
                                       <th>  Quê quán, nghề nghiệp, chức danh, chức vụ, đơn vị, công tác, học tập, nơi  ở (trong, ngoài nước)</th>
                                       <th>Hành động</th>
                                     </thead>
                                    <tbody id="load_quanhegiadinh">
                                    			
                                                                                                                <?php
                                        

        
				  $query = "Select * from quanhegiadinh where lylich_id = '$_SESSION[lylich_id]' and banthan_vochong='0'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> 
					    <select   id="quanhe'.$row['id'].'" name="quanhe'.$row['id'].'"  onKeyPress="keypress(0,'.$row['id'].')" >
						                         <option value="" >Chọn</option>
                                                 <option';
												 if($row['quanhe']=='Bố')
												   echo " selected ";
												 echo' value="Bố">Bố</option>
                                                 <option';
												  if($row['quanhe']=='Mẹ')
												   echo " selected ";
												 echo' value="Mẹ">Mẹ</option>
                                                 <option ';
												 if($row['quanhe']=='Vợ')
												   echo " selected ";
												 echo ' value="Vợ" >Vợ</option>
                                                 <option ';
												  if($row['quanhe']=='Chồng')
												   echo " selected ";
												 echo'value="Chồng">Chồng</option>
                                                 <option ';
												  if($row['quanhe']=='Con trai')
												   echo " selected ";
												 echo  'value="Con trai">Con trai</option>
                                                 <option ';
												 if($row['quanhe']=='Con gái')
												   echo " selected ";
												  echo'value="Con gái">Con gái</option>
                                                 <option ';
												  if($row['quanhe']=='Anh trai')
												   echo " selected ";
												 echo' value="Anh trai">Anh trai</option>
                                                 <option ';
												 if($row['quanhe']=='Chị gái')
												   echo " selected ";
												 echo' value="Chị gái">Chị gái</option>
                                                 <option ';
												  if($row['quanhe']=='Em trai')
												   echo " selected ";
												 echo ' value="Em trai">Em trai</option>
                                                 <option ';
												 if($row['quanhe']=='Em gái')
												   echo " selected ";
												 echo 'value="Em gái">Em gái</option>
                                           </select>
					   </td>';
		   echo '<td> <input type="text" name="hoten'.$row['id'].'" id="hoten'.$row['id'].'" value="'.$row['hoten'].'" size="20" 
		   onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   	   echo '<td> <input type="number" name="namsinh'.$row['id'].'" id="namsinh'.$row['id'].'" value="'.$row['namsinh'].'" size="20" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="lienquan'.$row['id'].'" id="lienquan'.$row['id'].'" value="'.$row['mota'].'" size="80" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
				
						
		   echo '<td><button name="btnDelete" class="btnDelete" value = "'.$row['id'].'" >Xóa</button>
		      <button class="btnUpdate" name="btnUpdate" onClick="keypress100(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           
                                           <select name="quanhe" id="quanhe" onKeyPress="keypress(1,0)" >
                                                 <option value="">Chọn</option>
                                                 <option value="Bố">Bố</option>
                                                 <option value="Mẹ">Mẹ</option>
                                                 <option value="Vợ">Vợ</option>
                                                 <option value="Chồng">Chồng</option>
                                                 <option value="Con trai">Con trai</option>
                                                 <option value="Con gái">Con gái</option>
                                                 <option value="Anh trai">Anh trai</option>
                                                 <option value="Chị gái">Chị gái</option>
                                                 <option value="Em trai">Em trai</option>
                                                 <option value="Em gái">Em gái</option>
                                           </select>
                                        </td>
                                        <td >
                                               <input type="text" name="hoten" id="hoten" size="20" onKeyPress="keypress(1,0)"  />  
                                        </td>
                                        <td>
                                                <input type="number" max="4" name="namsinh" id="namsinh" size="20" onKeyPress="keypress(1,0)" /> 
                                        </td>
                                        <td>
                                                <input type="text" name="lienquan" id="lienquan" size="80" onKeyPress="keypress(1,0)" /> 
                                        </td>
                                        <td>
                                             <button id="btnInsert" name="btnInsert" onClick="keypress100(1,0)">Thêm</button>
                                        </td>
                                  
                                      
                                    </tr>
                                    </tbody></table>
                                    </fieldset >
                                     <fieldset >
                               <legend>Bố, Mẹ, anh chị em ruột (bên vợ hoặc chồng)</legend>
                                
                        <table class="kyluat" border="1"  >
                                    <thead>
                                       <th>Quan hệ</th>
                                       <th>Họ và tên</th>
                                       <th>Năm sinh</th>
                                       <th>  Quê quán, nghề nghiệp, chức danh, chức vụ, đơn vị, công tác, học tập, nơi  ở (trong, ngoài nước)</th>
                                       <th>Hành động</th>
                                     </thead>
                                    <tbody id="load_thonggia">
                                                                             <?php
                                        

        
				  $query = "Select * from quanhegiadinh where lylich_id = '$_SESSION[lylich_id]' and banthan_vochong='1'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> 
					       <select name="quanhe_1'.$row['id'].'" id="quanhe_1'.$row['id'].'"  onKeyPress="keypress1(0,'.$row['id'].')"  >
                                                 <option value="">Chọn</option>
                                                 <option ';
												 if($row['quanhe']=='Bố')
												    echo ' selected ';
												 echo'value="Bố">Bố</option>
                                                 <option ';
												  if($row['quanhe']=='Mẹ')
												    echo ' selected ';
												 echo' value="Mẹ">Mẹ</option>
                                                 <option ';
												  if($row['quanhe']=='Anh vợ')
												    echo ' selected ';
												 echo ' value="Anh vợ">Anh vợ</option>
                                                 <option ';
												  if($row['quanhe']=='Chị vợ')
												    echo ' selected ';
												 echo' value="Chị vợ">Chị vợ</option>
                                                 <option ';
												  if($row['quanhe']=='Em vợ')
												    echo ' selected ';
												 echo' value="Em vợ">Em vợ</option>
                                                 <option ';
												  if($row['quanhe']=='Anh chồng')
												    echo ' selected ';
												 echo 'value="Anh chồng">Anh chồng</option>
                                                 <option ';
												  if($row['quanhe']=='Chị chồng')
												    echo ' selected ';
												 echo' value="Chị chồng">Chị chồng</option>
                                                 <option ';
												  if($row['quanhe']=='Em chồng')
												    echo ' selected ';
												 echo'value="Em chồng">Em chồng</option>
                                                
                                           </select>
					   </td>';
		   echo '<td> <input type="text" name="hoten1'.$row['id'].'" id="hoten1'.$row['id'].'" value="'.$row['hoten'].'" size="20" 
		   onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
		   	   echo '<td> <input type="number" name="namsinh1'.$row['id'].'" id="namsinh1'.$row['id'].'" value="'.$row['namsinh'].'" size="20" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="lienquan1'.$row['id'].'" id="lienquan1'.$row['id'].'" value="'.$row['mota'].'" size="80" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
				
						
		   echo '<td><button name="btnDelete1" class="btnDelete1" value = "'.$row['id'].'" >Xóa</button>
		      <button class="btnUpdate" name="btnUpdate" onClick="keypress101(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                         
                                                 <select name="quanhe_1" id="quanhe_1"  onKeyPress="keypress1(1,0)" >
                                                 <option value="">Chọn</option>
                                                 <option value="Bố">Bố</option>
                                                 <option value="Mẹ">Mẹ</option>
                                                 <option value="Anh vợ">Anh vợ</option>
                                                 <option value="Chị vợ">Chị vợ</option>
                                                 <option value="Em vợ">Em vợ</option>
                                                 <option value="Anh chồng">Anh chồng</option>
                                                 <option value="Chị chồng">Chị chồng</option>
                                                 <option value="Em chồng">Em chồng</option>
                                                
                                           </select>
                                        </td>
                                        <td >
                                               <input type="text" name="hoten1" id="hoten1" size="20" onKeyPress="keypress1(1,0)"   />  
                                        </td>
                                        <td>
                                                <input type="number" max="4" name="namsinh1" id="namsinh1" size="20" onKeyPress="keypress1(1,0)"   /> 
                                        </td>
                                        <td>
                                                <input type="text" name="lienquan1" id="lienquan1" size="80" onKeyPress="keypress1(1,0)"   /> 
                                        </td>
                                        <td>
                                             <button name="btnInsert" id="btnInsert" onClick="keypress101(1,0)" >Thêm</button>
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