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
		  	  $mota = isset($_GET['mota'])?$_GET['mota']:'';
			  $hoten = isset($_GET['hoten'])?$_GET['hoten']:'';
			  $quanhe = isset($_GET['quanhe'])?$_GET['quanhe']:'';
			  $namsinh = isset($_GET['namsinh'])?$_GET['namsinh']:'';

		
		  $id = isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
           $query ="Insert into quanhegiadinh values('','$_SESSION[lylich_id]','$quanhe','$hoten','$namsinh','$mota','0')";
		 
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else if($action==0){
			
			           $query ="Update  quanhegiadinh set quanhe='$quanhe',hoten='$hoten',namsinh='$namsinh',mota='$mota' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from quanhegiadinh where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}

             
			         $query = "Select * from quanhegiadinh where lylich_id = '$_SESSION[lylich_id]' and banthan_vochong='0'";
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	         echo '<td> 
					    <select   id="quanhe'.$row['id'].'" name="quanhe'.$row['id'].'"  onKeyPress="keypress(0,'.$row['id'].')" >
						                         <option value="" >Chọn</option>
                                                 <option';
												 if($row['quanhe']=='Bố')
												   echo " selected ";
												 echo' value="Bố">Bố</option>
                                                 <option';
												  if($row['quanhe']=='Mẹ')
												   echo " selected ";
												 echo' value="Mẹ">Mẹ</option>
                                                 <option ';
												 if($row['quanhe']=='Vợ')
												   echo " selected ";
												 echo ' value="Vợ" >Vợ</option>
                                                 <option ';
												  if($row['quanhe']=='Chồng')
												   echo " selected ";
												 echo'value="Chồng">Chồng</option>
                                                 <option ';
												  if($row['quanhe']=='Con trai')
												   echo " selected ";
												 echo  'value="Con trai">Con trai</option>
                                                 <option ';
												 if($row['quanhe']=='Con gái')
												   echo " selected ";
												  echo'value="Con gái">Con gái</option>
                                                 <option ';
												  if($row['quanhe']=='Anh trai')
												   echo " selected ";
												 echo' value="Anh trai">Anh trai</option>
                                                 <option ';
												 if($row['quanhe']=='Chị gái')
												   echo " selected ";
												 echo' value="Chị gái">Chị gái</option>
                                                 <option ';
												  if($row['quanhe']=='Em trai')
												   echo " selected ";
												 echo ' value="Em trai">Em trai</option>
                                                 <option ';
												 if($row['quanhe']=='Em gái')
												   echo " selected ";
												 echo 'value="Em gái">Em gái</option>
                                           </select>
					   </td>';
		   echo '<td> <input type="text" name="hoten'.$row['id'].'" id="hoten'.$row['id'].'" value="'.$row['hoten'].'" size="20" 
		   onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   	   echo '<td> <input type="number" name="namsinh'.$row['id'].'" id="namsinh'.$row['id'].'" value="'.$row['namsinh'].'" size="20" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="lienquan'.$row['id'].'" id="lienquan'.$row['id'].'" value="'.$row['mota'].'" size="80" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
				
						
		   echo '<td><button name="btnDelete" onclick="keypress(2,'.$row['id'].')" class="btnDelete" value = "'.$row['id'].'" >Xóa</button>
		   <button class="btnUpdate" name="btnUpdate" onClick="keypress100(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                            <select name="quanhe" id="quanhe" onKeyPress="keypress(1,0)" >
                                                 <option value="">Chọn</option>
                                                 <option value="Bố">Bố</option>
                                                 <option value="Mẹ">Mẹ</option>
                                                 <option value="Vợ">Vợ</option>
                                                 <option value="Chồng">Chồng</option>
                                                 <option value="Con trai">Con trai</option>
                                                 <option value="Con gái">Con gái</option>
                                                 <option value="Anh trai">Anh trai</option>
                                                 <option value="Chị gái">Chị gái</option>
                                                 <option value="Em trai">Em trai</option>
                                                 <option value="Em gái">Em gái</option>
                                           </select>
                                        </td>
                                        <td >
                                               <input type="text" name="hoten" id="hoten" size="20" onKeyPress="keypress(1,0)"  />  
                                        </td>
                                        <td>
                                                <input type="number" name="namsinh" id="namsinh" size="20" onKeyPress="keypress(1,0)" /> 
                                        </td>
                                        <td>
                                                <input type="text" name="lienquan" id="lienquan" size="80" onKeyPress="keypress(1,0)" /> 
                                        </td>
                                   
                                  <td>
                                  <button id="btnInsert" name="btnInsert" onClick="keypress100(1,0)">Thêm</button>
                               </td>
                                      
                                    </tr>
                                    
   
</body>
</html>