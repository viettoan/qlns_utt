<?php
  session_start();
/**
* Multi file upload example
* @author Resalat Haque
* @link http://www.w3bees.com/2013/02/multiple-file-upload-with-php.html
**/

$valid_formats = array("xls", "xlsx", "xlsm");
$max_file_size = 1024*1000; //100 kb
$path = "../../upload_capnhat/"; // Upload directory

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
  // Loop $_FILES to execute all files
  foreach ($_FILES['files']['name'] as $f => $name) {     
      $files = scandir($path);
      if ($_FILES['files']['error'][$f] == 4) {
          continue; // Skip file if any error found
      }        
      if ($_FILES['files']['error'][$f] == 0) {            
          if ($_FILES['files']['size'][$f] > $max_file_size) {
              $_SESSION["message"][] = "$name quá lớn!.";
              continue; // Skip large files
          }
      elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
        $_SESSION["message"][] = "$name không đúng kiểu";
        continue; // Skip invalid file formats
      }
          else{ // No error found! Move uploaded files 
              if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.(string)(count($files)-1).'_'.$name)) {
                $_SESSION["count"]++; // Number of successfully uploaded files
              }
          }
      }
  }
  header("Location: ../../PL/CapNhatFileCB/PLCapNhatCB.php");
}
?>