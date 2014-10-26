<?php
  session_start();
  $filename = $_POST["filename"];
  unlink("../../upload_capnhat/".$filename);

  header("Location: ../../PL/CapNhatFileCB/PLCapNhatCB.php");
?>