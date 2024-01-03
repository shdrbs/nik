<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	function sendMail( $to_mail, $to_name, $from_mail, $from_name, $title, $content ){
		// lifwwngksxtbjmjc
		$mail = new PHPMailer(true);
	    //$mail->SMTPDebug  = 2;						//디버깅시 필요
		$mail -> CharSet   = "utf-8";					// 한글 인코딩
		$mail->SMTPAuth    = true;						// SMTP 인증을 사용함
		$mail->SMTPSecure  = 'ssl';						// SSL을 사용함
		$mail->isHTML(true);
		$mail->Host        = 'smtp.gmail.com';
		$mail->Port        = 465;
		$mail->Mailer      = 'smtp';
		$mail->Username    = 'wntmxld55@gmail.com';		// 메일 계정 주소
		$mail->Password    = 'lifwwngksxtbjmjc';		// 앱 비밀번호
		$mail->addAddress($to_mail, $to_name);			// 받는 사람 (이메일, 이름)
		$mail->setFrom($from_mail, $from_name);			// 보내는 사람 (이메일, 이름)
		$mail->Subject     = $title;					// 이메일 제목
		$mail->Body        = $content;					// 이메일 내용
		$mail->send();
	}

	//sendMail();
?>