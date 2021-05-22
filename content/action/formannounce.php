<?php
    $mail_receiver = $_POST['mail_receiver'];
    $mail_subject = ucwords($_POST['mail_subject']);
    $mail_content = $_POST['mail_content'];
    if (isset($_POST['mail_cc'])) { $mail_cc = $_POST['mail_cc']; }
    if (isset($_POST['mail_bcc'])) { $mail_bcc = $_POST['mail_bcc']; }
    if (isset($_POST['mail_replyto'])) { $mail_replyto = $_POST['mail_replyto']; }
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    try {
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'mail.zesto.com.ph';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'genmar.dadivo@zesto.com.ph';
        $mail->Password   = 'P@ssword1';
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port       = 465;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->setFrom('info@zesto.com.ph', 'Zesto Mailer');
        $mail->addAddress('genmar.dadivo.25@gmail.com');
        // $mail->addAddress('ellen@example.com');
        // if (isset($_POST['mail_replyto'])) { $mail->addReplyTo($mail_replyto); }
        // if (isset($_POST['mail_cc'])) { $mail->addCC($mail_cc); }
        // if (isset($_POST['mail_bcc'])) { $mail->addBCC($mail_bcc); }
        $mail->isHTML(true);
        $mail->Subject = $mail_subject;
        $mail->Body    = $mail_content;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        echo 'Message has been sent';
    }
    catch (Exception $e) { echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; }
?>