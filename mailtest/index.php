<?php
error_reporting(E_ALL);
require("Mail/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP(); // set mailer to use SMTP
$mail->SMTPDebug  = 2; 
$mail->From = "qlphonglag@gmail.com";
$mail->FromName = "Jiansen";
$mail->Host = "smtp.gmail.com"; // specif smtp server
$mail->SMTPSecure= "ssl"; // Used instead of TLS when only POP mail is selected
$mail->Port = 465; // Used instead of 587 when only POP mail is selected
$mail->SMTPAuth = true;
$mail->Username = "qlphonglag@gmail.com"; // SMTP username
$mail->Password = "admin123admin"; // SMTP password
$mail->AddAddress("thuc130495@gmail.com", "Jiansen"); //replace myname and mypassword to yours
$mail->AddReplyTo("thuc130495@gmail.com", "Jiansen");
$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("c:\\temp\\js-bak.sql"); // add attachments
//$mail->AddAttachment("c:/temp/11-10-00.zip");

$mail->IsHTML(true); // set email format to HTML
$mail->Subject = 'test';
$mail->Body = 'test';

if($mail->Send()) {echo "Send mail successfully";}
else {echo "Send mail fail";} 
?>