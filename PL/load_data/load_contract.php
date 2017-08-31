<!DOCTYPE html>
<html>
<head>
	<style>
		table {
			width: 100%;
			border-collapse: collapse;
		}

		table, td, th {
			border: 1px solid black;
			padding: 5px;
		}

		th {text-align: left;}
	</style>
</head>
<body>

	<?php
	session_start();
	$action = isset($_GET['action'])?$_GET['action']:0;
	$ngayhdlaodong = isset($_GET['ngayhdlaodong'])?$_GET['ngayhdlaodong']:'';
	$loaihdlaodong = isset($_GET['loaihdlaodong'])?$_GET['loaihdlaodong']:'';
	$ngayhdlamviec = isset($_GET['ngayhdlamviec'])?$_GET['ngayhdlamviec']:'';
	$loaihdlamviec = isset($_GET['loaihdlamviec'])?$_GET['loaihdlamviec']:'';

	$id = isset($_GET['id'])?$_GET['id']:'';

	include("../../config/config.php");

	if($action ==1){
		$query ="Insert into hopdong values('','$_SESSION[lylich_id]','$loaihdlaodong','$ngayhdlaodong','$loaihdlamviec','$ngayhdlamviec')";

		$result = mysql_query($query);
		if($result)

			mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
	}
	else if($action==0){

		$query ="Update  hopdong set loaihdlamviec='$loaihdlamviec',loaihdlaodong='$loaihdlaodong',ngayhdlamviec='$ngayhdlamviec',ngayhdlaodong='$ngayhdlaodong' where id='$id'";
		/*	 echo $query;*/
		$result = mysql_query($query);
		if($result)

			mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
	}
	else{
		$query ="Delete from hopdong where id='$id'";
		/*	 echo $query;*/
		$result = mysql_query($query);
		if($result)

			mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
	}


	$query = "Select * from hopdong where lylich_id = '$_SESSION[lylich_id]'";

	$result = mysql_query($query);


	while($row = mysql_fetch_array($result)){


		echo '<tr> ';

		echo '<td> 
		<select  name="loaihdlaodong'.$row['id'].'" id="loaihdlaodong'.$row['id'].'"  onKeyPress="keypress1(0,'.$row['id'].')"  >
			<option   value="">Chọn</option>
			<option ';
			if($row['loaihdlaodong']=='Hợp đồng vụ việc')
				echo " selected ";
			echo  'value="Hợp đồng vụ việc">Hợp đồng vụ việc</option>
			<option ';
			if($row['loaihdlaodong']=='Hợp đồng 1 năm')
				echo " selected ";
			echo  'value="Hợp đồng 1 năm">Hợp đồng 1 năm</option>
			<option ';
			if($row['loaihdlaodong']=='Hợp đồng 2 năm')
				echo " selected ";
			echo  'value="Hợp đồng 2 năm">Hợp đồng 2 năm</option>
			<option ';
			if($row['loaihdlaodong']=='Hợp đồng 3 năm')
				echo " selected ";
			echo '  value="Hợp đồng 3 năm">Hợp đồng 3 năm</option>
			<option';
			if($row['loaihdlaodong']=='HĐ không xác định thời hạn')
				echo " selected ";
			echo'   value="HĐ không xác định thời hạn">HĐ không xác định thời hạn</option>  
		</select> 
	</td>';
	echo '<td> <input type="date" name="ngayhdlaodong'.$row['id'].'" id="ngayhdlaodong'.$row['id'].'" value="'.$row['ngayhdlaodong'].'" size="20" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
	echo '<td> 
	<select name="loaihdlamviec'.$row['id'].'" id="loaihdlamviec'.$row['id'].'" 
	onKeyPress="keypress1(0,'.$row['id'].')"  /> 
	<option value="">Chọn</option>
	<option';
	if($row['loaihdlamviec']=='Hợp đồng thử việc')
		echo " selected ";
	echo ' value="Hợp đồng thử việc">Hợp đồng thử việc (1 năm)</option>
	<option';
	if($row['loaihdlamviec']=="Hợp đồng 2 năm")
		echo " selected ";
	echo ' value="Hợp đồng 2 năm">Hợp đồng 2 năm</option>
	<option ';
	if($row['loaihdlamviec']=="Hợp đồng 3 năm")
		echo " selected ";
	echo ' value="Hợp đồng 3 năm">Hợp đồng 3 năm</option>
	<option ';
	if($row['loaihdlamviec']=="HĐ không xác định thời hạn")
		echo " selected ";
	echo' value="HĐ không xác định thời hạn">HĐ không xác định thời hạn</option>  
</select>
</td> ';
echo '<td> <input type="date" name="ngayhdlamviec'.$row['id'].'" id="ngayhdlamviec'.$row['id'].'" value="'.$row['ngayhdlamviec'].'" size="20" 
onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';	

echo '<td><button name="btnDelete1" onclick="keypress1(2,'.$row['id'].')" class="btnDelete1" value = "'.$row['id'].'" >Xóa</button>
<button name="btnUpdate" class="btnUpdate" onClick="keypress101(0,'.$row['id'].')">Sửa</button>
</td>';
echo'</tr>';
}
?>
<tr >

	<td >
		<select   name="loaihdlaodong" id="loaihdlaodong"  onKeyPress="keypress1(1,0)"  >
			<option   value="">Chọn</option>
			<option   value="Hợp đồng vụ việc">Hợp đồng vụ việc</option>
			<option   value="Hợp đồng 1 năm">Hợp đồng 1 năm</option>
			<option   value="Hợp đồng 2 năm">Hợp đồng 2 năm</option>
			<option   value="Hợp đồng 3 năm">Hợp đồng 3 năm</option>
			<option   value="HĐ không xác định thời hạn">HĐ không xác định thời hạn</option>  
		</select>                                         </td>
		<td>
			<input type="date" name="ngayhdlaodong" id="ngayhdlaodong" size="20"  onKeyPress="keypress1(1,0)"  /> 
		</td>
		<td>
			<select name="loaihdlamviec" id="loaihdlamviec"  onKeyPress="keypress1(1,0)"  >
				<option value="">Chọn</option>
				<option value="Hợp đồng thử việc">Hợp đồng thử việc (1 năm)</option>
				<option value="Hợp đồng 2 năm">Hợp đồng 2 năm</option>
				<option value="Hợp đồng 3 năm">Hợp đồng 3 năm</option>
				<option  value="HĐ không xác định thời hạn">HĐ không xác định thời hạn</option>  
			</select>                                        </td>
			<td>
				<input type="date" name="ngayhdlamviec" id="ngayhdlamviec" size="20" onKeyPress="keypress1(1,0)"   /> 
			</td>
			<td> <button id="btnInsert" name="btnInsert" onClick="keypress101(1,0)">Thêm</button></td>


		</tr>

	</body>
	</html>