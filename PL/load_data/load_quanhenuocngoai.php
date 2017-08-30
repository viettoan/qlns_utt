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
			  $tochuc = isset($_GET['tochuc'])?$_GET['tochuc']:'';
			  $truso = isset($_GET['truso'])?$_GET['truso']:'';
	

		
		  $id = isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
           $query ="Insert into tochucnuocngoai values('','$_SESSION[lylich_id]','$lamgi','$tochuc','$truso')";
		 
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else if($action==0){
			
			           $query ="Update  tochucnuocngoai set lamgi='$lamgi',tochuc='$tochuc',truso='$truso' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from tochucnuocngoai where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}

        
				 
				  $query = "Select * from tochucnuocngoai where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> <input type="text" name="tochuc'.$row['id'].'" id="tochuc'.$row['id'].'" value="'.$row['tochuc'].'" size="40" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   echo '<td> <input type="text" name="truso'.$row['id'].'" id="truso'.$row['id'].'" value="'.$row['truso'].'" size="40" 
		   onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="nhiemvu'.$row['id'].'" id="nhiemvu'.$row['id'].'" value="'.$row['lamgi'].'" size="40" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
	
						
		   echo '<td><button name="btnDelete" class="btnDelete" onclick="keypress(2,'.$row['id'].')" value = "'.$row['id'].'" >Xóa</button>
		    <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="text" name="tochuc" id="tochuc" size="40" onKeyPress="keypress(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="text" name="truso" id="truso" size="40" onKeyPress="keypress(1,0)"  />  
                                        </td>
                                        <td>
                                                <input type="text" name="nhiemvu" id="nhiemvu" size="40" onKeyPress="keypress(1,0)" /> 
                                        </td>
                                        <td> <button name="btnInsert" id="btnInsert" onClick="keypress100(1,0)">Thêm</button></td>
                                        
                                  
                                      
                                    </tr>
   
</body>
</html>