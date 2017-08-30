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
		  	  $thoigian = isset($_GET['thoigian'])?$_GET['thoigian']:'';
			  $coquan = isset($_GET['coquan'])?$_GET['coquan']:'';
			  $diadiem = isset($_GET['diadiem'])?$_GET['diadiem']:'';
			  $donvi =isset($_GET['donvi'])?$_GET['donvi']:'';
			  $chucvu =isset($_GET['chucvu'])?$_GET['chucvu']:'';

		
		  $id = isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
           $query ="Insert into chedocu values('','$_SESSION[lylich_id]','$coquan','$donvi','$diadiem','$chucvu','$thoigian')";
		 
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else if($action==0){
			
			           $query ="Update  chedocu set thoigian='$thoigian',donvi='$donvi',chucvu='$chucvu',diadiem='$diadiem',coquan='$coquan' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from chedocu where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}

        
				  $query = "Select * from chedocu where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> <input type="number" name="thoigianlamviec'.$row['id'].'" id="thoigianlamviec'.$row['id'].'" value="'.$row['thoigian'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   echo '<td> <input type="text" name="coquan'.$row['id'].'" id="coquan'.$row['id'].'" value="'.$row['coquan'].'" size="30" 
		   onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="donvi'.$row['id'].'" id="donvi'.$row['id'].'" value="'.$row['donvi'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
					   echo '<td> <input type="text" name="chucvu'.$row['id'].'" id="chucvu'.$row['id'].'" value="'.$row['chucvu'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
					   				   echo '<td> <input type="text" name="diadiem'.$row['id'].'" id="diadiem'.$row['id'].'" value="'.$row['diadiem'].'" size="30" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
						
		   echo '<td><button name="btnDelete" class="btnDelete" value = "'.$row['id'].'" onclick="keypress(2,'.$row['id'].')" >Xóa</button>
		   <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="number" name="thoigianlamviec" id="thoigianlamviec" size="30" onKeyPress="keypress(1,0)"   />
                                        </td>
                                        <td >
                                               <input type="text" name="coquan" id="coquan" size="30"  onKeyPress="keypress(1,0)"   />  
                                        </td>
                                        <td>
                                                <input type="text" name="donvi" id="donvi" size="30"  onKeyPress="keypress(1,0)"  /> 
                                        </td>
                                   
                                           <td >
                                           <input type="text" name="chucvu" id="chucvu" size="30" onKeyPress="keypress(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="text" name="diadiem" id="diadiem" size="30" onKeyPress="keypress(1,0)"  />  
                                      </td>
                                  
                                      <td><button id="btnInsert" name="btnInsert" onClick="keypress100(1,0)">Thêm</button></td>
                                    </tr>
   
</body>
</html>