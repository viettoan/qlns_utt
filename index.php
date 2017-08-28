<?php
ob_start();
session_start();
include_once("header.php");
if( isset($_SESSION["login_user"]) ) {
	header('Location: PL/NhapFileCB/PLDanhSachCB.php');
	exit();
} 

else { 
	if( isset($_SESSION['login_msg']) ) {
		echo "<script type='text/javascript'>alert('Đăng nhập ko thành công');</script>";
	} 
?>
<style>
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
    top:10%;
    left:50%;
    margin-left:-300px;
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
.submit-button{
    display: inline-block;
    padding: auto;
    margin: 15px 75px;
    width: 150px;
}
</style>
<body>
<header class="art-header">
    <div class="art-shapes">

	</div>
			
	<nav class="art-nav">
    <ul class="art-hmenu">
		<li><a href="index.php" class="active">Trang chủ</a></li>
	</ul> 
    </nav>

                    
</header>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
						<div class="art-layout-cell layout-item-1" style="width: 5%" >
							
						</div>
						
						<div class="art-layout-cell layout-item-1" style="width: 65%" >
							<br/><br/>
							<fieldset style="border: 1px solid lightgray">
								<legend><b>Hướng dẫn</b></legend>
								<ul class="">
									<li>Đăng nhập hệ thống</li>
									<li>Sơ yếu lý lịch</li>
									<li>Quá trình học tập - công tác</li>
								</ul>
							</fieldset>
							
						</div>
                        <div class="art-layout-cell layout-item-1" style="width: 40%" >
						<article class="art-post art-article">
							<div class="art-postcontent art-postcontent-0 clearfix"><p><br/></p></div>
							<div id="wrapper">
                                <div id="login" class="animate form">
									<form  action="BLL/QLTaikhoan/BLLchecklogin.php" method="post" autocomplete="on"> 
										<h1>Đăng nhập</h1> 
										<p> 
											<label for="username" class="uname" data-icon="u" >Tên đăng nhập</label>
											<input id="username" name="username" required type="text" placeholder="sonnt"/>
										</p>
										<p> 
											<label for="password" class="youpasswd" data-icon="p">Mật khẩu </label>
											<input id="password" name="password" required type="password" placeholder="20581" /> 
										</p>
										<p class="keeplogin"> 
											<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
											<label for="loginkeeping">Giữ trạng thái đăng nhập</label>
										</p>
                                     
										<p class="signin button">
                                        	<input type="submit" value="Login" />  
                                                  <input class="register-window"  href="#register-box"  type="submit" value="Register" /> 
										
                                      
										</p>
										
									</form>
								</div>
						</article></div>
                    </div>
                </div>
            </div>
	<?php
		include_once("footer.php");
		include_once("config/config.php");
		if(isset($_POST['register'])){
			$user = isset($_POST['username1'])?$_POST['username1']:'';
			$pass = isset($_POST['password1'])?md5(addslashes($_POST['password1'])):'';
			$email = isset($_POST['email'])?$_POST['email']:'';
			$khuvuc = isset($_POST['khuvuc'])?$_POST['khuvuc']:'';
			$hoten = isset($_POST['hoten'])?$_POST['hoten']:'';
			$query = "Insert into taikhoan values('','$user','$pass','$email','0','0','$hoten','$khuvuc')";
			$result = mysql_query($query);
			if($result)
			   echo "<script>alert('Đăng ký thành công !');</script>";
			else
			   echo "<script>alert('Đăng ký thất bại( Trùng tên đăng nhập ! ) !');</script>";
		}
	?>

    </div>
  
</div>
<div class="register" id="register-box" style="text-align:center"><label style="font-size: 25px">Đăng ký</label>
 
 <a class="close" href="#"><img class="img-close" title="Close Window" alt="Close" src="close.png" /></a>
<form class="register-content" action="#" method="post"><label class="username">
  <label class="password">
 <span  style="margin-bottom:5px;margin-top:5px">Họ tên</span>
   <input id="hoten" type="text" required autocomplete="on" name="hoten" placeholder="Họ tên" value="" />
</label>
 <span style="margin-bottom:5px;margin-top:5px">Tên đăng nhập</span>
 <input id="username1" type="text" required autocomplete="on" name="username1" placeholder="Username" value="" />
 </label>
  <span  style="margin-bottom:5px;margin-top:5px">Mật khẩu</span>
 <input id="password1" type="password" required autocomplete="on" name="password1" placeholder="password" value="" />
 </label>
 <label class="password">
 <span  style="margin-bottom:5px;margin-top:5px">Email</span>
 <input id="email" type="email" name="email" placeholder="email" value="" />
 </label>
 <label class="password">
 <span  style="margin-bottom:5px;margin-top:5px">CƠ SỞ ĐÀO TẠO</span>
    <select name="khuvuc" id="khuvuc" >
         <option value="1">CƠ SỞ ĐÀO TẠO HÀ NỘI</option>
         <option value="2">CƠ SỞ ĐÀO TẠO VĨNH PHÚC</option>
         <option value="3">CƠ SỞ ĐÀO TẠO THÁI NGUYÊN</option>
    </select>
 </label>

 <button class="button1 submit-button" name="register" type="submit">Đăng ký</button>
 </form></div>
<script>
$(document).ready(function() {
    $('input.register-window ').click(function() {
        //lấy giá trị thuộc tính href - chính là phần tử "#login-box"
        var loginBox = $(this).attr('href');
         $("#username1").val("");
		 $("#password1").val("");
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
</script>
</body></html>
<?php
}
?>