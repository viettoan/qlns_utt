<?php  
if (($_POST['mail_from_name'] != "") &&
        ($_POST['mail_to'] != "") &&
            ($_POST['mail_subject'] != "") && 
                ($_POST['mail_body'] != "")) {
    $mail_from_name = $_POST['mail_from_name'];
    $mail_to = $_POST['mail_to'];
    $mail_subject = $_POST['mail_subject'];
    $mail_body = $_POST['mail_body'];
    require("../../../mailtest/Mail/class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->IsSMTP(); // set mailer to use SMTP
    $mail->SMTPDebug  = 2; 
    $mail->From = "qlphonglag@gmail.com";
    $mail->FromName = mb_encode_mimeheader($mail_from_name,"UTF-8");
    $mail->Host = "smtp.gmail.com"; // specif smtp server
    $mail->SMTPSecure= "ssl"; // Used instead of TLS when only POP mail is selected
    $mail->Port = 465; // Used instead of 587 when only POP mail is selected
    $mail->SMTPAuth = true;
    $mail->Username = "qlphonglag@gmail.com"; // SMTP username
    $mail->Password = "admin123admin"; // SMTP password
    //$mail->AddAddress($cu['mail'], "Password"); //replace myname and mypassword to yours
    //$mail->AddReplyTo($cu['mail'], "Password");
    $mail->AddAddress($mail_to, $mail_to);
    $mail->SMTPDebug = false;
    $mail->do_debug = 0;
    $mail->WordWrap = 50; // set word wrap
    //$mail->AddAttachment("c:\\temp\\js-bak.sql"); // add attachments
    //$mail->AddAttachment("c:/temp/11-10-00.zip");

    $mail->IsHTML(true); // set email format to HTML
    $mail->Subject = mb_encode_mimeheader($mail_subject,"UTF-8");
    $mail->Body = $mail_body;
    if($mail->Send())
         echo "<script>alert('Gửi đi thành công');window.location.replace(\"../BaoKyHopDong.php\");</script>";
} else {
    echo "Có lỗi xảy ra:<br>";
    echo "<ol>";
    if ($_POST['mail_from_name'] == '') {
        echo "<li>Thiếu tên người gửi</li>";
    }
    if ($_POST['mail_to'] == '') {
        echo "<li>Thiếu hòm thư người nhận</li>";
    }
    if ($_POST['mail_subject'] == '') {
        echo "<li>Thiếu tiêu đề</li>";
    }
    if ($_POST['mail_body'] == '') {
        echo "<li>Thiếu nội dung</li>";
    }
    echo "</ol>";
}
?>