<?php
  ob_start();
  session_start();
  include("../../config/config.php");
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
  ?>
<!--Search Function start-->
                        <script type="text/javascript">
                            function search_fucn() {
                                if((document.search_form.search_name.value()=="") ) {
                                    alert("Thông tin tìm kiếm chưa được điền vào!");
                                    document.search_form.search_name.focus();
                                    return false;
                                }else {
                                    return true;
                                }
                            }
                        </script>
                        <!--End of Search Function-->
<body>
    <script src="../../js/jquery-1.11.1.min.js"></script>
  <script src="../../js/jquery.js"></script>
<style>
  #taikhoan_bang td{
	   border:1px;
	   border-collapse:collapse;
	   border-bottom-style:solid;
  }
/*phần tử phủ toàn màn hình,không được hiển thị*/
#over {
    display: none;
    background: #000;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    opacity: 0.8;
    z-index: 999;
}

a, a:visited, a:active{
    text-decoration:none;
}

.register
{
    background-color:#85B561;
    height:auto;
    width:450px;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:14px;
    padding-bottom:5px;
    display:none;
    overflow:hidden;
    position:absolute;
    z-index:99999;
    top:20%;
    left:50%;
    margin-left:-300px;
	position:fixed;
}
 
.register .register_title
{
    color:white;
    font-size:16px;
    padding:8px 0 5px 8px;
    text-align:left;
}
 
.register-content label {
    display: block;
    padding-bottom: 7px;
}
 
.register-content span {
    display: block;
}
.register-content
{
    padding-left:35px;
    background-color:white;
    margin-left:5px;
    margin-right:5px;
    height:auto;
    padding-top:15px;
    overflow:hidden;
}
 
.img-close {
    float: right;
    margin-top:-43px;
    margin-right:5px
}

