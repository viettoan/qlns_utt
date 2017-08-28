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
		  $thoidiembatdau = isset($_GET['thoidiembatdau'])?$_GET['thoidiembatdau']:'';
		  $thoidiembatdau = $thoidiembatdau.'-01';
		  $thoidiemketthuc = isset($_GET['thoidiemketthuc'])?$_GET['thoidiemketthuc']:'';
	      $thoidiemketthuc = $thoidiemketthuc.'-01';
		  $chucvu = isset($_GET['chucvu'])?$_GET['chucvu']:'';
		  $id = isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
           $query ="Insert into congtac values('','$_SESSION[lylich_id]','$thoidiembatdau','$thoidiemketthuc','$chucvu')";
		 
		   $result = mysql_query($query);
		   if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		   	}
		else if($action==0){
			
			           $query ="Update  congtac set thoidiem_batdau='$thoidiembatdau',thoidiem_ketthuc='$thoidiemketthuc',chucvu='$chucvu' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from congtac where id='$id'";
								   
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		
       

        
				  $query = "Select * from congtac where lylich_id = '$_SESSION[lylich_id]' ";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					$batdau = substr( $row['thoidiem_batdau'],0,7);
					$ketthuc = substr( $row['thoidiem_ketthuc'],0,7);

					
									 echo '<tr> ';
		   
           echo '<td style="width:140px" > <input style="width:140px"  type="month" name="thoidiembatdau'.$row['id'].'" id="thoidiembatdau'.$row['id'].'" value="'.$batdau.'" size="25" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
		           echo '<td style="width:140px" > <input style="width:140px"  type="month" name="thoidiemketthuc'.$row['id'].'" id="thoidiemketthuc'.$row['id'].'" value="'.$ketthuc .'" size="25" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
		   echo '<td> <input type="text" name="chucvu'.$row['id'].'" id="chucvu'.$row['id'].'" value="'.$row['chucvu'].'" size="100" onKeyPress="keypress(0,
		   '.$row['id'].')"  /></td>';
		
		   echo '<td><button onclick="keypress(2,'.$row['id'].')" name="btnDelete" class="btnDelete" value = "'.$row['id'].'" >Xóa</button>
		     <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
								 
								 
					  }
		  	?>
            <tr >
                                           <td style="width:140px" >
                                           <input style="width:140px"  autofocus type="month" placeholder="yyyy-mm-dd" name="thoidiembatdau" id="thoidiembatdau" size="25" onKeyPress="keypress(1,0)" />
                                        </td>
                                         <td style="width:140px" >
                                           <input  style="width:140px" type="month" placeholder="yyyy-mm-dd" name="thoidiemketthuc" id="thoidiemketthuc" size="25" onKeyPress="keypress(1,0)" />
                                        </td>
                                        <td >
                                               <input type="text" name="chucvu" id="chucvu" size="100" onKeyPress="keypress(1,0)"  />  
                                        </td>
                                        <td >
                                                <button name="btnInsert" id="btnInsert" onClick="keypress100(1,0)">Thêm</button>
                                        </td>
                                    </tr>
   
</body>
</html>