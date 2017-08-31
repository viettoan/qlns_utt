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
       
function createcb4($table,$col1,$cmt,$selected=0,$keypress){ // hàm tạo select
            $sql1="select $col1 from $table ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select '.$keypress.' onChange="keypress52();
	  keypress82();"
			 required  name="'.$table.'" id='.$table.' style="margin-left:5px;">';
                    echo'<option value="">Chọn</option>';
            foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' $keypress  value="'.$k.'">'.$v.'</option>';
            }
            echo '</select>';
          }
		      function createcb5($table,$col1,$col2,$cmt,$selected=0,$keypress){ // hàm tạo select
            $sql1="select $col1,$col2 from $table  ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col2]]=$row[$col1];
            }
            echo '<select  onChange="keypress62()" '.$keypress.' required name="mangach" id="mangach" style="margin-left:5px;">';
                    echo'<option value="" >chọn</option>';
           		  $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
		  $result_check = mysql_query($check);
		  $row_check = mysql_fetch_row($result_check);
		  $check_select = $row_check[0];
			if($check_select!=0){
				foreach ($ar as $k => $v) {
				  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
				}
				
			}
			echo '</select>';
          }
		  
	
		  
		  
		        function createcb6($table,$col1,$cmt,$selected=0,$keypress){ // hàm tạo select
            $sql1="select $col1 from $table  ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select '.$keypress.' required   name="hesoluong" id="hesoluong" style="margin-left:5px;">';
                    echo'<option value="">chọn</option>';
      	/*	  $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
		  $result_check = mysql_query($check);
		  $row_check = mysql_fetch_row($result_check);
		  $check_select = $row_check[0];
			if($check_select!=0){
				foreach ($ar as $k => $v) {
				  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
				}
				
				}*/
				echo '</select>';
          }
		       function createcb10($table,$col1,$cmt,$selected=0,$keypress){ // hàm tạo select
            $sql1="select $col1 from $table ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select onChange="keypress72()"  '.$keypress.' required  name="bac" id="bac" >';
                    echo'<option value="">-chọn</option>';
		
		/*	   foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
            }*/
            echo '</select>';
          }
  
		 function createcb51($table,$col1,$col2,$cmt,$selected=0,$keypress,$stt){ // hàm tạo select
            $sql1="select $col1,$col2 from $table   ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col2];
			  $temp = $row[$col1];
            }
            echo '<select '.$keypress.' onChange="keypress61('.$stt.')" required name="mangach'.$stt.'" id="mangach'.$stt.'" style="margin-left:5px;">';
                    echo'<option value="">chọn</option>';
             if(isset($_SESSION['admin_id']))
						  {
									 $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
					  $result_check = mysql_query($check);
					  $row_check = mysql_fetch_row($result_check);
					  $check_select = $row_check[0];  
						  }
						  else if($_SESSION['lylich_id1'])
						      $check_select=1;
			if($check_select!=0){
				foreach ($ar as $k => $v) {
				  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
				}
				
			}
			echo '</select>';
          }
		  
		         function createcb61($table,$col1,$cmt,$selected=0,$keypress,$ten,$dk,$ten1,$dk1,$stt){ // hàm tạo select
            $sql1="select $col1 from $table inner join ngach on ngach.id = $table.ngachid where $ten = '$dk' and $ten1 ='$dk1'  ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select '.$keypress.'required   name="hesoluong'.$stt.'" id="hesoluong'.$stt.'" style="margin-left:5px;">';
                    echo'<option value="">chọn</option>';
         if(isset($_SESSION['admin_id']))
						  {
									 $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
					  $result_check = mysql_query($check);
					  $row_check = mysql_fetch_row($result_check);
					  $check_select = $row_check[0];  
						  }
						  else if($_SESSION['lylich_id1'])
						      $check_select=1;
			if($check_select!=0){
				foreach ($ar as $k => $v) {
				  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
				}
				
				}
				echo '</select>';
          }
		       function createcb101($table,$col1,$cmt,$selected=0,$keypress,$ten,$dk,$stt){ // hàm tạo select
            $sql1="select $col1 from $table inner join ngach on ngach.id = $table.ngachid where $ten='$dk' ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select '.$keypress.' onChange="keypress71('.$stt.')" required  name="bac'.$stt.'" id="bac'.$stt.'" >';
                    echo'<option value="">-chọn</option>';
				   if(isset($_SESSION['admin_id']))
						  {
									 $check = "Select taikhoan_id from lylich where taikhoan_id = '$_SESSION[admin_id]'";
					  $result_check = mysql_query($check);
					  $row_check = mysql_fetch_row($result_check);
					  $check_select = $row_check[0];  
						  }
						  else if($_SESSION['lylich_id1'])
						      $check_select=1;
					if($check_select!=0){
					   foreach ($ar as $k => $v) {
					  echo '<option '.($selected==$k?"selected":"").' value="'.$k.'">'.$v.'</option>';
					}
					}
            echo '</select>';
          }
		function createcb41($table,$col1,$cmt,$selected=0,$keypress,$stt){ // hàm tạo select
            $sql1="select $col1 from $table ";
            $re_s=mysql_query($sql1);
            $ar=array();
            while($row=mysql_fetch_array($re_s)){
              $ar[$row[$col1]]=$row[$col1];
            }
            echo '<select onChange="keypress51('.$stt.');keypress81('.$stt.')" '.$keypress.' required  name="ngach'.$stt.'" id="ngach'.$stt.'" style="margin-left:5px;">';
                    echo'<option value="">Chọn</option>';
            foreach ($ar as $k => $v) {
              echo '<option '.($selected==$k?"selected":"").' $keypress  value="'.$k.'">'.$v.'</option>';
            }
            echo '</select>';
          }
