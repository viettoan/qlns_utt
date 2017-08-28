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
		  	  $ngaythangnam = isset($_GET['ngaythangnam'])?$_GET['ngaythangnam']:'';
			  $nhanxet = isset($_GET['nhanxet'])?$_GET['nhanxet']:'';
			  $lydo = isset($_GET['lydo'])?$_GET['lydo']:'';

		
		  $id = isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
           $query ="Insert into danhgia values('','$_SESSION[lylich_id]','$ngaythangnam','$nhanxet','$lydo')";
		 
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else if($action==0){
			
			           $query ="Update  danhgia set nam='$ngaythangnam',nhanxetdanhgia='$nhanxet',lydo='$lydo' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from danhgia where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}

                                        
     	  $query = "Select * from danhgia where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        
		           echo '<td> <input type="date" name="ngaythangnam'.$row['id'].'" id="ngaythangnam'.$row['id'].'" value="'.$row['nam'].'" size="20" onKeyPress="keypress2(0,'.$row['id'].')"  /></td>';
		      echo '<td> 
		   
		
             <select name="nhanxet'.$row['id'].'" id="nhanxet'.$row['id'].'" 
		   onKeyPress="keypress2(0,'.$row['id'].')"  /> 
                              <option value="">Chọn</option>
                             <option';
							 if($row['nhanxetdanhgia']=='Hoàn thành xuất sắc nhiệm vụ')
							  echo " selected ";
							  echo ' value="Hoàn thành xuất sắc nhiệm vụ">Hoàn thành xuất sắc nhiệm vụ</option>
                             <option';
							  if($row['nhanxetdanhgia']=="Hoàn thành tốt nhiệm vụ")
							  echo " selected ";
							 echo ' value="Hoàn thành tốt nhiệm vụ">Hoàn thành tốt nhiệm vụ</option>
                             <option ';
							  if($row['nhanxetdanhgia']=="Hoàn thành nhiệm vụ")
							  echo " selected ";
							 echo' value="Hoàn thành nhiệm vụ">Hoàn thành nhiệm vụ</option> <option ';
							    if($row['nhanxetdanhgia']=="Không hoàn thành nhiệm vụ")
							  echo " selected ";
                            echo ' value="Không hoàn thành nhiệm vụ">Không hoàn thành nhiệm vụ</option></select>
		   </td>';
	   echo '<td> <input type="text" name="lydo'.$row['id'].'" id="lydo'.$row['id'].'" value="'.$row['lydo'].'" size="50" onKeyPress="keypress2(0,'.$row['id'].')"  /></td>';
					
		   echo '<td><button name="btnDelete2" onclick="keypress2(2,'.$row['id'].')" class="btnDelete2" value = "'.$row['id'].'" >Xóa</button>
		    <button name="btnUpdate" class="btnUpdate" onClick="keypress102(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="date" name="ngaythangnam" id="ngaythangnam" size="20" OnKeyPress="keypress2(1,0)"  />
                                        </td>
                                        <td >
                                               <select  name="nhanxet" id="nhanxet"  OnKeyPress="keypress2(1,0)">
                                                    <option value="">Chọn</option>
                                               <option value="Hoàn thành xuất sắc nhiệm vụ">Hoàn thành xuất sắc nhiệm vụ</option>
                                               <option value="Hoàn thành tốt nhiệm vụ">Hoàn thành tốt nhiệm vụ</option>
                                               <option value="Hoàn thành nhiệm vụ">Hoàn thành nhiệm vụ</option>
                                               <option value="Không hoàn thành nhiệm vụ">Không hoàn thành nhiệm vụ</option>
                                               </select> 
                                        </td>
                                        <td>
                                                <input type="text" name="lydo" id="lydo" size="50"  OnKeyPress="keypress2(1,0)"  /> 
                                        </td>
                                        
                                        <td><button name="btnInsert" id="btnInsert" onClick="keypress102(1,0)">Thêm</button></td>
                                  
                                      
                                    </tr>
   
</body>
</html>