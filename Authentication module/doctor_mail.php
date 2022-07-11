<?php	
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

	function sendDetails($email,$username,$password) 
	{
		$message_body = "Your Generated Doctor ID is:<br/><b>". $username ."<br/><br/>Your Generated Password is:<br/><b>" . $password . "</b>";
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
		$mail->Port       = 465;
		$mail->Username   = 'lifeplus.goa@gmail.com';   //SMTP username
		$mail->Password   = 'lifeplus101';                
		$mail->Host       = 'smtp.gmail.com';

		$mail->SetFrom('lifeplus.goa@gmail.com', 'Life Plus');
		$mail->AddAddress($email);
		$mail->Subject = "Registration Details";
		$mail->MsgHTML($message_body);
		$mail->IsHTML(true);		
		$result = $mail->Send();
		
		return $result;
	}
?>