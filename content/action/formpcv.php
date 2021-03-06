<?php
    date_default_timezone_set("Asia/Manila");
    require '../dbase/dbconfig.php';
    $daterequest = date('Y-m-d');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    $pcvno = preg_replace('/[^a-zA-Z0-9\']/', '', strtoupper($_POST['pcvno']));
    $payto = preg_replace('/[^a-zA-Z Ññ\']/', '', ucwords($_POST['payto']));
    $branch = $_POST['branch'];
    $description = $_POST['description'];
    $emailapprover = preg_replace('/[^a-zA-Z0-9. @#\']/', '', strtolower($_POST['emailapprover']));
    $emailrequest = preg_replace('/[^a-zA-Z0-9. @#\']/', '', strtolower($_POST['emailrequest']));
    $descriptionmerge = '';
    foreach ($description as $key => $descriptionvalue) {
        $descriptionmerge .=  preg_replace('/[^a-zA-Z0-9 @#\']/', '', ucwords($descriptionvalue)) . ',';
    }
    $amount = $_POST['amount'];
    $amountmerge = '';
    foreach ($amount as $key => $amountvalue) {
        $amountmerge .=  preg_replace('/[^a-zA-Z0-9\']/', '', $amountvalue). ',';
    }
	$commacount = substr_count($descriptionmerge, ",");
	$counter = 0;
	$descriptionsplitter = explode(",", $descriptionmerge);
	$amountsplitter = explode(",", $amountmerge);
	$particulars = '';
	while ($counter <= $commacount) {
		$particulars .= $descriptionsplitter[$counter] . " " . $amountsplitter[$counter] . "<br>";
		$counter++;
	}
	$link = "<a href='#link'> Click here to approve PCV.</a>";
    $sql = "SELECT pcvno FROM pcv WHERE pcvno = '$pcvno' AND branch = '$branch' ";
    $stm = $con->prepare($sql);
	$stm->execute();
    if ($stm->rowCount() == 0) {
        $sql = "INSERT INTO pcv (pcvno, branch, particulars, amount, payto, daterequest, emailapprover, emailrequest) VALUES ('$pcvno', '$branch', '$descriptionmerge', '$amountmerge', '$payto', '$daterequest', '$emailapprover', '$emailrequest')";
        $stm = $con->prepare($sql);
        $stm->execute();
        // SEND MAIL FOR APPROVER
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'developer.zesto@gmail.com';
        $mail->Password   = '12302112';
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port       = 465;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->setFrom('no-reply@zesto.com.ph', 'Zesto Mailer');
        $mail->addAddress($emailapprover);
		$mail->AddCC($emailrequest );
        $mail->isHTML(true);
        $mail->Subject = $pcvno;
        $mail->Body    = '
        <!DOCTYPE html>
		<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width,initial-scale=1">
			<meta name="x-apple-disable-message-reformatting">
			<title></title>
			<!--[if mso]>
			<noscript>
				<xml>
					<o:OfficeDocumentSettings>
						<o:PixelsPerInch>96</o:PixelsPerInch>
					</o:OfficeDocumentSettings>
				</xml>
			</noscript>
			<![endif]-->
			<style>
				table, td, div, h1, p {font-family: Arial, sans-serif;}
			</style>
		</head>
		<body style="margin:0;padding:0;">
		<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
		<tr>
		<td align="center" style="padding:0;">
		<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
		<tr>
		<td align="center" style="padding:40px 0 30px 0;background:#ffffff;">
		<img src="https://sa.kapamilya.com/absnews/abscbnnews/media/abs-cbnnews/a_images/graphics/logos/12313_zesto.jpg" alt="" width="300" style="height:auto;display:block;" />
		</td>
		</tr>
		<tr>
		<td style="padding:36px 30px 42px 30px;">
		<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
		<tr>
		<td style="padding:0 0 36px 0;color:#153643;">
		<h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">' .
		$pcvno .
		'</h1>
		<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
		<tr>
		<td align="center" style="padding:40px 0 30px 0;background:#ffffff;">
		Approver
		</td>
		</tr>
		</table>
		<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">' .
		$particulars
		. '</p>
		<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><a href="http://www.example.com" style="color:#ee4c50;text-decoration:underline;">' .
		$link
		.'</a></p>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
		<td style="padding:30px;background:#ee4c50;">
		<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
		<tr>
		<td style="padding:0;width:50%;" align="left">
		<p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
		&reg; Someone, Somewhere 2021<br/><a href="http://www.example.com" style="color:#ffffff;text-decoration:underline;">Unsubscribe</a>
		</p>
		</td>
		<td style="padding:0;width:50%;" align="right">
		<table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
		<tr>
		<td style="padding:0 0 0 10px;width:38px;">
		<a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
		</td>
		<td style="padding:0 0 0 10px;width:38px;">
		<a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</body>
		</html>
        ';
        $mail->send();
        echo "Data Entered.";
    }
    else { echo "Error Occured."; }
?>