<?php
ob_start();
session_start();
include_once("header.php");
if( !isset($_SESSION["login_user"]) ) {
?>
	<script>

    alert("Không phải là người dùng thì không vào trang này được");

</script>
<?php	
} else { 
	if( isset($_SESSION["alert"]) && $_SESSION["alert"] != "") {
		?>
		<script>
			alert("<?=$_SESSION["alert"]?>");
		</script>
		<?php
		$_SESSION["alert"] = "";
	}

?>
<body>
<header class="art-header">
    <div class="art-shapes">

	</div>
			
	<nav class="art-nav">
    <ul class="art-hmenu">
		<li><a href="../../index.php" class="active">Trang chủ</a></li>
		<li><a href="#"><?=$_SESSION["login_user"]?></a></li>
	</ul> 
    </nav>

                    
</header>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
						<div class="art-layout-cell layout-item-1" style="width: 5%" >
							
						</div>
						
						<div class="art-layout-cell layout-item-1" style="width: 30%" >
							<br/><br/>
							<fieldset style="border: 1px solid lightgray">
								<legend><b>Hướng dẫn</b></legend>
								<ul class="">
									<li>Nhập mật khẩu cũ</li>
									<li>Nhập mật khẩu mới</li>
									<li>Nhập lại mật khẩu mới</li>
									<li>Chấp nhận thay đổi</li>
								</ul>
							</fieldset>
							
						</div>
                        <div class="art-layout-cell layout-item-1" style="width: 40%" >
						<article class="art-post art-article">
							<div class="art-postcontent art-postcontent-0 clearfix"><p><br/></p></div>
							<div id="wrapper">
                                <div id="login" class="animate form">
									<form  action="../../BLL/QLTaikhoan/BLLchangepwd.php" method="post" autocomplete="on"> 
										<h1>Đổi mật khẩu</h1> 
										<p> 
											<label class="youpasswd" >Mật khẩu hiện tại</label>
											<input id="curpass" name="curpass" required="required" type="password"/>
										</p>
										<p> 
											<label class="youpasswd" >Mật khẩu mới</label>
											<input id="newpass" name="newpass" required="required" type="password"/>
										</p>
										<p> 
											<label class="youpasswd">Nhập lại mật khẩu mới </label>
											<input id="renew" name="renew" required="required" type="password"/> 
										</p>
										<p class="signin button"> 
											<input type="submit" value="Chấp nhận" /> 
										</p>
										
									</form>
								</div>
						</article></div>
                    </div>
                </div>
            </div>
	<?php
		include("../../footer.php");
	?>

    </div>
  
</div>


</body></html>
<?php
}
?>