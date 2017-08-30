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
           $query ="Insert into quanhegiadinh values('','$_SESSION[lylich_id]','$quanhe','$hoten','$namsinh','$mota','1')";
		 
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

             
				  $query = "Select * from quanhegiadinh where lylich_id = '$_SESSION[lylich_id]' and banthan_vochong='1'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	       echo '<td> 
					       <select name="quanhe_1'.$row['id'].'" id="quanhe_1'.$row['id'].'"  onKeyPress="keypress1(0,'.$row['id'].')"  >
                                                 <option value="">Chọn</option>
                                                 <option ';
												 if($row['quanhe']=='Bố')
												    echo ' selected ';
												 echo'value="Bố">Bố</option>
                                                 <option';
												  if($row['quanhe']=='Mẹ')
												    echo ' selected ';
												 echo' value="Mẹ">Mẹ</option>
                                                 <option ';
												  if($row['quanhe']=='Anh vợ')
												    echo ' selected ';
												 echo 'value="Anh vợ">Anh vợ</option>
                                                 <option ';
												  if($row['quanhe']=='Chị vợ')
												    echo ' selected ';
												 echo'value="Chị vợ">Chị vợ</option>
                                                 <option ';
												  if($row['quanhe']=='Em vợ')
												    echo ' selected ';
												 echo' value="Em vợ">Em vợ</option>
                                                 <option ';
												  if($row['quanhe']=='Anh chồng')
												    echo ' selected ';
												 echo 'value="Anh chồng">Anh chồng</option>
                                                 <option ';
												  if($row['quanhe']=='Chị chồng')
												    echo ' selected ';
												 echo' value="Chị chồng">Chị chồng</option>
                                                 <option ';
												  if($row['quanhe']=='Em chồng')
												    echo ' selected ';
												 echo'value="Em chồng">Em chồng</option>
                                                
                                           </select>
					   </td>';
		   echo '<td> <input type="text" name="hoten1'.$row['id'].'" id="hoten1'.$row['id'].'" value="'.$row['hoten'].'" size="20" 
		   onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
		   	   echo '<td> <input type="number" name="namsinh1'.$row['id'].'" id="namsinh1'.$row['id'].'" value="'.$row['namsinh'].'" size="20" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="lienquan1'.$row['id'].'" id="lienquan1'.$row['id'].'" value="'.$row['mota'].'" size="80" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
				
						
		   echo '<td><button name="btnDelete1" class="btnDelete1" onclick="keypress1(2,'.$row['id'].')" value = "'.$row['id'].'" >Xóa</button>
		   <button class="btnUpdate" name="btnUpdate" onClick="keypress101(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           
                                                 <select name="quanhe_1" id="quanhe_1"  onKeyPress="keypress1(1,0)" >
                                                 <option value="">Chọn</option>
                                                 <option value="Bố">Bố</option>
                                                 <option value="Mẹ">Mẹ</option>
                                                 <option value="Anh vợ">Anh vợ</option>
                                                 <option value="Chị vợ">Chị vợ</option>
                                                 <option value="Em vợ">Em vợ</option>
                                                 <option value="Anh chồng">Anh chồng</option>
                                                 <option value="Chị chồng">Chị chồng</option>
                                                 <option value="Em chồng">Em chồng</option>
                                                
                                           </select>
                                        </td>
                                        <td >
                                               <input type="text" name="hoten1" id="hoten1" size="20" onKeyPress="keypress1(1,0)"   />  
                                        </td>
                                        <td>
                                                <input type="number" name="namsinh1" id="namsinh1" size="20" onKeyPress="keypress1(1,0)"   /> 
                                        </td>
                                        <td>
                                                <input type="text" name="lienquan1" id="lienquan1" size="80" onKeyPress="keypress1(1,0)"   /> 
                                        </td>
                                        <td>
<button name="btnInsert" id="btnInsert" onClick="keypress101(1,0)" >Thêm</button>
                                        </td>
                                  
                                      
                                    </tr>
                                    
   
</body>
</html>