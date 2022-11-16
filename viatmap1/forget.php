<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

// initialize gmail smtp
date_default_timezone_set('Asia/Jakarta');
require 'vendor/autoload.php';
$mail = new PHPMailer();
$mail->isSMTP();
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->SMTPDebug = SMTP::DEBUG_OFF;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->SMTPAuth = true;
$mail->AuthType = 'XOAUTH2';

$email = 'sukma.bening42@gmail.com';
$clientId = '146968610148-6kej520qsfj0q554mhc3ogt02u149f9c.apps.googleusercontent.com';
$clientSecret = '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';

$refreshToken = '1//0g3a9eGZY0ed1CgYIARAAGBASNwF-L9IrYOjX0CoIpZUxL-VTXf5zM4NAs73zXXlW25I_jNpL7TlfiV9HKOtxt3cuZs8I7r1G1GE';

$provider = new Google(
	[
		'clientId' => $clientId,
		'clientSecret' => $clientSecret,
	]
);

$mail->setOAuth(
	new OAuth(
		[
			'provider' => $provider,
			'clientId' => $clientId,
			'clientSecret' => $clientSecret,
			'refreshToken' => $refreshToken,
			'userName' => $email,
		]
	)
);

$mail->setFrom($email, 'Sukma Bening');

include_once "conn.php";
$email = isset($_POST['email']) ? $_POST['email'] : false;
// forget password
$query = mysqli_query($connect, "SELECT * FROM `user` WHERE email = '" . $email . "'");
$cek = mysqli_num_rows($query);
if ($cek > 0) {
	$tampil = mysqli_fetch_assoc($query);
	// echo '{"email":"' . $tampil['email'] . '","induk":"' . $tampil['nomor_induk'] . '","nama":"' . $tampil['nama'] . '","pass":"' . $tampil['password'] . '","kelas":"' . $tampil['level'] . '","id":"' . $tampil['id_user'] . '","status":"berhasil"}';
	$mail->CharSet = PHPMailer::CHARSET_UTF8;

	$mail->addAddress($tampil['email'], $tampil['nama']);

	$mail->Subject = 'ViatMAP Forget Password';

	$mail->isHTML(true);
	$mail->Body = '<h2>Akun ViatMAP anda</h2><br>
	<b>E-mail: </b> ' . $tampil['email'] . '<br>
	<b>Password: </b> ' . $tampil['password'] . '<br>';

	// $mail->AltBody = 'This is a plain';

	if (!$mail->send()) {
		echo '{"email":"' . $email . '","status":"gagal", "message": "tidak kirim email", "data": "Mailer error: ' . $mail->ErrorInfo . '"}';
	} else {
		echo '{"status":"berhasil","message": "Check Your Email For Email and Password"}';
	}
} else {
	echo '{"email":"' . $email . '","status":"gagal","message": "email not found"}';
}
