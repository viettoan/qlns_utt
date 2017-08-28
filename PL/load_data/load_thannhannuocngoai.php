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
		  	  $lamgi = isset($_GET['lamgi'])?$_GET['lamgi']:'';
			  $hoten = isset($_GET['hoten'])?$_GET['hoten']:'';
			  $quanhe = isset($_GET['quanhe'])?$_GET['quanhe']:'';
			  $diachi = isset($_GET['diachi'])?$_GET['diachi']:'';
	

		
		  $id = isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
           $query ="Insert into thannhannuocngoai values('','$_SESSION[lylich_id]','$quanhe','$hoten','$lamgi','$diachi')";
		 
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else if($action==0){
			
			           $query ="Update  thannhannuocngoai set lamgi='$lamgi',hoten='$hoten',quanhe='$quanhe',diachi='$diachi' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from thannhannuocngoai where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}

        
        
				  $query = "Select * from thannhannuocngoai where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> <input type="text" name="quanhe'.$row['id'].'" id="quanhe'.$row['id'].'" value="'.$row['quanhe'].'" size="30" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
		   echo '<td> <input type="text" name="hoten'.$row['id'].'" id="hoten'.$row['id'].'" value="'.$row['hoten'].'" size="30" 
		   onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="congviec'.$row['id'].'" id="congviec'.$row['id'].'" value="'.$row['lamgi'].'" size="30" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
	
	  	   echo '<td> <input type="text" name="diachi'.$row['id'].'" id="diachi'.$row['id'].'" value="'.$row['diachi'].'" size="30" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
						
		   echo '<td><button name="btnDelete1" class="btnDelete1" onclick="keypress1(2,'.$row['id'].')" value = "'.$row['id'].'" >Xóa</button>
		      <button name="btnUpdate" class="btnUpdate" onClick="keypress101(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="text" name="quanhe" id="quanhe" size="30" onKeyPress="keypress1(1,0)" />
                                        </td>
                                        <td >
                                               <input type="text" name="hoten" id="hoten" size="30" onKeyPress="keypress1(1,0)"  />  
                                        </td>
                                        <td>
                                                <input type="text" name="congviec" id="congviec" size="30" onKeyPress="keypress1(1,0)" /> 
                                        </td>
                                   
                                           <td >
                                           <input type="text" name="diachi" id="diachi" size="30" onKeyPress="keypress1(1,0)"  />
                                        </td>
                                      <td> <button id="btnInsert" name="btnInsert" onClick="keypress101(1,0)">Thêm</button></td>
                                  
                                      
                                    </tr>
                                    
   
</body>
</html>