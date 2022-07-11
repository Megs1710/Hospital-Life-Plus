<?php	
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

	function sendOTP($email,$username,$OTP,$is_password_reset) 
	{
		$message_registration = "Your generated patient ID is:<br/><b>". $username ."<br/><br/>Your One Time Password for Patient Authentication is:<br/><b>" . $OTP . "</b>";
		$message_password_reset = "Your One Time Password for Password Reset is:<br/><br/><b>" . $OTP . "</b>";
		$message_body = $is_password_reset ? $message_password_reset : $message_registration;
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
		$mail->Port       = 465;
		$mail->Username   = 'lifeplus.goa@gmail.com';                     //SMTP username
		$mail->Password   = 'lifeplus101';                
		$mail->Host       = 'smtp.gmail.com';

		$mail->SetFrom('lifeplus.goa@gmail.com', 'Life Plus');
		$mail->AddAddress($email);
		$mail->Subject = $is_password_reset ? "OTP for password reset": "OTP for completing patient registration";
		$mail->MsgHTML($message_body);
		$mail->IsHTML(true);		
		$result = $mail->Send();
		
		return $result;
	}
?>