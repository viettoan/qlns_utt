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
		  $tentruong = isset($_GET['tentruong'])?$_GET['tentruong']:'';
		  $lophoc = isset($_GET['lophoc'])?$_GET['lophoc']:'';
		  $thoigian = isset($_GET['thoigian'])?$_GET['thoigian']:'';
		  $hinhthuc = isset($_GET['hinhthuc'])?$_GET['hinhthuc']:'';
		  if($hinhthuc=="Bồi dưỡng")
		        $boiduong=1;
		  else 
		       $boiduong=0;
		  $vanbang = isset($_GET['vanbang'])?$_GET['vanbang']:'';
		  $noidaotao = isset($_GET['noidaotao'])?$_GET['noidaotao']:'';
		  $khoahoc = isset($_GET['khoahoc'])?$_GET['khoahoc']:'';
		  $dean = isset($_GET['dean'])?$_GET['dean']:'';
		  $qdinh = isset($_GET['qdinh'])?$_GET['qdinh']:'';
		  $thangnamcu = isset($_GET['thangnamcu'])?$_GET['thangnamcu']:'';
		  $doituong = isset($_GET['doituong'])?$_GET['doituong']:'';
          $id=isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
           $query ="Insert into daotao values('','$_SESSION[lylich_id]','$tentruong','$lophoc','$thoigian','$hinhthuc','$vanbang','$boiduong','$noidaotao','$khoahoc','$dean','$qdinh','$doituong','$thangnamcu')";
		 
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else if($action==0){
			
			           $query ="Update  daotao set tentruong='$tentruong',nganhhoc='$lophoc',thoigianhoc='$thoigian',hinhthuchoc='$hinhthuc',vanbang='$vanbang',noidaotao='$noidaotao',khoahoc='$khoahoc',dean='$dean',quyetdinh='$qdinh',doituong='$doituong',ngaycudi='$thangnamcu',daotao_boiduong='$boiduong' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from daotao where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		
       

        
				  $query = "Select * from daotao where lylich_id = '$_SESSION[lylich_id]' ";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
								 echo '<tr> ';
		   
           
           echo '<td width="117px"> <input type="text" name="tentruong'.$row['id'].'" id="tentruong'.$row['id'].'" value="'.$row['tentruong'].'" size="15" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
		   echo '<td width="152px"> <input type="text" name="lophoc'.$row['id'].'" id="lophoc'.$row['id'].'" value="'.$row['nganhhoc'].'" size="20" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
	       echo '<td width="117px"> <input type="text" name="thoigian'.$row['id'].'" id="thoigian'.$row['id'].'" value="'.$row['thoigianhoc'].'" size="15" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
	
		   echo ' <td width="100px">  <select name="hinhthuc'.$row['id'].'" id="hinhthuc'.$row['id'].'"   onKeyPress="keypress(0,
		   '.$row['id'].')" style="width:100px" >
                                                <option ';
												if($row['hinhthuchoc']=='')
												echo "selected";
												 echo' value="">---Chọn---</option>
                                                <option ';
												if($row['hinhthuchoc']=='Chính quy')
												echo'selected';
												echo' value="Chính quy">Chính quy</option>
                                                <option ';
												if($row['hinhthuchoc']=='Tại chức')
												echo 'selected';
												echo ' value="Tại chức">Tại chức</option>
                                                <option ';
												if($row['hinhthuchoc']=='Chuyên tu')
												echo'selected';
												echo' value="Chuyên tu">Chuyên tu</option>
                                                 <option ';
												 if($row['hinhthuchoc']=='Bồi dưỡng')
												 echo'selected';
												 echo ' value="Bồi dưỡng">Bồi dưỡng</option>
                                                <option ';
												if($row['hinhthuchoc']=='Tập trung')
												echo'selected';
												echo ' value="Tập trung">Tập trung</option>
                                                 <option ';
												 if($row['hinhthuchoc']=='Không tập trung')
												 echo'selected';
												 echo' value="Không tập trung">Không tập trung</option>
                                                <option ';
												if($row['hinhthuchoc']=='Khác')
												echo 'selected ';
												echo 'value="Khác">Khác</option>
                                            </select></td>';

		  echo ' <td width="100px">   <select style="width:100px" name="vanbang'.$row['id'].'" id="vanbang'.$row['id'].'"  onKeyPress="keypress(0,
		   '.$row['id'].')"   >
                                                 <option ';
												 if($row['vanbang']=='')
												 echo 'selected';
												 echo ' value="">---Chọn---</option>';
                                                 if($row['vanbang']=='TSKH')
												 echo'selected';
												 echo' value="TSKH">TSKH</option>
                                                 <option ';
												 if($row['vanbang']=='TS')
												 echo'selected';
												 echo' value="TS">TS</option>
                                                 <option ';
												 if($row['vanbang']=='NCS')
												 echo 'selected';
												 echo' value="NCS">NCS</option>
                                                 <option ';
												 if($row['vanbang']=='Ths')
												 echo 'selected';
												 echo' value="Ths">Ths</option>
                                                 <option ';
												 if($row['vanbang']=='Cử nhân')
												 echo'selected';
												 echo' value="Cử nhân">Cử nhân</option>
                                                 <option ';
												 if($row['vanbang']=='Kỹ sư')
												 echo'selected';
												 echo' value="Kỹ sư">Kỹ sư</option>
                                                 <option ';
												 if($row['vanbang']=='Cao đẳng')
												 echo'selected';
												 echo' value="Cao đẳng">Cao đẳng</option>
                                                 <option ';
												 if($row['vanbang']=='Trung cấp')
												 echo 'selected';
												 echo' value="Trung cấp">Trung cấp</option>
                                                 <option ';
												 if($row['vanbang']=='Sơ cấp')
												 echo 'selected';
												 echo' value="Sơ cấp">Sơ cấp</option>
                                                 <option ';
												 if($row['vanbang']=='Chuyên ngành')
												 echo'selected';
												 echo' value="Chuyên ngành">Chuyên ngành</option>
                                                 <option ';
												 if($row['vanbang']=='Bằng tốt nghiệp')
												 echo'selected';
												 echo' value="Bằng tốt nghiệp">Bằng tốt nghiệp</option>
                                                 <option ';
												 if($row['vanbang']=='Chứng chỉ')
												 echo'selected';
												 echo' value="Chứng chỉ">Chứng chỉ</option>
                                                <option ';
												if($row['vanbang']=='Khác')
												echo'selected';
												echo ' value="Khác">Khác</option>
                                            </select></td>';

		   		echo '      <td width="80px">   <select style="width:80px" name="noidaotao'.$row['id'].'" id="noidaotao'.$row['id'].'"   onKeyPress="keypress(0,
		   '.$row['id'].')"  >
                                                 <option ';
												 if($row['noidaotao']=="")
												 echo'selected';
												 echo' value="">---Chọn---</option>
                                                 <option ';
												 if($row['noidaotao']=='Trong nước')
												 echo'selected';
												 echo' value="Trong nước">Trong nước</option>
                                                 <option ';
												 if($row['noidaotao']=='Ngoài nước')
												 echo'selected';
												 echo' value="Ngoài nước">Ngoài nước</option>
                                                  <option ';
												 if($row['noidaotao']=='Liên kết')
												 echo'selected';
												 echo'  value="Liên kết">Liên kết</option>
                                                <option ';
												if($row['noidaotao']=='Khác')
												echo'selected';
												echo'  value="Khác">Khác</option>
                                            </select></td>';
		   echo '<td> <select name="khoahoc'.$row['id'].'" id="khoahoc'.$row['id'].'"   onKeyPress="keypress(0,
		   '.$row['id'].')"   >
                                                 <option';
												  if($row['khoahoc']=='')
												  echo' selected';
												  echo' value="">---Chọn---</option>
                                                 <option ';
												 if($row['khoahoc']=='Ngắn hạn')
												 echo 'selected';
												 echo' value="Ngắn hạn">Ngắn hạn</option>
                                                 <option ';
												 if($row['khoahoc']=='Dài hạn')
												 echo'selected';
												 echo' value="Dài hạn">Dài hạn</option>
                                              
                                            </select></td>';
	       echo '<td width="68px"> <input type="text"  name="dean'.$row['id'].'" id="dean'.$row['id'].'" value="'.$row['dean'].'" size="8" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
		  
		   echo '<td>  <input style="width:135px"   type="month" name="thangnamcu'.$row['id'].'" id="thangnamcu'.$row['id'].'" value="'.$row['ngaycudi'].'" onKeyPress="keypress(0,
		   '.$row['id'].')"   /></td >';
	      echo ' <td width="56px">  <input size ="5" name="doituong'.$row['id'].'" id="doituong'.$row['id'].'" value ="'.$row['doituong'].'" /></td>';	
											  echo '<td width="68px"> <input type="text" name="qdinh'.$row['id'].'" id="qdinh'.$row['id'].'" value="'.$row['quyetdinh'].'" size="8" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';	
		   echo '<td><button name="btnDelete" class="btnDelete" onclick="keypress(2,'.$row['id'].')" value="'.$row['id'].'" >Xóa</button>
		   <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')"  value = "'.$row['id'].'" >Sửa</button>
		   </td>';
								 echo'</tr>';
								 
								 
					  }
		  	?>
            <tr >
                            
                                        <td >
                                           <input autofocus type="text" name="tentruong" id="tentruong" size="15" onKeyPress="keypress(1,0)" />
                                        </td>
                                        <td >
                                               <input type="text" name="lophoc" id="lophoc" size="20" onKeyPress="keypress(1,0)"  />  
                                        </td>
                                        <td>
                                                <input type="text" name="thoigian" id="thoigian" size="15"  onKeyPress="keypress(1,0)" /> 
                                        </td>
                                        <td width="100px" >
                                       
                                            <select name="hinhthuc" id="hinhthuc"  style="width:100px"  onKeyPress="keypress(1,0)" >
                                                <option value="">---Chọn---</option>
                                                <option value="Chính quy">Chính quy</option>
                                                 <option value="Tại chức">Tại chức</option>
                                                <option value="Chuyên tu">Chuyên tu</option>
                                                 <option value="Bồi dưỡng">Bồi dưỡng</option>
                                                <option value="Tập trung">Tập trung</option>
                                                 <option value="Không tập trung">Không tập trung</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </td>
                                           <td width="100px">
                                        
                                                <select name="vanbang" id="vanbang"  style="width:100px"   onKeyPress="keypress(1,0)"  >
                                                 <option value="">---Chọn---</option>
                                                 <option value="TSKH">TSKH</option>
                                                 <option value="TS">TS</option>
                                                 <option value="NCS">NCS</option>
                                                 <option value="Ths">Ths</option>
                                                 <option value="Cử nhân">Cử nhân</option>
                                                 <option value="Kỹ sư">Kỹ sư</option>
                                                 <option value="Cao đẳng">Cao đẳng</option>
                                                 <option value="Trung cấp">Trung cấp</option>
                                                 <option value="Sơ cấp">Sơ cấp</option>
                                                 <option value="Chuyên ngành">Chuyên ngành</option>
                                                 <option value="Bằng tốt nghiệp">Bằng tốt nghiệp</option>
                                                 <option value="Chứng chỉ">Chứng chỉ</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </td>
                                        <td width="80px">
                                               
                                                <select name="noidaotao" style="width:80px" id="noidaotao" onKeyPress="keypress(1,0)"  >
                                                 <option value="">---Chọn---</option>
                                                 <option value="Trong nước">Trong nước</option>
                                                 <option value="Ngoài nước">Ngoài nước</option>
                                                  <option value="Liên kết">Liên kết</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </td>
                                        <td width="80px" >
                                               
                                                  <select name="khoahoc" id="khoahoc" style="width:80px"   onKeyPress="keypress(1,0)"  >
                                                 <option value="">---Chọn---</option>
                                                 <option value="Ngắn hạn">Ngắn hạn</option>
                                                 <option value="Dài hạn">Dài hạn</option>
                                              
                                            </select>
                                        </td>
                                       <td  >
                                            <input type="text" name="dean" id="dean" size="8" onKeyPress="keypress(1,0)" /> 
                                        </td>
                                      
                                        <td width="100px">
                                               <input type="month" style="width:135px"   name="thangnamcu" id="thangnamcu" onKeyPress="keypress(1,0)" />  
                                        </td>
                                        <td >
                                                  <select name="doituong" id="doituong"  >
                                                 <option value="">Chọn</option>
                                                 <option value="I">I</option>
                                                 <option value="II">II</option>
                                                  <option value="III">III</option>
                                                 <option value="IV">IV</option>
                                                 <option value="V">V</option>
                                                 <option value="Khác">Khác</option>
                                            </select>
                                        </td>
                                             <td >
                                            <input type="text" name="qdinh" id="qdinh" size="8" onKeyPress="keypress(1,0)" />
                                        </td>
                                        <td>
                                           <button name="btnInsert" class="btnInsert" onClick="keypress100(1,0)" >Thêm</button>
                                        </td>
 
                                    </tr>
   
</body>
</html>