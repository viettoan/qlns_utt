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
		  	  $vande = isset($_GET['vande'])?$_GET['vande']:'';
			  $odau = isset($_GET['odau'])?$_GET['odau']:'';
			  $lydo = isset($_GET['lydo'])?$_GET['lydo']:'';
			  $thoidiem_batdau =isset($_GET['thoidiem_batdau'])?$_GET['thoidiem_batdau']:'';
			  $khaibaocho = isset($_GET['khaibaocho'])?$_GET['khaibaocho']:'';
			  $thoidiem_ketthuc =isset($_GET['thoidiem_ketthuc'])?$_GET['thoidiem_ketthuc']:'';

		
		  $id = isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
           $query ="Insert into phamphap values('','$_SESSION[lylich_id]','$lydo','$thoidiem_batdau','$thoidiem_ketthuc','$odau','$khaibaocho','$vande')";
		 
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else if($action==0){
			
			           $query ="Update  phamphap set odau='$odau',khaibaocho='$khaibaocho',lydo='$lydo',thoidiem_batdau='$thoidiem_batdau',thoidiem_ketthuc='$thoidiem_ketthuc',vande='$vande' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from phamphap where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}

        
				  $query = "Select * from phamphap where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					
									 echo '<tr> ';
		   
        	           echo '<td> <input type="date" name="thoidiem_batdau'.$row['id'].'" id="thoidiem_batdau'.$row['id'].'" value="'.$row['thoidiem_batdau'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
		   echo '<td> <input type="date" name="thoidiem_ketthuc'.$row['id'].'" id="thoidiem_ketthuc'.$row['id'].'" value="'.$row['thoidiem_ketthuc'].'" size="25" 
		   onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
	   echo '<td> <input type="text" name="khaibaocho'.$row['id'].'" id="khaibaocho'.$row['id'].'" value="'.$row['khaibaocho'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
					   echo '<td> <input type="text" name="vande'.$row['id'].'" id="vande'.$row['id'].'" value="'.$row['vande'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
					   		   echo '<td> <input type="text" name="odau'.$row['id'].'" id="odau'.$row['id'].'" value="'.$row['odau'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
					   				   echo '<td> <input type="text" name="lydo'.$row['id'].'" id="lydo'.$row['id'].'" value="'.$row['lydo'].'" size="25" onKeyPress="keypress1(0,'.$row['id'].')"  /></td>';
						
		   echo '<td><button name="btnDelete1" onclick="keypress1(2,'.$row['id'].')" class="btnDelete1" value = "'.$row['id'].'" >Xóa</button>
		   <button name="btnUpdate" class="btnUpdate" onClick="keypress101(0,'.$row['id'].')">Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="date" name="thoidiem_batdau" id="thoidiem_batdau" size="25" onKeyPress="keypress1(1,0)"  />
                                        </td>
                                          <td >
                                           <input type="date" name="thoidiem_ketthuc" id="thoidiem_ketthuc" size="25" onKeyPress="keypress1(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="text" name="khaibaocho" id="khaibaocho" size="25" onKeyPress="keypress1(1,0)"   />  
                                        </td>
                                        <td>
                                                <input type="text" name="vande" id="vande" size="25" onKeyPress="keypress1(1,0)"  /> 
                                        </td>
                                   
                                           <td >
                                           <input type="text" name="odau" id="odau" size="25"  onKeyPress="keypress1(1,0)"  />
                                        </td>
                                        <td >
                                               <input type="text" name="lydo" id="lydo" size="25" onKeyPress="keypress1(1,0)"   />  
                                      </td>
                                  <td><button name="btnInsert" id="btnInsert" onClick="keypress101(1,0)">Thêm</button></td>
                                      
                                    </tr>
</body>
</html>