<?php
include("../../config/config.php");
session_start();

$id= $_GET['text1'];
$query = "Select * from taikhoan where id = '$id'";
$result= mysql_query($query);
$row = mysql_fetch_row($result);

  echo '<label class="username">
 <span style="margin-bottom:5px;margin-top:5px">Tên đăng nhập</span>
 <input id="tendangnhap"  type="text" autocomplete="on" name="tendangnhap" placeholder="tên đăng nhập" value="'.$row[1].'" />
 </label>
  <span  style="margin-bottom:5px;margin-top:5px">Mật khẩu</span>
 <input id="matkhau" type="password" autocomplete="on" name="matkhau" placeholder="mật khẩu" value="'.$row[2].'" />
 </label>
 <label class="password">
 <span  style="margin-bottom:5px;margin-top:5px">Email</span>
 <input id="email" type="email" name="email" placeholder="email" value="'.$row[3].'" />
 </label>
 <label class="role">
  <span  style="margin-bottom:5px;margin-top:5px">Quyền</span>
  '?>

    <select name="role"    >
                       <option <?php if($row[4]==4) echo "selected" ?>  value="4">Chọn</option>
                       <option <?php if($row[4]==0) echo "selected" ?> value="0">Thường</option>
                       <option <?php if($row[4]==1) echo "selected" ?> value="1">Cấp cao</option>
                       <option <?php if($row[4]==2) echo "selected" ?> value="2">Admin</option>
                       <option <?php if($row[4]==3) echo "selected" ?> value="3">Admin_khuvuc</option>
                    </select>
  </label>
  <label class="status">
  <span  style="margin-bottom:5px;margin-top:5px">Trạng thái</span>
                       <select name="s_trangthai" >
                       <option <?php if($row[5]==2) echo "selected" ?> value="2">Chọn</option>
                       <option <?php if($row[5]==1) echo "selected" ?> value="1">Duyệt</option>
                       <option <?php if($row[5]==0) echo "selected" ?> value="0">Chưa duyệt</option>
                 
                    </select>
  </label>
  <input type="hidden" name="id" value="<?php echo $id  ?>" />
 <button class="button1 submit-button" name="account" type="submit">Hoàn tất</button>