.button1{
    display: inline-block;
    min-width: 46px;
    text-align: center;
    color: #444;
    font-size: 14px;
    font-weight: 700;
    height: 36px;
    padding: 0px 8px;
    line-height: 36px;
    border-radius: 4px;
    transition: all 0.218s ease 0s;
    border: 1px solid #DCDCDC;
    background-color: #F5F5F5;
    background-image: -moz-linear-gradient(center top , #F5F5F5, #F1F1F1);
    cursor: pointer;
}
.class_a{
width: 30%;
cursor: pointer;
background: rgb(61, 157, 179);
padding: 8px 5px;
font-family: 'BebasNeueRegular','Arial Narrow',Arial,sans-serif;
color: #fff;
font-size: 24px;
border: 1px solid rgb(28, 108, 122);
margin-bottom: 10px;
text-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
-webkit-box-shadow: 0px 1px 6px 4px rgba(0, 0, 0, 0.07) inset, 0px 0px 0px 3px rgb(254, 254, 254), 0px 5px 3px 3px rgb(210, 210, 210);
-moz-box-shadow: 0px 1px 6px 4px rgba(0, 0, 0, 0.07) inset, 0px 0px 0px 3px rgb(254, 254, 254), 0px 5px 3px 3px rgb(210, 210, 210);
box-shadow: 0px 1px 6px 4px rgba(0, 0, 0, 0.07) inset, 0px 0px 0px 3px rgb(254, 254, 254), 0px 5px 3px 3px rgb(210, 210, 210);
-webkit-transition: all 0.2s linear;
-moz-transition: all 0.2s linear;
-o-transition: all 0.2s linear;
transition: all 0.2s linear;	
}
.button1:hover{
     border: 1px solid #DCDCDC;
    text-decoration: none;
    -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    box-shadow: 0 2px 2px rgba(0,0,0,0.1);
}

.register  input 
{
    border:1px solid #D5D5D5;
    border-radius:5px;
    box-shadow:1px 1px 5px rgba(0,0,0,.07) inset;
    color:black;
    font:12px/25px "Droid Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
    height:28px;
    padding:0px 8px;
    word-spacing:0.1em;
    width:300px;
}
.register  select 
{
    border:1px solid #D5D5D5;
    border-radius:5px;
    box-shadow:1px 1px 5px rgba(0,0,0,.07) inset;
    color:black;
    font:12px/25px "Droid Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
    height:28px;
    padding:0px 8px;
    word-spacing:0.1em;
    width:300px;
}
.submit-button{
    display: inline-block;
    padding: auto;
    margin: 15px 75px;
    width: 150px;
}
</style>
  
 <?php
      include("../../header1.php");
	    if(isset($_POST['btnDuyet'])){
	 $id=$_POST['btnDuyet'];
     $query="Update taikhoan set trangthai='1' where id='$id'";
	 $result=mysql_query($query);
	 if($result)
	    echo "<script>alert('Duyệt thành công !')</script>";
	 else
	   echo "<script>alert('Duyệt thất bại !')</script>";
  }
  ?>
 <!--Search Form start -->
 <script type="text/javascript">
     function search_func() {
        if(document.s_form.s_ten.value=="") {      
           
            if(document.s_form.s_donvi.value=="") {
                if(document.s_form.s_huyen.value=="") {
                    if(document.s_form.s_tinh.value=="") {
                        alert("Thông tin tìm kiếm chưa được nhập. Cần nhập ít nhất một thông tin tìm kiếm !");
                        
                        document.s_form.s_ten.focus();
                        return false;
                    }
                }
            }
        }else{
            return true;
        }
    }
 </script>
 

 
<!-- Thông tin tất cả các cán bộ
-->
    
  <div class="art-layout-wrapper">
    <div class="art-content-layout">
      <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
          <article class="art-post art-article">
            <div class="art-postcontent art-postcontent-0 clearfix">
              <div class="art-content-layout">
                <div class="art-content-layout-row">
                  <div class="art-layout-cell layout-item-1" style="width: 50%" >
                  <p>
                    <b>Tải tài liệu:</b><br>
                    <ul>
                      <li>Danh sách chi tiết cán bộ <a href="../../BLL/QuanLyCB/BLLDanhSachChiTiet.php">Download</a> | <a href="../../BLL/QuanLyCB/BLLDanhSachChiTiet_Online.php" target="_blank">Xem online</a></li>                      
                      <li><a href="../../BLL/QuanLyCB/BLLDanhSachTrichNgang.php">Danh sách trích ngang cán bộ</a></li>
                      <li><a href="../../BLL/QuanLyCB/BLLDanhSachDaoTao.php">Danh sách thông tin đào tạo</a></li>
                    </ul>                    
                  </p>                                                                       
                  <br />
          
          <fieldset style="width: auto; hight: 100l; margin: auto;">
          <legend>Tìm kiếm tài khoản</legend>
                <?php 
			     $sql_name=isset($_POST['s_taikhoan'])?$_POST['s_taikhoan']:'';
		
                
                $sql_quyen=isset($_POST['s_quyen'])?$_POST['s_quyen']:4;
				
				
				$sql_trangthai=isset($_POST['s_trangthai'])?$_POST['s_trangthai']:2;
				$sql_khuvuc=isset($_POST['s_khuvuc'])?$_POST['s_khuvuc']:0;
			
			?>
            <form name="s_form" action="" method="POST" action="#timkiem_table">
      
              <table id="timkiem_table" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: solid;  width: auto;">
                <tr>
                  <td width="20%" style="text-align: center">
                    Tài khoản:
                  </td>
                  <td>
                    <input type="text"  value="<?php echo $sql_name; ?>"  name="s_taikhoan" onChange="submit()" />
                  </td>
                  
                  <td width="20%" style="text-align: center">
                    Quyền:
                  </td>
                  <td >
                    <select name="s_quyen"  onChange="submit()"  >
                       <option <?php if($sql_quyen==4) echo "selected"; ?>  value="4">Chọn</option>
                       <option <?php if($sql_quyen==0) echo "selected"; ?> value="0">Thường</option>
                       <option <?php if($sql_quyen==1) echo "selected"; ?> value="1">Cấp cao</option>
                       <option <?php if($sql_quyen==2) echo "selected"; ?> value="2">Admin</option>
                       <option <?php if($sql_quyen==3) echo "selected"; ?> value="3">Admin_khuvuc</option>
                    </select>
                  </td>
                   <td width="20%" style="text-align: center">
                    Trạng thái:
                  </td>
                    <td >
                       <select name="s_trangthai" onChange="submit()" >
                        <option <?php if($sql_trangthai==0) echo "selected"; ?>  value="2">Chọn</option>
                       <option <?php if($sql_trangthai==1) echo "selected"; ?> value="1">Duyệt</option>
                       <option <?php if($sql_trangthai==0) echo "selected"; ?> value="0">Chưa duyệt</option>
                 
                    </select>
                  </td>
                  <?php if(!isset($_SESSION['khuvuc'])){ ?>
                   <td width="20%" style="text-align: center">
                    Khu vực:
                  </td>
                  <td >
                       <select name="s_khuvuc" onChange="submit()" >
                      
                       <option <?php if($sql_khuvuc==0) echo "selected"; ?>  value="0">Chọn</option>
                       <option <?php if($sql_khuvuc == 1) echo "selected"; ?> value="1">Hà Nội</option>
                       <option <?php if($sql_khuvuc == 2) echo "selected"; ?> value="2">Vĩnh Phúc</option>
                       <option <?php if($sql_khuvuc == 3) echo "selected"; ?> value="3">Thái Nguyên</option>
                 
                    </select>
                  </td>
                  <?php } ?>
                </tr>
              </table>
              <br />
          <!--   <form name="search" action="" method="POST">
                <input align="right" type="submit" name="search_submit" value="Tìm kiếm" />
              </form>-->
        
          
      <!--    <br />
          <h2>Kết quả tìm kiếm: </h2>
          <br />-->
          
         
          </fieldset>
         <!--Search Form stop -->
          
          <br/>
  
          
          <script type="text/javascript">
          $(document).ready(function(){ // ajax
            $("#s_box > select").change(function(){
              var fin;
              fin=$("#cosodaotao").val();
              fin=fin+'_'+$("#tochuctructhuoc").val();
              fin=fin+'_'+$("#khoaphongban").val();
              fin=fin+'_'+$("#bomonto").val();
              $.ajax({
                method:'post',
                dataType:"json",
                data:{thu:fin},
                url:'../ajax/fincb.php',
                success:function(data){
                  if(data){
                    $("#findcb").html(data.da);
                    if(data.tc){$("#tochuctructhuoc").html(data.tc);}
                    if(data.kh){$("#khoaphongban").html(data.kh);}
                    if(data.bm){$("#bomonto").html(data.bm);}
                  }
                }
              });
              console.log(fin);
            });
          });
          </script>
          <br/>
          <hr/>

            
            <div id="findcb">

            <?php
			   if(isset($_POST['account']))
			   {
				  $id =  isset($_POST['id'])? $_POST['id']:'';
				
				  $tendangnhap = isset($_POST['tendangnhap'])?  $_POST['tendangnhap']:'';
				  $matkhau = isset($_POST['matkhau'])? md5(addslashes( $_POST['matkhau'])):'';
				  $email = isset($_POST['email'])?  $_POST['email']:'';
				  $quyen = isset($_POST['role'])?  $_POST['role']:'';
				  $trangthai = isset($_POST['status'])?  $_POST['status']:'';
				  $khuvuc = isset($_POST['khuvuc'])?  $_POST['khuvuc']:'';
				  $hoten = isset($_POST['hoten'])?  $_POST['hoten']:'';
				  if($id!=0)
				  {
					  echo $id;
					   if($_SESSION['role']<$quyen||$quyen==0){
						   if(!isset($_SESSION['khuvuc']))
					 $query = "Update taikhoan set tendangnhap ='$tendangnhap',matkhau='$matkhau',email='$email',nhom='$quyen',trangthai='$trangthai' ,khuvuc=
					 '$khuvuc',hoten='$hoten'
					 where id = '$id'   ";
					 else
					      $query = "Update taikhoan set tendangnhap ='$tendangnhap',matkhau='$matkhau',email='$email',nhom='$quyen',trangthai='$trangthai' ,hoten='$hoten'
					 where id = '$id'   ";
					 $result=mysql_query($query);
					 if($result)
					    echo "<script>alert('Cập nhật thành công !');</script>";
				     else
					    echo "<script>alert('Cập nhật thất bại (Trùng tên đăng nhập !');</script>";
					   
				     } else{
						 echo "<script>alert('Bạn không đủ quyền để sửa tài khoản có quyền cao hơn hoặc bằng !');</script>";
					 }
				  }
				 
				  else{
					 if($_SESSION['role']<$quyen||$quyen==0){
						 if(!isset($_SESSION['khuvuc']))
						    $query = "Insert into taikhoan values('','$tendangnhap','$matkhau','$email','$quyen','$trangthai','$hoten','$khuvuc' ) ";
						 else
						    $query = "Insert into taikhoan values('','$tendangnhap','$matkhau','$email','$quyen','$trangthai','$hoten','$_SESSION[khuvuc]' ) ";
						 $result=mysql_query($query);
						 if($result)
							echo "<script>alert('Thêm thành công !');</script>";
						 else
							echo "<script>alert('Thêm thất bại (Trùng tên đăng nhập ) !');</script>";
					 }
					 else
					 {
						 echo "<script>alert('Bạn không đủ quyền để thêm tài khoản có quyền cao hơn hoặc bằng !');</script>";
					 }
				  }
			   }
	
			   if($_SESSION['role']==3)
			   {
				
		/*				 $query = "Select cosodaotao_id,taikhoan.id from lylich inner join taikhoan on lylich.taikhoan_id = taikhoan.id where taikhoan.id='$_SESSION[temp_id]'";	
						 $result = mysql_query($query);
						 $row = mysql_fetch_row($result);
						 $number= mysql_num_rows($result);
						 if($number>0)*/
						 if(isset($_SESSION['khuvuc']))
						   $temp="and khuvuc='$_SESSION[khuvuc]'";
						 else
							$temp="";
	                
								 if ( ($sql_quyen != 4 || $sql_trangthai !=2)&& $sql_name==''){
							$s_result=  mysql_query("select * from taikhoan where (nhom = '$sql_quyen' or taikhoan.trangthai='$sql_trangthai')and (nhom > $_SESSION[role] or nhom ='0') $temp   order by trangthai ,hoten ");
						 
						}
						else if(($sql_quyen != 4 || $sql_trangthai !=2)&& $sql_name != ''){
							 $s_result=  mysql_query("select * from taikhoan  where (nhom = '$sql_quyen' or taikhoan.trangthai='$sql_trangthai' and tendangnhap like '%$sql_name%')and (nhom > $_SESSION[role] or nhom ='0') $temp   order by trangthai ,hoten  ");
						}
						else if (($sql_quyen == 4 || $sql_trangthai ==2)&& $sql_name != ''){
												 $s_result=  mysql_query("select * from taikhoan  where tendangnhap like '%$sql_name%' and (nhom > $_SESSION[role] or nhom ='0') $temp order by trangthai,hoten  ");

						}
						else{
	
												 $s_result=  mysql_query("select * from taikhoan  where  (nhom > $_SESSION[role] or nhom ='0') $temp  order by trangthai ,hoten  ");
		 
						}
			   }else{
				   		     if ( ($sql_quyen != 4 || $sql_trangthai !=2)&& $sql_name==''){
                    $s_result=  mysql_query("select * from taikhoan  where (nhom = '$sql_quyen' or trangthai='$sql_trangthai')and (nhom > $_SESSION[role] or nhom ='0')   order by trangthai ,hoten ");
		         
                }
				else if(($sql_quyen != 4 || $sql_trangthai !=2)&& $sql_name != ''){
					 $s_result=  mysql_query("select * from taikhoan  where (nhom = '$sql_quyen' or trangthai='$sql_trangthai' and tendangnhap like '%$sql_name%')and (nhom > $_SESSION[role] or nhom ='0')  order by trangthai ,hoten  ");
				}
				
					else if( ($sql_quyen == 4 || $sql_trangthai ==2 || $sql_name == '')&&$sql_khuvuc!=0){
			
					 $s_result=  mysql_query("select * from taikhoan  where  khuvuc = '$sql_khuvuc' and (nhom > $_SESSION[role] or nhom ='0')  order by trangthai ,hoten  ");
			
				}
				else if (($sql_quyen == 4 || $sql_trangthai ==2)&& $sql_name != ''){
					 					 $s_result=  mysql_query("select * from taikhoan  where tendangnhap like '%$sql_name%' and (nhom > $_SESSION[role] or nhom ='0')  order by trangthai ,hoten  ");

				}
				else{
					
										 $s_result=  mysql_query("select * from taikhoan  where  (nhom > $_SESSION[role] or nhom ='0')   order by trangthai ,hoten ");
 
				}
			   }
            
			
            $sum_pp=mysql_num_rows($s_result);
            $stt=1;?>
            <button  name="btnThem" type="submit"  href="#register-box" id="btnThem" >Thêm mới </button>
                   
            <fieldset name="fs_list_all">
              <legend>Danh sách tất cả cán bộ:<?php echo $sum_pp.' Người'; ?></legend>
                <div style:="width:">
                   <table id="taikhoan_bang" style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: solid; border-color: initial; width: 100%;">
            <tbody>
            <tr style="font-weight: bold;">
              <td style="width: 10%;">STT</td>
              <td style="width:  20%;">Tài khoản</td>
              <td style="width:  10%;">Họ tên</td>
              <td style="width:  5%;">Email</td>
              <!--td style="width: 50px;">Số hiệu CB</td-->
              <td style="width:  10%;">Quyền</td>
              <td style="width:  5%;">Khuc vực</td>
              <td style="width:  10%;">Sửa</td>
              <td style="width:  5%;">Thêm lý lịch</td>
              <td style="width:  10%;">Duyệt</td>
              <td style="width:  10%;">Duyệt</td>
              <td style="width:  10%;">Xóa</td>
             
            </tr>
            <?php
         //   if(isset($_POST['search_submit'])){
              
		
           
                //$sql_tinh=$_POST['s_tinh'];
                
               /* $sql_huyen=mysql_query("select * from huyen where name like '%$sql_huyen_1%'");
                $sql_huyen_2=$sql_huyen["districtid"];
                echo $sql_huyen_2;*/  
                
               //$s_result=mysql_query("select * from lylich where hoten LIKE '%$sql_name%' or donvitructhuoc like '%$sql_donvi%' or donvicoso like '%$sql_donvi%'  or quequan_tinh='$sql_tinh'") or die("Không tìm thấy");
               /* if($sql_huyen_1!="") {
                  $sql_huyen_2="select '%$sql_huyen_1%' like name from huyen";
                  
                 // $sql_huyen=$sql_huyen_2['districtid'];
                  echo "$sql_huyen_2";
                  $s_result=  mysql_query("select * from lylich where quequan_huyen=$sql_huyen");
                }*/
           /*     if ($sql_name!=""){
                  $s_result=  mysql_query("select * from taikhoan where hoten like '%$sql_name%'");
                }
             */
  
             /*     if ($sql_name=="" and $sql_quyen=="" and $sql_trangthai!="" ){
                  $s_result=  mysql_query("select * from taikhoan where trangthai like '%$sql_trangthai%'");
                }*/
                
                
                
                /*if ($sql_name!="" and $sql_donvi!="" and $sql_huyen_1=="" and $sql_tinh==""){
                $s_result=mysql_query("select * from lylich where hoten like '%$sql_name%' and donvitructhuoc like '%$sql_donvi%' or donvicoso like '%$sql_donvi%'");
                }*/
                
                if(mysql_num_rows($s_result)>0){
                    $stt=1;
                    while ($row = mysql_fetch_array($s_result)){
						if($row['trangthai']==0)
						      $temp = 'bgcolor="#FFCC33"';
					    else
						      $temp='bgcolor="00FFFF"';
                    ?>
                      <tr   <?php echo $temp; ?>  style="margin-bottom:5px">
                      <td><?php echo $stt?></td>
                      <td><?php echo $row['tendangnhap']; ?></td>
                      <td><?php echo $row['hoten']; ?></td>
                      <td><?php echo $row['email']; ?>
                      <td>
					  <?php 
					  if($row['nhom']==0)
					    echo "Tài khoản người dùng";
					  else if($row['nhom']==3)
					      echo "Quản trị khu vực";
					   else if($row['nhom']==2)
					       echo "Quản trị ";
					    else
						   echo "Quản trị cao cấp ";
					   ?>
                      
                      </td>
                         <td>
					  <?php 
					  if($row['khuvuc']==1)
					    echo "Hà Nội";
					  else if($row['khuvuc']==2)
					      echo "Vĩnh Phúc";
					   else if($row['nhom']==3)
					       echo "Thái Nguyên";
					  
					   ?>
                      
                      </td>
            
                      <td>
<!--                    
-->            <button class="register-window" name="btnSua" type="submit"  href="#register-box" id="btnSua"   onClick="showHint(<?php echo $row["id"]; ?>)" >Sửa </button>
                      </td>
                             <form method="post">
                                   <td>
<!--                    
-->            <button name="btnThemLL" type="submit" id="btnThemLL"  value="<?php echo $row['id'] ?>"
  >Thêm Lí Lịch</button>
                      </td>
               
                       <td><?php if($row['trangthai']==1) echo "Đã duyệt"; else echo "Chưa duyệt"; ?></td>
                      <td><button type="submit" name="btnDuyet" id="btnDuyet" value="<?php echo $row['id'] ?>" >Duyệt</button></td>
                     </form>
                  <!--    <td>
                      <p></p>
                      </td>-->
                   <!--   <td>
                      <p></p>
                      </td>-->
                            <td>
                      <!--img src="../../images/edit.png" style="width: 20px; height: 20px; cursor: pointer;"-->
                      <form action="../../BLL/QLTaikhoan/BLLDeleteAccount.php" method="post" id="delete_form<?php echo $row["id"];?>" style="display: none">
                      <input type="hidden" name="account_id" value="<?php echo $row["id"];?>"/>
                      </form>
                      <img src="../../images/delete.png" style="width: 20px; height: 20px; cursor: pointer;" onClick="
                      if (confirm('Xóa tài khoản này đồng nghĩa với việc xóa toàn bộ lý lịch liên quan: <?php echo $row["tendangnhap"];?>?')) $('#delete_form<?php echo $row["id"];?>').submit()">
                      </td>
                       </tr>
                      <?php  $stt++ ;}
                }else {
                  
            ?>
                  <tr>
                    <td>
                      <p><?php echo "Not found!";?> </p>
                    </td>
                  </tr>
                <?php
                
                }                              
            //}
          ?>
            </tbody>
          </table>
                </div>
              </fieldset>
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
  <div class="register" id="register-box" style="text-align:center"><label style="font-size: 25px">Cập nhật tài khoản</label>
 
 <a class="close" href="#"><img class="img-close" title="Close Window" alt="Close" src="close.png" /></a>
<form class="register-content"  method="post" id="frm">
<label class="hoten">
 <span style="margin-bottom:5px;margin-top:5px">Họ tên:</span>
 <input id="hoten"  type="text"  name="hoten" placeholder="Họ tên" />
 </label>
<label class="tendangnhap">
 <span style="margin-bottom:5px;margin-top:5px">Tên đăng nhập</span>
 <input id="tendangnhap"  type="text"   name="tendangnhap" placeholder="tên đăng nhập" />
 </label>
  <span  style="margin-bottom:5px;margin-top:5px">Mật khẩu</span>
 <input id="matkhau" type="password"  name="matkhau" placeholder="mật khẩu"  />
 </label>
 <label class="email">
 <span  style="margin-bottom:5px;margin-top:5px">Email</span>
 <input id="email" type="email" name="email" placeholder="email" value="" />
 </label>
 <label class="role">
  <span  style="margin-bottom:5px;margin-top:5px">Quyền</span>

    <select name="role"  id="role"  >
                       <option  value="4">Chọn</option>
                       <option  value="0">Thường</option>
                       <option  value="1">Cấp cao</option>
                       <option   value="2">Admin</option>
                       <option  value="3">Admin_khuvuc</option>
                    </select>
  </label>
  <label class="status" >
  <span  style="margin-bottom:5px;margin-top:5px">Trạng thái</span>
                       <select name="status" id="status"  >
                       <option  value="2">Chọn</option>
                       <option  value="1">Duyệt</option>
                       <option value="0">Chưa duyệt</option>
                 
                    </select>
  </label>
  <label class="khuvuc">
 <span  style="margin-bottom:5px;margin-top:5px">CƠ SỞ ĐÀO TẠO</span>
    <select name="khuvuc" id="khuvuc" >
         <option value="1">CƠ SỞ ĐÀO TẠO HÀ NỘI</option>
         <option value="2">CƠ SỞ ĐÀO TẠO VĨNH PHÚC</option>
         <option value="3">CƠ SỞ ĐÀO TẠO THÁI NGUYÊN</option>
    </select>
 </label>

 <button class="button1 submit-button" name="account" type="submit">Hoàn tất</button>
 </form></div>
 <script>
$(document).ready(function() {
    $('button.register-window').click(function() {

        //lấy giá trị thuộc tính href - chính là phần tử "#login-box"
        var loginBox = $(this).attr('href');
 
        //cho hiện hộp đăng nhập trong 300ms
        $(loginBox).fadeIn(300);
 
        // thêm phần tử id="over" vào sau body
        $('body').append('<div id="over">');
        $('#over').fadeIn(300);
        showHint($(this).attr("value"));
        return false;
 });
 
  $('button#btnThem').click(function() {
         $("#tendangnhap").val("");
		 $("#matkhau").val("");
		 $("#email").val("");
		 $('select#role>option:eq(0)').attr('selected', true);
		 $('select#status>option:eq(0)').attr('selected', true);
        //lấy giá trị thuộc tính href - chính là phần tử "#login-box"
        var loginBox = $(this).attr('href');
 
        //cho hiện hộp đăng nhập trong 300ms
        $(loginBox).fadeIn(300);
 
        // thêm phần tử id="over" vào sau body
        $('body').append('<div id="over">');
        $('#over').fadeIn(300);
  
        return false;

 });
 
 // khi click đóng hộp thoại
 $(document).on('click', "a.close, #over", function() {
       $('#over, .register').fadeOut(300 , function() {
           $('#over').remove();
       });
      return false;
 });
 
 
 
});



function showHint(str) {

	 var loginBox = $("a.login-window").attr('href');
    
        //cho hiện hộp đăng nhập trong 300ms
        $(loginBox).fadeIn(300);
 
        // thêm phần tử id="over" vào sau body
        $('body').append('<div id="over">');
        $('#over').fadeIn(300);
    if (str.length == 0) {
        document.getElementById("frm").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("frm").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../load_data/load_capnhat.php?text1=" + str, true);
        xmlhttp.send();
    }
}
function Add() {

	 var loginBox = $("#btnAdd").attr("href");
    
        //cho hiện hộp đăng nhập trong 300ms
        $(loginBox).fadeIn(300);
 
        // thêm phần tử id="over" vào sau body
        $('body').append('<div id="over">');
        $('#over').fadeIn(300);
   
}

</script>
</body>
 </form>
</html>
<?php
  }
   if(isset($_POST['btnThemLL']))
   { 
           $taikhoan_id =  $_POST['btnThemLL'];
		   echo $taikhoan_id;
	       $query="Update taikhoan set trangthai='1' where id='$taikhoan_id'";
		   unset($_SESSION['admin_id']);
		   $_SESSION['admin_id']= $taikhoan_id ;
		   header("location:Nhapmanhinh.php");
   }
  
  ?>
