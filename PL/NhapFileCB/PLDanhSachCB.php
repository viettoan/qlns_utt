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
<!-- header start -->    
  <header class="art-header">
    <div class="art-shapes">
    </div>
    <nav class="art-nav">
      <ul class="art-hmenu">
        <li><a href="PLNhapFileCB.php">Nhập lý lịch</a></li>
        <li><a href="PLDanhSachCB.php" class="active">Danh sách cán bộ</a></li>
        <li><a href="PLTienIch.php" class="">Tiện ích</a></li>
      </ul>
      <ul class="art-hmenu-user">
        <li>
          <a href="#" >Chào, <?=$_SESSION["username_user"]?></a>
          <ul class="active">
            <li><a href="#">Hộp thư</a></li>
            <li><a href="../QLTaikhoan/PLchangepass.php">Đổi mật khẩu</a></li>
            <li><a href="../../BLL/QLTaikhoan/BLLlogout.php">Thoát</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
 <!--header stop -->   
 
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
                      <li><a href="../../BLL/QuanLyCB/BLLDanhSachTrichNgang.php">Danh sách trích ngang cán bộ</a></li>
                      <li><a href="../../BLL/QuanLyCB/BLLDanhSachDaoTao.php">Danh sách thông tin đào tạo</a></li>
                    </ul>
                    
                  </p>
                 
                  
                  
                  
                  <br />
				  
				  <fieldset style="width: auto; hight: 100l; margin: auto;">
					<legend>Tìm kiếm cán bộ</legend>
						<form name="s_form" action="" method="POST" onsubmit="return search_func()">
							<table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden;  width: auto;">
								<tr>
									<td width="20%">
										Tên cán bộ:
									</td>
									<td>
										<input type="text" name="s_ten" />
									</td>
									
									<td width="20%" style="text-align: right">
										Chức vụ:
									</td>
									<td >
										<input type="text" name="s_chucvu" />
									</td>
									
								</tr>
							</table>
							<br />
							<form name="search" action="search-process.php" method="POST">
							  <input align="right" type="submit" name="search_submit" value="Tìm kiếm" />
							</form>
						</form>
					
					<br />
					<h2>Kết quả tìm kiếm: </h2>
					<br />
					
					<table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
					  <tbody>
						<tr style="font-weight: bold;">
						  <td style="width: 10%;">Ảnh</td>
						  <td style="width: 30%;">Họ tên</td>
						  <td style="width: 10%;">Ngày sinh</td>
						  <td style="width: 15%;">Số hiệu CB</td>
						  <td style="width: 25%;">Cấp ủy hiện tại</td>
						  <td style="width: 10%;">Tải lý lịch</td>
						  
						</tr>
						<?php
					  if(isset($_POST['search_submit'])){
						  
							  $sql_name=$_POST['s_ten'];
							  //$sql_donvi=$_POST['s_donvi'];
							  
							  $sql_chucvu=$_POST['s_chucvu'];
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
							  if ($sql_name!=""){
								$s_result=  mysql_query("select * from lylich where hoten like '$sql_name'");
							  }
							  
							  if ($sql_name=="" and $sql_chucvu!=""){
								$s_result=  mysql_query("select * from lylich where chucvu='$sql_chucvu'");
							  }
							  
							  
							  
							  /*if ($sql_name!="" and $sql_donvi!="" and $sql_huyen_1=="" and $sql_tinh==""){
								$s_result=mysql_query("select * from lylich where hoten like '%$sql_name%' and donvitructhuoc like '%$sql_donvi%' or donvicoso like '%$sql_donvi%'");
							  }*/
							  
							  if(mysql_num_rows($s_result)>0){
								  while($s_row=mysql_fetch_array($s_result)){
						?>                  
										<tr>
											<td>
											<?php if (file_exists("../../images/avatar/".$row["cmnd"].".jpg")) {?>
											  <img src="../../images/avatar/<?php echo $row["cmnd"];?>.jpg" alt="" style="width: 40px; height: 40px;">
											<?php } else { ?>
											  <img src="../../images/avatar/noavatar" alt="" style="width: 40px; height: 40px;">
											<?php }?>
											</td>
											<td>
											  <p><?php echo $s_row["hoten"];?></p>
											</td>       
											
											<td>
											  <p><?php echo date("d-m-Y",strtotime($s_row["ngaysinh"]));?></p>
											</td>
											<td>
											   <p><?php echo $s_row["sohieucanbo"];?></p>
											</td>
											<td>
											  <p><?php echo $s_row["chucvu"];?></p>
											</td>
											
											<td>
												<!-- <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Quyết định"> -->
												<a href="../../BLL/XuatLylichCb/BLLExport.php?lylich_id=<?php echo $row["id"];?>">
												  <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Lý lịch trích ngang">
												</a>
											  </td>
										</tr>
						<?php               
					
								  }
							  }else {
								  
						?>
								  <tr>
									  <td>
										  <p><?php echo "Not found!";?> </p>
									  </td>
								  </tr>
							  <?php
							  
							  }                              
					  }
					?>
					  </tbody>
					</table>
					</fieldset>
				 <!--Search Form stop -->
				  
				  <br/>
                  <fieldset name="fs_list_all">
                    <legend>Danh sách tất cả cán bộ Đoàn</legend>
                    <div style:="width:">
                      <table style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: hidden; border-color: initial; width: 100%;">
                        <tbody>
                          <tr style="font-weight: bold;">
                            <td style="width: 60px;">Ảnh</td>
                            <td style="width: 180px;">Họ tên</td>
                            <td style="width: 70px;">Ngày sinh</td>
                            <td style="width: 100px;">Số hiệu CB</td>
                            <td style="width: 170px;">Chức vụ</td>
                            <td style="width: 70px;">Tải lý lịch</td>
                            <td style="width: 90px;">Thao tác</td>
                          </tr>
                          <?php
  
                            $sql = "SELECT * FROM lylich WHERE 1";
                            $result = mysql_query($sql) or die("QDQWDQWDWQ");
                            while ($row = mysql_fetch_array($result)){
                          ?>
                              <tr>
                                  <td>
                                  <?php if (file_exists("../../images/avatar/".$row["cmnd"].".jpg")) {?>
                                    <img src="../../images/avatar/<?php echo $row["cmnd"];?>.jpg" alt="" style="width: 40px; height: 40px;">
                                  <?php } else { ?>
                                    <img src="../../images/avatar/noavatar" alt="" style="width: 40px; height: 40px;">
                                  <?php }?>
                                  </td>
                                  <td>
                                    <p><?php echo $row["hoten"];?></p>
                                  </td>
                                  <td>
                                    <p><?php echo date("d-m-Y",strtotime($row["ngaysinh"]));?></p>
                                  </td>
                                  <td>
                                    <p><?php echo $row["sohieucanbo"];?></p>
                                  </td>
                                  <td>
                                    <p><?php echo $row["chucvu"];?></p>
                                  </td>
                                  <td>
                                    <!-- <img src="../../images/icon_word.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Quyết định"> -->
                                    <a href="../../BLL/XuatLylichCb/BLLExport.php?lylich_id=<?php echo $row["id"];?>">
                                      <img src="../../images/icon_excel.gif" style="width: 20px; height: 20px; cursor: pointer;" alt="Lý lịch trích ngang">
                                    </a>
                                  </td>
                                  <td>
                                    <img src="../../images/edit.png" style="width: 20px; height: 20px; cursor: pointer;">
                                    <form action="../../BLL/QuanLyCB/BLLDelete.php" method="post" id="delete_form" style="display: none">
                                      <input type="hidden" name="lylich_id" value="<?php echo $row["id"];?>"/>
                                    </form>
                                      <img src="../../images/delete.png" style="width: 20px; height: 20px; cursor: pointer;" onclick="if (confirm('Bạn có thực sự muốn xóa cán bộ: <?php echo $row["hoten"];?>?')) $('#delete_form').submit()">
                                  </td>
                              </tr>
                            <?php } ?>
                            <?php if (mysql_num_rows($result) == 0){?>
                              <tr><td colspan="5" style="width: 100%; text-align: center;">Không có file dữ liệu</td></tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                  </fieldset>
                  </div>
                </div>
              </div>
              
              <div class="art-content-layout layout-item-2">
                <div class="art-content-layout-row">
                  <div class="art-layout-cell layout-item-3" style="width: 50%" >
                    <p>
                    	Đoàn TNCS Hồ Chí Minh
                    </p>
                  </div>
                  <div class="art-layout-cell layout-item-3" style="width: 50%" >
                    <p style="float: right;">Hệ thống được phát triển bởi nhóm SV ĐH Công Nghệ</p>
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
</body>
</html>
<?php
  }
  ?>