$action = isset($_GET['action'])?$_GET['action']:0;
		  	  $thoidiem = isset($_GET['thoidiem'])?$_GET['thoidiem']:'';
			  $thoidiem = $thoidiem.'-01';
			  $bac = isset($_GET['bac'])?$_GET['bac']:'';
			  $heso = isset($_GET['heso'])?$_GET['heso']:'';
			  $vuotkhung = isset($_GET['vuotkhung'])?$_GET['vuotkhung']:'';
			  $phantram_hs = isset($_GET['phantram_hs'])?$_GET['phantram_hs']:'';
			  $mangach = isset($_GET['mangach'])?$_GET['mangach']:'';
			  $ngach =  isset($_GET['ngach'])?$_GET['ngach']:'';
		  $id = isset($_GET['id'])?$_GET['id']:'';

		 include("../../config/config.php");
		 
        if($action ==1){
        	 // echo "<script>alert('$phantram_hs ' + 'sdgdg');</script>";
           $query ="Insert into quatrinhluong values('','$_SESSION[lylich_id]','$thoidiem','$ngach','$mangach','$bac','$heso','$vuotkhung','$phantram_hs')";
		 
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else if($action==0){
			
			           $query ="Update  quatrinhluong set thoidiem='$thoidiem',bac='$bac',heso='$heso',ngach='$ngach',mangach='$mangach',vuotkhung='$vuotkhung', phantram_hs='$phantram_hs' where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		else{
						           $query ="Delete from quatrinhluong where id='$id'";
	/*	 echo $query;*/
		   $result = mysql_query($query);
		    if($result)
	
		         mysql_query("Update  lylich set trangthai='0' where id='$_SESSION[lylich_id]'");	
		}
		
       

				
			
                                        

        
				  $query = "Select * from quatrinhluong where lylich_id = '$_SESSION[lylich_id]'";
			     
				  $result = mysql_query($query);
				
				
						  while($row = mysql_fetch_array($result)){
							  
					 $thoidiem = substr( $row['thoidiem'],0,7);
									 echo '<tr> ';
		   
           echo '<td> <input type="month" name="thoidiem'.$row['id'].'" id="thoidiem'.$row['id'].'" value="'.$thoidiem.'" size="20" onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
			           echo '<td> ';
				   createcb41('ngach','tenngach','name',$row['ngach'],'onKeyPress="keypress(0,'.$row['id'].')"' ,$row['id']);
				   echo'</td>';
				     echo '<td> ';
		                  createcb51('ngach','mangach','mangach','name',$row['mangach'],'onKeyPress="keypress(0,'.$row['id'].')"',$row['id']);
		  echo' </td>';	
		   echo '<td> 
		   ';
		     createcb101('bac_heso','bac','name',$row['bac'],'onKeyPress="keypress(0,'.$row['id'].')"' ,'mangach',$row['mangach'],$row['id']);
		   echo'</td>';
	echo '<td> ';
		   createcb61('bac_heso','heso','name',$row['heso'],'onKeyPress="keypress(0,'.$row['id'].')"','mangach',$row['mangach'],'bac',$row['bac'],$row['id']);
		   echo'</td>';	

		   // echo '<td> <input type="checkbox" name="phantram_hs'.$row['id'].'" id="phantram_hs'.$row['id'].'"';  if($row['phantram_hs']) echo " checked "; 
		   // echo'   size="20" 
		   // onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
		   echo "<td><select name='phantram_hs".$row['id']."' id='phantram_hs".$row['id']."'>";
		   if($row['phantram_hs']==0){
			echo"<option value='0' selected>Không</option>";
			echo"<option value='1'>Có</option>";
		   } 
		   else{
			echo"<option value='1' selected>Có</option>";
			echo"<option value='0' >Không</option>";
		   }
		  echo"</select></td>";

	echo '<td> <input type="text" name="vuotkhung'.$row['id'].'" id="vuotkhung'.$row['id'].'" value="'.$row['vuotkhung'].'" size="5" 
		   onKeyPress="keypress(0,'.$row['id'].')"  /></td>';
  			
		   echo '<td><button name="btnDelete" class="btnDelete" onclick="keypress(2,'.$row['id'].')" value = "'.$row['id'].'" >Xóa</button>
		      <button name="btnUpdate" class="btnUpdate" onClick="keypress100(0,'.$row['id'].')" >Sửa</button>
		   </td>';
								 echo'</tr>';
					  }
		  	?>
                                    <tr>
                                        <td >
                                           <input type="month" name="thoidiem" id="thoidiem" size="20" onKeyPress="keypress(1,0)"  />
                                        </td>
                                     <td >
                                              
                                                 <?php createcb4("ngach",'tenngach','name','0','onKeyPress="keypress(1,0)"') ?>
                                        </td>
                                         <td>
                                                
                                                <?php createcb5("ngach",'mangach','mangach','name','0','onKeyPress="keypress(1,0)') ?>
                                        </td>
                                          <td>
                                               
                                                 <?php createcb10("bac_heso",'bac','name','0','onKeyPress="keypress(1,0)"') ?>
                                        </td>
                                        <td>
                                            
                                                <?php createcb6("bac_heso",'heso','name','0','onKeyPress="keypress(1,0)') ?>
                                        </td>
                                        <td>
  											<!-- <input type="checkbox" name="phantram_hs" id="phantram_hs" size="15" onKeyPress="keypress(1,0)"  />  -->

  											<select name="phantram_hs" id="phantram_hs">
  												<option value="0">Không</option>
  												<option value="1">Có</option>
  											</select>
										</td>
                                        <td>
                                                <input type="text" name="vuotkhung" id="vuotkhung" size="5" onKeyPress="keypress(1,0)"  /> 
                                        </td>
                                       
                                    
                                        <td>
                                        <button name="btnInsert" name="btnInsert"  onClick="keypress100(1,0)">Thêm</button>
                                        </td>
                                      
                                    </tr>
         <script>

	//$(document).ready(function(e) {
//      $("#ngach").change(
//	   function(e){
//	/*	  keypress5($(this).attr("value"));
//		  keypress8($(this).attr("value"));*/
//	     alert("Hello");
//	   }
//	
//);
//});
/*$(document).ready(function(e) {
      $("#mangach").change(
	   function(e){
		  keypress6($(this).attr("value"));
	     
	   }
	
);
});
	$(document).ready(function(e) {
      $("#bac").change(
	   function(e){
		  keypress7($(this).attr("value"));
	     
	   }
	
);
});*/
  </script>
</body>
</html>