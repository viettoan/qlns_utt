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
		  	  $nam = isset($_GET['nam'])?$_GET['nam']:'';
			  $capquyetdinh = isset($_GET['capquyetdinh'])?$_GET['capquyetdinh']:'';
			  $lydo = isset($_GET['lydo'])?$_GET['lydo']:'';
			  $hinhthuc =isset($_GET['hinhthuc'])?$_GET['hinhthuc']:'';

		
		  $id = isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
           $query ="Insert into kyluat values('','$_SESSION[lylich_id]','$capquyetdinh','$nam','$lydo','$hinhthuc')";
		 
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else if($action==0){
			
			           $query ="Update  kyluat set nam='$nam',capquyetdinh='$capquyetdinh',lydo='$lydo',hinhthuc='$hinhthuc' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from kyluat where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}

        
				  $query = "Select * from kyluat where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> <input type="text" name="capquyetdinh'.$row['id'].'" id="capquyetdinh'.$row['id'].'" value="'.$row['capquyetdinh'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   echo '<td> <input type="number" name="namquyetdinh'.$row['id'].'" id="namquyetdinh'.$row['id'].'" value="'.$row['nam'].'" size="30" 
		   onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="lydo'.$row['id'].'" id="lydo'.$row['id'].'" value="'.$row['lydo'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
					   echo '<td> <input type="text" name="hinhthuc'.$row['id'].'" id="hinhthuc'.$row['id'].'" value="'.$row['hinhthuc'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
						
		   echo '<td><button name="btnDelete" onclick="keypress(2,'.$row['id'].')" class="btnDelete" value = "'.$row['id'].'" >Xóa</button>
		       <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')">Sửa </button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td>
                                           <input type="text" name="capquyetdinh" id="capquyetdinh" size="30" onKeyPress="keypress(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="number" name="namquyetdinh" id="namquyetdinh" size="30" onKeyPress="keypress(1,0)"   />  
                                        </td>
                                        <td>
                                                <input type="text" name="lydo" id="lydo" size="30"  onKeyPress="keypress(1,0)"  /> 
                                        </td>
                                        <td >
                                            <input type="text" name="hinhthuc" id="hinhthuc" size="30" onKeyPress="keypress(1,0)"   /> 
                                        </td>
                                        <td><button name="btnInsert" id="btnInsert" onClick="keypress100(1,0)">Thêm</button></td>
                                    </tr>
   
</body>
</html>