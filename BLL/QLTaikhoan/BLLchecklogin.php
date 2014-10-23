<?php
	session_start();
	require("../../config/config.php");	
	
	if(isset($_POST["username"]) && isset($_POST["password"])){
		// username and password sent from Form 
		$myusername=addslashes($_POST['username']); 
		$mypassword=md5(addslashes($_POST['password'])); 

		$sql="SELECT * FROM taikhoan WHERE tendangnhap='$myusername' and matkhau='$mypassword'";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$count=mysql_num_rows($result);
		

		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1)
		{
			//session_register("myusername");
			$_SESSION['login_user']=$myusername;
			$_SESSION['username_user']=$myusername;
			//$_SESSION['type_user']=$row["typeUser_idtype"];
			header('Location: ../../PL/NhapFileCB/PLNhapFileCB.php');
		}
		else 
		{
			$_SESSION['login_msg']="Sai tên đăng nhập hoặc mật khẩu";
			header('Location: ../../index.php');
		}
	}else{
		echo "không vào được database";
	}
	
?>