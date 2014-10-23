<?php
  session_start();
  $filename = $_POST["filename"];
  unlink("../../upload/".$filename);

  header("Location: ../../PL/NhapFileCB/PLNhapFileCB.php");
?>