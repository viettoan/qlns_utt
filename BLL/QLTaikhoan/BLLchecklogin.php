<?php
	session_start();
	require("../../config/config.php");	
	
	if(isset($_POST["username"]) && isset($_POST["password"])){
		// username and password sent from Form 
		$myusername=addslashes($_POST['username']); 
		$mypassword=md5(addslashes($_POST['password'])); 
		 

		$sql="SELECT * FROM taikhoan WHERE tendangnhap='$myusername' and matkhau='$mypassword' and trangthai='1'";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$count=mysql_num_rows($result);
		$role=$row[4];
		$myid = $row[0];
		$hoten = $row['hoten'];
		$khuvuc = $row["khuvuc"];
	

		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1)
		{
			//session_register("myusername");
			$_SESSION['login_user']=$myusername;
			$_SESSION['username_user']=$hoten ;
			$_SESSION['role'] = $role;
			if($role==0){
			  $_SESSION['admin_id'] = $myid;
			  header('Location: ../../PL/NhapFileCB/Nhapmanhinh.php');
			}else{
			    $_SESSION['temp_id']=$myid ;
				if($role==3)
				  $_SESSION['khuvuc'] = $khuvuc;
				header('Location: ../../PL/NhapFileCB/PLDanhSachCB.php');
			}
		}
		else 
		{
			
			//alert('Đăng nhập ko thành công,');
			$_SESSION['login_msg']="Đăng nhập ko thành công, Sai tên đăng nhập hoặc mật khẩu";
			
			header('Location: ../../index.php');
		}
	}else{
		echo "không vào được database";
	}
	
?>